<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Arvita Agus Kurniasari</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f7f2ea] text-[#1f2933] dark:bg-[#151b18] dark:text-[#f6f1e8]">

    <div class="mx-auto max-w-6xl px-6 py-8">
        <div class="rounded-[2rem] border border-[#e3d8c8] bg-white/70 p-6 shadow-sm dark:border-white/10 dark:bg-white/5">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.22em] text-[#4f6f52] dark:text-[#c7d7a9]">
                        Admin Site
                    </p>

                    <h1 class="mt-2 text-3xl font-black tracking-tight">
                        Dashboard Admin
                    </h1>

                    <p class="mt-2 text-sm text-[#6b6258] dark:text-[#d7cec0]/75">
                        Selamat datang, {{ auth()->user()->name }}.
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="rounded-full bg-[#4f6f52] px-5 py-3 text-sm font-black text-white transition hover:bg-[#405d43] dark:bg-[#e9efe1] dark:text-[#151b18]"
                    >
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-3">
            <a href="#" class="rounded-[1.5rem] border border-[#e3d8c8] bg-white/70 p-5 shadow-sm transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-white/5">
                <p class="text-sm font-black">Publications</p>
                <p class="mt-2 text-sm text-[#6b6258] dark:text-[#d7cec0]/75">
                    Kelola jurnal, SINTA, Scholar, Scopus, dan DOI.
                </p>
            </a>

            <a href="#" class="rounded-[1.5rem] border border-[#e3d8c8] bg-white/70 p-5 shadow-sm transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-white/5">
                <p class="text-sm font-black">Courses</p>
                <p class="mt-2 text-sm text-[#6b6258] dark:text-[#d7cec0]/75">
                    Kelola materi kuliah dan learning path.
                </p>
            </a>

            <a href="#" class="rounded-[1.5rem] border border-[#e3d8c8] bg-white/70 p-5 shadow-sm transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-white/5">
                <p class="text-sm font-black">Videos</p>
                <p class="mt-2 text-sm text-[#6b6258] dark:text-[#d7cec0]/75">
                    Kelola video pembelajaran.
                </p>
            </a>
        </div>
    </div>

</body>
</html>