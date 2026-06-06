@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="mt-10">
        <div
            class="flex flex-col gap-4 rounded-[1.75rem] border border-[#e3d8c8] bg-[#fffaf2] px-5 py-4 shadow-sm dark:border-white/10 dark:bg-[#1f2722] sm:px-6">

            {{-- Info + Desktop Pagination --}}
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                {{-- Result text --}}
                <div class="text-sm font-medium text-[#5f6b66] dark:text-[#d7d2c8]">
                    Showing
                    <span class="font-semibold text-[#1f2933] dark:text-white">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="font-semibold text-[#1f2933] dark:text-white">{{ $paginator->lastItem() }}</span>
                    of
                    <span class="font-semibold text-[#1f2933] dark:text-white">{{ $paginator->total() }}</span>
                    results
                </div>

                {{-- Pagination links --}}
                <div class="flex flex-wrap items-center gap-2">
                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())
                        <span
                            class="inline-flex h-11 min-w-[44px] items-center justify-center rounded-2xl border border-[#e3d8c8] bg-[#f3ede3] px-4 text-sm font-semibold text-[#b3aa9d] dark:border-white/10 dark:bg-white/5 dark:text-white/30">
                            <span aria-hidden="true">‹</span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                            class="inline-flex h-11 min-w-[44px] items-center justify-center rounded-2xl border border-[#d9cfbf] bg-white px-4 text-sm font-semibold text-[#2c3a33] transition hover:-translate-y-0.5 hover:border-[#4f6f52] hover:bg-[#f7f2ea] hover:text-[#4f6f52] dark:border-white/10 dark:bg-[#243129] dark:text-[#f7f2ea] dark:hover:border-[#b89b58] dark:hover:bg-[#2b382f] dark:hover:text-[#f6e7bf]">
                            <span aria-hidden="true">‹</span>
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span
                                class="inline-flex h-11 min-w-[44px] items-center justify-center rounded-2xl border border-transparent px-3 text-sm font-semibold text-[#9a9488] dark:text-white/40">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span
                                        aria-current="page"
                                        class="inline-flex h-11 min-w-[44px] items-center justify-center rounded-2xl border border-[#4f6f52] bg-[#4f6f52] px-4 text-sm font-bold text-white shadow-sm dark:border-[#b89b58] dark:bg-[#b89b58] dark:text-[#1b211d]">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="inline-flex h-11 min-w-[44px] items-center justify-center rounded-2xl border border-[#d9cfbf] bg-white px-4 text-sm font-semibold text-[#2c3a33] transition hover:-translate-y-0.5 hover:border-[#4f6f52] hover:bg-[#f7f2ea] hover:text-[#4f6f52] dark:border-white/10 dark:bg-[#243129] dark:text-[#f7f2ea] dark:hover:border-[#b89b58] dark:hover:bg-[#2b382f] dark:hover:text-[#f6e7bf]">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}"
                            class="inline-flex h-11 min-w-[44px] items-center justify-center rounded-2xl border border-[#d9cfbf] bg-white px-4 text-sm font-semibold text-[#2c3a33] transition hover:-translate-y-0.5 hover:border-[#4f6f52] hover:bg-[#f7f2ea] hover:text-[#4f6f52] dark:border-white/10 dark:bg-[#243129] dark:text-[#f7f2ea] dark:hover:border-[#b89b58] dark:hover:bg-[#2b382f] dark:hover:text-[#f6e7bf]">
                            <span aria-hidden="true">›</span>
                        </a>
                    @else
                        <span
                            class="inline-flex h-11 min-w-[44px] items-center justify-center rounded-2xl border border-[#e3d8c8] bg-[#f3ede3] px-4 text-sm font-semibold text-[#b3aa9d] dark:border-white/10 dark:bg-white/5 dark:text-white/30">
                            <span aria-hidden="true">›</span>
                        </span>
                    @endif
                </div>
            </div>

            {{-- Mobile compact info --}}
            <div class="flex items-center justify-between gap-3 border-t border-[#ece3d7] pt-3 text-sm text-[#6a756f] dark:border-white/10 dark:text-[#d7d2c8] sm:hidden">
                <span>Page {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>
                <span>{{ $paginator->total() }} items</span>
            </div>
        </div>
    </nav>
@endif