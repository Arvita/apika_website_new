@extends('admin.layouts.app')

@section('title', 'Courses - Admin Panel')

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
        color: rgba(215, 206, 192, .66);
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

    .pub-btn:hover {
        background: #18382c;
    }

    .pub-panel {
        background: #fff;
        border: 1px solid #e7ded1;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(31, 41, 51, .04);
    }

    .dark .pub-panel {
        background: rgba(255, 255, 255, .06);
        border-color: rgba(255, 255, 255, .1);
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

    .pub-input:focus,
    .pub-select:focus {
        border-color: #4f6f52;
        box-shadow: 0 0 0 3px rgba(79, 111, 82, .12);
    }

    .dark .pub-input,
    .dark .pub-select {
        border-color: rgba(255, 255, 255, .1);
        background: rgba(255, 255, 255, .06);
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
        white-space: nowrap;
    }

    .dark .pub-table th {
        background: rgba(255, 255, 255, .05);
        color: rgba(215, 206, 192, .6);
        border-bottom-color: rgba(255, 255, 255, .1);
    }

    .pub-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #eee8de;
        vertical-align: top;
    }

    .dark .pub-table td {
        border-bottom-color: rgba(255, 255, 255, .1);
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
        color: rgba(215, 206, 192, .65);
    }

    .pub-muted {
        color: #6b6258;
        font-size: 13px;
        font-weight: 750;
        line-height: 1.45;
    }

    .dark .pub-muted {
        color: rgba(215, 206, 192, .65);
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

    .dark .pub-badge {
        background: rgba(79, 111, 82, .22);
        color: #dbe8d4;
    }

    .dark .pub-badge.gold {
        background: rgba(154, 118, 28, .22);
        color: #f3d998;
    }

    .dark .pub-badge.gray {
        background: rgba(255, 255, 255, .08);
        color: rgba(215, 206, 192, .72);
    }

    .pub-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        flex-wrap: wrap;
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

    .pub-action:hover {
        background: #fbfaf7;
    }

    .pub-action.danger {
        color: #b42318;
    }

    .dark .pub-action {
        border-color: rgba(255, 255, 255, .1);
        background: rgba(255, 255, 255, .06);
        color: #f6f1e8;
    }

    .dark .pub-action:hover {
        background: rgba(255, 255, 255, .1);
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

    .dark .pub-empty {
        color: rgba(215, 206, 192, .66);
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
        background: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 900;
    }

    .pub-page-link.is-disabled {
        opacity: .45;
        cursor: not-allowed;
    }

    .dark .pub-page-link {
        border-color: rgba(255, 255, 255, .1);
        background: rgba(255, 255, 255, .06);
        color: #f6f1e8;
    }

    @media (max-width: 900px) {
        .pub-head {
            flex-direction: column;
        }

        .pub-filter {
            grid-template-columns: 1fr;
        }

        .pub-pagination {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="pub-head">
    <div>
        <h1 class="pub-title">Courses</h1>
        <p class="pub-subtitle">
            Kelola course utama seperti Pemrograman Dasar, OOP, Microsoft Office, dan learning path lainnya.
        </p>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <a href="{{ route('admin.materials.index') }}" class="pub-btn" style="background:#18382c;">
            Manage Materials
        </a>

        <a href="{{ route('admin.courses.create') }}" class="pub-btn">
            + Add Course
        </a>
    </div>
</div>

@if (session('success'))
    <div class="pub-panel" style="padding:14px 18px;margin-bottom:18px;color:#4f6f52;font-size:14px;font-weight:850;">
        {{ session('success') }}
    </div>
@endif

<form method="GET" action="{{ route('admin.courses.index') }}" class="pub-panel pub-filter">
    <input
        type="search"
        name="q"
        value="{{ request('q') }}"
        class="pub-input"
        placeholder="Search title, category, level..."
    >

    <select name="status" class="pub-select">
        <option value="">All Status</option>
        <option value="published" @selected(request('status') === 'published')>Published</option>
        <option value="draft" @selected(request('status') === 'draft')>Draft</option>
    </select>

    <button type="submit" class="pub-btn">
        Filter
    </button>
</form>

<div class="pub-panel">
    <div class="pub-table-wrap">
        <table class="pub-table">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Category</th>
                    <th>Materials</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td style="min-width:340px;">
                            <p class="pub-name">{{ $course->title }}</p>

                            @if ($course->title_en)
                                <div class="pub-meta">
                                    {{ $course->title_en }}
                                </div>
                            @endif

                            @if ($course->summary)
                                <div class="pub-meta" style="max-width:620px;">
                                    {{ \Illuminate\Support\Str::limit($course->summary, 150) }}
                                </div>
                            @endif

                            <div class="pub-meta">
                                Slug: {{ $course->slug }}
                            </div>
                        </td>

                        <td>
                            @if ($course->category)
                                <span class="pub-badge gray">{{ $course->category }}</span>
                            @else
                                <span class="pub-muted">-</span>
                            @endif

                            @if ($course->level)
                                <div style="margin-top:8px;">
                                    <span class="pub-badge gold">{{ $course->level }}</span>
                                </div>
                            @endif
                        </td>

                        <td>
                            <span class="pub-badge">
                                {{ $course->materials_count ?? 0 }} materials
                            </span>
                        </td>

                        <td>
                            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                                @if ($course->is_published)
                                    <span class="pub-badge">Published</span>
                                @else
                                    <span class="pub-badge gray">Draft</span>
                                @endif

                                @if ($course->is_featured)
                                    <span class="pub-badge gold">Featured</span>
                                @endif
                            </div>
                        </td>

                        <td>
                            <div class="pub-actions">
                                @if (Route::has('courses.show'))
                                    <a
                                        href="{{ route('courses.show', $course) }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="pub-action"
                                    >
                                        View
                                    </a>
                                @endif

                                <a
                                    href="{{ route('admin.materials.index', ['course_id' => $course->id]) }}"
                                    class="pub-action"
                                >
                                    Materials
                                </a>

                                <a
                                    href="{{ route('admin.courses.edit', $course) }}"
                                    class="pub-action"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.courses.destroy', $course) }}"
                                    onsubmit="return confirm('Hapus course ini? Semua materi di dalamnya juga ikut terhapus.')"
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
                        <td colspan="5">
                            <div class="pub-empty">
                                Belum ada course. Klik Add Course untuk menambahkan data pertama.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($courses->hasPages())
        <div class="pub-pagination">
            <div class="pub-muted">
                Showing {{ $courses->firstItem() }} - {{ $courses->lastItem() }} of {{ $courses->total() }}
            </div>

            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                @if ($courses->onFirstPage())
                    <span class="pub-page-link is-disabled">Previous</span>
                @else
                    <a href="{{ $courses->previousPageUrl() }}" class="pub-page-link">Previous</a>
                @endif

                @if ($courses->hasMorePages())
                    <a href="{{ $courses->nextPageUrl() }}" class="pub-page-link">Next</a>
                @else
                    <span class="pub-page-link is-disabled">Next</span>
                @endif
            </div>
        </div>
    @endif
</div>

@endsection