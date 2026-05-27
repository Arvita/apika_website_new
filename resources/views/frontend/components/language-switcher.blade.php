@php
    $locale = app()->getLocale() ?? 'id';
    $nextLocale = $locale === 'id' ? 'en' : 'id';
@endphp

<a
    href="{{ url($nextLocale . '/' . ltrim(request()->path(), '/')) }}"
    class="rounded-full border border-[#e3d8c8] bg-[#fffaf2] px-3 py-2 text-xs font-bold text-[#4f6f52] dark:border-white/10 dark:bg-[#1f2722] dark:text-[#c7d7a9]"
>
    {{ strtoupper($locale) }}
</a>