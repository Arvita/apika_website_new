@extends('frontend.layouts.app')

@section('title', 'Videos | Arvita Agus Kurniasari')

@section('content')

@php
    $locale = session('locale', app()->getLocale() ?: 'id');
    $locale = in_array($locale, ['id', 'en']) ? $locale : 'id';
@endphp

<main class="mx-auto max-w-6xl px-4 pb-16 pt-10 sm:px-6">

    <section>
        <p class="text-xs font-black uppercase tracking-[0.22em] text-[#4f6f52] dark:text-[#c7d7a9]">
            {{ $locale === 'en' ? 'Academic Videos' : 'Video Akademik' }}
        </p>

        <h1 class="mt-4 text-4xl font-black tracking-[-0.04em] text-[#17212b] dark:text-[#f6f1e8] md:text-5xl">
            {{ $locale === 'en' ? 'Learning videos and academic resources.' : 'Video pembelajaran dan sumber akademik.' }}
        </h1>

        <p class="mt-4 max-w-2xl text-base leading-8 text-[#6b6258] dark:text-[#bdb4a7]">
            {{ $locale === 'en'
                ? 'Explore curated videos from Arvita Agus Kurniasari’s YouTube channel for learning, teaching, and academic references.'
                : 'Telusuri video pilihan dari channel YouTube Arvita Agus Kurniasari untuk pembelajaran, pengajaran, dan referensi akademik.' }}
        </p>

        <div class="mt-6">
            <a
                href="https://www.youtube.com/@arvitaaguskurniasari434"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex rounded-full bg-[#4f6f52] px-4 py-2 text-xs font-black text-white"
            >
                {{ $locale === 'en' ? 'Visit YouTube Channel' : 'Kunjungi Channel YouTube' }}
            </a>
        </div>
    </section>

    <section class="mt-10 space-y-4">
        @forelse ($videos as $video)
            @php
                $title = $locale === 'en' && filled($video->title_en)
                    ? $video->title_en
                    : $video->title;

                $description = $locale === 'en' && filled($video->description_en)
                    ? $video->description_en
                    : $video->description;

                $embedUrl = $video->embed_url ?? ('https://www.youtube.com/embed/' . $video->youtube_id);
            @endphp

            <article class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffaf2]/80 p-5 dark:border-white/10 dark:bg-white/5 sm:p-6">
                <div class="grid gap-6 lg:grid-cols-[minmax(0,0.95fr)_minmax(0,1.25fr)] lg:items-start">

                    <div class="overflow-hidden rounded-[1.2rem] border border-[#e3d8c8] bg-[#17212b] dark:border-white/10">
                        <div class="aspect-video">
                            <iframe
                                class="h-full w-full"
                                src="{{ $embedUrl }}"
                                title="{{ $title }}"
                                loading="lazy"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    <div>
                        <div class="flex flex-wrap gap-2">
                            @if ($video->year)
                                <span class="rounded-full bg-[#eef3e8] px-3 py-1 text-xs font-black text-[#4f6f52] dark:bg-white/10 dark:text-[#dce8cc]">
                                    {{ $video->year }}
                                </span>
                            @endif

                            @if ($video->category)
                                <span class="rounded-full bg-[#fbf4e7] px-3 py-1 text-xs font-black text-[#9a761c] dark:bg-white/10 dark:text-[#f3e8c5]">
                                    {{ $video->category }}
                                </span>
                            @endif

                            @if ($video->topic)
                                <span class="rounded-full bg-[#f1f1ef] px-3 py-1 text-xs font-black text-[#6b6258] dark:bg-white/10 dark:text-[#d7cec0]">
                                    {{ $video->topic }}
                                </span>
                            @endif

                            @if ($video->is_featured)
                                <span class="rounded-full bg-[#eef3e8] px-3 py-1 text-xs font-black text-[#4f6f52] dark:bg-white/10 dark:text-[#dce8cc]">
                                    Featured
                                </span>
                            @endif
                        </div>

                        <h2 class="mt-4 text-xl font-black leading-snug text-[#17212b] dark:text-[#f6f1e8]">
                            {{ $title }}
                        </h2>

                        @if ($description)
                            <p class="mt-4 max-w-3xl text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                                {{ \Illuminate\Support\Str::limit(strip_tags($description), 220) }}
                            </p>
                        @else
                            <p class="mt-4 max-w-3xl text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                                {{ $locale === 'en'
                                    ? 'Academic learning video from Arvita Agus Kurniasari’s YouTube channel.'
                                    : 'Video pembelajaran akademik dari channel YouTube Arvita Agus Kurniasari.' }}
                            </p>
                        @endif

                        <div class="mt-5 flex flex-wrap gap-2">
                            <a
                                href="{{ $video->youtube_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="rounded-full bg-[#4f6f52] px-3 py-2 text-xs font-black text-white"
                            >
                                {{ $locale === 'en' ? 'Watch on YouTube' : 'Tonton di YouTube' }}
                            </a>

                            <a
                                href="https://www.youtube.com/@arvitaaguskurniasari434"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="rounded-full border border-[#e3d8c8] px-3 py-2 text-xs font-black text-[#17212b] dark:border-white/10 dark:text-[#f6f1e8]"
                            >
                                Channel
                            </a>
                        </div>
                    </div>

                </div>
            </article>
        @empty
            <div class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffaf2]/80 p-8 text-center dark:border-white/10 dark:bg-white/5">
                <p class="text-sm font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                    {{ $locale === 'en' ? 'No videos yet.' : 'Belum ada video.' }}
                </p>
            </div>
        @endforelse
    </section>

    @if ($videos->hasPages())
        <div class="mt-8">
            {{ $videos->onEachSide(1)->links('vendor.pagination.academic') }}
        </div>
    @endif

</main>

@endsection