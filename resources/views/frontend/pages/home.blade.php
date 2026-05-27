@extends('frontend.layouts.app')

@php
    $locale = session('locale', app()->getLocale() ?: 'id');
    $locale = in_array($locale, ['id', 'en']) ? $locale : 'id';

    $copy = [
        'id' => [
            'seoTitle' => 'Arvita Agus Kurniasari | Website Akademik dan Materi Pembelajaran',
            'seoDescription' =>
                'Website akademik Arvita Agus Kurniasari untuk materi kuliah, publikasi ilmiah, video pembelajaran, riset, portfolio, dan bimbingan mahasiswa.',

            'badge' => 'Human Academic',
            'title' => 'Belajar, membaca, dan menonton dengan nyaman.',
            'subtitle' =>
                'Website akademik Arvita Agus Kurniasari dirancang sebagai ruang belajar yang hangat: mahasiswa mudah menemukan materi, pembaca mudah memahami publikasi, dan pengunjung bisa menonton video pembelajaran tanpa distraksi.',
            'ctaPrimary' => 'Mulai belajar',
            'ctaSecondary' => 'Baca jurnal',
            'modeText' =>
                'Pengunjung bisa memilih jalur: belajar materi, membaca jurnal, melihat profil akademik, atau menonton video.',
            'quickAccess' => 'Quick access',
            'learningNote' => 'Buat website terasa seperti meja kerja dosen: terarah, rapi, dan manusiawi.',

            'learn' => 'Belajar',
            'journal' => 'Jurnal',
            'video' => 'Video',

            'learnEyebrow' => 'Ruang belajar',
            'learnTitle' => 'Materi kuliah dibuat runtut dan tidak melelahkan.',
            'learnDesc' =>
                'Halaman materi punya alur: ringkasan, tujuan pembelajaran, materi utama, contoh kode, latihan, dan navigasi minggu berikutnya.',
            'openMaterial' => 'Lihat materi',

            'journalEyebrow' => 'Perpustakaan jurnal',
            'journalTitle' => 'Publikasi tetap lengkap, tapi lebih enak dibaca.',
            'journalDesc' =>
                'Bagian jurnal tidak hanya menampilkan data publikasi, tapi juga akses ke SINTA, Google Scholar, Scopus, dan konten bimbingan.',
            'journalNote' => 'Preview abstract, citation, keywords, DOI, dan tautan profil akademik tetap tersedia.',
            'oldContentTitle' => 'Konten lama tetap hidup.',
            'oldContentDesc' =>
                'Jurnal tidak berdiri sendiri. Bagian ini menghubungkan publikasi dengan profil eksternal dan bimbingan mahasiswa.',

            'videoEyebrow' => 'Ruang video',
            'videoTitle' => 'Video pembelajaran terasa terkurasi.',
            'videoDesc' =>
                'Video disusun sebagai playlist belajar dengan ringkasan, durasi, topik, dan relasi ke materi kuliah.',
            'featuredVideo' => 'Memahami Class dan Object',

            'researchEyebrow' => 'Research focus',
            'researchTitle' => 'Riset tetap terlihat, tapi tidak mendominasi.',
            'researchDesc' =>
                'Area riset menjadi penghubung antara jurnal, course, video, portfolio, dan bimbingan mahasiswa.',
        ],

        'en' => [
            'seoTitle' => 'Arvita Agus Kurniasari | Academic Learning Hub',
            'seoDescription' =>
                'Academic website of Arvita Agus Kurniasari containing course materials, scientific publications, learning videos, research, portfolio, and student supervision.',

            'badge' => 'Human Academic',
            'title' => 'Learn, read, and watch comfortably.',
            'subtitle' =>
                'Arvita Agus Kurniasari’s academic website is designed as a warm learning hub: students can find course materials, readers can understand publications, and visitors can watch learning videos without distraction.',
            'ctaPrimary' => 'Start learning',
            'ctaSecondary' => 'Read journals',
            'modeText' =>
                'Visitors can choose their path: study materials, read publications, view academic profiles, or watch videos.',
            'quickAccess' => 'Quick access',
            'learningNote' => 'Make the website feel like a lecturer’s desk: structured, warm, organized, and human.',

            'learn' => 'Learn',
            'journal' => 'Journals',
            'video' => 'Videos',

            'learnEyebrow' => 'Learning space',
            'learnTitle' => 'Course materials should feel structured and readable.',
            'learnDesc' =>
                'Each material page should include a summary, learning outcomes, main content, code examples, exercises, and next-week navigation.',
            'openMaterial' => 'Open material',

            'journalEyebrow' => 'Journal library',
            'journalTitle' => 'Publications stay complete, but easier to read.',
            'journalDesc' =>
                'The journal section keeps publication data while connecting readers to SINTA, Google Scholar, Scopus, and supervision content.',
            'journalNote' => 'Abstract preview, citation, keywords, DOI, and academic profile links remain available.',
            'oldContentTitle' => 'Existing content stays visible.',
            'oldContentDesc' => 'Journals should connect to external academic profiles and supervised student work.',

            'videoEyebrow' => 'Video room',
            'videoTitle' => 'Learning videos feel curated.',
            'videoDesc' =>
                'Videos are organized as learning playlists with summaries, duration, topics, and related course materials.',
            'featuredVideo' => 'Understanding Class and Object',

            'researchEyebrow' => 'Research focus',
            'researchTitle' => 'Research stays visible, but does not dominate.',
            'researchDesc' => 'Research areas connect journals, courses, videos, portfolio, and student supervision.',
        ],
    ];

    $externalLinks = [
        'sinta' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6757351',
        'scholar' => 'https://scholar.google.com/citations?hl=en&user=Yn7_99QAAAAJ',
        'scopus' => 'https://sinta.kemdiktisaintek.go.id/authors/scopusanalysis/6757351',
        'github' => 'https://github.com/Arvita',
        'youtube' => 'https://www.youtube.com/channel/UCU5lYacwXkUkYaX6AZ1WnGQ',
        'jti' => 'https://jti.polije.ac.id/jtipolije/public/dosen',
        'email' => 'mailto:arvita@polije.com',
    ];
    $t = $copy[$locale];

    $learningPaths = [
        [
            'title_id' => 'Pemrograman Dasar',
            'title_en' => 'Programming Fundamentals',
            'weeks' => '14 minggu',
            'desc_id' => 'Form, validasi, debugging, file handling, mini project.',
            'desc_en' => 'Forms, validation, debugging, file handling, and mini projects.',
            'tag' => 'Beginner',
        ],
        [
            'title_id' => 'Object-Oriented Programming',
            'title_en' => 'Object-Oriented Programming',
            'weeks' => '14 minggu',
            'desc_id' => 'Class, object, namespace, exception, relasi objek, SOLID, UML, PHP.',
            'desc_en' => 'Classes, objects, namespaces, exceptions, object relations, SOLID, UML, and PHP.',
            'tag' => 'Core skill',
        ],
        [
            'title_id' => 'Microsoft Office',
            'title_en' => 'Microsoft Office',
            'weeks' => 'Praktikum',
            'desc_id' => 'Produktivitas akademik, laporan, presentasi, dan pengolahan data.',
            'desc_en' => 'Academic productivity, reports, presentations, and data processing.',
            'tag' => 'Practical',
        ],
    ];

    $journals = [
        [
            'title' => 'Learning media development for programming education',
            'year' => '2025',
            'field' => 'Education Technology',
            'read' => '7 min overview',
        ],
        [
            'title' => 'Applied informatics approach for visual data and image processing',
            'year' => '2024',
            'field' => 'Image Processing',
            'read' => '9 min overview',
        ],
        [
            'title' => 'IoT-based prototype for interactive academic environments',
            'year' => '2024',
            'field' => 'Internet of Things',
            'read' => '6 min overview',
        ],
    ];

    $academicLinks = [
        [
            'title' => 'SINTA',
            'desc_id' => 'Profil indeks nasional dan rekam publikasi dosen.',
            'desc_en' => 'National academic index profile and publication records.',
        ],
        [
            'title' => 'Google Scholar',
            'desc_id' => 'Citation, artikel, dan riwayat sitasi akademik.',
            'desc_en' => 'Citations, articles, and academic citation history.',
        ],
        [
            'title' => 'Scopus',
            'desc_id' => 'Publikasi terindeks dan author profile internasional.',
            'desc_en' => 'Indexed publications and international author profile.',
        ],
        [
            'title' => $locale === 'en' ? 'Supervision' : 'Bimbinganku',
            'desc_id' => 'Daftar bimbingan, topik mahasiswa, dan supervised projects.',
            'desc_en' => 'Student supervision list, topics, and supervised projects.',
        ],
    ];

    $videos = [
        [
            'title_id' => 'Pengantar Pemrograman Dasar',
            'title_en' => 'Introduction to Programming Fundamentals',
            'length' => '18:24',
            'topic' => 'Course intro',
        ],
        [
            'title_id' => 'Memahami Class dan Object',
            'title_en' => 'Understanding Class and Object',
            'length' => '22:10',
            'topic' => 'OOP',
        ],
        [
            'title_id' => 'Debugging untuk Mahasiswa',
            'title_en' => 'Debugging for Students',
            'length' => '14:05',
            'topic' => 'Practice',
        ],
    ];

    $researchAreas = [
        [
            'title' => 'Web Development',
            'desc_id' => 'Learning platforms & academic systems.',
            'desc_en' => 'Learning platforms and academic systems.',
        ],
        [
            'title' => 'Internet of Things',
            'desc_id' => 'Applied devices and prototypes.',
            'desc_en' => 'Applied devices and prototypes.',
        ],
        [
            'title' => 'Image Processing',
            'desc_id' => 'Computer vision and visual data.',
            'desc_en' => 'Computer vision and visual data.',
        ],
        [
            'title' => 'Augmented Reality',
            'desc_id' => 'Interactive learning experiences.',
            'desc_en' => 'Interactive learning experiences.',
        ],
    ];
@endphp

@section('title', $t['seoTitle'])
@section('meta_description', $t['seoDescription'])

@section('content')
    <main x-data="{ activeMode: 'learn' }" class="mx-auto max-w-6xl px-4 pb-12 pt-6 sm:px-6">
        <section class="grid items-start gap-10 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <div
                    class="inline-flex rotate-[-1deg] items-center gap-2 rounded-full border border-[#d8e2d2] bg-[#eaf0e6] px-3 py-1 text-xs font-bold text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                    {{ $t['badge'] }}
                </div>

                <h1 class="mt-7 max-w-3xl text-4xl font-black leading-[0.98] tracking-[-0.055em] sm:text-5xl md:text-7xl">
                    {{ $t['title'] }}
                </h1>

                <p class="mt-6 max-w-xl text-base leading-8 text-[#6b6258] dark:text-[#bdb4a7] sm:text-lg">
                    {{ $t['subtitle'] }}
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('courses.index') }}"
                        class="inline-flex items-center gap-2 rounded-full bg-[#4f6f52] px-5 py-3 text-sm font-black text-white transition hover:-translate-y-0.5 dark:bg-[#9caf88] dark:text-[#151b18]">
                        {{ $t['ctaPrimary'] }}
                        <span>→</span>
                    </a>

                    <a href="{{ route('publications.index') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-[#e3d8c8] bg-[#fffaf2] px-5 py-3 text-sm font-black transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-[#1f2722]">
                        {{ $t['ctaSecondary'] }}
                    </a>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-[1fr_0.85fr]">
                <div
                    class="relative min-h-[430px] overflow-hidden rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2] p-4 shadow-xl dark:border-white/10 dark:bg-[#1f2722]">
                    <div
                        class="absolute inset-x-6 top-6 h-60 rounded-[1.5rem] bg-gradient-to-br from-[#4f6f52] to-[#7b8f68] opacity-95 dark:from-[#7f9869] dark:to-[#b89b58]">
                    </div>
                    <div class="absolute inset-x-10 top-12 h-52 rounded-[40%_60%_55%_45%] bg-white/20"></div>

                    <div
                        class="absolute bottom-5 left-5 right-5 rounded-[1.4rem] bg-white/85 p-4 text-black/80 shadow-lg backdrop-blur dark:bg-[#f7f2ea]/90">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-black/50">
                            Learning note
                        </p>
                        <p class="mt-2 text-sm font-bold leading-6">
                            {{ $t['learningNote'] }}
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div
                        class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffdf8] p-5 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-[#4f6f52] dark:text-[#c7d7a9]">
                            <span
                                x-text="activeMode === 'learn' ? '{{ $t['learn'] }} mode' : activeMode === 'journal' ? '{{ $t['journal'] }} mode' : '{{ $t['video'] }} mode'"></span>
                        </p>

                        <h2 class="mt-4 text-2xl font-black tracking-tight">
                            {{ $locale === 'en' ? 'Choose your path' : 'Pilih jalur belajar' }}
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-[#6b6258] dark:text-[#bdb4a7]">
                            {{ $t['modeText'] }}
                        </p>
                    </div>

                    <div
                        class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffaf2] p-3 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                        <div class="grid gap-2">
                            <button type="button" @click="activeMode = 'learn'"
                                :class="activeMode === 'learn'
                                    ?
                                    'border-[#d8e2d2] bg-[#eaf0e6] text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]' :
                                    'border-transparent hover:bg-black/5 dark:hover:bg-white/5'"
                                class="flex items-center justify-between rounded-2xl border px-4 py-3 text-left text-sm font-black transition">
                                <span>{{ $t['learn'] }}</span>
                                <span>→</span>
                            </button>

                            <button type="button" @click="activeMode = 'journal'"
                                :class="activeMode === 'journal'
                                    ?
                                    'border-[#d8e2d2] bg-[#eaf0e6] text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]' :
                                    'border-transparent hover:bg-black/5 dark:hover:bg-white/5'"
                                class="flex items-center justify-between rounded-2xl border px-4 py-3 text-left text-sm font-black transition">
                                <span>{{ $t['journal'] }}</span>
                                <span>→</span>
                            </button>

                            <button type="button" @click="activeMode = 'video'"
                                :class="activeMode === 'video'
                                    ?
                                    'border-[#d8e2d2] bg-[#eaf0e6] text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]' :
                                    'border-transparent hover:bg-black/5 dark:hover:bg-white/5'"
                                class="flex items-center justify-between rounded-2xl border px-4 py-3 text-left text-sm font-black transition">
                                <span>{{ $t['video'] }}</span>
                                <span>→</span>
                            </button>
                        </div>
                    </div>

                    <div
                        class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffdf8] p-5 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-[#4f6f52] dark:text-[#c7d7a9]">
                            {{ $t['quickAccess'] }}
                        </p>

                        <div class="mt-4 flex flex-wrap gap-2">
                            <a href="{{ $externalLinks['sinta'] }}" target="_blank" rel="noopener noreferrer"
                                class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold transition hover:-translate-y-0.5 dark:border-white/10">
                                SINTA
                            </a>

                            <a href="{{ $externalLinks['scholar'] }}" target="_blank" rel="noopener noreferrer"
                                class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold transition hover:-translate-y-0.5 dark:border-white/10">
                                Scholar
                            </a>

                            <a href="{{ $externalLinks['scopus'] }}" target="_blank" rel="noopener noreferrer"
                                class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold transition hover:-translate-y-0.5 dark:border-white/10">
                                Scopus
                            </a>

                            <a href="{{ $externalLinks['youtube'] }}" target="_blank" rel="noopener noreferrer"
                                class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold transition hover:-translate-y-0.5 dark:border-white/10">
                                YouTube
                            </a>

                            <a href="{{ $externalLinks['jti'] }}" target="_blank" rel="noopener noreferrer"
                                class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold transition hover:-translate-y-0.5 dark:border-white/10">
                                JTI Polije
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="mt-14 space-y-5">
            <section x-show="activeMode === 'learn'" x-cloak class="grid gap-5 lg:grid-cols-[0.8fr_1.2fr]">
                <div
                    class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffdf8] p-7 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
                    <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                        {{ $t['learnEyebrow'] }}
                    </p>
                    <h2 class="mt-5 text-3xl font-black tracking-tight">
                        {{ $t['learnTitle'] }}
                    </h2>
                    <p class="mt-4 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                        {{ $t['learnDesc'] }}
                    </p>

                    <div
                        class="mt-6 rounded-2xl border border-[#e3d8c8] bg-white/50 p-4 dark:border-white/10 dark:bg-white/5">
                        <p class="text-sm font-black">Comfort reading</p>
                        <p class="mt-2 text-sm leading-6 text-[#6b6258] dark:text-[#bdb4a7]">
                            Max-width artikel, line-height lega, block code jelas, sticky table of contents, dan tombol
                            next/previous.
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    @foreach ($learningPaths as $index => $path)
                        <article
                            class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffaf2] p-5 shadow-sm transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-[#1f2722]">
                            <div class="flex gap-4">
                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-[#d8e2d2] bg-[#eaf0e6] text-sm font-black text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                                    0{{ $index + 1 }}
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-lg font-black tracking-tight">
                                            {{ $locale === 'en' ? $path['title_en'] : $path['title_id'] }}
                                        </h3>
                                        <span
                                            class="rounded-full border border-[#d8e2d2] bg-[#eaf0e6] px-2.5 py-1 text-xs font-bold text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                                            {{ $path['tag'] }}
                                        </span>
                                    </div>

                                    <p class="mt-2 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                                        {{ $locale === 'en' ? $path['desc_en'] : $path['desc_id'] }}
                                    </p>

                                    <div class="mt-4 flex items-center justify-between">
                                        <span class="text-xs font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                                            {{ $path['weeks'] }}
                                        </span>
                                        <span class="text-sm font-black text-[#4f6f52] dark:text-[#c7d7a9]">
                                            {{ $t['openMaterial'] }} →
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section x-show="activeMode === 'journal'" x-cloak class="grid gap-5 lg:grid-cols-[1.08fr_0.92fr]">
                <div
                    class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2] p-7 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-start">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                                {{ $t['journalEyebrow'] }}
                            </p>
                            <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
                                {{ $t['journalTitle'] }}
                            </h2>
                            <p class="mt-3 max-w-2xl text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                                {{ $t['journalDesc'] }}
                            </p>
                        </div>

                        <button type="button"
                            class="inline-flex items-center gap-2 rounded-full border border-[#e3d8c8] px-4 py-2 text-sm font-black dark:border-white/10">
                            Filter
                        </button>
                    </div>

                    <div class="mt-7 space-y-4">
                        @foreach ($journals as $journal)
                            <article
                                class="rounded-[1.4rem] border border-[#e3d8c8] bg-white/45 p-5 dark:border-white/10 dark:bg-white/5">
                                <div class="flex flex-col gap-4 md:flex-row">
                                    <div
                                        class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border border-[#d8e2d2] bg-[#eaf0e6] text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                                        📄
                                    </div>

                                    <div>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="rounded-full border border-[#d8e2d2] bg-[#eaf0e6] px-2.5 py-1 text-xs font-bold text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                                                {{ $journal['year'] }}
                                            </span>
                                            <span
                                                class="rounded-full border border-[#e3d8c8] px-2.5 py-1 text-xs font-bold dark:border-white/10">
                                                {{ $journal['field'] }}
                                            </span>
                                            <span
                                                class="rounded-full border border-[#e3d8c8] px-2.5 py-1 text-xs font-bold dark:border-white/10">
                                                {{ $journal['read'] }}
                                            </span>
                                        </div>

                                        <h3 class="mt-3 text-lg font-black leading-snug tracking-tight">
                                            {{ $journal['title'] }}
                                        </h3>
                                        <p class="mt-2 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                                            {{ $t['journalNote'] }}
                                        </p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <aside
                    class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffdf8] p-7 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
                    <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                        Academic ecosystem
                    </p>
                    <h2 class="mt-2 text-3xl font-black tracking-tight">
                        {{ $t['oldContentTitle'] }}
                    </h2>
                    <p class="mt-3 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                        {{ $t['oldContentDesc'] }}
                    </p>

                    <div class="mt-6 grid gap-3">
                        @foreach ($academicLinks as $item)
                            <div
                                class="flex gap-4 rounded-2xl border border-[#e3d8c8] bg-white/40 p-4 dark:border-white/10 dark:bg-white/5">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#d8e2d2] bg-[#eaf0e6] text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                                    ↗
                                </div>
                                <div>
                                    <p class="text-sm font-black">{{ $item['title'] }}</p>
                                    <p class="mt-1 text-sm leading-6 text-[#6b6258] dark:text-[#bdb4a7]">
                                        {{ $locale === 'en' ? $item['desc_en'] : $item['desc_id'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </aside>
            </section>

            <section x-show="activeMode === 'video'" x-cloak class="grid gap-5 lg:grid-cols-[0.9fr_1.1fr]">
                <div
                    class="relative min-h-[420px] overflow-hidden rounded-[2rem] border border-white/10 bg-[#172322] p-6 text-white shadow-xl">
                    <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-[#d9a441]/30 blur-3xl"></div>

                    <div class="relative flex h-full flex-col justify-between">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.24em] text-white/60">
                                {{ $t['videoEyebrow'] }}
                            </p>
                            <h2 class="mt-3 max-w-md text-4xl font-black tracking-tight">
                                {{ $t['videoTitle'] }}
                            </h2>
                        </div>

                        <div class="mt-10 rounded-[1.5rem] bg-white/10 p-4 backdrop-blur">
                            <div class="flex aspect-video items-center justify-center rounded-[1.2rem] bg-black/35">
                                <button type="button"
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-white text-black shadow-xl">
                                    ▶
                                </button>
                            </div>

                            <div class="mt-4 flex items-center justify-between gap-3">
                                <div>
                                    <p class="font-black">{{ $t['featuredVideo'] }}</p>
                                    <p class="mt-1 text-sm text-white/60">OOP · 22:10</p>
                                </div>
                                <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-bold">Featured</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                            {{ $t['videoEyebrow'] }}
                        </p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
                            {{ $t['videoTitle'] }}
                        </h2>
                        <p class="mt-3 max-w-2xl text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                            {{ $t['videoDesc'] }}
                        </p>
                    </div>

                    <div class="grid gap-3 md:grid-cols-2">
                        @foreach ($videos as $video)
                            <article
                                class="rounded-[1.5rem] border border-[#e3d8c8] bg-[#fffaf2] p-4 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                                <div
                                    class="flex aspect-video items-center justify-center rounded-[1rem] bg-gradient-to-br from-[#4f6f52] to-[#7b8f68] text-white dark:from-[#7f9869] dark:to-[#b89b58]">
                                    ▶
                                </div>
                                <div class="mt-4">
                                    <span
                                        class="rounded-full border border-[#d8e2d2] bg-[#eaf0e6] px-2.5 py-1 text-xs font-bold text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                                        {{ $video['topic'] }}
                                    </span>
                                    <h3 class="mt-3 text-sm font-black leading-6">
                                        {{ $locale === 'en' ? $video['title_en'] : $video['title_id'] }}
                                    </h3>
                                    <p class="mt-2 text-xs font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                                        {{ $video['length'] }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section
                class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2] p-6 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                <div class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                            {{ $t['researchEyebrow'] }}
                        </p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
                            {{ $t['researchTitle'] }}
                        </h2>
                        <p class="mt-3 max-w-2xl text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                            {{ $t['researchDesc'] }}
                        </p>
                    </div>

                    <a href="{{ route('research') }}"
                        class="rounded-full bg-[#4f6f52] px-5 py-3 text-sm font-black text-white transition hover:-translate-y-0.5 dark:bg-[#9caf88] dark:text-[#151b18]">
                        {{ $locale === 'en' ? 'View all research' : 'Lihat semua riset' }}
                    </a>
                </div>

                <div class="mt-7 grid gap-3 md:grid-cols-4">
                    @foreach ($researchAreas as $area)
                        <div
                            class="rounded-2xl border border-[#e3d8c8] bg-white/35 p-4 dark:border-white/10 dark:bg-white/5">
                            <p class="text-sm font-black">{{ $area['title'] }}</p>
                            <p class="mt-1 text-sm leading-6 text-[#6b6258] dark:text-[#bdb4a7]">
                                {{ $locale === 'en' ? $area['desc_en'] : $area['desc_id'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>
@endsection
