@extends('admin.layouts.app')

@section('title', 'Videos - Admin Panel')

@section('content')

<style>
    .pub-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
    }

    .pub-title {
        margin: 0;
        color: #18382c;
        font-size: 32px;
        line-height: 1.1;
        letter-spacing: -0.035em;
        font-weight: 950;
    }

    .dark .pub-title {
        color: #f6f1e8;
    }

    .pub-subtitle {
        margin: 8px 0 0;
        color: #6b6258;
        font-size: 14px;
        font-weight: 650;
    }

    .dark .pub-subtitle {
        color: rgba(215,206,192,.66);
    }

    .pub-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 42px;
        padding: 0 18px;
        border-radius: 13px;
        background: #4f6f52;
        color: white;
        text-decoration: none;
        font-size: 14px;
        font-weight: 900;
        border: 0;
        cursor: pointer;
    }

    .pub-panel {
        background: #fff;
        border: 1px solid #e7ded1;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(31,41,51,.04);
    }

    .dark .pub-panel {
        background: rgba(255,255,255,.06);
        border-color: rgba(255,255,255,.1);
    }

    .pub-filter {
        display: grid;
        grid-template-columns: 1fr 180px auto;
        gap: 12px;
        padding: 18px;
        margin-bottom: 18px;
    }

    .pub-input,
    .pub-select {
        width: 100%;
        height: 42px;
        border-radius: 12px;
        border: 1px solid #e7ded1;
        background: #fbfaf7;
        color: #17212b;
        padding: 0 13px;
        font-size: 14px;
        font-weight: 650;
        outline: none;
    }

    .dark .pub-input,
    .dark .pub-select {
        border-color: rgba(255,255,255,.1);
        background: rgba(255,255,255,.06);
        color: #f6f1e8;
    }

    .pub-table-wrap {
        overflow-x: auto;
    }

    .pub-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .pub-table th {
        padding: 14px 18px;
        background: #fbfaf7;
        color: #4b5563;
        font-size: 12px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: .08em;
        border-bottom: 1px solid #eee8de;
    }

    .dark .pub-table th {
        background: rgba(255,255,255,.05);
        color: rgba(215,206,192,.6);
        border-bottom-color: rgba(255,255,255,.1);
    }

    .pub-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #eee8de;
        vertical-align: top;
    }

    .dark .pub-table td {
        border-bottom-color: rgba(255,255,255,.1);
    }

    .pub-name {
        margin: 0;
        color: #17212b;
        font-size: 14px;
        font-weight: 950;
        line-height: 1.45;
    }

    .dark .pub-name {
        color: #f6f1e8;
    }

    .pub-meta {
        margin-top: 5px;
        color: #6b6258;
        font-size: 13px;
        font-weight: 650;
        line-height: 1.45;
    }

    .dark .pub-meta {
        color: rgba(215,206,192,.65);
    }

    .pub-badge {
        display: inline-flex;
        align-items: center;
        min-height: 26px;
        padding: 0 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        background: #eef3e8;
        color: #4f6f52;
        white-space: nowrap;
    }

    .pub-badge.gold {
        background: #fbf4e7;
        color: #9a761c;
    }

    .pub-badge.gray {
        background: #f1f1ef;
        color: #6b6258;
    }

    .pub-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
    }

    .pub-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 34px;
        padding: 0 12px;
        border-radius: 10px;
        border: 1px solid #e7ded1;
        background: #fff;
        color: #17212b;
        text-decoration: none;
        font-size: 12px;
        font-weight: 900;
        cursor: pointer;
    }

    .pub-action.danger {
        color: #b42318;
    }

    .dark .pub-action {
        border-color: rgba(255,255,255,.1);
        background: rgba(255,255,255,.06);
        color: #f6f1e8;
    }

    .dark .pub-action.danger {
        color: #fca5a5;
    }

    .pub-empty {
        padding: 44px 20px;
        text-align: center;
        color: #6b6258;
        font-size: 14px;
        font-weight: 650;
    }

    .pub-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 16px 18px;
    }

    .pub-page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 36px;
        padding: 0 14px;
        border-radius: 10px;
        border: 1px solid #e7ded1;
        color: #17212b;
        text-decoration: none;
        font-size: 13px;
        font-weight: 900;
    }

    .dark .pub-page-link {
        border-color: rgba(255,255,255,.1);
        color: #f6f1e8;
    }

    .video-thumb {
        width: 92px;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        border-radius: 12px;
        border: 1px solid #e7ded1;
        background: #fbfaf7;
    }

    .video-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .dark .video-thumb {
        border-color: rgba(255,255,255,.1);
        background: rgba(255,255,255,.06);
    }

    @media (max-width: 900px) {
        .pub-head {
            flex-direction: column;
        }

        .pub-filter {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="pub-head">
    <div>
        <h1 class="pub-title">Videos</h1>
        <p class="pub-subtitle">
            Kelola video YouTube Arvita Agus Kurniasari untuk halaman pembelajaran akademik.
        </p>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <a
            href="https://www.youtube.com/@arvitaaguskurniasari434"
            target="_blank"
            rel="noopener noreferrer"
            class="pub-btn"
            style="background:#18382c;"
        >
            YouTube Channel
        </a>

        <a href="{{ route('admin.videos.create') }}" class="pub-btn">
            + Add Video
        </a>
    </div>
</div>

@if (session('success'))
    <div class="pub-panel" style="margin-bottom:18px;padding:14px 18px;color:#4f6f52;font-size:14px;font-weight:800;">
        {{ session('success') }}
    </div>
@endif

<form method="GET" action="{{ route('admin.videos.index') }}" class="pub-panel pub-filter">
    <input
        type="search"
        name="q"
        value="{{ request('q') }}"
        class="pub-input"
        placeholder="Search title, category, topic..."
    >

    <select name="status" class="pub-select">
        <option value="">All Status</option>
        <option value="published" @selected(request('status') === 'published')>Published</option>
        <option value="draft" @selected(request('status') === 'draft')>Draft</option>
        <option value="featured" @selected(request('status') === 'featured')>Featured</option>
    </select>

    <button type="submit" class="pub-btn">Filter</button>
</form>

<section class="pub-panel">
    <div class="pub-table-wrap">
        <table class="pub-table">
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>Video</th>
                    <th>Category</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($videos as $video)
                    <tr>
                        <td>
                            <div class="video-thumb">
                                <img
                                    src="{{ $video->thumbnail_url }}"
                                    alt="{{ $video->title }}"
                                    loading="lazy"
                                >
                            </div>
                        </td>

                        <td>
                            <p class="pub-name">{{ $video->title }}</p>

                            <div class="pub-meta">
                                @if ($video->topic)
                                    {{ $video->topic }}
                                @else
                                    YouTube Video
                                @endif

                                @if ($video->youtube_url)
                                    <br>
                                    <a
                                        href="{{ $video->youtube_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        style="color:#4f6f52;text-decoration:none;font-weight:900;"
                                    >
                                        Open YouTube →
                                    </a>
                                @endif
                            </div>
                        </td>

                        <td>
                            @if ($video->category)
                                <span class="pub-badge gold">{{ $video->category }}</span>
                            @else
                                <span class="pub-badge gray">-</span>
                            @endif
                        </td>

                        <td>
                            <span class="pub-badge gray">{{ $video->year ?? '-' }}</span>
                        </td>

                        <td>
                            @if ($video->is_published)
                                <span class="pub-badge">Published</span>
                            @else
                                <span class="pub-badge gray">Draft</span>
                            @endif

                            @if ($video->is_featured)
                                <span class="pub-badge gold" style="margin-left:4px;">Featured</span>
                            @endif
                        </td>

                        <td>
                            <div class="pub-actions">
                                <a href="{{ route('admin.videos.edit', $video) }}" class="pub-action">
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.videos.destroy', $video) }}"
                                    onsubmit="return confirm('Hapus video ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="pub-action danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="pub-empty">
                                Belum ada video. Klik <strong>Add Video</strong> untuk menambahkan data pertama.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($videos->hasPages())
        <div class="pub-pagination">
            <div class="pub-meta">
                Showing {{ $videos->firstItem() }} - {{ $videos->lastItem() }} of {{ $videos->total() }}
            </div>

            <div style="display:flex;gap:8px;">
                @if ($videos->onFirstPage())
                    <span class="pub-page-link" style="opacity:.45;">Previous</span>
                @else
                    <a href="{{ $videos->previousPageUrl() }}" class="pub-page-link">Previous</a>
                @endif

                @if ($videos->hasMorePages())
                    <a href="{{ $videos->nextPageUrl() }}" class="pub-page-link">Next</a>
                @else
                    <span class="pub-page-link" style="opacity:.45;">Next</span>
                @endif
            </div>
        </div>
    @endif
</section>

@endsection