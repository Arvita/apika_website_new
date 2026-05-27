<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Arvita Agus Kurniasari</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/brand/favicon-aak.png') }}?v=3">
    <link rel="shortcut icon" href="{{ asset('assets/brand/favicon.ico') }}?v=3">

    <script>
        (function () {
            const storedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f7f2ea] text-[#17212b] antialiased transition-colors duration-300 dark:bg-[#151b18] dark:text-[#f6f1e8]">
    <main class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-10">
        <div class="pointer-events-none absolute -left-24 top-10 h-72 w-72 rounded-full bg-[#4f6f52]/12 blur-3xl dark:bg-[#e9efe1]/8"></div>
        <div class="pointer-events-none absolute -right-24 bottom-10 h-80 w-80 rounded-full bg-[#c2a85a]/16 blur-3xl dark:bg-[#c2a85a]/10"></div>

        <section class="relative grid w-full max-w-5xl overflow-hidden rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2]/86 shadow-[0_28px_90px_rgba(31,41,51,0.14)] backdrop-blur-xl dark:border-white/10 dark:bg-[#1f2722]/90 dark:shadow-[0_28px_90px_rgba(0,0,0,0.34)] lg:grid-cols-[0.95fr_1.05fr]">

            <aside class="relative hidden overflow-hidden bg-gradient-to-br from-[#eaf0e6] via-[#dfe7d4] to-[#c8b36c] p-8 dark:from-[#223128] dark:via-[#2b3a2f] dark:to-[#6f633f] lg:block">
                <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-white/25 blur-3xl dark:bg-white/6"></div>
                <div class="absolute -bottom-20 -left-20 h-72 w-72 rounded-full bg-[#fffaf2]/30 blur-3xl dark:bg-[#d8c279]/10"></div>

                <div class="relative flex h-full flex-col justify-between">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full border border-white/45 bg-white/30 px-3 py-1.5 text-xs font-black uppercase tracking-[0.2em] text-[#3f5d42] backdrop-blur dark:border-white/10 dark:bg-white/10 dark:text-[#eef4df]">
                            <span class="h-2 w-2 rounded-full bg-[#4f6f52] dark:bg-[#e9efe1]"></span>
                            Admin Site
                        </div>

                        <div class="mt-8 rounded-[1.6rem] border border-white/45 bg-white/36 p-5 shadow-sm backdrop-blur-md dark:border-white/10 dark:bg-white/8">
                            <div class="block dark:hidden">
                                <img
                                    src="{{ asset('assets/brand/logo-aak-light.png') }}?v=3"
                                    alt="Arvita Agus Kurniasari"
                                    class="h-12 w-auto max-w-[300px] object-contain"
                                >
                            </div>

                            <div class="hidden dark:block">
                                <img
                                    src="{{ asset('assets/brand/logo-aak-dark.png') }}?v=3"
                                    alt="Arvita Agus Kurniasari"
                                    class="h-12 w-auto max-w-[300px] object-contain"
                                >
                            </div>

                            <p class="mt-5 max-w-sm text-sm font-semibold leading-7 text-[#4d564d] dark:text-[#f2ecdf]/78">
                                Kelola materi, publikasi, video, riset, portfolio, dan bimbingan mahasiswa dalam satu ruang admin yang rapi.
                            </p>
                        </div>
                    </div>

                    <div class="mt-10 grid grid-cols-2 gap-3">
                        <div class="rounded-2xl border border-white/45 bg-white/28 p-4 backdrop-blur dark:border-white/10 dark:bg-white/8">
                            <p class="text-2xl font-black text-[#22313c] dark:text-[#f6f1e8]">AAK</p>
                            <p class="mt-1 text-xs font-bold text-[#5f5a52] dark:text-[#e8ded0]/70">Academic Hub</p>
                        </div>

                        <div class="rounded-2xl border border-white/45 bg-white/28 p-4 backdrop-blur dark:border-white/10 dark:bg-white/8">
                            <p class="text-2xl font-black text-[#22313c] dark:text-[#f6f1e8]">CMS</p>
                            <p class="mt-1 text-xs font-bold text-[#5f5a52] dark:text-[#e8ded0]/70">Content Control</p>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="p-6 sm:p-8 lg:p-10">
                <div class="flex items-center justify-between gap-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full border border-[#e3d8c8] bg-white/60 px-4 py-2 text-xs font-black text-[#4f6f52] transition hover:-translate-y-0.5 hover:bg-white dark:border-white/10 dark:bg-white/5 dark:text-[#f6f1e8] dark:hover:bg-white/10">
                        ← Website
                    </a>

                    <button
                        type="button"
                        onclick="
                            document.documentElement.classList.toggle('dark');
                            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
                        "
                        class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-[#e3d8c8] bg-white/60 text-[#4f6f52] transition hover:-translate-y-0.5 hover:bg-white dark:border-white/10 dark:bg-white/5 dark:text-[#f6f1e8] dark:hover:bg-white/10"
                        aria-label="Toggle theme"
                    >
                        <span class="dark:hidden">☾</span>
                        <span class="hidden dark:inline">☀</span>
                    </button>
                </div>

                <div class="mt-10 lg:hidden">
                    <div class="block dark:hidden">
                        <img
                            src="{{ asset('assets/brand/logo-aak-light.png') }}?v=3"
                            alt="Arvita Agus Kurniasari"
                            class="h-12 w-auto max-w-[280px] object-contain"
                        >
                    </div>

                    <div class="hidden dark:block">
                        <img
                            src="{{ asset('assets/brand/logo-aak-dark.png') }}?v=3"
                            alt="Arvita Agus Kurniasari"
                            class="h-12 w-auto max-w-[280px] object-contain"
                        >
                    </div>
                </div>

                {{ $slot }}
            </div>
        </section>
    </main>
</body>
</html>