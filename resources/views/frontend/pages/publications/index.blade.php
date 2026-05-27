@extends('frontend.layouts.app')

@section('title', 'Publications | Arvita Agus Kurniasari')

@section('content')
@php
    $locale = session('locale', app()->getLocale() ?: 'id');
    $locale = in_array($locale, ['id', 'en']) ? $locale : 'id';
@endphp

<main class="mx-auto max-w-6xl px-4 pb-16 pt-10 sm:px-6">
    <section>
        <p class="text-xs font-black uppercase tracking-[0.22em] text-[#4f6f52] dark:text-[#c7d7a9]">
            {{ $locale === 'en' ? 'Academic Publications' : 'Publikasi Akademik' }}
        </p>

        <h1 class="mt-4 text-4xl font-black tracking-[-0.04em] text-[#17212b] dark:text-[#f6f1e8] md:text-5xl">
            {{ $locale === 'en' ? 'Research and scientific publications.' : 'Riset dan publikasi ilmiah.' }}
        </h1>

        <p class="mt-4 max-w-2xl text-base leading-8 text-[#6b6258] dark:text-[#bdb4a7]">
            {{ $locale === 'en'
                ? 'Explore academic works, journal papers, conference publications, and related research links.'
                : 'Telusuri karya akademik, jurnal, publikasi konferensi, dan tautan riset terkait.' }}
        </p>
    </section>

    <section class="mt-10 space-y-4">
        @forelse ($publications as $publication)
            <article class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffaf2]/80 p-6 dark:border-white/10 dark:bg-white/5">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div>
                        <div class="flex flex-wrap gap-2">
                            @if ($publication->year)
                                <span class="rounded-full bg-[#eef3e8] px-3 py-1 text-xs font-black text-[#4f6f52] dark:bg-white/10 dark:text-[#dce8cc]">
                                    {{ $publication->year }}
                                </span>
                            @endif

                            <span class="rounded-full bg-[#fbf4e7] px-3 py-1 text-xs font-black text-[#9a761c] dark:bg-white/10 dark:text-[#f3e8c5]">
                                {{ str_replace('_', ' ', ucfirst($publication->type)) }}
                            </span>

                            @if ($publication->citation_count)
                                <span class="rounded-full bg-[#f1f1ef] px-3 py-1 text-xs font-black text-[#6b6258] dark:bg-white/10 dark:text-[#d7cec0]">
                                    {{ $publication->citation_count }} citations
                                </span>
                            @endif
                        </div>

                        <h2 class="mt-4 text-xl font-black leading-snug text-[#17212b] dark:text-[#f6f1e8]">
                            {{ $publication->displayTitle($locale) }}
                        </h2>

                        <p class="mt-3 text-sm font-semibold leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                            {{ $publication->authors }}
                        </p>

                        @if ($publication->venue)
                            <p class="mt-2 text-sm font-bold text-[#4f6f52] dark:text-[#c7d7a9]">
                                {{ $publication->venue }}
                            </p>
                        @endif

                        @if ($publication->displayAbstract($locale))
                            <p class="mt-4 max-w-3xl text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                                {{ $publication->displayAbstract($locale) }}
                            </p>
                        @endif
                    </div>

                    <div class="flex shrink-0 flex-wrap gap-2 md:justify-end">
                        @if ($publication->doi)
                            <a href="https://doi.org/{{ $publication->doi }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-[#e3d8c8] px-3 py-2 text-xs font-black text-[#17212b] dark:border-white/10 dark:text-[#f6f1e8]">
                                DOI
                            </a>
                        @endif

                        @if ($publication->google_scholar_url)
                            <a href="{{ $publication->google_scholar_url }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-[#e3d8c8] px-3 py-2 text-xs font-black text-[#17212b] dark:border-white/10 dark:text-[#f6f1e8]">
                                Scholar
                            </a>
                        @endif

                        @if ($publication->sinta_url)
                            <a href="{{ $publication->sinta_url }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-[#e3d8c8] px-3 py-2 text-xs font-black text-[#17212b] dark:border-white/10 dark:text-[#f6f1e8]">
                                SINTA
                            </a>
                        @endif

                        @if ($publication->scopus_url)
                            <a href="{{ $publication->scopus_url }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-[#e3d8c8] px-3 py-2 text-xs font-black text-[#17212b] dark:border-white/10 dark:text-[#f6f1e8]">
                                Scopus
                            </a>
                        @endif

                        @if ($publication->journal_url)
                            <a href="{{ $publication->journal_url }}" target="_blank" rel="noopener noreferrer" class="rounded-full bg-[#4f6f52] px-3 py-2 text-xs font-black text-white">
                                View
                            </a>
                        @endif
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-[1.6rem] border border-[#e3d8c8] bg-[#fffaf2]/80 p-8 text-center dark:border-white/10 dark:bg-white/5">
                <p class="text-sm font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                    {{ $locale === 'en' ? 'No publications yet.' : 'Belum ada publikasi.' }}
                </p>
            </div>
        @endforelse
    </section>

    @if ($publications->hasPages())
        <div class="mt-8">
            {{ $publications->onEachSide(1)->links('vendor.pagination.academic') }}
        </div>
    @endif
</main>
@endsection