@php $locale = app()->getLocale() ?? 'id'; @endphp

<section class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
    <div class="rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2] p-7 shadow-sm dark:border-white/10 dark:bg-[#1f2722]">
        <p class="text-xs font-black uppercase tracking-[0.24em] text-[#4f6f52] dark:text-[#c7d7a9]">
            {{ $locale === 'en' ? 'Research Focus' : 'Fokus Riset' }}
        </p>

        <h2 class="mt-2 text-3xl font-black tracking-tight md:text-4xl">
            Web Development, IoT, Image Processing, AR, and Educational Technology.
        </h2>

        <div class="mt-7 grid gap-3 md:grid-cols-4">
            @foreach (['Web Development', 'Internet of Things', 'Image Processing', 'Augmented Reality'] as $item)
                <div class="rounded-2xl border border-[#e3d8c8] bg-white/35 p-4 dark:border-white/10 dark:bg-white/5">
                    <p class="text-sm font-black">{{ $item }}</p>
                    <p class="mt-2 text-sm leading-6 text-[#6b6258] dark:text-[#bdb4a7]">
                        {{ $locale === 'en' ? 'Applied academic research area.' : 'Area riset akademik terapan.' }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>