<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Arvita Agus Kurniasari | Academic Learning Hub')</title>

    <meta name="description" content="@yield('meta_description', 'Website akademik Arvita Agus Kurniasari untuk materi kuliah, publikasi ilmiah, video pembelajaran, riset, portfolio, dan bimbingan mahasiswa.')">

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }

        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem(
                'theme',
                document.documentElement.classList.contains('dark') ? 'dark' : 'light'
            );
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="min-h-screen bg-[#f7f2ea] text-[#1f2933] antialiased transition-colors duration-300 dark:bg-[#151b18] dark:text-[#f6f1e8]">
    <div class="relative min-h-screen overflow-x-hidden">
        <div class="pointer-events-none fixed -right-24 top-24 h-72 w-72 rounded-full bg-[#d9a441]/20 blur-3xl"></div>
        <div class="pointer-events-none fixed -left-24 top-96 h-80 w-80 rounded-full bg-[#4f6f52]/10 blur-3xl"></div>

        <header
            class="sticky top-0 z-50 border-b border-[#e3d8c8]/80 bg-[#f7f2ea]/85 backdrop-blur-xl dark:border-white/10 dark:bg-[#151b18]/85">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6">
                <a href="{{ route('home') }}" class="group flex items-center gap-3">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/brand/logo-aak-light.png') }}"
                            alt="Arvita Agus Kurniasari Academic Learning Hub"
                            class="h-11 w-auto max-w-[190px] object-contain transition duration-300 dark:hidden sm:h-12 sm:max-w-[230px]">

                        <img src="{{ asset('assets/brand/logo-aak-dark.png') }}"
                            alt="Arvita Agus Kurniasari Academic Learning Hub"
                            class="hidden h-11 w-auto max-w-[190px] object-contain transition duration-300 dark:block sm:h-12 sm:max-w-[230px]">
                    </div>
                </a>

                <nav class="hidden items-center gap-6 text-sm font-medium text-[#6b6258] dark:text-[#bdb4a7] lg:flex">
                    <a href="{{ route('courses.index') }}"
                        class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Belajar</a>
                    <a href="{{ route('publications.index') }}"
                        class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Jurnal</a>
                    <a href="{{ route('videos.index') }}"
                        class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Video</a>
                    <a href="{{ route('research') }}"
                        class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Riset</a>
                    <a href="{{ route('supervisions.index') }}"
                        class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Bimbinganku</a>
                    <a href="{{ route('portfolio.index') }}"
                        class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Portfolio</a>
                </nav>

                <div class="flex items-center gap-2">
                    <button type="button"
                        class="rounded-full border border-[#e3d8c8] bg-[#fffaf2] px-3 py-2 text-xs font-black text-[#4f6f52] dark:border-white/10 dark:bg-[#1f2722] dark:text-[#c7d7a9]">
                        ID
                    </button>

                    <button type="button" onclick="toggleTheme()"
                        class="rounded-full border border-[#e3d8c8] bg-[#fffaf2] px-3 py-2 text-xs font-black text-[#4f6f52] dark:border-white/10 dark:bg-[#1f2722] dark:text-[#c7d7a9]">
                        Mode
                    </button>

                    <a href="{{ route('contact') }}"
                        class="hidden rounded-full bg-[#4f6f52] px-4 py-2 text-sm font-bold text-white dark:bg-[#9caf88] dark:text-[#151b18] sm:inline-flex">
                        Kontak
                    </a>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="border-t border-[#e3d8c8] bg-[#fffaf2]/70 dark:border-white/10 dark:bg-[#1f2722]/70">
            <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 sm:px-6 md:grid-cols-[1.2fr_0.8fr_0.8fr]">
                <div>
                    <p class="text-lg font-black">Arvita Agus Kurniasari</p>
                    <p class="mt-3 max-w-md text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                        Website akademik untuk materi kuliah, publikasi, video pembelajaran, riset, portfolio, dan
                        bimbingan mahasiswa.
                    </p>
                </div>

                <div>
                    <p class="text-sm font-black">Profil Akademik</p>
                    <div class="mt-4 space-y-2 text-sm text-[#6b6258] dark:text-[#bdb4a7]">
                        <a href="#" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">SINTA</a>
                        <a href="#" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Google
                            Scholar</a>
                        <a href="#" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Scopus</a>
                        <a href="#" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">GitHub</a>
                    </div>
                </div>

                <div>
                    <p class="text-sm font-black">Konten</p>
                    <div class="mt-4 space-y-2 text-sm text-[#6b6258] dark:text-[#bdb4a7]">
                        <a href="{{ route('courses.index') }}"
                            class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Belajar</a>
                        <a href="{{ route('publications.index') }}"
                            class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Jurnal</a>
                        <a href="{{ route('videos.index') }}"
                            class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Video</a>
                        <a href="{{ route('supervisions.index') }}"
                            class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Bimbinganku</a>
                    </div>
                </div>
            </div>

            <div
                class="border-t border-[#e3d8c8] py-5 text-center text-xs text-[#6b6258] dark:border-white/10 dark:text-[#bdb4a7]">
                © {{ date('Y') }} Arvita Agus Kurniasari. All rights reserved.
            </div>
        </footer>
    </div>
</body>

</html>
