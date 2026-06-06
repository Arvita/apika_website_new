<footer class="px-3 pb-3 pt-10">
    <div class="mx-auto max-w-6xl overflow-hidden rounded-[2rem] border border-[#e3d8c8] bg-[#fffaf2]/80 shadow-[0_18px_70px_rgba(31,41,51,0.08)] backdrop-blur-xl dark:border-white/10 dark:bg-[#1f2722]/80 dark:shadow-[0_18px_70px_rgba(0,0,0,0.28)]">
        <div class="grid gap-0 lg:grid-cols-[1.1fr_0.9fr_0.9fr]">
            <div class="relative border-b border-[#e3d8c8] p-7 dark:border-white/10 lg:border-b-0 lg:border-r">
                <div class="absolute -right-16 -top-16 h-44 w-44 rounded-full bg-[#d9a441]/20 blur-3xl dark:bg-[#d0a150]/20"></div>

                <div class="relative">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full border border-[#e3d8c8] bg-[#f7f2ea] text-sm font-black text-[#4f6f52] dark:border-white/10 dark:bg-[#151b18] dark:text-[#c7d7a9]">
                            AA
                        </div>

                        <div>
                            <p class="text-lg font-black leading-tight">
                                Arvita Agus Kurniasari
                            </p>
                            <p class="mt-1 text-xs font-bold uppercase tracking-[0.18em] text-[#4f6f52] dark:text-[#c7d7a9]">
                                Academic Learning Hub
                            </p>
                        </div>
                    </div>

                    <p class="mt-5 max-w-md text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                        {{ $t['footerDescription'] ?? 'Website akademik untuk materi kuliah, publikasi, video pembelajaran, riset, portfolio, dan bimbingan mahasiswa.' }}
                    </p>

                    <div class="mt-6 flex flex-wrap gap-2">
                        <a href="{{ $externalLinks['sinta'] }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-[#e3d8c8] bg-white/35 px-3 py-1.5 text-xs font-black text-[#6b6258] transition hover:-translate-y-0.5 hover:text-[#4f6f52] dark:border-white/10 dark:bg-white/5 dark:text-[#bdb4a7] dark:hover:text-[#c7d7a9]">
                            SINTA
                        </a>

                        <a href="{{ $externalLinks['scholar'] }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-[#e3d8c8] bg-white/35 px-3 py-1.5 text-xs font-black text-[#6b6258] transition hover:-translate-y-0.5 hover:text-[#4f6f52] dark:border-white/10 dark:bg-white/5 dark:text-[#bdb4a7] dark:hover:text-[#c7d7a9]">
                            Scholar
                        </a>

                        <a href="{{ $externalLinks['scopus'] }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-[#e3d8c8] bg-white/35 px-3 py-1.5 text-xs font-black text-[#6b6258] transition hover:-translate-y-0.5 hover:text-[#4f6f52] dark:border-white/10 dark:bg-white/5 dark:text-[#bdb4a7] dark:hover:text-[#c7d7a9]">
                            Scopus
                        </a>

                        <a href="{{ $externalLinks['github'] }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-[#e3d8c8] bg-white/35 px-3 py-1.5 text-xs font-black text-[#6b6258] transition hover:-translate-y-0.5 hover:text-[#4f6f52] dark:border-white/10 dark:bg-white/5 dark:text-[#bdb4a7] dark:hover:text-[#c7d7a9]">
                            GitHub
                        </a>

                        <a href="{{ $externalLinks['youtube'] }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-[#e3d8c8] bg-white/35 px-3 py-1.5 text-xs font-black text-[#6b6258] transition hover:-translate-y-0.5 hover:text-[#4f6f52] dark:border-white/10 dark:bg-white/5 dark:text-[#bdb4a7] dark:hover:text-[#c7d7a9]">
                            YouTube
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-b border-[#e3d8c8] p-7 dark:border-white/10 lg:border-b-0 lg:border-r">
                <p class="text-xs font-black uppercase tracking-[0.22em] text-[#4f6f52] dark:text-[#c7d7a9]">
                    {{ $t['academicLinks'] ?? 'Profil Akademik' }}
                </p>

                <div class="mt-5 grid gap-2 text-sm font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                    <a href="{{ $externalLinks['sinta'] }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                        <span>SINTA</span>
                        <span class="transition group-hover:translate-x-1">→</span>
                    </a>

                    <a href="{{ $externalLinks['scholar'] }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                        <span>Google Scholar</span>
                        <span class="transition group-hover:translate-x-1">→</span>
                    </a>

                    <a href="{{ $externalLinks['scopus'] }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                        <span>Scopus</span>
                        <span class="transition group-hover:translate-x-1">→</span>
                    </a>

                    <a href="{{ $externalLinks['github'] }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                        <span>GitHub</span>
                        <span class="transition group-hover:translate-x-1">→</span>
                    </a>

                    <a href="{{ $externalLinks['youtube'] }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                        <span>YouTube</span>
                        <span class="transition group-hover:translate-x-1">→</span>
                    </a>

                    <a href="{{ $externalLinks['jti'] }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                        <span>{{ $t['jtiWebsite'] ?? 'Website JTI' }}</span>
                        <span class="transition group-hover:translate-x-1">→</span>
                    </a>
                </div>
            </div>

            <div class="p-7">
                <p class="text-xs font-black uppercase tracking-[0.22em] text-[#4f6f52] dark:text-[#c7d7a9]">
                    {{ $t['content'] ?? 'Konten' }}
                </p>

                <div class="mt-5 grid gap-2 text-sm font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                    @foreach ($navItems as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            class="group flex items-center justify-between rounded-2xl px-4 py-3 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]"
                        >
                            <span>{{ $item['label'] }}</span>
                            <span class="transition group-hover:translate-x-1">→</span>
                        </a>
                    @endforeach
                </div>

                <div class="mt-7 rounded-[1.4rem] border border-[#e3d8c8] bg-white/35 p-4 dark:border-white/10 dark:bg-white/5">
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-[#4f6f52] dark:text-[#c7d7a9]">
                        Connect
                    </p>

                    <div class="mt-4 grid gap-2 text-sm font-bold text-[#6b6258] dark:text-[#bdb4a7]">
                        <a href="{{ $externalLinks['email'] }}" class="group flex items-center justify-between rounded-2xl px-3 py-2 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                            <span>{{ $t['email'] ?? 'Email' }}</span>
                            <span class="transition group-hover:translate-x-1">→</span>
                        </a>

                        <a href="{{ $externalLinks['website'] }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between rounded-2xl px-3 py-2 transition hover:bg-[#eaf0e6] hover:text-[#3e5d42] dark:hover:bg-[#314033] dark:hover:text-[#dce8cc]">
                            <span>{{ $t['officialWebsite'] ?? 'Website Resmi' }}</span>
                            <span class="transition group-hover:translate-x-1">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-3 border-t border-[#e3d8c8] bg-[#f7f2ea]/60 px-7 py-5 text-xs font-semibold text-[#6b6258] dark:border-white/10 dark:bg-[#151b18]/50 dark:text-[#bdb4a7] sm:flex-row sm:items-center sm:justify-between">
            <p>
                © {{ date('Y') }} Arvita Agus Kurniasari. All rights reserved.
            </p>

            <p class="text-[#4f6f52] dark:text-[#c7d7a9]">
                {{ $t['designedAs'] ?? 'Dirancang sebagai Human Academic Learning Hub.' }}
            </p>
        </div>
    </div>
</footer>