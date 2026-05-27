@php
    $locale = session('locale', app()->getLocale() ?: 'id');
    $locale = in_array($locale, ['id', 'en']) ? $locale : 'id';

    app()->setLocale($locale);

    $nextLocale = $locale === 'id' ? 'en' : 'id';

    $languageUrl = \Illuminate\Support\Facades\Route::has('language.switch')
        ? route('language.switch', $nextLocale)
        : url('/language/' . $nextLocale);

    $labels = [
        'id' => [
            'learn' => 'Belajar',
            'journals' => 'Jurnal',
            'videos' => 'Video',
            'research' => 'Riset',
            'supervision' => 'Bimbinganku',
            'portfolio' => 'Portfolio',
            'contact' => 'Kontak',
            'academicLinks' => 'Profil Akademik',
            'content' => 'Konten',
            'footerDescription' =>
                'Website akademik untuk materi kuliah, publikasi, video pembelajaran, riset, portfolio, dan bimbingan mahasiswa.',
            'themeDark' => 'Gelap',
            'themeLight' => 'Terang',
            'mobileMenu' => 'Menu',
            'designedAs' => 'Dirancang sebagai Human Academic Learning Hub.',
            'email' => 'Email',
            'youtube' => 'YouTube',
            'jtiWebsite' => 'Website JTI',
            'officialWebsite' => 'Website Resmi',
            'openLink' => 'Buka tautan',
        ],
        'en' => [
            'learn' => 'Learn',
            'journals' => 'Journals',
            'videos' => 'Videos',
            'research' => 'Research',
            'supervision' => 'Supervision',
            'portfolio' => 'Portfolio',
            'contact' => 'Contact',
            'academicLinks' => 'Academic Links',
            'content' => 'Content',
            'footerDescription' =>
                'Academic website for course materials, scientific publications, learning videos, research, portfolio, and student supervision.',
            'themeDark' => 'Dark',
            'themeLight' => 'Light',
            'mobileMenu' => 'Menu',
            'designedAs' => 'Designed as a Human Academic Learning Hub.',
            'email' => 'Email',
            'youtube' => 'YouTube',
            'jtiWebsite' => 'JTI Website',
            'officialWebsite' => 'Official Website',
            'openLink' => 'Open link',
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
        'website' => 'https://arvitaagusk.com',
    ];
    $t = $labels[$locale];

    $navItems = [
        ['label' => $t['learn'], 'route' => 'courses.index'],
        ['label' => $t['journals'], 'route' => 'publications.index'],
        ['label' => $t['videos'], 'route' => 'videos.index'],
        ['label' => $t['research'], 'route' => 'research'],
        ['label' => $t['supervision'], 'route' => 'supervisions.index'],
        ['label' => $t['portfolio'], 'route' => 'portfolio.index'],
    ];

    $defaultTitle =
        $locale === 'en'
            ? 'Arvita Agus Kurniasari | Academic Learning Hub'
            : 'Arvita Agus Kurniasari | Website Akademik dan Materi Pembelajaran';

    $defaultDescription =
        $locale === 'en'
            ? 'Academic website of Arvita Agus Kurniasari containing course materials, scientific publications, learning videos, research, portfolio, and student supervision.'
            : 'Website akademik Arvita Agus Kurniasari untuk materi kuliah, publikasi ilmiah, video pembelajaran, riset, portfolio, dan bimbingan mahasiswa.';

    $title = trim($__env->yieldContent('title', $defaultTitle));
    $description = trim($__env->yieldContent('meta_description', $defaultDescription));
    $canonical = trim($__env->yieldContent('canonical', url()->current()));
@endphp

<!DOCTYPE html>
<html lang="{{ $locale }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ $canonical }}">

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', $title)">
    <meta property="og:description" content="@yield('og_description', $description)">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:site_name" content="Arvita Agus Kurniasari">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', $title)">
    <meta name="twitter:description" content="@yield('twitter_description', $description)">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');

            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }

            window.toggleTheme = function() {
                const html = document.documentElement;
                const isDark = html.classList.toggle('dark');

                localStorage.setItem('theme', isDark ? 'dark' : 'light');

                const label = document.getElementById('theme-label');

                if (label) {
                    label.textContent = isDark ?
                        label.dataset.lightText :
                        label.dataset.darkText;
                }
            };

            window.toggleMobileMenu = function() {
                const menu = document.getElementById('mobile-menu');
                const button = document.getElementById('mobile-menu-button');

                if (menu) {
                    menu.classList.toggle('hidden');
                }

                if (button) {
                    button.classList.toggle('bg-[#eaf0e6]');
                    button.classList.toggle('dark:bg-[#314033]');
                }
            };

            window.addEventListener('DOMContentLoaded', function() {
                const label = document.getElementById('theme-label');
                const isDark = document.documentElement.classList.contains('dark');

                if (label) {
                    label.textContent = isDark ?
                        label.dataset.lightText :
                        label.dataset.darkText;
                }
            });
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    @stack('schema')
</head>

<body
    class="min-h-screen bg-[#f7f2ea] text-[#1f2933] antialiased transition-colors duration-300 dark:bg-[#151b18] dark:text-[#f6f1e8]">
    <div class="relative min-h-screen overflow-x-hidden">
        <div
            class="pointer-events-none fixed -right-24 top-24 h-72 w-72 rounded-full bg-[#d9a441]/20 blur-3xl dark:bg-[#d0a150]/20">
        </div>
        <div
            class="pointer-events-none fixed -left-24 top-96 h-80 w-80 rounded-full bg-[#4f6f52]/10 blur-3xl dark:bg-[#9caf88]/10">
        </div>

        <header class="sticky top-0 z-50 px-3 pt-3">
            <div class="mx-auto max-w-6xl">
                <div
                    class="rounded-[1.4rem] border border-[#e3d8c8]/80 bg-[#f7f2ea]/80 px-4 py-3 shadow-[0_18px_60px_rgba(31,41,51,0.08)] backdrop-blur-2xl transition-colors duration-300 dark:border-white/10 dark:bg-[#151b18]/80 dark:shadow-[0_18px_60px_rgba(0,0,0,0.25)]">
                    <div class="flex items-center justify-between gap-4">
                        <a href="{{ route('home') }}" class="group flex items-center gap-3">
                            <div class="relative">
                                <div
                                    class="absolute inset-0 rounded-full bg-[#d9a441]/30 blur-md transition group-hover:bg-[#d9a441]/50">
                                </div>
                                <div
                                    class="relative flex h-11 w-11 items-center justify-center rounded-full border border-[#e3d8c8] bg-[#fffaf2] text-[#4f6f52] shadow-sm transition group-hover:-rotate-3 group-hover:scale-105 dark:border-white/10 dark:bg-[#1f2722] dark:text-[#c7d7a9]">
                                    <span class="text-sm font-black">AA</span>
                                </div>
                            </div>

                            <div class="leading-none">
                                <p class="text-sm font-black tracking-tight">
                                    Arvita Agus K.
                                </p>
                                <p class="mt-1.5 text-xs font-semibold text-[#6b6258] dark:text-[#bdb4a7]">
                                    Academic Learning Hub
                                </p>
                            </div>
                        </a>

                        <nav
                            class="hidden items-center gap-1 rounded-full border border-[#e3d8c8] bg-[#fffaf2]/70 p-1 text-sm font-bold text-[#6b6258] shadow-sm dark:border-white/10 dark:bg-[#1f2722]/70 dark:text-[#bdb4a7] lg:flex">
                            @foreach ($navItems as $item)
                                <a href="{{ route($item['route']) }}"
                                    class="rounded-full px-4 py-2 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        </nav>

                        <div class="flex items-center gap-2">
                            <a href="{{ $languageUrl }}"
                                class="rounded-full border border-[#e3d8c8] bg-[#fffaf2]/80 px-3 py-2 text-xs font-black text-[#4f6f52] shadow-sm transition hover:-translate-y-0.5 hover:bg-[#eaf0e6] dark:border-white/10 dark:bg-[#1f2722]/80 dark:text-[#c7d7a9] dark:hover:bg-[#314033]"
                                title="Switch language">
                                {{ strtoupper($nextLocale) }}
                            </a>

                            <button type="button" onclick="toggleTheme()"
                                class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-[#e3d8c8] bg-[#fffaf2]/80 text-[#4f6f52] shadow-sm transition hover:-translate-y-0.5 hover:bg-[#eaf0e6] dark:border-white/10 dark:bg-[#1f2722]/80 dark:text-[#c7d7a9] dark:hover:bg-[#314033]"
                                aria-label="{{ $locale === 'en' ? 'Switch theme' : 'Ganti mode tampilan' }}"
                                title="{{ $locale === 'en' ? 'Switch theme' : 'Ganti mode tampilan' }}">
                                <svg id="theme-icon-sun" class="h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="4"></circle>
                                    <path
                                        d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41">
                                    </path>
                                </svg>

                                <svg id="theme-icon-moon" class="hidden h-4 w-4 dark:block" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 3a6.6 6.6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                                </svg>
                            </button>

                            <a href="{{ route('contact') }}"
                                class="hidden rounded-full bg-[#4f6f52] px-4 py-2 text-sm font-black text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-[#405d43] dark:bg-[#9caf88] dark:text-[#151b18] dark:hover:bg-[#c7d7a9] sm:inline-flex">
                                {{ $t['contact'] }}
                            </a>
                            <button id="mobile-menu-button" type="button" onclick="toggleMobileMenu()"
                                class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-[#e3d8c8] bg-[#fffaf2]/80 text-[#4f6f52] shadow-sm transition hover:bg-[#eaf0e6] dark:border-white/10 dark:bg-[#1f2722]/80 dark:text-[#c7d7a9] dark:hover:bg-[#314033] lg:hidden"
                                aria-label="{{ $locale === 'en' ? 'Open menu' : 'Buka menu' }}"
                                title="{{ $locale === 'en' ? 'Open menu' : 'Buka menu' }}">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M4 7h16"></path>
                                    <path d="M4 12h16"></path>
                                    <path d="M4 17h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div id="mobile-menu" class="hidden pt-4 lg:hidden">
                        <nav class="grid gap-2 text-sm font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                            @foreach ($navItems as $item)
                                <a href="{{ route($item['route']) }}"
                                    class="rounded-2xl border border-[#e3d8c8] bg-[#fffaf2]/75 px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:border-white/10 dark:bg-[#1f2722]/75 dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                                    {{ $item['label'] }}
                                </a>
                            @endforeach

                            <a href="{{ route('contact') }}"
                                class="rounded-2xl bg-[#4f6f52] px-4 py-3 text-white transition hover:bg-[#405d43] dark:bg-[#9caf88] dark:text-[#151b18]">
                                {{ $t['contact'] }}
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="px-3 pb-3 pt-10">
            <div
                class="mx-auto max-w-6xl overflow-hidden rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2]/80 shadow-[0_18px_70px_rgba(31,41,51,0.08)] backdrop-blur-xl dark:border-white/10 dark:bg-[#1f2722]/80 dark:shadow-[0_18px_70px_rgba(0,0,0,0.28)]">
                <div class="grid gap-0 lg:grid-cols-[1.15fr_0.85fr_0.85fr]">
                    <div class="relative border-b border-[#e3d8c8] p-7 dark:border-white/10 lg:border-b-0 lg:border-r">
                        <div
                            class="absolute -right-16 -top-16 h-44 w-44 rounded-full bg-[#d9a441]/20 blur-3xl dark:bg-[#d0a150]/20">
                        </div>

                        <div class="relative">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-full border border-[#e3d8c8] bg-[#f7f2ea] text-sm font-black text-[#4f6f52] dark:border-white/10 dark:bg-[#151b18] dark:text-[#c7d7a9]">
                                    AA
                                </div>

                                <div>
                                    <p class="text-lg font-black leading-tight">
                                        Arvita Agus Kurniasari
                                    </p>
                                    <p
                                        class="mt-1 text-xs font-bold uppercase tracking-[0.18em] text-[#4f6f52] dark:text-[#c7d7a9]">
                                        Academic Learning Hub
                                    </p>
                                </div>
                            </div>

                            <p class="mt-5 max-w-md text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                                {{ $t['footerDescription'] }}
                            </p>

                            <div class="mt-6 flex flex-wrap gap-2">
                                <a href="#"
                                    class="rounded-full border border-[#e3d8c8] bg-white/35 px-3 py-1.5 text-xs font-black text-[#6b6258] transition hover:-translate-y-0.5 hover:text-[#4f6f52] dark:border-white/10 dark:bg-white/5 dark:text-[#bdb4a7] dark:hover:text-[#c7d7a9]">
                                    SINTA
                                </a>
                                <a href="#"
                                    class="rounded-full border border-[#e3d8c8] bg-white/35 px-3 py-1.5 text-xs font-black text-[#6b6258] transition hover:-translate-y-0.5 hover:text-[#4f6f52] dark:border-white/10 dark:bg-white/5 dark:text-[#bdb4a7] dark:hover:text-[#c7d7a9]">
                                    Scholar
                                </a>
                                <a href="#"
                                    class="rounded-full border border-[#e3d8c8] bg-white/35 px-3 py-1.5 text-xs font-black text-[#6b6258] transition hover:-translate-y-0.5 hover:text-[#4f6f52] dark:border-white/10 dark:bg-white/5 dark:text-[#bdb4a7] dark:hover:text-[#c7d7a9]">
                                    Scopus
                                </a>
                                <a href="{{ route('supervisions.index') }}"
                                    class="rounded-full border border-[#e3d8c8] bg-white/35 px-3 py-1.5 text-xs font-black text-[#6b6258] transition hover:-translate-y-0.5 hover:text-[#4f6f52] dark:border-white/10 dark:bg-white/5 dark:text-[#bdb4a7] dark:hover:text-[#c7d7a9]">
                                    {{ $t['supervision'] }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-[#e3d8c8] p-7 dark:border-white/10 lg:border-b-0 lg:border-r">
                        <p class="text-xs font-black uppercase tracking-[0.22em] text-[#4f6f52] dark:text-[#c7d7a9]">
                            {{ $t['academicLinks'] }}
                        </p>

                        <div class="mt-5 grid gap-2 text-sm font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                            <a href="#"
                                class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                                <span>SINTA</span>
                                <span class="transition group-hover:translate-x-1">→</span>
                            </a>
                            <a href="#"
                                class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                                <span>Google Scholar</span>
                                <span class="transition group-hover:translate-x-1">→</span>
                            </a>
                            <a href="#"
                                class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                                <span>Scopus</span>
                                <span class="transition group-hover:translate-x-1">→</span>
                            </a>
                            <a href="#"
                                class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                                <span>GitHub</span>
                                <span class="transition group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </div>

                    <div class="p-7">
                        <p class="text-xs font-black uppercase tracking-[0.22em] text-[#4f6f52] dark:text-[#c7d7a9]">
                            {{ $t['content'] }}
                        </p>

                        <div class="mt-5 grid gap-2 text-sm font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                            @foreach ($navItems as $item)
                                <a href="{{ route($item['route']) }}"
                                    class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                                    <span>{{ $item['label'] }}</span>
                                    <span class="transition group-hover:translate-x-1">→</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div
                    class="flex flex-col gap-3 border-t border-[#e3d8c8] bg-[#f7f2ea]/60 px-7 py-5 text-xs font-semibold text-[#6b6258] dark:border-white/10 dark:bg-[#151b18]/50 dark:text-[#bdb4a7] sm:flex-row sm:items-center sm:justify-between">
                    <p>
                        © {{ date('Y') }} Arvita Agus Kurniasari. All rights reserved.
                    </p>

                    <p class="text-[#4f6f52] dark:text-[#c7d7a9]">
                        {{ $t['designedAs'] }}
                    </p>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>

</html>
