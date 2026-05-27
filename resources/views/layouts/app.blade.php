<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?? 'id' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Arvita Agus Kurniasari')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f7f2ea] text-[#1f2933] antialiased dark:bg-[#151b18] dark:text-[#f6f1e8]">
    <div class="relative min-h-screen overflow-x-hidden">
        <div class="pointer-events-none fixed -right-24 top-24 h-72 w-72 rounded-full bg-[#d9a441]/20 blur-3xl"></div>
        <div class="pointer-events-none fixed -left-24 top-96 h-80 w-80 rounded-full bg-[#4f6f52]/10 blur-3xl"></div>

        <header class="sticky top-0 z-50 border-b border-[#e3d8c8]/80 bg-[#f7f2ea]/85 backdrop-blur-xl">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-full border border-[#e3d8c8] bg-[#fffaf2] text-[#4f6f52] shadow-sm">
                        <span class="text-sm font-black">AA</span>
                    </div>

                    <div>
                        <p class="text-sm font-black leading-none tracking-tight">
                            Arvita Agus K.
                        </p>
                        <p class="mt-1 text-xs text-[#6b6258]">
                            Academic Learning Hub
                        </p>
                    </div>
                </a>

                <nav class="hidden items-center gap-6 text-sm font-medium text-[#6b6258] lg:flex">
                    <a href="{{ route('courses.index') }}" class="hover:text-[#4f6f52]">Belajar</a>
                    <a href="{{ route('publications.index') }}" class="hover:text-[#4f6f52]">Jurnal</a>
                    <a href="{{ route('videos.index') }}" class="hover:text-[#4f6f52]">Video</a>
                    <a href="{{ route('research') }}" class="hover:text-[#4f6f52]">Riset</a>
                    <a href="{{ route('supervisions.index') }}" class="hover:text-[#4f6f52]">Bimbinganku</a>
                    <a href="{{ route('portfolio.index') }}" class="hover:text-[#4f6f52]">Portfolio</a>
                </nav>

                <a href="{{ route('contact') }}" class="rounded-full bg-[#4f6f52] px-4 py-2 text-sm font-bold text-white">
                    Kontak
                </a>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="border-t border-[#e3d8c8] bg-[#fffaf2]/60">
            <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 sm:px-6 md:grid-cols-[1.2fr_0.8fr_0.8fr]">
                <div>
                    <p class="text-lg font-black">Arvita Agus Kurniasari</p>
                    <p class="mt-3 max-w-md text-sm leading-7 text-[#6b6258]">
                        Website akademik untuk materi kuliah, publikasi, video pembelajaran, riset, portfolio, dan bimbingan mahasiswa.
                    </p>
                </div>

                <div>
                    <p class="text-sm font-black">Profil Akademik</p>
                    <div class="mt-4 space-y-2 text-sm text-[#6b6258]">
                        <a href="#" class="block hover:text-[#4f6f52]">SINTA</a>
                        <a href="#" class="block hover:text-[#4f6f52]">Google Scholar</a>
                        <a href="#" class="block hover:text-[#4f6f52]">Scopus</a>
                        <a href="#" class="block hover:text-[#4f6f52]">GitHub</a>
                    </div>
                </div>

                <div>
                    <p class="text-sm font-black">Konten</p>
                    <div class="mt-4 space-y-2 text-sm text-[#6b6258]">
                        <a href="{{ route('courses.index') }}" class="block hover:text-[#4f6f52]">Belajar</a>
                        <a href="{{ route('publications.index') }}" class="block hover:text-[#4f6f52]">Jurnal</a>
                        <a href="{{ route('videos.index') }}" class="block hover:text-[#4f6f52]">Video</a>
                        <a href="{{ route('supervisions.index') }}" class="block hover:text-[#4f6f52]">Bimbinganku</a>
                    </div>
                </div>
            </div>

            <div class="border-t border-[#e3d8c8] py-5 text-center text-xs text-[#6b6258]">
                © {{ date('Y') }} Arvita Agus Kurniasari. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>