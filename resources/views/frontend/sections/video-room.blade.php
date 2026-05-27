@php $locale = app()->getLocale() ?? 'id'; @endphp

<section class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
    <div class="grid gap-5 lg:grid-cols-[0.9fr_1.1fr]">
        <div class="relative min-h-[360px] overflow-hidden rounded-[2rem] border border-white/10 bg-[#172322] p-6 text-white shadow-xl">
            <p class="text-xs font-black uppercase tracking-[0.24em] text-white/60">
                {{ $locale === 'en' ? 'Video Room' : 'Ruang Video' }}
            </p>

            <h2 class="mt-3 max-w-md text-4xl font-black tracking-tight">
                {{ $locale === 'en' ? 'Curated learning videos.' : 'Video pembelajaran yang terkurasi.' }}
            </h2>

            <div class="mt-10 flex aspect-video items-center justify-center rounded-[1.2rem] bg-black/35">
                <span class="flex h-16 w-16 items-center justify-center rounded-full bg-white text-xl text-black shadow-xl">
                    ▶
                </span>
            </div>
        </div>

        <div class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2] p-7 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
            <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                YouTube Learning
            </p>

            <h2 class="mt-2 text-3xl font-black tracking-tight">
                {{ $locale === 'en' ? 'Videos linked to courses.' : 'Video terhubung dengan materi.' }}
            </h2>

            <p class="mt-3 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                {{ $locale === 'en'
                    ? 'Each video can have duration, topic, summary, and related course materials.'
                    : 'Setiap video bisa memiliki durasi, topik, ringkasan, dan materi kuliah terkait.' }}
            </p>
        </div>
    </div>
</section>