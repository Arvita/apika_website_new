@php
    $locale = app()->getLocale() ?: session('locale', 'id');
    $locale = in_array($locale, ['id', 'en']) ? $locale : 'id';

    $nextLocale = $locale === 'id' ? 'en' : 'id';

    $hasLanguageRoute = \Illuminate\Support\Facades\Route::has('language.switch');
    $languageUrl = $hasLanguageRoute
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
            'footerDescription' => 'Website akademik untuk materi kuliah, publikasi, video pembelajaran, riset, portfolio, dan bimbingan mahasiswa.',
            'themeDark' => 'Gelap',
            'themeLight' => 'Terang',
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
            'footerDescription' => 'Academic website for course materials, publications, learning videos, research, portfolio, and student supervision.',
            'themeDark' => 'Dark',
            'themeLight' => 'Light',
        ],
    ];

    $t = $labels[$locale];

    $siteName = 'Arvita Agus Kurniasari';
    $defaultTitle = $locale === 'en'
        ? 'Arvita Agus Kurniasari | Academic Learning Hub'
        : 'Arvita Agus Kurniasari | Website Akademik dan Materi Pembelajaran';

    $defaultDescription = $locale === 'en'
        ? 'Academic website of Arvita Agus Kurniasari containing course materials, scientific publications, learning videos, research, portfolio, and student supervision.'
        : 'Website akademik Arvita Agus Kurniasari untuk materi kuliah, publikasi ilmiah, video pembelajaran, riset, portfolio, dan bimbingan mahasiswa.';

    $title = trim($__env->yieldContent('title', $defaultTitle));
    $description = trim($__env->yieldContent('meta_description', $defaultDescription));

    $canonical = rtrim(config('app.url'), '/') . '/' . ltrim(request()->path(), '/');

    if (request()->path() === '/') {
        $canonical = rtrim(config('app.url'), '/') . '/';
    }

    $canonical = trim($__env->yieldContent('canonical', $canonical));
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
    <meta property="og:site_name" content="{{ $siteName }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', $title)">
    <meta name="twitter:description" content="@yield('twitter_description', $description)">

    <script>
        (function () {
            const savedTheme = localStorage.getItem('theme');

            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }

            window.toggleTheme = function () {
                const html = document.documentElement;
                const isDark = html.classList.toggle('dark');

                localStorage.setItem('theme', isDark ? 'dark' : 'light');

                const label = document.getElementById('theme-label');

                if (label) {
                    label.textContent = isDark
                        ? label.dataset.lightText
                        : label.dataset.darkText;
                }
            };

            window.addEventListener('DOMContentLoaded', function () {
                const label = document.getElementById('theme-label');
                const isDark = document.documentElement.classList.contains('dark');

                if (label) {
                    label.textContent = isDark
                        ? label.dataset.lightText
                        : label.dataset.darkText;
                }
            });
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="min-h-screen bg-[#f7f2ea] text-[#1f2933] antialiased transition-colors duration-300 dark:bg-[#151b18] dark:text-[#f6f1e8]">
    <div class="relative min-h-screen overflow-x-hidden">
        <div class="pointer-events-none fixed -right-24 top-24 h-72 w-72 rounded-full bg-[#d9a441]/20 blur-3xl dark:bg-[#d0a150]/20"></div>
        <div class="pointer-events-none fixed -left-24 top-96 h-80 w-80 rounded-full bg-[#4f6f52]/10 blur-3xl dark:bg-[#9caf88]/10"></div>

        <header class="sticky top-0 z-50 border-b border-[#e3d8c8]/80 bg-[#f7f2ea]/85 backdrop-blur-xl transition-colors duration-300 dark:border-white/10 dark:bg-[#151b18]/85">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-full border border-[#e3d8c8] bg-[#fffaf2] text-[#4f6f52] shadow-sm transition-colors duration-300 dark:border-white/10 dark:bg-[#1f2722] dark:text-[#c7d7a9]">
                        <span class="text-sm font-black">AA</span>
                    </div>

                    <div>
                        <p class="text-sm font-black leading-none tracking-tight">
                            Arvita Agus K.
                        </p>
                        <p class="mt-1 text-xs text-[#6b6258] dark:text-[#bdb4a7]">
                            Academic Learning Hub
                        </p>
                    </div>
                </a>

                <nav class="hidden items-center gap-6 text-sm font-medium text-[#6b6258] dark:text-[#bdb4a7] lg:flex">
                    <a href="{{ route('courses.index') }}" class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                        {{ $t['learn'] }}
                    </a>
                    <a href="{{ route('publications.index') }}" class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                        {{ $t['journals'] }}
                    </a>
                    <a href="{{ route('videos.index') }}" class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                        {{ $t['videos'] }}
                    </a>
                    <a href="{{ route('research') }}" class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                        {{ $t['research'] }}
                    </a>
                    <a href="{{ route('supervisions.index') }}" class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                        {{ $t['supervision'] }}
                    </a>
                    <a href="{{ route('portfolio.index') }}" class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                        {{ $t['portfolio'] }}
                    </a>
                </nav>

                <div class="flex items-center gap-2">
                    <a
                        href="{{ $languageUrl }}"
                        class="rounded-full border border-[#e3d8c8] bg-[#fffaf2] px-3 py-2 text-xs font-black text-[#4f6f52] transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-[#1f2722] dark:text-[#c7d7a9]"
                        title="Switch language"
                    >
                        {{ strtoupper($nextLocale) }}
                    </a>

                    <button
                        type="button"
                        onclick="toggleTheme()"
                        class="rounded-full border border-[#e3d8c8] bg-[#fffaf2] px-3 py-2 text-xs font-black text-[#4f6f52] transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-[#1f2722] dark:text-[#c7d7a9]"
                    >
                        <span
                            id="theme-label"
                            data-dark-text="{{ $t['themeDark'] }}"
                            data-light-text="{{ $t['themeLight'] }}"
                        >
                            {{ $t['themeDark'] }}
                        </span>
                    </button>

                    <a
                        href="{{ route('contact') }}"
                        class="hidden rounded-full bg-[#4f6f52] px-4 py-2 text-sm font-bold text-white transition hover:-translate-y-0.5 dark:bg-[#9caf88] dark:text-[#151b18] sm:inline-flex"
                    >
                        {{ $t['contact'] }}
                    </a>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="border-t border-[#e3d8c8] bg-[#fffaf2]/70 transition-colors duration-300 dark:border-white/10 dark:bg-[#1f2722]/70">
            <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 sm:px-6 md:grid-cols-[1.2fr_0.8fr_0.8fr]">
                <div>
                    <p class="text-lg font-black">Arvita Agus Kurniasari</p>
                    <p class="mt-3 max-w-md text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                        {{ $t['footerDescription'] }}
                    </p>
                </div>

                <div>
                    <p class="text-sm font-black">{{ $t['academicLinks'] }}</p>
                    <div class="mt-4 space-y-2 text-sm text-[#6b6258] dark:text-[#bdb4a7]">
                        <a href="#" class="block transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">SINTA</a>
                        <a href="#" class="block transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Google Scholar</a>
                        <a href="#" class="block transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Scopus</a>
                        <a href="#" class="block transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">GitHub</a>
                    </div>
                </div>

                <div>
                    <p class="text-sm font-black">{{ $t['content'] }}</p>
                    <div class="mt-4 space-y-2 text-sm text-[#6b6258] dark:text-[#bdb4a7]">
                        <a href="{{ route('courses.index') }}" class="block transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                            {{ $t['learn'] }}
                        </a>
                        <a href="{{ route('publications.index') }}" class="block transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                            {{ $t['journals'] }}
                        </a>
                        <a href="{{ route('videos.index') }}" class="block transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                            {{ $t['videos'] }}
                        </a>
                        <a href="{{ route('supervisions.index') }}" class="block transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                            {{ $t['supervision'] }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-[#e3d8c8] py-5 text-center text-xs text-[#6b6258] dark:border-white/10 dark:text-[#bdb4a7]">
                © {{ date('Y') }} Arvita Agus Kurniasari. All rights reserved.
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>