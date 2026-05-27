@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - Arvita Agus Kurniasari')

@section('content')
    <style>
        .dash-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b6258;
            font-size: 14px;
            font-weight: 700;
        }

        .dark .dash-breadcrumb {
            color: rgba(215, 206, 192, .65);
        }

        .dash-title {
            margin: 16px 0 0;
            color: #18382c;
            font-size: clamp(30px, 4vw, 42px);
            line-height: 1.1;
            letter-spacing: -0.04em;
            font-weight: 950;
        }

        .dark .dash-title {
            color: #f6f1e8;
        }

        .dash-subtitle {
            margin: 8px 0 0;
            color: #6b6258;
            font-size: 15px;
            font-weight: 650;
        }

        .dark .dash-subtitle {
            color: rgba(215, 206, 192, .65);
        }

        .dash-panel {
            background: #fff;
            border: 1px solid #e7ded1;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(31, 41, 51, .04);
        }

        .dark .dash-panel {
            background: rgba(255, 255, 255, .06);
            border-color: rgba(255, 255, 255, .1);
        }

        .notice-panel {
            margin-top: 28px;
            padding: 22px 26px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .notice-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .notice-icon {
            width: 58px;
            height: 58px;
            border-radius: 999px;
            background: #eef3e8;
            color: #4f6f52;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
        }

        .notice-icon svg {
            width: 30px;
            height: 30px;
        }

        .notice-title {
            margin: 0;
            font-size: 15px;
            font-weight: 950;
            color: #17212b;
        }

        .dark .notice-title {
            color: #f6f1e8;
        }

        .notice-text {
            margin: 4px 0 0;
            color: #6b6258;
            font-size: 14px;
            font-weight: 650;
        }

        .dark .notice-text {
            color: rgba(215, 206, 192, .65);
        }

        .view-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 46px;
            padding: 0 22px;
            border-radius: 14px;
            background: #4f6f52;
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 950;
            white-space: nowrap;
        }

        .stats-grid {
            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
        }

        .stat-card {
            padding: 24px;
        }

        .stat-content {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .stat-icon {
            width: 68px;
            height: 68px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
        }

        .stat-icon svg {
            width: 34px;
            height: 34px;
        }

        .stat-icon.green {
            background: #eef3e8;
            color: #4f6f52;
        }

        .stat-icon.gold {
            background: #f5ead4;
            color: #b18a20;
        }

        .stat-label {
            margin: 0;
            font-size: 16px;
            font-weight: 950;
            color: #17212b;
        }

        .dark .stat-label {
            color: #f6f1e8;
        }

        .stat-value {
            margin: 4px 0 0;
            font-size: 38px;
            line-height: 1;
            font-weight: 950;
            color: #000;
        }

        .dark .stat-value {
            color: #fff;
        }

        .stat-desc {
            margin: 8px 0 0;
            color: #6b6258;
            font-size: 14px;
            font-weight: 650;
        }

        .dark .stat-desc {
            color: rgba(215, 206, 192, .65);
        }

        .middle-grid {
            margin-top: 20px;
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            gap: 20px;
        }

        .block-panel {
            padding: 22px 24px;
        }

        .block-title {
            margin: 0;
            color: #18382c;
            font-size: 24px;
            line-height: 1.2;
            letter-spacing: -0.02em;
            font-weight: 950;
        }

        .dark .block-title {
            color: #f6f1e8;
        }

        .block-subtitle {
            margin: 5px 0 0;
            color: #6b6258;
            font-size: 14px;
            font-weight: 650;
        }

        .dark .block-subtitle {
            color: rgba(215, 206, 192, .65);
        }

        .management-list {
            margin-top: 20px;
            border-top: 1px solid #eee8de;
        }

        .dark .management-list {
            border-top-color: rgba(255, 255, 255, .1);
        }

        .management-link {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 0;
            color: inherit;
            text-decoration: none;
            border-bottom: 1px solid #eee8de;
        }

        .dark .management-link {
            border-bottom-color: rgba(255, 255, 255, .1);
        }

        .mini-icon {
            width: 26px;
            height: 26px;
            color: #4f6f52;
            flex: 0 0 auto;
        }

        .management-link-title {
            margin: 0;
            font-size: 14px;
            font-weight: 950;
            color: #17212b;
        }

        .dark .management-link-title {
            color: #f6f1e8;
        }

        .management-link-desc {
            margin: 2px 0 0;
            color: #6b6258;
            font-size: 13px;
            font-weight: 650;
        }

        .dark .management-link-desc {
            color: rgba(215, 206, 192, .62);
        }

        .quick-grid {
            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }

        .quick-card {
            min-height: 170px;
            border-radius: 18px;
            padding: 20px 14px;
            text-align: center;
            color: inherit;
            text-decoration: none;
            transition: .18s ease;
        }

        .quick-card:hover {
            transform: translateY(-2px);
        }

        .quick-card.green {
            background: #f1f5ef;
        }

        .quick-card.gold {
            background: #fbf4e7;
        }

        .dark .quick-card.green,
        .dark .quick-card.gold {
            background: rgba(255, 255, 255, .08);
        }

        .quick-card .stat-icon {
            width: 56px;
            height: 56px;
            margin: 0 auto;
        }

        .quick-card .stat-icon svg {
            width: 28px;
            height: 28px;
        }

        .quick-title {
            margin: 14px 0 0;
            font-size: 14px;
            font-weight: 950;
            color: #17212b;
        }

        .dark .quick-title {
            color: #f6f1e8;
        }

        .quick-desc {
            margin: 6px 0 0;
            color: #6b6258;
            font-size: 13px;
            font-weight: 650;
            line-height: 1.45;
        }

        .dark .quick-desc {
            color: rgba(215, 206, 192, .62);
        }

        .quick-arrow {
            margin-top: 12px;
            color: #4f6f52;
            font-size: 22px;
            font-weight: 950;
        }

        .recent-panel {
            margin-top: 20px;
            overflow: hidden;
        }

        .recent-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 24px;
            border-bottom: 1px solid #eee8de;
        }

        .dark .recent-head {
            border-bottom-color: rgba(255, 255, 255, .1);
        }

        .recent-title {
            margin: 0;
            color: #18382c;
            font-size: 22px;
            font-weight: 950;
        }

        .dark .recent-title {
            color: #f6f1e8;
        }

        .outline-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 16px;
            border-radius: 12px;
            border: 1px solid rgba(79, 111, 82, .45);
            color: #4f6f52;
            text-decoration: none;
            font-size: 13px;
            font-weight: 950;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .admin-table th {
            padding: 14px 24px;
            background: #fbfaf7;
            color: #4b5563;
            font-size: 12px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .dark .admin-table th {
            background: rgba(255, 255, 255, .05);
            color: rgba(215, 206, 192, .6);
        }

        .empty-state {
            padding: 44px 24px;
            text-align: center;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto;
            border-radius: 999px;
            background: #fbf4e7;
            color: #b18a20;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-icon svg {
            width: 32px;
            height: 32px;
        }

        .empty-state strong {
            display: block;
            margin-top: 14px;
            color: #17212b;
            font-size: 14px;
            font-weight: 950;
        }

        .dark .empty-state strong {
            color: #f6f1e8;
        }

        .empty-state span {
            display: block;
            margin-top: 4px;
            color: #6b6258;
            font-size: 14px;
            font-weight: 650;
        }

        .dark .empty-state span {
            color: rgba(215, 206, 192, .62);
        }

        @media (max-width: 1280px) {

            .stats-grid,
            .quick-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .middle-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {

            .notice-panel,
            .notice-left,
            .stat-content {
                align-items: flex-start;
                flex-direction: column;
            }

            .stats-grid,
            .quick-grid {
                grid-template-columns: 1fr;
            }

            .recent-head {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        .dash-title {
            font-size: clamp(28px, 3vw, 36px);
        }

        .notice-panel {
            margin-top: 22px;
            padding: 18px 22px;
        }

        .notice-icon {
            width: 48px;
            height: 48px;
        }

        .notice-icon svg {
            width: 24px;
            height: 24px;
        }

        .stats-grid {
            gap: 16px;
        }

        .stat-card {
            padding: 18px;
        }

        .stat-content {
            gap: 16px;
        }

        .stat-icon {
            width: 54px;
            height: 54px;
        }

        .stat-icon svg {
            width: 26px;
            height: 26px;
        }

        .stat-label {
            font-size: 14px;
        }

        .stat-value {
            font-size: 32px;
        }

        .stat-desc {
            font-size: 13px;
        }

        .middle-grid {
            gap: 16px;
        }

        .block-panel {
            padding: 18px 20px;
        }

        .block-title {
            font-size: 21px;
        }

        .quick-grid {
            gap: 14px;
        }

        .quick-card {
            min-height: 145px;
            padding: 16px 12px;
        }

        .quick-card .stat-icon {
            width: 48px;
            height: 48px;
        }

        .quick-card .stat-icon svg {
            width: 24px;
            height: 24px;
        }

        .quick-title {
            font-size: 13px;
        }

        .quick-desc {
            font-size: 12px;
        }

        .recent-head {
            padding: 15px 20px;
        }

        .recent-title {
            font-size: 20px;
        }

        .admin-table th {
            padding: 12px 20px;
        }

        .empty-state {
            padding: 34px 20px;
        }
    </style>

    @php
        $stats = [
            [
                'label' => 'Publications',
                'value' => '0',
                'desc' => 'Total publications',
                'icon' => 'book',
                'tone' => 'green',
            ],
            ['label' => 'Courses', 'value' => '0', 'desc' => 'Total courses', 'icon' => 'cap', 'tone' => 'gold'],
            ['label' => 'Videos', 'value' => '0', 'desc' => 'Total videos', 'icon' => 'video', 'tone' => 'green'],
            [
                'label' => 'Portfolio Items',
                'value' => '0',
                'desc' => 'Total portfolio items',
                'icon' => 'briefcase',
                'tone' => 'gold',
            ],
        ];

        $managementItems = [
            [
                'title' => 'Publications',
                'desc' => 'Add, edit, and manage your journal papers.',
                'route' => 'admin.publications.index',
                'icon' => 'book',
                'tone' => 'green',
            ],
            [
                'title' => 'Courses',
                'desc' => 'Manage your teaching materials and syllabus.',
                'route' => 'admin.courses.index',
                'icon' => 'cap',
                'tone' => 'gold',
            ],
            [
                'title' => 'Videos',
                'desc' => 'Upload and organize your learning videos.',
                'route' => 'admin.videos.index',
                'icon' => 'video',
                'tone' => 'green',
            ],
            [
                'title' => 'Portfolio',
                'desc' => 'Showcase your projects and achievements.',
                'route' => 'admin.portfolio.index',
                'icon' => 'briefcase',
                'tone' => 'gold',
            ],
        ];
    @endphp

    <div class="admin-container">
        <div class="dash-breadcrumb">
            <a href="{{ route('admin.dashboard') }}" style="color:inherit;text-decoration:none;">Home</a>
            <span>›</span>
            <span>Dashboard</span>
        </div>

        <h1 class="dash-title">
            Welcome back, {{ auth()->user()->name ?? 'Admin Arvita' }} 👋
        </h1>

        <p class="dash-subtitle">
            Here’s what’s happening with your academic website.
        </p>

        <section class="dash-panel notice-panel">
            <div class="notice-left">
                <div class="notice-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M11 20A7 7 0 0 1 4 13c0-5 7-9 14-9 0 7-4 14-9 14"></path>
                        <path d="M4 20c4-6 8-9 14-12"></path>
                    </svg>
                </div>

                <div>
                    <p class="notice-title">Keep your academic profile up to date.</p>
                    <p class="notice-text">Regular updates build trust and showcase your impact.</p>
                </div>
            </div>

            <a href="{{ route('home') }}" target="_blank" class="view-btn">
                View Website
                <span>↗</span>
            </a>
        </section>

        <section class="stats-grid">
            @foreach ($stats as $stat)
                <article class="dash-panel stat-card">
                    <div class="stat-content">
                        <div class="stat-icon {{ $stat['tone'] }}">
                            @include('admin.partials.icon', ['name' => $stat['icon']])
                        </div>

                        <div>
                            <p class="stat-label">{{ $stat['label'] }}</p>
                            <p class="stat-value">{{ $stat['value'] }}</p>
                            <p class="stat-desc">{{ $stat['desc'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        <section class="middle-grid">
            <div class="dash-panel block-panel">
                <h2 class="block-title">Content Management</h2>
                <p class="block-subtitle">Create, manage, and organize your content with ease.</p>

                <div class="management-list">
                    @foreach ($managementItems as $item)
                        @php
                            $exists = Route::has($item['route']);
                        @endphp

                        <a href="{{ $exists ? route($item['route']) : '#' }}" class="management-link">
                            <div class="mini-icon">
                                @include('admin.partials.icon', ['name' => $item['icon']])
                            </div>

                            <div style="flex:1;min-width:0;">
                                <p class="management-link-title">{{ $item['title'] }}</p>
                                <p class="management-link-desc">{{ $item['desc'] }}</p>
                            </div>

                            <span style="color:#6b6258;font-size:22px;">›</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="dash-panel block-panel">
                <h2 class="block-title">Quick Links</h2>
                <p class="block-subtitle">Shortcuts to the most used sections.</p>

                <div class="quick-grid">
                    @foreach ($managementItems as $item)
                        @php
                            $exists = Route::has($item['route']);
                        @endphp

                        <a href="{{ $exists ? route($item['route']) : '#' }}" class="quick-card {{ $item['tone'] }}">
                            <div class="stat-icon {{ $item['tone'] }}">
                                @include('admin.partials.icon', ['name' => $item['icon']])
                            </div>

                            <p class="quick-title">{{ $item['title'] }}</p>
                            <p class="quick-desc">Manage your<br>{{ strtolower($item['title']) }}</p>
                            <p class="quick-arrow">→</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="dash-panel recent-panel">
            <div class="recent-head">
                <h2 class="recent-title">Recent Items</h2>
                <a href="#" class="outline-btn">View All Content</a>
            </div>

            <div style="overflow-x:auto;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Updated</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        @include('admin.partials.icon', ['name' => 'briefcase'])
                                    </div>

                                    <strong>No content yet</strong>
                                    <span>Start by adding your first publication, course, video, or portfolio item.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
