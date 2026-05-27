@php
    $locale = app()->getLocale() ?? 'id';

    $menu = [
        ['label_id' => 'Belajar', 'label_en' => 'Learn', 'url' => route('courses.index')],
        ['label_id' => 'Jurnal', 'label_en' => 'Journals', 'url' => route('publications.index')],
        ['label_id' => 'Video', 'label_en' => 'Videos', 'url' => route('videos.index')],
        ['label_id' => 'Riset', 'label_en' => 'Research', 'url' => route('research')],
        ['label_id' => 'Bimbinganku', 'label_en' => 'Supervision', 'url' => route('supervisions.index')],
        ['label_id' => 'Portfolio', 'label_en' => 'Portfolio', 'url' => route('portfolio.index')],
    ];
@endphp

<header class="sticky top-0 z-50 border-b border-[#e3d8c8]/80 bg-[#f7f2ea]/85 backdrop-blur-xl dark:border-white/10 dark:bg-[#151b18]/85">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-full border border-[#e3d8c8] bg-[#fffaf2] text-[#4f6f52] shadow-sm dark:border-white/10 dark:bg-[#1f2722] dark:text-[#c7d7a9]">
                <span class="text-sm font-black">AA</span>
            </div>

            <div>
                <p class="text-sm font-black leading-none tracking-tight">
                    Arvita Agus K.
                </p>
                <p class="mt-1 text-xs text-[#6b6258] dark:text-[#bdb4a7]">
                    Academic Learning Hub
                </p>
            </div>
        </a>

        <nav class="hidden items-center gap-6 text-sm font-medium text-[#6b6258] dark:text-[#bdb4a7] lg:flex">
            @foreach ($menu as $item)
                <a href="{{ $item['url'] }}" class="transition hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                    {{ $locale === 'en' ? $item['label_en'] : $item['label_id'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2">
            @include('frontend.components.language-switcher')

            <button
                type="button"
                onclick="toggleTheme()"
                class="rounded-full border border-[#e3d8c8] bg-[#fffaf2] px-3 py-2 text-xs font-bold text-[#4f6f52] dark:border-white/10 dark:bg-[#1f2722] dark:text-[#c7d7a9]"
            >
                Dark
            </button>

            <a
                href="{{ route('contact') }}"
                class="hidden rounded-full bg-[#4f6f52] px-4 py-2 text-sm font-bold text-white dark:bg-[#9caf88] dark:text-[#151b18] sm:inline-flex"
            >
                {{ $locale === 'en' ? 'Contact' : 'Kontak' }}
            </a>
        </div>
    </div>
</header>