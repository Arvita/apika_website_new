<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\CourseMaterialSection;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CrawlArvitaMaterials extends Command
{
    protected $signature = 'materials:crawl-arvita
        {--dry-run : Preview hasil crawl tanpa simpan database}
        {--reset : Hapus course lama yang slug-nya sama sebelum import}';

    protected $description = 'Crawl course materials from old arvitaagusk.com pages into dynamic course/material tables';

    private string $baseUrl = 'https://arvitaagusk.com';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $reset = (bool) $this->option('reset');

        $this->info('Crawling materi lama dari arvitaagusk.com...');
        $this->line($dryRun ? 'Mode: DRY RUN, tidak menyimpan database.' : 'Mode: IMPORT DATABASE.');

        foreach ($this->courseMap() as $courseData) {
            $this->newLine();
            $this->info("Course: {$courseData['title']}");

            if ($reset && ! $dryRun) {
                Course::where('slug', $courseData['slug'])->delete();
                $this->warn("Existing course '{$courseData['slug']}' dihapus.");
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
                        'category' => $courseData['category'] ?? null,
                        'level' => $courseData['level'] ?? null,
                        'is_featured' => $courseData['is_featured'] ?? false,
                        'is_published' => true,
                        'published_at' => now(),
                        'sort_order' => $courseData['sort_order'] ?? 0,
                    ]
                );
            }

            foreach ($courseData['materials'] as $materialData) {
                $this->line(" - {$materialData['title']}");

                $page = $this->crawlPage($materialData['url']);

                $title = $page['title'] ?: $materialData['title'];
                $sections = $page['sections'];

                if ($dryRun) {
                    $this->line("   URL: {$materialData['url']}");
                    $this->line("   Sections: " . count($sections));

                    foreach (array_slice($sections, 0, 4) as $section) {
                        $this->line("     - {$section['title']}");
                    }

                    continue;
                }

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
                        'summary' => $materialData['summary'] ?? $page['summary'],
                        'content' => $page['intro'],
                        'material_type' => $materialData['material_type'] ?? 'lesson',
                        'external_url' => $materialData['url'],
                        'is_published' => true,
                        'published_at' => now(),
                        'sort_order' => $materialData['sort_order'] ?? ($materialData['week_number'] ?? 0),
                        'meta_title' => $title . ' | ' . $courseData['title'],
                        'meta_description' => Str::limit(strip_tags($materialData['summary'] ?? $page['summary'] ?? ''), 155),
                    ]
                );

                $material->sections()->delete();

                foreach ($sections as $index => $section) {
                    CourseMaterialSection::create([
                        'course_material_id' => $material->id,
                        'title' => $section['title'],
                        'type' => $section['type'],
                        'body' => $section['body'],
                        'code' => $section['code'],
                        'code_language' => $section['code_language'],
                        'media_url' => null,
                        'button_label' => null,
                        'button_url' => null,
                        'sort_order' => $index + 1,
                        'is_published' => true,
                    ]);
                }

                $this->line("   Imported sections: " . count($sections));
            }
        }

        $this->newLine();
        $this->info('Selesai.');

        return self::SUCCESS;
    }

    private function crawlPage(string $url): array
    {
        try {
            $response = Http::timeout(30)
                ->retry(2, 500)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 ArvitaAcademicCrawler/1.0',
                    'Accept' => 'text/html,application/xhtml+xml',
                ])
                ->get($url);

            if (! $response->successful()) {
                $this->warn("   Gagal fetch {$url}. Status: {$response->status()}");

                return [
                    'title' => null,
                    'summary' => null,
                    'intro' => null,
                    'sections' => [],
                ];
            }

            return $this->parseHtml($response->body());
        } catch (\Throwable $e) {
            $this->warn("   Error fetch {$url}: {$e->getMessage()}");

            return [
                'title' => null,
                'summary' => null,
                'intro' => null,
                'sections' => [],
            ];
        }
    }

    private function parseHtml(string $html): array
    {
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);

        $xpath = new \DOMXPath($dom);

        foreach ($xpath->query('//script|//style|//nav|//footer|//header|//noscript') as $node) {
            $node->parentNode?->removeChild($node);
        }

        $title = $this->firstText($xpath, '//h1') ?: $this->firstText($xpath, '//title');

        $h2Nodes = $xpath->query('//h2');

        $sections = [];

        foreach ($h2Nodes as $h2) {
            $sectionTitle = $this->cleanText($h2->textContent);

            if (! $sectionTitle || $this->shouldSkipSection($sectionTitle)) {
                continue;
            }

            $body = $this->collectUntilNextHeading($h2);

            if (! $body) {
                continue;
            }

            $cleanBody = $this->cleanBody($body);

            if (! $cleanBody) {
                continue;
            }

            [$type, $code, $language] = $this->detectSectionType($sectionTitle, $cleanBody);

            $sections[] = [
                'title' => $sectionTitle,
                'type' => $type,
                'body' => $type === 'code' ? null : $cleanBody,
                'code' => $code,
                'code_language' => $language,
            ];
        }

        $summary = null;

        if (count($sections)) {
            $summary = Str::limit($sections[0]['body'] ?: $sections[0]['code'] ?: '', 220);
        }

        return [
            'title' => $title,
            'summary' => $summary,
            'intro' => $summary,
            'sections' => $sections,
        ];
    }

    private function firstText(\DOMXPath $xpath, string $query): ?string
    {
        $node = $xpath->query($query)?->item(0);

        if (! $node) {
            return null;
        }

        return $this->cleanText($node->textContent);
    }

    private function collectUntilNextHeading(\DOMNode $start): string
    {
        $texts = [];
        $node = $start->nextSibling;

        while ($node) {
            if ($node instanceof \DOMElement && in_array(strtolower($node->tagName), ['h1', 'h2'], true)) {
                break;
            }

            $text = $this->nodeText($node);

            if ($text) {
                $texts[] = $text;
            }

            $node = $node->nextSibling;
        }

        return implode("\n", array_filter($texts));
    }

    private function nodeText(\DOMNode $node): string
    {
        if ($node instanceof \DOMText) {
            return $this->cleanText($node->textContent);
        }

        if (! $node instanceof \DOMElement) {
            return '';
        }

        $tag = strtolower($node->tagName);

        if (in_array($tag, ['script', 'style', 'button', 'svg'], true)) {
            return '';
        }

        $text = $node->textContent ?? '';

        return $this->cleanText($text);
    }

    private function cleanText(?string $text): string
    {
        $text = html_entity_decode($text ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\x{00A0}/u', ' ', $text);
        $text = preg_replace('/[ \t]+/', ' ', $text);
        $text = preg_replace('/\n{3,}/', "\n\n", $text);

        return trim($text ?? '');
    }

    private function cleanBody(string $body): string
    {
        $lines = preg_split('/\R/u', $body) ?: [];

        $clean = [];

        foreach ($lines as $line) {
            $line = $this->cleanText($line);

            if ($line === '') {
                continue;
            }

            if ($this->isNoiseLine($line)) {
                continue;
            }

            $clean[] = $line;
        }

        $clean = array_values(array_unique($clean));

        return trim(implode("\n", $clean));
    }

    private function isNoiseLine(string $line): bool
    {
        $lower = Str::lower($line);

        $noise = [
            'sebelumnya berikutnya',
            'sebelumnya mulai ulang',
            'presentasi',
            'copyright',
            '©',
            'sign in',
            'sign up',
            'email password',
        ];

        foreach ($noise as $item) {
            if (str_contains($lower, $item)) {
                return true;
            }
        }

        return false;
    }

    private function shouldSkipSection(string $title): bool
    {
        $lower = Str::lower($title);

        return in_array($lower, [
            'download materi',
        ], true);
    }

    private function detectSectionType(string $title, string $body): array
    {
        $sample = Str::lower($title . "\n" . $body);

        $looksLikeCode = str_contains($body, '<?php')
            || preg_match('/\$[a-zA-Z_][a-zA-Z0-9_]*/', $body)
            || str_contains($body, 'function ')
            || str_contains($body, 'class ')
            || str_contains($body, 'echo ')
            || str_contains($body, '<form')
            || str_contains($body, '<input')
            || str_contains($body, '</');

        if ($looksLikeCode) {
            $language = 'php';

            if (str_contains($sample, '<form') || str_contains($sample, '<input') || str_contains($sample, '<textarea')) {
                $language = 'html';
            }

            return ['code', $body, $language];
        }

        return ['content', null, null];
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