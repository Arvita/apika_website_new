@php $locale = app()->getLocale() ?? 'id'; @endphp

<section class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
    <div class="grid gap-5 lg:grid-cols-[0.8fr_1.2fr]">
        <div class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffdf8] p-7 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
            <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                {{ $locale === 'en' ? 'Learning Space' : 'Ruang Belajar' }}
            </p>
            <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
                {{ $locale === 'en' ? 'Structured course materials.' : 'Materi kuliah yang runtut.' }}
            </h2>
            <p class="mt-3 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                {{ $locale === 'en'
                    ? 'Course pages are designed for comfortable reading, weekly navigation, and related videos.'
                    : 'Halaman materi dirancang nyaman dibaca, mudah dinavigasi per minggu, dan terhubung dengan video pembelajaran.' }}
            </p>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            @foreach (['Pemrograman Dasar', 'Object-Oriented Programming', 'Microsoft Office'] as $course)
                <div class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffaf2] p-5 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                    <p class="text-lg font-black">{{ $course }}</p>
                    <p class="mt-2 text-sm leading-6 text-[#6b6258] dark:text-[#bdb4a7]">
                        {{ $locale === 'en' ? 'Course materials and weekly learning path.' : 'Materi kuliah dan alur belajar mingguan.' }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>