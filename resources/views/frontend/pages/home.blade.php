@extends('frontend.layouts.app')

@php
    $locale = session('locale', app()->getLocale() ?: 'id');
    $locale = in_array($locale, ['id', 'en']) ? $locale : 'id';

    $copy = [
        'id' => [
            'seoTitle' => 'Arvita Agus Kurniasari | Materi Informatika, Publikasi, dan Karya Akademik',
            'seoDescription' =>
                'Website akademik Arvita Agus Kurniasari untuk mengakses materi kuliah, publikasi ilmiah, video pembelajaran, riset, portfolio, dan bimbingan mahasiswa.',

            'badge' => 'Academic Learning Hub',
            'title' => 'Belajar informatika dengan alur yang lebih jelas.',
            'subtitle' =>
                'arvitaagusk.com menjadi ruang akademik Arvita Agus Kurniasari untuk menemukan materi kuliah, publikasi, video pembelajaran, riset, dan bimbingan mahasiswa dalam satu tempat yang rapi dan mudah diakses.',
            'ctaPrimary' => 'Mulai belajar',
            'ctaSecondary' => 'Lihat publikasi',
            'modeText' =>
                'Pilih bagian yang ingin kamu jelajahi: materi kuliah, publikasi ilmiah, video pembelajaran, atau profil akademik.',
            'quickAccess' => 'Akses cepat',
            'learningNote' =>
                'Website ini membantu mahasiswa dan pembaca menemukan materi, publikasi, video, serta informasi akademik Arvita dengan lebih mudah.',

            'learn' => 'Materi',
            'journal' => 'Publikasi',
            'video' => 'Video',

            'learnEyebrow' => 'Materi Kuliah',
            'learnTitle' => 'Materi disusun agar lebih mudah dipahami.',
            'learnDesc' =>
                'Setiap materi diarahkan agar mahasiswa dapat mengikuti pembelajaran dari konsep dasar, contoh, latihan, hingga penerapan dalam proyek sederhana.',
            'openMaterial' => 'Buka materi',

            'journalEyebrow' => 'Publikasi & Riset',
            'journalTitle' => 'Publikasi dibuat lebih mudah ditemukan.',
            'journalDesc' =>
                'Bagian publikasi menghubungkan karya ilmiah dengan bidang riset, tahun terbit, SINTA, Google Scholar, Scopus, dan topik akademik terkait.',
            'journalNote' =>
                'Publikasi dapat dilengkapi ringkasan, bidang riset, citation, DOI, dan tautan profil akademik.',
            'oldContentTitle' => 'Konten lama tetap tersedia.',
            'oldContentDesc' =>
                'Konten dari website sebelumnya tetap dipertahankan, lalu ditata ulang agar lebih rapi, mudah dicari, dan nyaman dibaca.',

            'videoEyebrow' => 'Video Pembelajaran',
            'videoTitle' => 'Video membantu memahami materi dengan lebih praktis.',
            'videoDesc' =>
                'Video pembelajaran dapat dikelompokkan berdasarkan mata kuliah, topik, dan durasi agar mahasiswa tahu harus mulai dari mana.',
            'featuredVideo' => 'Memahami Class dan Object',

            'researchEyebrow' => 'Fokus Akademik',
            'researchTitle' => 'Bidang yang diajarkan, diteliti, dan dikembangkan.',
            'researchDesc' =>
                'Area akademik Arvita mencakup web development, OOP, IoT, image processing, augmented reality, dan educational technology yang terhubung dengan materi, publikasi, dan bimbingan.',
        ],

        'en' => [
            'seoTitle' => 'Arvita Agus Kurniasari | Informatics Materials, Publications, and Academic Work',
            'seoDescription' =>
                'Academic website of Arvita Agus Kurniasari for course materials, scientific publications, learning videos, research, portfolio, and student supervision.',

            'badge' => 'Academic Learning Hub',
            'title' => 'Learn informatics through a clearer path.',
            'subtitle' =>
                'arvitaagusk.com is Arvita Agus Kurniasari’s academic space for accessing course materials, publications, learning videos, research, and student supervision in one organized place.',
            'ctaPrimary' => 'Start learning',
            'ctaSecondary' => 'View publications',
            'modeText' =>
                'Choose what you want to explore: course materials, scientific publications, learning videos, or academic profiles.',
            'quickAccess' => 'Quick access',
            'learningNote' =>
                'This website helps students and readers find Arvita’s materials, publications, videos, and academic information more easily.',

            'learn' => 'Materials',
            'journal' => 'Publications',
            'video' => 'Videos',

            'learnEyebrow' => 'Course Materials',
            'learnTitle' => 'Materials are organized for easier learning.',
            'learnDesc' =>
                'Each material is designed to help students move from basic concepts to examples, exercises, and simple project-based practice.',
            'openMaterial' => 'Open material',

            'journalEyebrow' => 'Publications & Research',
            'journalTitle' => 'Publications are easier to find and explore.',
            'journalDesc' =>
                'The publication section connects academic work with research areas, publication years, SINTA, Google Scholar, Scopus, and related academic topics.',
            'journalNote' =>
                'Each publication can include a summary, research field, citation, DOI, and academic profile links.',
            'oldContentTitle' => 'Previous content remains available.',
            'oldContentDesc' =>
                'Content from the previous website is preserved and reorganized to make it cleaner, easier to search, and more comfortable to read.',

            'videoEyebrow' => 'Learning Videos',
            'videoTitle' => 'Videos help explain materials more practically.',
            'videoDesc' =>
                'Learning videos can be grouped by course, topic, and duration so students know where to begin.',
            'featuredVideo' => 'Understanding Class and Object',

            'researchEyebrow' => 'Academic Focus',
            'researchTitle' => 'Fields taught, researched, and developed.',
            'researchDesc' =>
                'Arvita’s academic areas include web development, OOP, IoT, image processing, augmented reality, and educational technology, connected with materials, publications, and supervision.',
        ],
    ];

    $externalLinks = [
        'sinta' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6757351',
        'scholar' => 'https://scholar.google.com/citations?hl=en&user=Yn7_99QAAAAJ',
        'scopus' => 'https://sinta.kemdiktisaintek.go.id/authors/scopusanalysis/6757351',
        'github' => 'https://github.com/Arvita',
        'youtube' => 'https://www.youtube.com/channel/UCU5lYacwXkUkYaX6AZ1WnGQ',
        'jti' => 'https://jti.polije.ac.id/jtipolije/public/dosen/32/arvita-agus-kurniasari-sstmtrkom',
        'email' => 'mailto:arvita@polije.com',
    ];
    $t = $copy[$locale];

    $learningPaths = [
        [
            'title_id' => 'Pemrograman Dasar',
            'title_en' => 'Programming Fundamentals',
            'weeks' => $locale === 'en' ? '14 weeks' : '14 minggu',
            'desc_id' => 'Mulai dari logika dasar, form, validasi, debugging, file handling, sampai mini project.',
            'desc_en' => 'Start from basic logic, forms, validation, debugging, file handling, and mini projects.',
            'tag' => 'Beginner',
        ],
        [
            'title_id' => 'Object-Oriented Programming',
            'title_en' => 'Object-Oriented Programming',
            'weeks' => $locale === 'en' ? 'Core course' : 'Mata kuliah inti',
            'desc_id' => 'Belajar class, object, relasi objek, exception, UML, dan implementasi OOP di PHP.',
            'desc_en' => 'Learn classes, objects, object relations, exceptions, UML, and OOP implementation in PHP.',
            'tag' => 'Core skill',
        ],
        [
            'title_id' => 'Microsoft Office',
            'title_en' => 'Microsoft Office',
            'weeks' => $locale === 'en' ? 'Practical lab' : 'Praktikum',
            'desc_id' => 'Materi produktivitas akademik untuk laporan, presentasi, data, dan pekerjaan kuliah.',
            'desc_en' => 'Academic productivity materials for reports, presentations, data, and coursework.',
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
            'desc_id' => 'Pengembangan sistem informasi, website akademik, dan platform pembelajaran.',
            'desc_en' => 'Information systems, academic websites, and learning platform development.',
        ],
        [
            'title' => 'Internet of Things',
            'desc_id' => 'Prototype perangkat, sensor, dan sistem terapan untuk kebutuhan pembelajaran maupun riset.',
            'desc_en' => 'Device prototypes, sensors, and applied systems for learning and research needs.',
        ],
        [
            'title' => 'Image Processing',
            'desc_id' => 'Pengolahan citra, data visual, dan pendekatan computer vision.',
            'desc_en' => 'Image processing, visual data, and computer vision approaches.',
        ],
        [
            'title' => 'Augmented Reality',
            'desc_id' => 'Media pembelajaran interaktif yang menggabungkan objek digital dan pengalaman nyata.',
            'desc_en' => 'Interactive learning media that combines digital objects with real-world experiences.',
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

                    <a href="{{ route('research') }}"
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
