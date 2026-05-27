@php $locale = app()->getLocale() ?? 'id'; @endphp

<section class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
    <div class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffdf8] p-7 shadow-sm dark:border-white/10 dark:bg-[#202a24]">
        <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
            Academic Ecosystem
        </p>

        <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
            {{ $locale === 'en' ? 'Existing academic content stays visible.' : 'Konten akademik lama tetap hidup.' }}
        </h2>

        <div class="mt-7 grid gap-3 md:grid-cols-4">
            @foreach (['SINTA', 'Google Scholar', 'Scopus', 'Bimbinganku'] as $link)
                <a href="#" class="rounded-2xl border border-[#e3d8c8] bg-white/40 p-4 transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-white/5">
                    <p class="text-sm font-black">{{ $link }}</p>
                    <p class="mt-2 text-sm leading-6 text-[#6b6258] dark:text-[#bdb4a7]">
                        {{ $locale === 'en' ? 'Academic profile and related content.' : 'Profil akademik dan konten terkait.' }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</section>