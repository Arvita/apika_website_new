<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\CourseMaterialSection;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CrawlArvitaMaterials extends Command
{
    protected $signature = 'materials:crawl-arvita
        {--dry-run : Preview hasil crawl tanpa simpan database}
        {--reset : Hapus course lama yang slug-nya sama sebelum import}';

    protected $description = 'Crawl SABO and Pemrograman Dasar materials from arvitaagusk.com into slide/demo file format';

    private string $baseUrl = 'https://arvitaagusk.com';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $reset = (bool) $this->option('reset');

        $this->info('Crawling materi dari arvitaagusk.com...');
        $this->line($dryRun ? 'Mode: DRY RUN, tidak menyimpan database.' : 'Mode: IMPORT DATABASE.');

        foreach ($this->courseMap() as $courseData) {
            $this->newLine();
            $this->info("Course: {$courseData['title']}");

            if ($reset && ! $dryRun) {
                $existingCourse = Course::where('slug', $courseData['slug'])->first();

                if ($existingCourse) {
                    foreach ($existingCourse->materials as $material) {
                        foreach ($material->sections as $section) {
                            if (
                                $section->media_url &&
                                Str::startsWith($section->media_url, 'course-section-files/') &&
                                Storage::exists($section->media_url)
                            ) {
                                Storage::delete($section->media_url);
                            }
                        }
                    }

                    $existingCourse->delete();
                    $this->warn("Existing course '{$courseData['slug']}' dihapus.");
                }
            }

            $course = null;

            if (! $dryRun) {
                $course = Course::updateOrCreate(
                    ['slug' => $courseData['slug']],
                    [
                        'title' => $courseData['title'],
                        'title_en' => $courseData['title_en'] ?? null,
                        'summary' => $courseData['summary'] ?? null,
                        'summary_en' => $courseData['summary_en'] ?? null,
                        'intro' => $courseData['intro'] ?? ($courseData['summary'] ?? null),
                        'intro_en' => $courseData['intro_en'] ?? ($courseData['summary_en'] ?? null),
                        'category' => $courseData['category'] ?? null,
                        'level' => $courseData['level'] ?? null,
                        'is_featured' => $courseData['is_featured'] ?? false,
                        'is_published' => true,
                        'published_at' => now(),
                        'sort_order' => $courseData['sort_order'] ?? 0,
                        'meta_title' => $courseData['title'],
                        'meta_description' => Str::limit(strip_tags($courseData['summary'] ?? ''), 155),
                    ]
                );
            }

            foreach ($courseData['materials'] as $materialData) {
                $this->line(" - {$materialData['title']}");
                $this->line("   URL: {$materialData['url']}");

                $page = $this->crawlPage($materialData['url']);

                if (! $page['html']) {
                    $this->warn('   Halaman gagal diambil. Dilewati.');
                    continue;
                }

                $title = $page['title'] ?: $materialData['title'];
                $summary = $materialData['summary'] ?: ($page['summary'] ?: 'Materi pembelajaran dari arvitaagusk.com.');

                $filePath = $this->buildStoragePath($courseData['slug'], $materialData['slug']);

                if ($dryRun) {
                    $this->line("   Title: {$title}");
                    $this->line("   File: {$filePath}");
                    $this->line("   Type: slide");
                    continue;
                }

                Storage::put($filePath, $this->preparePhpFile($page['html'], $materialData['url']));

                $material = CourseMaterial::updateOrCreate(
                    [
                        'course_id' => $course->id,
                        'slug' => $materialData['slug'],
                    ],
                    [
                        'title' => $title,
                        'title_en' => $materialData['title_en'] ?? null,
                        'week_label' => $materialData['week_label'] ?? null,
                        'week_number' => $materialData['week_number'] ?? null,
                        'summary' => $summary,
                        'summary_en' => $materialData['summary_en'] ?? null,
                        'content' => $summary,
                        'content_en' => $materialData['summary_en'] ?? null,
                        'material_type' => $materialData['material_type'] ?? 'lesson',
                        'external_url' => $materialData['url'],
                        'file_path' => $filePath,
                        'related_video_url' => null,
                        'is_published' => true,
                        'published_at' => now(),
                        'sort_order' => $materialData['sort_order'] ?? ($materialData['week_number'] ?? 0),
                        'meta_title' => $title . ' | ' . $courseData['title'],
                        'meta_description' => Str::limit(strip_tags($summary), 155),
                    ]
                );

                foreach ($material->sections as $section) {
                    if (
                        $section->media_url &&
                        Str::startsWith($section->media_url, 'course-section-files/') &&
                        Storage::exists($section->media_url) &&
                        $section->media_url !== $filePath
                    ) {
                        Storage::delete($section->media_url);
                    }
                }

                $material->sections()->delete();

                CourseMaterialSection::create([
                    'course_material_id' => $material->id,
                    'title' => $title,
                    'title_en' => $materialData['title_en'] ?? null,
                    'type' => 'slide',
                    'body' => $summary,
                    'body_en' => $materialData['summary_en'] ?? null,
                    'code' => null,
                    'code_language' => null,
                    'media_url' => $filePath,
                    'button_label' => 'Buka sumber asli',
                    'button_url' => $materialData['url'],
                    'sort_order' => 1,
                    'is_published' => true,
                ]);

                $this->info("   Imported as slide file: {$filePath}");
            }
        }

        $this->newLine();
        $this->info('Selesai.');

        return self::SUCCESS;
    }

    private function crawlPage(string $url): array
    {
        try {
            $response = Http::timeout(40)
                ->retry(2, 700)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (compatible; ArvitaAcademicCrawler/1.0)',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                ])
                ->get($url);

            if (! $response->successful()) {
                $this->warn("   Gagal fetch {$url}. Status: {$response->status()}");

                return [
                    'html' => null,
                    'title' => null,
                    'summary' => null,
                ];
            }

            $html = $response->body();

            return [
                'html' => $html,
                'title' => $this->extractTitle($html),
                'summary' => $this->extractSummary($html),
            ];
        } catch (\Throwable $e) {
            $this->warn("   Error fetch {$url}: {$e->getMessage()}");

            return [
                'html' => null,
                'title' => null,
                'summary' => null,
            ];
        }
    }

    private function buildStoragePath(string $courseSlug, string $materialSlug): string
    {
        return 'course-section-files/' . $courseSlug . '-' . $materialSlug . '.php';
    }

    private function preparePhpFile(string $html, string $pageUrl): string
    {
        $html = trim($html);

        if (Str::contains($html, ['<?php', '<?='])) {
            return $html;
        }

        $baseTag = '<base href="' . htmlspecialchars($pageUrl, ENT_QUOTES, 'UTF-8') . '">';

        if (preg_match('/<head([^>]*)>/i', $html)) {
            $html = preg_replace('/<head([^>]*)>/i', '<head$1>' . PHP_EOL . $baseTag, $html, 1) ?: $html;

            return $html;
        }

        return '<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    ' . $baseTag . '
</head>
<body>
' . $html . '
</body>
</html>';
    }

    private function extractTitle(string $html): ?string
    {
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);

        $xpath = new \DOMXPath($dom);

        foreach (['//h1', '//title'] as $query) {
            $node = $xpath->query($query)?->item(0);

            if ($node) {
                $title = $this->cleanText($node->textContent);

                if ($title !== '') {
                    return $title;
                }
            }
        }

        return null;
    }

    private function extractSummary(string $html): ?string
    {
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);

        $xpath = new \DOMXPath($dom);

        $meta = $xpath->query('//meta[@name="description"]')?->item(0);

        if ($meta instanceof \DOMElement) {
            $description = $this->cleanText($meta->getAttribute('content'));

            if ($description !== '') {
                return Str::limit($description, 220);
            }
        }

        $paragraph = $xpath->query('//p')?->item(0);

        if ($paragraph) {
            $text = $this->cleanText($paragraph->textContent);

            if ($text !== '') {
                return Str::limit($text, 220);
            }
        }

        return null;
    }

    private function cleanText(?string $text): string
    {
        $text = html_entity_decode($text ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\x{00A0}/u', ' ', $text);
        $text = preg_replace('/\s+/u', ' ', $text);

        return trim($text ?? '');
    }

    private function courseMap(): array
    {
        return [
            [
                'title' => 'Pemrograman Dasar',
                'title_en' => 'Basic Programming',
                'slug' => 'pemrograman-dasar',
                'summary' => 'Konsep fundamental yang membentuk fondasi untuk membuat program komputer.',
                'summary_en' => 'Fundamental concepts that build the foundation for creating computer programs.',
                'intro' => 'Course ini berisi materi Pemrograman Dasar yang ditampilkan sebagai file demo interaktif.',
                'intro_en' => 'This course contains Basic Programming materials displayed as interactive demo files.',
                'category' => 'Programming',
                'level' => 'Beginner',
                'is_featured' => true,
                'sort_order' => 1,
                'materials' => [
                    [
                        'title' => 'Form dan Input',
                        'slug' => 'form-dan-input',
                        'week_label' => 'Minggu 9',
                        'week_number' => 9,
                        'summary' => 'Elemen antarmuka pengguna untuk mengumpulkan data dari pengguna.',
                        'url' => $this->baseUrl . '/pemrograman-dasar/minggu-9',
                        'material_type' => 'lesson',
                        'sort_order' => 9,
                    ],
                    [
                        'title' => 'Validasi Form',
                        'slug' => 'validasi-form',
                        'week_label' => 'Minggu 10',
                        'week_number' => 10,
                        'summary' => 'Proses memeriksa data yang dimasukkan pengguna agar sesuai aturan sebelum diproses.',
                        'url' => $this->baseUrl . '/pemrograman-dasar/minggu-10',
                        'material_type' => 'lesson',
                        'sort_order' => 10,
                    ],
                    [
                        'title' => 'String dan Manipulasi',
                        'slug' => 'string-dan-manipulasi',
                        'week_label' => 'Minggu 11',
                        'week_number' => 11,
                        'summary' => 'Operasi string untuk mengubah, memproses, dan memodifikasi teks.',
                        'url' => $this->baseUrl . '/pemrograman-dasar/minggu-11',
                        'material_type' => 'lesson',
                        'sort_order' => 11,
                    ],
                    [
                        'title' => 'File Handling',
                        'slug' => 'file-handling',
                        'week_label' => 'Minggu 12',
                        'week_number' => 12,
                        'summary' => 'Proses membuka, membaca, menulis, dan menutup file untuk menyimpan atau mengambil data.',
                        'url' => $this->baseUrl . '/pemrograman-dasar/minggu-12',
                        'material_type' => 'lesson',
                        'sort_order' => 12,
                    ],
                    [
                        'title' => 'Pemecahan Masalah dan Debugging',
                        'slug' => 'pemecahan-masalah-dan-debugging',
                        'week_label' => 'Minggu 13',
                        'week_number' => 13,
                        'summary' => 'Proses mencari dan memperbaiki kesalahan dalam kode perangkat lunak.',
                        'url' => $this->baseUrl . '/pemrograman-dasar/minggu-13',
                        'material_type' => 'lesson',
                        'sort_order' => 13,
                    ],
                    [
                        'title' => 'Game Tebak Kode',
                        'slug' => 'game-tebak-kode',
                        'week_label' => 'Minggu 14',
                        'week_number' => 14,
                        'summary' => 'Game interaktif untuk latihan membaca potongan kode PHP dan HTML.',
                        'url' => $this->baseUrl . '/pemrograman-dasar/minggu-14',
                        'material_type' => 'game',
                        'sort_order' => 14,
                    ],
                    [
                        'title' => 'Mini Project',
                        'slug' => 'mini-project',
                        'week_label' => 'Minggu 15',
                        'week_number' => 15,
                        'summary' => 'Mini project untuk menerapkan konsep pemrograman dasar.',
                        'url' => $this->baseUrl . '/pemrograman-dasar/minggu-15',
                        'material_type' => 'project',
                        'sort_order' => 15,
                    ],
                ],
            ],
            [
                'title' => 'Object-Oriented Programming',
                'title_en' => 'Object-Oriented Programming',
                'slug' => 'sabo',
                'summary' => 'Paradigma pemrograman yang menyusun kode berdasarkan objek dan data, bukan fungsi atau logika saja.',
                'summary_en' => 'A programming paradigm that organizes code around objects and data.',
                'intro' => 'Course ini berisi materi Sistem Aplikasi Berbasis Object yang ditampilkan sebagai file demo interaktif.',
                'intro_en' => 'This course contains Object-Oriented Programming materials displayed as interactive demo files.',
                'category' => 'Programming',
                'level' => 'Intermediate',
                'is_featured' => true,
                'sort_order' => 2,
                'materials' => [
                    [
                        'title' => 'Static Method dan Static Property',
                        'slug' => 'static-method-dan-static-property',
                        'week_label' => 'Minggu 9',
                        'week_number' => 9,
                        'summary' => 'Konsep static sebagai milik class, bukan objek hasil instansiasi.',
                        'url' => $this->baseUrl . '/sabo/minggu-9',
                        'material_type' => 'lesson',
                        'sort_order' => 9,
                    ],
                    [
                        'title' => 'Namespace dan Autoloading',
                        'slug' => 'namespace-dan-autoloading',
                        'week_label' => 'Minggu 10',
                        'week_number' => 10,
                        'summary' => 'Namespace untuk mengelompokkan class dan autoloading untuk memuat class otomatis.',
                        'url' => $this->baseUrl . '/sabo/minggu-10',
                        'material_type' => 'lesson',
                        'sort_order' => 10,
                    ],
                    [
                        'title' => 'Exception Handling',
                        'slug' => 'exception-handling',
                        'week_label' => 'Minggu 11',
                        'week_number' => 11,
                        'summary' => 'Mekanisme menangani error secara elegan agar aplikasi tidak langsung crash.',
                        'url' => $this->baseUrl . '/sabo/minggu-11',
                        'material_type' => 'lesson',
                        'sort_order' => 11,
                    ],
                    [
                        'title' => 'Relasi Antar Objek',
                        'slug' => 'relasi-antar-objek',
                        'week_label' => 'Minggu 12',
                        'week_number' => 12,
                        'summary' => 'Konsep hubungan antar class seperti dependency, association, aggregation, dan composition.',
                        'url' => $this->baseUrl . '/sabo/minggu-12',
                        'material_type' => 'lesson',
                        'sort_order' => 12,
                    ],
                    [
                        'title' => 'Prinsip SOLID',
                        'slug' => 'prinsip-solid',
                        'week_label' => 'Minggu 13',
                        'week_number' => 13,
                        'summary' => 'Lima prinsip desain untuk membuat kode OOP lebih mudah dipelihara dan dikembangkan.',
                        'url' => $this->baseUrl . '/sabo/minggu-13',
                        'material_type' => 'lesson',
                        'sort_order' => 13,
                    ],
                    [
                        'title' => 'Studi Kasus Aplikasi OOP',
                        'slug' => 'studi-kasus-aplikasi-oop',
                        'week_label' => 'Minggu 14',
                        'week_number' => 14,
                        'summary' => 'Studi kasus untuk menggabungkan konsep class, inheritance, polymorphism, encapsulation, dan interface.',
                        'url' => $this->baseUrl . '/sabo/minggu-14',
                        'material_type' => 'lesson',
                        'sort_order' => 14,
                    ],
                    [
                        'title' => 'OOP Memory Match',
                        'slug' => 'oop-memory-match',
                        'week_label' => 'Minggu 14',
                        'week_number' => 14,
                        'summary' => 'Game interaktif untuk mencocokkan konsep OOP dengan keyword PHP.',
                        'url' => $this->baseUrl . '/sabo/minggu-14-1',
                        'material_type' => 'game',
                        'sort_order' => 15,
                    ],
                    [
                        'title' => 'Unified Modeling Language',
                        'slug' => 'unified-modeling-language',
                        'week_label' => 'Minggu 14',
                        'week_number' => 14,
                        'summary' => 'Pengenalan UML sebagai blueprint perangkat lunak.',
                        'url' => $this->baseUrl . '/sabo/minggu-14-2',
                        'material_type' => 'lesson',
                        'sort_order' => 16,
                    ],
                    [
                        'title' => 'Mini Project Aplikasi Berbasis OOP',
                        'slug' => 'mini-project-aplikasi-berbasis-oop',
                        'week_label' => 'Minggu 15',
                        'week_number' => 15,
                        'summary' => 'Mini project untuk menguji pemahaman arsitektur OOP dalam aplikasi fungsional.',
                        'url' => $this->baseUrl . '/sabo/minggu-15',
                        'material_type' => 'project',
                        'sort_order' => 17,
                    ],
                ],
            ],
        ];
    }
}