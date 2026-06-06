@php
    $queryLocale = request()->query('lang');
    $savedLocale = request()->cookie('locale') ?: session('locale', app()->getLocale() ?: 'id');

    $locale = in_array($queryLocale, ['id', 'en'], true)
        ? $queryLocale
        : (in_array($savedLocale, ['id', 'en'], true) ? $savedLocale : 'id');

    $nextLocale = $locale === 'id' ? 'en' : 'id';

    $query = request()->query();
    $query['lang'] = $nextLocale;

    $languageUrl = url()->current() . '?' . http_build_query($query);

    $copy = [
        'id' => [
            'title' => 'Halaman Tidak Ditemukan | Arvita Agus Kurniasari',
            'meta' => 'Halaman yang Anda cari tidak ditemukan atau sudah dipindahkan.',
            'badge' => '404 Error',
            'heading' => 'Halaman tidak ditemukan.',
            'lead' => 'Link yang Anda buka mungkin sudah dipindahkan, dihapus, atau belum tersedia. Silakan kembali ke halaman utama atau jelajahi materi akademik yang tersedia.',
            'home' => 'Kembali ke Beranda',
            'courses' => 'Lihat Courses',
            'publications' => 'Lihat Publications',
            'note' => 'Periksa kembali URL yang Anda buka. Jika halaman ini seharusnya tersedia, hubungi pengelola website.',
            'language' => 'EN',
            'theme' => 'Mode',
        ],
        'en' => [
            'title' => 'Page Not Found | Arvita Agus Kurniasari',
            'meta' => 'The page you are looking for cannot be found or may have been moved.',
            'badge' => '404 Error',
            'heading' => 'Page not found.',
            'lead' => 'The link you opened may have been moved, deleted, or is not available yet. Please return to the homepage or explore the available academic learning materials.',
            'home' => 'Back to Home',
            'courses' => 'View Courses',
            'publications' => 'View Publications',
            'note' => 'Please check the URL again. If this page should be available, contact the website administrator.',
            'language' => 'ID',
            'theme' => 'Theme',
        ],
    ];

    $t = $copy[$locale];
@endphp

<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $t['title'] }}</title>
    <meta name="description" content="{{ $t['meta'] }}">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="{{ asset('assets/brand/favicon-aak.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (function () {
            const savedTheme = localStorage.getItem('theme');

            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }

            window.toggleTheme404 = function () {
                const html = document.documentElement;
                const isDark = html.classList.toggle('dark');

                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            };
        })();
    </script>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f7f2ea;
            color: #18382c;
        }

        .dark body {
            background: #151b18;
            color: #f6f1e8;
        }

        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background:
                radial-gradient(circle at 15% 10%, rgba(154, 118, 28, .16), transparent 32%),
                radial-gradient(circle at 88% 80%, rgba(79, 111, 82, .18), transparent 34%),
                #fbfaf7;
        }

        .dark .error-page {
            background:
                radial-gradient(circle at 15% 10%, rgba(243, 217, 152, .13), transparent 32%),
                radial-gradient(circle at 88% 80%, rgba(79, 111, 82, .26), transparent 34%),
                #151b18;
        }

        .error-card {
            width: min(940px, 100%);
            position: relative;
            overflow: hidden;
            padding: clamp(26px, 5vw, 54px);
            border-radius: 34px;
            border: 1px solid #e3d8c8;
            background: rgba(255, 250, 242, .86);
            box-shadow: 0 28px 80px rgba(31, 41, 51, .12);
            backdrop-filter: blur(18px);
        }

        .dark .error-card {
            border-color: rgba(255, 255, 255, .10);
            background: rgba(21, 27, 24, .82);
            box-shadow: 0 28px 80px rgba(0, 0, 0, .28);
        }

        .error-tools {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-bottom: 28px;
        }

        .error-tool-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 44px;
            height: 38px;
            padding: 0 13px;
            border-radius: 999px;
            border: 1px solid #e3d8c8;
            background: #fffaf2;
            color: #4f6f52;
            font-size: 12px;
            font-weight: 950;
            text-decoration: none;
            cursor: pointer;
            transition: transform .2s ease, background .2s ease;
        }

        .error-tool-btn:hover {
            transform: translateY(-1px);
            background: #eaf0e6;
        }

        .dark .error-tool-btn {
            border-color: rgba(255, 255, 255, .10);
            background: rgba(255, 255, 255, .07);
            color: #c7d7a9;
        }

        .dark .error-tool-btn:hover {
            background: rgba(255, 255, 255, .11);
        }

        .error-inner {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 260px;
            gap: clamp(24px, 5vw, 52px);
            align-items: center;
        }

        .error-brand {
            display: inline-flex;
            align-items: center;
            margin-bottom: 28px;
        }

        .error-brand img {
            display: block;
            height: 44px;
            width: auto;
            max-width: 255px;
            object-fit: contain;
        }

        .error-logo-dark {
            display: none !important;
        }

        .dark .error-logo-light {
            display: none !important;
        }

        .dark .error-logo-dark {
            display: block !important;
        }

        .error-badge {
            display: inline-flex;
            align-items: center;
            min-height: 34px;
            padding: 0 14px;
            border-radius: 999px;
            border: 1px solid rgba(79, 111, 82, .18);
            background: rgba(238, 243, 232, .92);
            color: #4f6f52;
            font-size: 12px;
            font-weight: 950;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .dark .error-badge {
            border-color: rgba(255, 255, 255, .10);
            background: rgba(79, 111, 82, .22);
            color: #dbe8d4;
        }

        .error-title {
            margin: 20px 0 0;
            max-width: 620px;
            color: #18382c;
            font-size: clamp(42px, 6vw, 74px);
            line-height: .98;
            font-weight: 950;
            letter-spacing: -0.06em;
        }

        .dark .error-title {
            color: #f6f1e8;
        }

        .error-title span {
            color: #9a761c;
        }

        .dark .error-title span {
            color: #f3d998;
        }

        .error-lead {
            max-width: 600px;
            margin: 20px 0 0;
            color: #6b6258;
            font-size: clamp(15px, 1.8vw, 18px);
            line-height: 1.8;
            font-weight: 650;
        }

        .dark .error-lead {
            color: rgba(215, 206, 192, .78);
        }

        .error-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .error-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 20px;
            border-radius: 999px;
            border: 1px solid #4f6f52;
            background: #4f6f52;
            color: #fff;
            font-size: 14px;
            font-weight: 900;
            text-decoration: none;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .error-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(79, 111, 82, .18);
            background: #405d43;
        }

        .error-btn.secondary {
            border-color: #e7ded1;
            background: #fff;
            color: #18382c;
        }

        .dark .error-btn.secondary {
            border-color: rgba(255, 255, 255, .12);
            background: rgba(255, 255, 255, .06);
            color: #f6f1e8;
        }

        .error-visual {
            position: relative;
            min-height: 260px;
            display: grid;
            place-items: center;
            overflow: hidden;
            border-radius: 28px;
            background:
                linear-gradient(135deg, rgba(79, 111, 82, .13), rgba(154, 118, 28, .12)),
                #fbfaf7;
        }

        .dark .error-visual {
            background:
                linear-gradient(135deg, rgba(79, 111, 82, .25), rgba(154, 118, 28, .18)),
                rgba(255, 255, 255, .04);
        }

        .error-code {
            position: relative;
            z-index: 2;
            color: #18382c;
            font-size: clamp(82px, 12vw, 132px);
            line-height: 1;
            font-weight: 950;
            letter-spacing: -0.08em;
        }

        .dark .error-code {
            color: #f6f1e8;
        }

        .error-code span {
            color: #9a761c;
        }

        .dark .error-code span {
            color: #f3d998;
        }

        .error-orbit {
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 999px;
            border: 1px solid rgba(79, 111, 82, .22);
            transform: rotate(18deg);
        }

        .error-orbit.two {
            width: 230px;
            height: 230px;
            transform: rotate(-24deg);
            border-color: rgba(154, 118, 28, .24);
        }

        .error-note {
            margin-top: 16px;
            padding: 15px 17px;
            border-radius: 18px;
            border: 1px solid #e7ded1;
            background: rgba(255, 255, 255, .74);
            color: #6b6258;
            font-size: 13px;
            font-weight: 650;
            line-height: 1.7;
        }

        .dark .error-note {
            border-color: rgba(255, 255, 255, .10);
            background: rgba(255, 255, 255, .05);
            color: rgba(215, 206, 192, .72);
        }

        @media (max-width: 820px) {
            .error-card {
                padding: 24px;
            }

            .error-inner {
                grid-template-columns: 1fr;
            }

            .error-visual-wrap {
                order: -1;
            }

            .error-visual {
                min-height: 210px;
            }
        }

        @media (max-width: 520px) {
            .error-page {
                padding: 14px;
            }

            .error-card {
                border-radius: 28px;
                padding: 20px;
            }

            .error-tools {
                margin-bottom: 22px;
            }

            .error-brand img {
                height: 36px;
                max-width: 210px;
            }

            .error-actions {
                flex-direction: column;
            }

            .error-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <main class="error-page">
        <section class="error-card">
            <div class="error-tools">
                <a href="{{ $languageUrl }}" class="error-tool-btn" title="Switch language">
                    {{ $t['language'] }}
                </a>

                <button type="button" onclick="toggleTheme404()" class="error-tool-btn" title="Switch theme">
                    ◐
                </button>
            </div>

            <div class="error-inner">
                <div>
                    <a href="{{ route('home') }}" class="error-brand">
                        <img
                            src="{{ asset('assets/brand/logo-aak-light.png') }}"
                            alt="Arvita Agus Kurniasari"
                            class="error-logo-light"
                        >
                        <img
                            src="{{ asset('assets/brand/logo-aak-dark.png') }}"
                            alt="Arvita Agus Kurniasari"
                            class="error-logo-dark"
                        >
                    </a>

                    {{-- <div class="error-badge">
                        {{ $t['badge'] }}
                    </div> --}}

                    <h1 class="error-title">
                        @if ($locale === 'en')
                            Page not <span>found</span>.
                        @else
                            Halaman tidak <span>ditemukan</span>.
                        @endif
                    </h1>

                    <p class="error-lead">
                        {{ $t['lead'] }}
                    </p>

                    <div class="error-actions">
                        <a href="{{ route('home') }}" class="error-btn">
                            {{ $t['home'] }}
                        </a>

                        @if (Route::has('courses.index'))
                            <a href="{{ route('courses.index') }}" class="error-btn secondary">
                                {{ $t['courses'] }}
                            </a>
                        @endif

                        @if (Route::has('publications.index'))
                            <a href="{{ route('publications.index') }}" class="error-btn secondary">
                                {{ $t['publications'] }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="error-visual-wrap">
                    <div class="error-visual">
                        <div class="error-orbit"></div>
                        <div class="error-orbit two"></div>

                        <div class="error-code">
                            4<span>0</span>4
                        </div>
                    </div>

                    <div class="error-note">
                        {{ $t['note'] }}
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>