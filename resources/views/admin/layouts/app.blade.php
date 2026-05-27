<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel - Arvita Agus Kurniasari')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/brand/favicon-aak.png') }}?v=6">
    <link rel="shortcut icon" href="{{ asset('assets/brand/favicon.ico') }}?v=6">

    <script>
        (function() {
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        * {
            box-sizing: border-box;
        }

        body.aak-admin-body {
            margin: 0;
            min-height: 100vh;
            background: #fbfaf7;
            color: #17212b;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.5;
        }

        .dark body.aak-admin-body {
            background: #111814;
            color: #f6f1e8;
        }

        .admin-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 50;
            width: 286px;
            background: #fbfaf7;
            border-right: 1px solid #e8e3d8;
            transform: translateX(0);
        }

        .dark .admin-sidebar {
            background: #151d18;
            border-right-color: rgba(255, 255, 255, .1);
        }

        .admin-main {
            min-height: 100vh;
            margin-left: 286px;
        }

        .admin-topbar {
            position: sticky;
            top: 0;
            z-index: 30;
            height: 84px;
            border-bottom: 1px solid #e8e3d8;
            background: rgba(251, 250, 247, .94);
            backdrop-filter: blur(16px);
        }

        .dark .admin-topbar {
            border-bottom-color: rgba(255, 255, 255, .1);
            background: rgba(17, 24, 20, .94);
        }

        .admin-content {
            padding: 28px 40px;
        }

        .admin-container {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
        }

        .sidebar-brand {
            height: 84px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid #e8e3d8;
        }

        .dark .sidebar-brand {
            border-bottom-color: rgba(255, 255, 255, .1);
        }

        .brand-link {
            display: flex;
            align-items: center;
            gap: 16px;
            color: inherit;
            text-decoration: none;
        }

        .brand-logo-box {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            background: #ffffff;
            border: 1px solid #e7ded1;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(31, 41, 51, .06);
        }

        .dark .brand-logo-box {
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .1);
        }

        .brand-logo-box img {
            width: 34px;
            height: 34px;
            object-fit: contain;
        }

        .brand-copy {
            padding-left: 16px;
            border-left: 1px solid #d9d2c7;
        }

        .dark .brand-copy {
            border-left-color: rgba(255, 255, 255, .12);
        }

        .brand-copy strong {
            display: block;
            font-size: 16px;
            font-weight: 900;
            color: #18382c;
            line-height: 1.1;
        }

        .dark .brand-copy strong {
            color: #f6f1e8;
        }

        .brand-copy span {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            font-weight: 650;
            color: #6b6258;
        }

        .dark .brand-copy span {
            color: rgba(215, 206, 192, .66);
        }

        .sidebar-nav {
            height: calc(100vh - 84px - 96px);
            overflow-y: auto;
            padding: 24px 20px;
        }

        .sidebar-divider {
            height: 1px;
            background: #e8e3d8;
            margin: 18px 0;
        }

        .dark .sidebar-divider {
            background: rgba(255, 255, 255, .1);
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 48px;
            padding: 12px 16px;
            border-radius: 16px;
            color: #4b5563;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            transition: .18s ease;
        }

        .nav-item:hover {
            background: #f2f5ef;
            color: #18382c;
        }

        .nav-item.active {
            background: #eef3e8;
            color: #2f5b3b;
        }

        .dark .nav-item {
            color: rgba(215, 206, 192, .76);
        }

        .dark .nav-item:hover,
        .dark .nav-item.active {
            background: rgba(255, 255, 255, .1);
            color: #f6f1e8;
        }

        .nav-icon {
            width: 22px;
            height: 22px;
            flex: 0 0 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .nav-icon svg,
        .topbar-icon,
        .card-icon svg,
        .mini-icon svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .sidebar-user {
            position: absolute;
            left: 20px;
            right: 20px;
            bottom: 20px;
        }

        .sidebar-user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 18px;
            background: #fff;
            border: 1px solid #e7ded1;
            box-shadow: 0 8px 24px rgba(31, 41, 51, .05);
        }

        .dark .sidebar-user-card {
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .1);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            background: #4f6f52;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 900;
            flex: 0 0 auto;
        }

        .user-meta {
            min-width: 0;
            flex: 1;
        }

        .user-meta strong {
            display: block;
            font-size: 13px;
            font-weight: 900;
            color: #17212b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dark .user-meta strong {
            color: #f6f1e8;
        }

        .user-meta span {
            display: block;
            margin-top: 2px;
            font-size: 12px;
            font-weight: 650;
            color: #6b6258;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dark .user-meta span {
            color: rgba(215, 206, 192, .66);
        }

        .logout-button {
            border: 0;
            background: transparent;
            color: #6b6258;
            cursor: pointer;
            padding: 6px;
            border-radius: 10px;
        }

        .logout-button:hover {
            color: #4f6f52;
            background: #eef3e8;
        }

        .dark .logout-button {
            color: rgba(215, 206, 192, .66);
        }

        .topbar-inner {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 0 40px;
        }

        .menu-button {
            width: 44px;
            height: 44px;
            border-radius: 16px;
            border: 0;
            background: transparent;
            color: #18382c;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .menu-button:hover {
            background: #eef3e8;
        }

        .dark .menu-button {
            color: #f6f1e8;
        }

        .dark .menu-button:hover {
            background: rgba(255, 255, 255, .08);
        }

        .search-wrap {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .search-box {
            width: 100%;
            max-width: 440px;
            height: 48px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 18px;
            background: #fff;
            border: 1px solid #e7ded1;
            padding: 0 14px;
            box-shadow: 0 8px 24px rgba(31, 41, 51, .04);
        }

        .dark .search-box {
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .1);
        }

        .search-box input {
            flex: 1;
            min-width: 0;
            border: 0;
            outline: 0;
            background: transparent;
            color: #17212b;
            font-size: 14px;
            font-weight: 650;
        }

        .dark .search-box input {
            color: #f6f1e8;
        }

        .shortcut {
            padding: 4px 8px;
            border-radius: 9px;
            border: 1px solid #e7ded1;
            color: #9b9388;
            font-size: 12px;
            font-weight: 800;
        }

        .dark .shortcut {
            border-color: rgba(255, 255, 255, .1);
            color: rgba(215, 206, 192, .55);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .theme-toggle {
            height: 48px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px;
            border-radius: 18px;
            background: #fff;
            border: 1px solid #e7ded1;
            box-shadow: 0 8px 24px rgba(31, 41, 51, .04);
            cursor: pointer;
        }

        .dark .theme-toggle {
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .1);
        }

        .theme-toggle span {
            width: 34px;
            height: 34px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #18382c;
        }

        .theme-toggle .moon {
            background: #d0ad63;
            color: #fff;
        }

        .profile-chip {
            height: 56px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 20px;
            background: #fff;
            border: 1px solid #e7ded1;
            padding: 0 14px;
            box-shadow: 0 8px 24px rgba(31, 41, 51, .04);
        }

        .dark .profile-chip {
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .1);
        }

        .mobile-overlay {
            display: none;
        }

        @media (max-width: 1023px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.is-open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .mobile-overlay {
                position: fixed;
                inset: 0;
                z-index: 40;
                background: rgba(0, 0, 0, .42);
                backdrop-filter: blur(4px);
            }

            .topbar-inner {
                padding: 0 18px;
            }

            .search-wrap {
                display: none;
            }

            .admin-content {
                padding: 22px 18px;
            }
        }

        @media (max-width: 640px) {
            .profile-chip .user-meta {
                display: none;
            }

            .profile-chip {
                width: 56px;
                padding: 0;
                justify-content: center;
            }

            .theme-toggle {
                width: 48px;
                overflow: hidden;
            }

            .theme-toggle .sun {
                display: none;
            }
        }

        :root {
            --admin-sidebar-width: 260px;
            --admin-sidebar-collapsed: 84px;
            --admin-topbar-height: 76px;
        }

        .admin-sidebar {
            width: var(--admin-sidebar-width);
            transition: width .22s ease, transform .3s ease;
            overflow: hidden;
        }

        .admin-sidebar.is-collapsed {
            width: var(--admin-sidebar-collapsed);
        }

        .admin-main {
            margin-left: var(--admin-sidebar-width);
            transition: margin-left .22s ease;
        }

        .admin-main.is-expanded {
            margin-left: var(--admin-sidebar-collapsed);
        }

        .admin-topbar {
            height: var(--admin-topbar-height);
        }

        .sidebar-brand {
            height: var(--admin-topbar-height);
            padding: 0 18px;
        }

        .brand-logo-box {
            width: 46px;
            height: 46px;
            border-radius: 15px;
        }

        .brand-logo-box img {
            width: 30px;
            height: 30px;
        }

        .brand-copy strong {
            font-size: 14px;
        }

        .brand-copy span {
            font-size: 11px;
        }

        .sidebar-nav {
            height: calc(100vh - var(--admin-topbar-height) - 88px);
            padding: 18px 14px;
        }

        .nav-item {
            min-height: 42px;
            padding: 10px 12px;
            border-radius: 13px;
            gap: 12px;
            font-size: 13px;
        }

        .nav-icon {
            width: 18px;
            height: 18px;
            flex-basis: 18px;
        }

        .sidebar-user {
            left: 14px;
            right: 14px;
            bottom: 14px;
        }

        .sidebar-user-card {
            padding: 10px 12px;
            border-radius: 15px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            font-size: 13px;
        }

        .topbar-inner {
            padding: 0 32px;
        }

        .search-box {
            height: 44px;
            max-width: 420px;
            border-radius: 15px;
        }

        .theme-toggle {
            height: 44px;
            border-radius: 15px;
        }

        .theme-toggle span {
            width: 30px;
            height: 30px;
            border-radius: 11px;
        }

        .profile-chip {
            height: 48px;
            border-radius: 16px;
        }

        .admin-content {
            padding: 24px 32px;
        }

        /* collapsed sidebar */
        .admin-sidebar.is-collapsed .brand-copy,
        .admin-sidebar.is-collapsed .nav-item span:not(.nav-icon),
        .admin-sidebar.is-collapsed .sidebar-user .user-meta,
        .admin-sidebar.is-collapsed .sidebar-user .logout-button {
            display: none;
        }

        .admin-sidebar.is-collapsed .sidebar-brand {
            padding: 0 14px;
        }

        .admin-sidebar.is-collapsed .brand-link {
            width: 100%;
            justify-content: center;
        }

        .admin-sidebar.is-collapsed .brand-logo-box {
            width: 46px;
            height: 46px;
        }

        .admin-sidebar.is-collapsed .sidebar-nav {
            padding-left: 12px;
            padding-right: 12px;
        }

        .admin-sidebar.is-collapsed .nav-item {
            justify-content: center;
            padding-left: 10px;
            padding-right: 10px;
        }

        .admin-sidebar.is-collapsed .sidebar-user-card {
            justify-content: center;
            padding: 10px;
        }

        /* mobile */
        @media (max-width: 1023px) {
            .admin-sidebar {
                width: var(--admin-sidebar-width);
                transform: translateX(-100%);
            }

            .admin-sidebar.is-open {
                transform: translateX(0);
            }

            .admin-sidebar.is-collapsed {
                width: var(--admin-sidebar-width);
            }

            .admin-main,
            .admin-main.is-expanded {
                margin-left: 0;
            }

            .topbar-inner {
                padding: 0 18px;
            }

            .admin-content {
                padding: 22px 18px;
            }
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="aak-admin-body">
    @php
        $navItems = [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'icon' => 'dashboard'],
            [
                'label' => 'Publications',
                'route' => 'admin.publications.index',
                'match' => 'admin.publications.*',
                'icon' => 'book',
            ],
            ['label' => 'Courses', 'route' => 'admin.courses.index', 'match' => 'admin.courses.*', 'icon' => 'cap'],
            ['label' => 'Videos', 'route' => 'admin.videos.index', 'match' => 'admin.videos.*', 'icon' => 'video'],
            [
                'label' => 'Portfolio',
                'route' => 'admin.portfolio.index',
                'match' => 'admin.portfolio.*',
                'icon' => 'briefcase',
            ],
            ['label' => 'Media Library', 'route' => 'admin.media.index', 'match' => 'admin.media.*', 'icon' => 'image'],
            ['label' => 'Pages', 'route' => 'admin.pages.index', 'match' => 'admin.pages.*', 'icon' => 'page'],
            [
                'label' => 'Comments',
                'route' => 'admin.comments.index',
                'match' => 'admin.comments.*',
                'icon' => 'comment',
            ],
            [
                'label' => 'Settings',
                'route' => 'admin.settings.index',
                'match' => 'admin.settings.*',
                'icon' => 'settings',
            ],
            ['label' => 'Profile', 'route' => 'admin.profile.edit', 'match' => 'admin.profile.*', 'icon' => 'user'],
        ];
    @endphp

    <div x-data="{ sidebarOpen: false, sidebarCollapsed: false }">
        <div x-show="sidebarOpen" x-cloak class="mobile-overlay" @click="sidebarOpen = false"></div>

        <aside class="admin-sidebar"
            :class="{
                'is-open': sidebarOpen,
                'is-collapsed': sidebarCollapsed
            }">
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}" class="brand-link">
                    <div class="brand-logo-box">
                        <img src="{{ asset('assets/brand/favicon-aak.png') }}?v=6" alt="AAK">
                    </div>

                    <div class="brand-copy">
                        <strong>Admin Panel</strong>
                        <span>Arvita Agus Kurniasari</span>
                    </div>
                </a>
            </div>

            <nav class="sidebar-nav">
                @foreach ($navItems as $index => $item)
                    @php
                        $exists = Route::has($item['route']);
                        $href = $exists ? route($item['route']) : '#';
                        $active = request()->routeIs($item['match']);
                    @endphp

                    @if ($index === 5)
                        <div class="sidebar-divider"></div>
                    @endif

                    <a href="{{ $href }}" class="nav-item {{ $active ? 'active' : '' }}">
                        <span class="nav-icon">
                            @include('admin.partials.icon', ['name' => $item['icon']])
                        </span>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="sidebar-user">
                <div class="sidebar-user-card">
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>

                    <div class="user-meta">
                        <strong>{{ auth()->user()->name ?? 'Admin Arvita' }}</strong>
                        <span>{{ auth()->user()->email ?? 'admin@aak.id' }}</span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-button" title="Logout">
                            @include('admin.partials.icon', ['name' => 'logout'])
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="admin-main" :class="sidebarCollapsed ? 'is-expanded' : ''">
            <header class="admin-topbar">
                <div class="topbar-inner">
                    <button type="button" class="menu-button"
                        @click="window.innerWidth >= 1024 ? sidebarCollapsed = !sidebarCollapsed : sidebarOpen = true"
                        title="Toggle sidebar">
                        @include('admin.partials.icon', ['name' => 'menu'])
                    </button>

                    <div class="search-wrap">
                        <div class="search-box">
                            <span style="width:20px;height:20px;color:#6b6258;">
                                @include('admin.partials.icon', ['name' => 'search'])
                            </span>
                            <input type="search" placeholder="Search anything...">
                            <span class="shortcut">⌘K</span>
                        </div>
                    </div>

                    <div class="topbar-actions">
                        <button type="button" class="theme-toggle"
                            onclick="
                            document.documentElement.classList.toggle('dark');
                            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
                        ">
                            <span class="sun">☼</span>
                            <span class="moon">☾</span>
                        </button>

                        <div class="profile-chip">
                            <div class="avatar">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            </div>

                            <div class="user-meta">
                                <strong>{{ auth()->user()->name ?? 'Admin Arvita' }}</strong>
                                <span>Administrator</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="admin-content">
                @if (session('success'))
                    <div
                        style="margin-bottom:24px;border:1px solid #d8e2d2;background:#eef3e8;color:#3e5d42;border-radius:16px;padding:14px 16px;font-size:14px;font-weight:800;">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
