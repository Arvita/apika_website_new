@php
    $locale = app()->getLocale() ?? 'id';
@endphp

<section class="mx-auto grid max-w-6xl items-start gap-10 px-4 pb-16 pt-10 sm:px-6 lg:grid-cols-[0.9fr_1.1fr]">
    <div>
        <div class="inline-flex rotate-[-1deg] items-center gap-2 rounded-full border border-[#d8e2d2] bg-[#eaf0e6] px-3 py-1 text-xs font-bold text-[#3e5d42] dark:border-white/10 dark:bg-[#314033] dark:text-[#dce8cc]">
            Human Academic Learning Hub
        </div>

        <h1 class="mt-7 max-w-3xl text-4xl font-black leading-[0.98] tracking-[-0.055em] sm:text-5xl md:text-7xl">
            {{ $locale === 'en'
                ? 'Learn, read, and watch comfortably.'
                : 'Belajar, membaca, dan menonton dengan nyaman.' }}
        </h1>

        <p class="mt-6 max-w-xl text-base leading-8 text-[#6b6258] dark:text-[#bdb4a7] sm:text-lg">
            {{ $locale === 'en'
                ? 'Arvita Agus Kurniasari’s academic website is designed as a warm learning hub for course materials, publications, videos, research, and student supervision.'
                : 'Website akademik Arvita Agus Kurniasari dirancang sebagai ruang belajar yang hangat untuk materi kuliah, publikasi, video pembelajaran, riset, dan bimbingan mahasiswa.' }}
        </p>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('courses.index') }}" class="rounded-full bg-[#4f6f52] px-5 py-3 text-sm font-black text-white dark:bg-[#9caf88] dark:text-[#151b18]">
                {{ $locale === 'en' ? 'Start learning' : 'Mulai belajar' }}
            </a>

            <a href="{{ route('publications.index') }}" class="rounded-full border border-[#e3d8c8] bg-[#fffaf2] px-5 py-3 text-sm font-black dark:border-white/10 dark:bg-[#1f2722]">
                {{ $locale === 'en' ? 'Read journals' : 'Baca jurnal' }}
            </a>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-[1fr_0.85fr]">
        <div class="relative min-h-[430px] overflow-hidden rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2] p-4 shadow-xl dark:border-white/10 dark:bg-[#1f2722]">
            <div class="absolute inset-x-6 top-6 h-60 rounded-[1.5rem] bg-gradient-to-br from-[#4f6f52] to-[#7b8f68] opacity-95 dark:from-[#7f9869] dark:to-[#b89b58]"></div>
            <div class="absolute inset-x-10 top-12 h-52 rounded-[40%_60%_55%_45%] bg-white/20"></div>

            <div class="absolute bottom-5 left-5 right-5 rounded-[1.4rem] bg-white/85 p-4 shadow-lg backdrop-blur dark:bg-[#f7f2ea]/90">
                <p class="text-xs font-black uppercase tracking-[0.2em] text-black/50">Learning note</p>
                <p class="mt-2 text-sm font-bold leading-6 text-black/80">
                    {{ $locale === 'en'
                        ? 'A website should feel like a lecturer’s desk: organized, warm, and useful.'
                        : 'Website ini dibuat seperti meja kerja dosen: terarah, rapi, hangat, dan bermanfaat.' }}
                </p>
            </div>
        </div>

        <div class="space-y-4">
            <div class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffdf8] p-5 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
                <p class="text-xs font-black uppercase tracking-[0.2em] text-[#4f6f52] dark:text-[#c7d7a9]">Quick access</p>

                <div class="mt-4 flex flex-wrap gap-2">
                    <a href="#" class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold dark:border-white/10">SINTA</a>
                    <a href="#" class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold dark:border-white/10">Scholar</a>
                    <a href="#" class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold dark:border-white/10">Scopus</a>
                    <a href="{{ route('supervisions.index') }}" class="rounded-full border border-[#e3d8c8] px-3 py-1.5 text-xs font-bold dark:border-white/10">
                        {{ $locale === 'en' ? 'Supervision' : 'Bimbinganku' }}
                    </a>
                </div>
            </div>

            <div class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffaf2] p-5 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
                <p class="text-xs font-black uppercase tracking-[0.2em] text-[#4f6f52] dark:text-[#c7d7a9]">Focus</p>
                <p class="mt-3 text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                    Web Development, OOP, IoT, Image Processing, Augmented Reality, and Educational Technology.
                </p>
            </div>
        </div>
    </div>
</section>