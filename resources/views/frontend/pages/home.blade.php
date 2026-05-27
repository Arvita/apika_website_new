@extends('frontend.layouts.app')

@php
    $locale = app()->getLocale() ?: session('locale', 'id');
    $locale = in_array($locale, ['id', 'en']) ? $locale : 'id';

    $t = [
        'id' => [
            'seoTitle' => 'Arvita Agus Kurniasari | Website Akademik dan Materi Pembelajaran',
            'seoDescription' => 'Website akademik Arvita Agus Kurniasari untuk belajar pemrograman, membaca publikasi ilmiah, menonton video pembelajaran, melihat riset, portfolio, dan bimbingan mahasiswa.',

            'badge' => 'Human Academic Learning Hub',
            'heroTitle' => 'Belajar, membaca, dan menonton dengan nyaman.',
            'heroDescription' => 'Website akademik Arvita Agus Kurniasari dirancang sebagai ruang belajar yang hangat: mahasiswa mudah menemukan materi, pembaca mudah memahami publikasi, dan pengunjung bisa menonton video pembelajaran tanpa distraksi.',
            'startLearning' => 'Mulai belajar',
            'readJournals' => 'Baca jurnal',
            'learningNote' => 'Website ini dibuat seperti meja kerja dosen: terarah, rapi, hangat, dan bermanfaat.',
            'quickAccess' => 'Akses Cepat',
            'focus' => 'Fokus',

            'learningEyebrow' => 'Ruang Belajar',
            'learningTitle' => 'Materi kuliah dibuat runtut dan nyaman dibaca.',
            'learningDescription' => 'Halaman belajar akan disusun seperti learning path: ringkasan, tujuan pembelajaran, materi utama, contoh kode, latihan, video terkait, dan navigasi minggu berikutnya.',
            'openMaterial' => 'Lihat materi',

            'journalEyebrow' => 'Perpustakaan Jurnal',
            'journalTitle' => 'Publikasi tetap lengkap, tapi lebih enak dibaca.',
            'journalDescription' => 'Jurnal tidak hanya menjadi daftar publikasi. Setiap publikasi bisa punya abstract preview, tahun, bidang riset, citation, DOI, dan tautan akademik.',
            'journalPreview' => 'Preview abstract, citation, keywords, DOI, dan tautan profil akademik tersedia.',
            'viewPublications' => 'Lihat publikasi',

            'ecosystemEyebrow' => 'Academic Ecosystem',
            'ecosystemTitle' => 'Konten lama tetap hidup.',
            'ecosystemDescription' => 'Jurnal tetap terhubung dengan profil eksternal dan bimbingan mahasiswa.',
            'academicRelated' => 'Profil akademik dan konten terkait.',

            'videoEyebrow' => 'Ruang Video',
            'videoTitle' => 'Video pembelajaran terasa terkurasi.',
            'videoDescription' => 'Video disusun sebagai playlist belajar dengan ringkasan, durasi, topik, dan relasi ke materi kuliah.',
            'featuredVideo' => 'Memahami Class dan Object',
            'learningVideo' => 'Video pembelajaran',
            'watchVideos' => 'Lihat video',

            'researchEyebrow' => 'Fokus Riset',
            'researchTitle' => 'Riset sebagai penghubung antara materi, jurnal, dan proyek.',
            'researchDescription' => 'Area riset membantu pengunjung memahami hubungan antara pengajaran, publikasi, portfolio, dan karya mahasiswa.',
            'appliedResearch' => 'Area riset akademik terapan.',

            'supervisionEyebrow' => 'Bimbinganku',
            'supervisionTitle' => 'Bimbingan mahasiswa tetap menjadi bagian penting.',
            'supervisionDescription' => 'Bagian Bimbinganku dapat menampilkan topik mahasiswa, status bimbingan, proyek akhir, dan keterkaitan dengan riset atau publikasi.',
            'viewSupervision' => 'Lihat Bimbinganku',
        ],

        'en' => [
            'seoTitle' => 'Arvita Agus Kurniasari | Academic Learning Hub',
            'seoDescription' => 'Academic website of Arvita Agus Kurniasari for programming courses, scientific publications, learning videos, research, portfolio, and student supervision.',

            'badge' => 'Human Academic Learning Hub',
            'heroTitle' => 'Learn, read, and watch comfortably.',
            'heroDescription' => 'Arvita Agus Kurniasari’s academic website is designed as a warm learning hub: students can find course materials, readers can understand publications, and visitors can watch learning videos without distraction.',
            'startLearning' => 'Start learning',
            'readJournals' => 'Read journals',
            'learningNote' => 'This website is designed like a lecturer’s desk: structured, warm, organized, and useful.',
            'quickAccess' => 'Quick Access',
            'focus' => 'Focus',

            'learningEyebrow' => 'Learning Space',
            'learningTitle' => 'Course materials should feel structured and readable.',
            'learningDescription' => 'Each course page can be organized as a learning path: summary, learning outcomes, core materials, code examples, exercises, related videos, and next-week navigation.',
            'openMaterial' => 'Open material',

            'journalEyebrow' => 'Journal Library',
            'journalTitle' => 'Publications stay complete, but easier to read.',
            'journalDescription' => 'Journals should not feel like a plain database. Each publication can include abstract preview, year, research field, citation, DOI, and academic links.',
            'journalPreview' => 'Abstract preview, citation, keywords, DOI, and academic profile links are available.',
            'viewPublications' => 'View publications',

            'ecosystemEyebrow' => 'Academic Ecosystem',
            'ecosystemTitle' => 'Existing content stays visible.',
            'ecosystemDescription' => 'Publications stay connected to external academic profiles and student supervision content.',
            'academicRelated' => 'Academic profile and related content.',

            'videoEyebrow' => 'Video Room',
            'videoTitle' => 'Learning videos feel curated.',
            'videoDescription' => 'Videos are organized as learning playlists with summaries, duration, topics, and related course materials.',
            'featuredVideo' => 'Understanding Class and Object',
            'learningVideo' => 'Learning video',
            'watchVideos' => 'View videos',

            'researchEyebrow' => 'Research Focus',
            'researchTitle' => 'Research connects materials, journals, and projects.',
            'researchDescription' => 'Research areas help visitors understand the relationship between teaching, publications, portfolio, and student work.',
            'appliedResearch' => 'Applied academic research area.',

            'supervisionEyebrow' => 'Supervision',
            'supervisionTitle' => 'Student supervision remains an important part.',
            'supervisionDescription' => 'The supervision section can present student topics, supervision status, final projects, and connections to research or publications.',
            'viewSupervision' => 'View supervision',
        ],
    ][$locale];

    $courses = [
        [
            'title_id' => 'Pemrograman Dasar',
            'title_en' => 'Programming Fundamentals',
            'desc_id' => 'Form, validasi, debugging, file handling, dan mini project.',
            'desc_en' => 'Forms, validation, debugging, file handling, and mini projects.',
            'tag' => 'Beginner',
        ],
        [
            'title_id' => 'Object-Oriented Programming',
            'title_en' => 'Object-Oriented Programming',
            'desc_id' => 'Class, object, relasi objek, SOLID, UML, dan PHP.',
            'desc_en' => 'Classes, objects, object relations, SOLID, UML, and PHP.',
            'tag' => 'Core Skill',
        ],
        [
            'title_id' => 'Microsoft Office',
            'title_en' => 'Microsoft Office',
            'desc_id' => 'Materi produktivitas akademik untuk laporan, data, dan presentasi.',
            'desc_en' => 'Academic productivity materials for reports, data, and presentations.',
            'tag' => 'Practical',
        ],
    ];

    $journals = [
        [
            'title' => 'Learning media development for programming education',
            'year' => '2025',
            'field' => 'Education Technology',
        ],
        [
            'title' => 'Applied informatics approach for visual data and image processing',
            'year' => '2024',
            'field' => 'Image Processing',
        ],
        [
            'title' => 'IoT-based prototype for interactive academic environments',
            'year' => '2024',
            'field' => 'Internet of Things',
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
            'desc_id' => 'Data bimbingan mahasiswa, topik, dan proyek akhir.',
            'desc_en' => 'Student supervision data, topics, and final projects.',
        ],
    ];

    $videos = [
        [
            'title_id' => 'Pengantar Pemrograman Dasar',
            'title_en' => 'Introduction to Programming Fundamentals',
            'duration' => '18:24',
            'topic' => 'Course Intro',
        ],
        [
            'title_id' => 'Memahami Class dan Object',
            'title_en' => 'Understanding Class and Object',
            'duration' => '22:10',
            'topic' => 'OOP',
        ],
        [
            'title_id' => 'Debugging untuk Mahasiswa',
            'title_en' => 'Debugging for Students',
            'duration' => '14:05',
            'topic' => 'Practice',
        ],
        [
            'title_id' => 'Mini Project OOP',
            'title_en' => 'OOP Mini Project',
            'duration' => '20:15',
            'topic' => 'Project',
        ],
    ];

    $researchAreas = [
        [
            'title' => 'Web Development',
            'desc_id' => 'Platform pembelajaran dan sistem akademik.',
            'desc_en' => 'Learning platforms and academic systems.',
        ],
        [
            'title' => 'Internet of Things',
            'desc_id' => 'Prototype perangkat dan sistem terapan.',
            'desc_en' => 'Device prototypes and applied systems.',
        ],
        [
            'title' => 'Image Processing',
            'desc_id' => 'Computer vision dan data visual.',
            'desc_en' => 'Computer vision and visual data.',
        ],
        [
            'title' => 'Augmented Reality',
            'desc_id' => 'Media pembelajaran interaktif.',
            'desc_en' => 'Interactive learning media.',
        ],
    ];
@endphp

@section('title', $t['seoTitle'])
@section('meta_description', $t['seoDescription'])

@section('content')
    <section class="mx-auto grid max-w-6xl items-start gap-10 px-4 pb-16 pt-10 sm:px-6 lg:grid-cols-[0.9fr_1.1fr]">
        <div>
            <div class="inline-flex rotate-[-1deg] items-center gap-2 rounded-full border border-[#d8e2d2] bg-[#eaf0e6] px-3 py-1 text-xs font-black text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                {{ $t['badge'] }}
            </div>

            <h1 class="mt-7 max-w-3xl text-4xl font-black leading-[0.98] tracking-[-0.055em] sm:text-5xl md:text-7xl">
                {{ $t['heroTitle'] }}
            </h1>

            <p class="mt-6 max-w-xl text-base leading-8 text-[#6b6258] dark:text-[#bdb4a7] sm:text-lg">
                {{ $t['heroDescription'] }}
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('courses.index') }}" class="rounded-full bg-[#4f6f52] px-5 py-3 text-sm font-black text-white transition hover:-translate-y-0.5 dark:bg-[#9caf88] dark:text-[#151b18]">
                    {{ $t['startLearning'] }}
                </a>

                <a href="{{ route('publications.index') }}" class="rounded-full border border-[#e3d8c8] bg-[#fffaf2] px-5 py-3 text-sm font-black transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-[#1f2722]">
                    {{ $t['readJournals'] }}
                </a>
            </div>

            <div class="mt-10 grid max-w-xl grid-cols-3 gap-3">
                <div class="rounded-2xl border border-[#e3d8c8] bg-[#fffaf2] p-4 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                    <p class="text-2xl font-black">3+</p>
                    <p class="mt-1 text-xs font-bold text-[#6b6258] dark:text-[#bdb4a7]">Courses</p>
                </div>

                <div class="rounded-2xl border border-[#e3d8c8] bg-[#fffaf2] p-4 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                    <p class="text-2xl font-black">6</p>
                    <p class="mt-1 text-xs font-bold text-[#6b6258] dark:text-[#bdb4a7]">Focus Areas</p>
                </div>

                <div class="rounded-2xl border border-[#e3d8c8] bg-[#fffaf2] p-4 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                    <p class="text-2xl font-black">2025</p>
                    <p class="mt-1 text-xs font-bold text-[#6b6258] dark:text-[#bdb4a7]">Latest Work</p>
                </div>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-[1fr_0.85fr]">
            <div class="relative min-h-[430px] overflow-hidden rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2] p-4 shadow-xl dark:border-white/10 dark:bg-[#1f2722]">
                <div class="absolute inset-x-6 top-6 h-60 rounded-[1.5rem] bg-gradient-to-br from-[#4f6f52] to-[#7b8f68] opacity-95 dark:from-[#7f9869] dark:to-[#b89b58]"></div>
                <div class="absolute inset-x-10 top-12 h-52 rounded-[40%_60%_55%_45%] bg-white/20"></div>

                <div class="absolute right-8 top-8 flex h-14 w-14 items-center justify-center rounded-full bg-white/90 text-2xl shadow-lg">
                    ❝
                </div>

                <div class="absolute bottom-5 left-5 right-5 rounded-[1.4rem] bg-white/85 p-4 shadow-lg backdrop-blur dark:bg-[#f7f2ea]/90">
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-black/50">Learning note</p>
                    <p class="mt-2 text-sm font-bold leading-6 text-black/80">
                        {{ $t['learningNote'] }}
                    </p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffdf8] p-5 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-[#4f6f52] dark:text-[#c7d7a9]">
                        {{ $t['quickAccess'] }}
                    </p>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <a href="#" class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold transition hover:-translate-y-0.5 dark:border-white/10">SINTA</a>
                        <a href="#" class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold transition hover:-translate-y-0.5 dark:border-white/10">Scholar</a>
                        <a href="#" class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold transition hover:-translate-y-0.5 dark:border-white/10">Scopus</a>
                        <a href="{{ route('supervisions.index') }}" class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold transition hover:-translate-y-0.5 dark:border-white/10">
                            {{ $locale === 'en' ? 'Supervision' : 'Bimbinganku' }}
                        </a>
                    </div>
                </div>

                <div class="rotate-[1deg] rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffaf2] p-5 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-[#4f6f52] dark:text-[#c7d7a9]">
                        {{ $t['focus'] }}
                    </p>
                    <p class="mt-3 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                        Web Development, OOP, IoT, Image Processing, Augmented Reality, and Educational Technology.
                    </p>
                </div>

                <div class="-rotate-[1deg] rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffdf8] p-5 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-[#4f6f52] dark:text-[#c7d7a9]">
                        Academic identity
                    </p>
                    <p class="mt-3 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                        Lecturer, researcher, and informatics educator at State Polytechnic of Jember.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="grid gap-5 lg:grid-cols-[0.8fr_1.2fr]">
            <div class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffdf8] p-7 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
                <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                    {{ $t['learningEyebrow'] }}
                </p>
                <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
                    {{ $t['learningTitle'] }}
                </h2>
                <p class="mt-3 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                    {{ $t['learningDescription'] }}
                </p>

                <div class="mt-6 rounded-2xl border border-[#e3d8c8] bg-white/50 p-4 dark:border-white/10 dark:bg-white/5">
                    <p class="text-sm font-black">Reading comfort</p>
                    <p class="mt-2 text-sm leading-6 text-[#6b6258] dark:text-[#bdb4a7]">
                        Max-width artikel, line-height lega, block code jelas, sticky table of contents, dan tombol next/previous.
                    </p>
                </div>
            </div>

            <div class="space-y-4">
                @foreach ($courses as $index => $course)
                    <article class="group rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffaf2] p-5 shadow-sm transition hover:-translate-y-1 dark:border-white/10 dark:bg-[#1f2722]">
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-[#d8e2d2] bg-[#eaf0e6] text-sm font-black text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                                0{{ $index + 1 }}
                            </div>

                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="text-lg font-black tracking-tight">
                                        {{ $locale === 'en' ? $course['title_en'] : $course['title_id'] }}
                                    </h3>
                                    <span class="rounded-full border border-[#d8e2d2] bg-[#eaf0e6] px-2.5 py-1 text-xs font-bold text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                                        {{ $course['tag'] }}
                                    </span>
                                </div>

                                <p class="mt-2 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                                    {{ $locale === 'en' ? $course['desc_en'] : $course['desc_id'] }}
                                </p>

                                <p class="mt-4 text-sm font-black text-[#4f6f52] dark:text-[#c7d7a9]">
                                    {{ $t['openMaterial'] }} →
                                </p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="grid gap-5 lg:grid-cols-[1.08fr_0.92fr]">
            <div class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2] p-7 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                            {{ $t['journalEyebrow'] }}
                        </p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
                            {{ $t['journalTitle'] }}
                        </h2>
                        <p class="mt-3 max-w-2xl text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                            {{ $t['journalDescription'] }}
                        </p>
                    </div>

                    <a href="{{ route('publications.index') }}" class="rounded-full bg-[#4f6f52] px-5 py-3 text-sm font-black text-white transition hover:-translate-y-0.5 dark:bg-[#9caf88] dark:text-[#151b18]">
                        {{ $t['viewPublications'] }}
                    </a>
                </div>

                <div class="mt-7 space-y-4">
                    @foreach ($journals as $journal)
                        <article class="rounded-[1.4rem] border border-[#e3d8c8] bg-white/45 p-5 dark:border-white/10 dark:bg-white/5">
                            <div class="flex flex-wrap gap-2">
                                <span class="rounded-full border border-[#d8e2d2] bg-[#eaf0e6] px-2.5 py-1 text-xs font-bold text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                                    {{ $journal['year'] }}
                                </span>
                                <span class="rounded-full border border-[#e3d8c8] px-2.5 py-1 text-xs font-bold dark:border-white/10">
                                    {{ $journal['field'] }}
                                </span>
                            </div>

                            <h3 class="mt-3 text-lg font-black leading-snug tracking-tight">
                                {{ $journal['title'] }}
                            </h3>

                            <p class="mt-2 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                                {{ $t['journalPreview'] }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </div>

            <aside class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffdf8] p-7 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
                <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                    {{ $t['ecosystemEyebrow'] }}
                </p>
                <h2 class="mt-2 text-3xl font-black tracking-tight">
                    {{ $t['ecosystemTitle'] }}
                </h2>
                <p class="mt-3 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                    {{ $t['ecosystemDescription'] }}
                </p>

                <div class="mt-6 grid gap-3">
                    @foreach ($academicLinks as $item)
                        <a href="#" class="rounded-2xl border border-[#e3d8c8] bg-white/40 p-4 transition hover:-translate-y-1 dark:border-white/10 dark:bg-white/5">
                            <p class="text-sm font-black">{{ $item['title'] }}</p>
                            <p class="mt-1 text-sm leading-6 text-[#6b6258] dark:text-[#bdb4a7]">
                                {{ $locale === 'en' ? $item['desc_en'] : $item['desc_id'] }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="grid gap-5 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="relative min-h-[420px] overflow-hidden rounded-[2rem] border border-white/10 bg-[#172322] p-6 text-white shadow-xl">
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
                            <span class="flex h-16 w-16 items-center justify-center rounded-full bg-white text-black shadow-xl">
                                ▶
                            </span>
                        </div>

                        <div class="mt-4">
                            <p class="font-black">{{ $t['featuredVideo'] }}</p>
                            <p class="mt-1 text-sm text-white/60">OOP · 22:10</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2] p-7 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                    Video Learning
                </p>

                <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
                    {{ $t['videoDescription'] }}
                </h2>

                <div class="mt-6 grid gap-3 md:grid-cols-2">
                    @foreach ($videos as $video)
                        <article class="rounded-[1.5rem] border border-[#e3d8c8] bg-white/40 p-4 dark:border-white/10 dark:bg-white/5">
                            <div class="flex aspect-video items-center justify-center rounded-[1rem] bg-gradient-to-br from-[#4f6f52] to-[#7b8f68] text-white">
                                ▶
                            </div>

                            <div class="mt-4">
                                <span class="rounded-full border border-[#d8e2d2] bg-[#eaf0e6] px-2.5 py-1 text-xs font-bold text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
                                    {{ $video['topic'] }}
                                </span>
                                <h3 class="mt-3 text-sm font-black leading-6">
                                    {{ $locale === 'en' ? $video['title_en'] : $video['title_id'] }}
                                </h3>
                                <p class="mt-2 text-xs font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                                    {{ $video['duration'] }} · {{ $t['learningVideo'] }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <a href="{{ route('videos.index') }}" class="mt-6 inline-flex rounded-full bg-[#4f6f52] px-5 py-3 text-sm font-black text-white transition hover:-translate-y-0.5 dark:bg-[#9caf88] dark:text-[#151b18]">
                    {{ $t['watchVideos'] }}
                </a>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2] p-7 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
            <div class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                        {{ $t['researchEyebrow'] }}
                    </p>
                    <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
                        {{ $t['researchTitle'] }}
                    </h2>
                    <p class="mt-3 max-w-2xl text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                        {{ $t['researchDescription'] }}
                    </p>
                </div>

                <a href="{{ route('research') }}" class="rounded-full border border-[#e3d8c8] bg-[#fffdf8] px-5 py-3 text-sm font-black transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-[#202a24]">
                    {{ $locale === 'en' ? 'View research' : 'Lihat riset' }}
                </a>
            </div>

            <div class="mt-7 grid gap-3 md:grid-cols-4">
                @foreach ($researchAreas as $area)
                    <article class="rounded-2xl border border-[#e3d8c8] bg-white/35 p-4 dark:border-white/10 dark:bg-white/5">
                        <p class="text-sm font-black">{{ $area['title'] }}</p>
                        <p class="mt-2 text-sm leading-6 text-[#6b6258] dark:text-[#bdb4a7]">
                            {{ $locale === 'en' ? $area['desc_en'] : $area['desc_id'] }}
                        </p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-20 pt-10 sm:px-6">
        <div class="grid gap-5 lg:grid-cols-[0.85fr_1.15fr]">
            <div class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffdf8] p-7 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
                <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                    {{ $t['supervisionEyebrow'] }}
                </p>
                <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
                    {{ $t['supervisionTitle'] }}
                </h2>
                <p class="mt-3 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                    {{ $t['supervisionDescription'] }}
                </p>

                <a href="{{ route('supervisions.index') }}" class="mt-6 inline-flex rounded-full bg-[#4f6f52] px-5 py-3 text-sm font-black text-white transition hover:-translate-y-0.5 dark:bg-[#9caf88] dark:text-[#151b18]">
                    {{ $t['viewSupervision'] }}
                </a>
            </div>

            <div class="grid gap-3 md:grid-cols-3">
                @foreach ([
                    ['title' => 'Final Project', 'count' => '12+'],
                    ['title' => 'Research Topic', 'count' => '6'],
                    ['title' => 'Student Work', 'count' => '2025'],
                ] as $item)
                    <div class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffaf2] p-5 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                        <p class="text-3xl font-black">{{ $item['count'] }}</p>
                        <p class="mt-2 text-sm font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                            {{ $item['title'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection