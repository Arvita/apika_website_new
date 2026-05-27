@php
    $locale = app()->getLocale() ?? 'id';
@endphp

<footer class="border-t border-[#e3d8c8] bg-[#fffaf2]/60 dark:border-white/10 dark:bg-[#1f2722]/60">
    <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 sm:px-6 md:grid-cols-[1.2fr_0.8fr_0.8fr]">
        <div>
            <p class="text-lg font-black">Arvita Agus Kurniasari</p>
            <p class="mt-3 max-w-md text-sm leading-7 text-[#6b6258] dark:text-[#bdb4a7]">
                {{ $locale === 'en'
                    ? 'Academic website for course materials, publications, videos, research, portfolio, and student supervision.'
                    : 'Website akademik untuk materi kuliah, publikasi, video pembelajaran, riset, portfolio, dan bimbingan mahasiswa.' }}
            </p>
        </div>

        <div>
            <p class="text-sm font-black">
                {{ $locale === 'en' ? 'Academic Links' : 'Profil Akademik' }}
            </p>

            <div class="mt-4 space-y-2 text-sm text-[#6b6258] dark:text-[#bdb4a7]">
                <a href="#" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">SINTA</a>
                <a href="#" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Google Scholar</a>
                <a href="#" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">Scopus</a>
                <a href="#" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">GitHub</a>
            </div>
        </div>

        <div>
            <p class="text-sm font-black">
                {{ $locale === 'en' ? 'Content' : 'Konten' }}
            </p>

            <div class="mt-4 space-y-2 text-sm text-[#6b6258] dark:text-[#bdb4a7]">
                <a href="{{ route('courses.index') }}" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                    {{ $locale === 'en' ? 'Courses' : 'Belajar' }}
                </a>
                <a href="{{ route('publications.index') }}" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                    {{ $locale === 'en' ? 'Journals' : 'Jurnal' }}
                </a>
                <a href="{{ route('videos.index') }}" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                    Video
                </a>
                <a href="{{ route('supervisions.index') }}" class="block hover:text-[#4f6f52] dark:hover:text-[#c7d7a9]">
                    {{ $locale === 'en' ? 'Supervision' : 'Bimbinganku' }}
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-[#e3d8c8] py-5 text-center text-xs text-[#6b6258] dark:border-white/10 dark:text-[#bdb4a7]">
        © {{ date('Y') }} Arvita Agus Kurniasari. All rights reserved.
    </div>
</footer>