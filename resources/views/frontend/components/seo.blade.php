@php
    $siteName = 'Arvita Agus Kurniasari';

    $defaultTitle = 'Arvita Agus Kurniasari | Dosen, Peneliti, dan Academic Learning Hub';

    $defaultDescription = 'Website akademik Arvita Agus Kurniasari berisi materi kuliah, publikasi ilmiah, video pembelajaran, portfolio, riset, dan bimbingan mahasiswa.';

    $title = trim($__env->yieldContent('title', $defaultTitle));
    $description = trim($__env->yieldContent('meta_description', $defaultDescription));

    $canonical = rtrim(config('app.url'), '/') . '/' . ltrim(request()->path(), '/');

    if (request()->path() === '/') {
        $canonical = rtrim(config('app.url'), '/') . '/';
    }

    if (request()->has('page') && request('page') > 1) {
        $canonical .= '?page=' . request('page');
    }

    $canonical = trim($__env->yieldContent('canonical', $canonical));

    $ogImage = trim($__env->yieldContent('og_image', asset('images/og/arvita-og.jpg')));
@endphp

<title>{{ $title }}</title>

<meta name="description" content="{{ $description }}">
<meta name="robots" content="index, follow, max-image-preview:large">
<link rel="canonical" href="{{ $canonical }}">

<meta property="og:type" content="@yield('og_type', 'website')">
<meta property="og:title" content="@yield('og_title', $title)">
<meta property="og:description" content="@yield('og_description', $description)">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:image" content="{{ $ogImage }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('twitter_title', $title)">
<meta name="twitter:description" content="@yield('twitter_description', $description)">
<meta name="twitter:image" content="{{ $ogImage }}">

@stack('schema')