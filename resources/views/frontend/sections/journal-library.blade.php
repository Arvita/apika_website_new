@php $locale = app()->getLocale() ?? 'id'; @endphp

<section class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
    <div class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2] p-7 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
                    {{ $locale === 'en' ? 'Journal Library' : 'Perpustakaan Jurnal' }}
                </p>
                <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
                    {{ $locale === 'en' ? 'Publications with academic links.' : 'Publikasi dengan tautan akademik.' }}
                </h2>
                <p class="mt-3 max-w-2xl text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                    {{ $locale === 'en'
                        ? 'Publications connect to SINTA, Google Scholar, Scopus, and supervision content.'
                        : 'Publikasi tetap terhubung ke SINTA, Google Scholar, Scopus, dan Bimbinganku.' }}
                </p>
            </div>

            <a href="{{ route('publications.index') }}" class="rounded-full bg-[#4f6f52] px-5 py-3 text-sm font-black text-white dark:bg-[#9caf88] dark:text-[#151b18]">
                {{ $locale === 'en' ? 'View publications' : 'Lihat publikasi' }}
            </a>
        </div>
    </div>
</section>