@extends('admin.layouts.app')

@section('title', 'Publications - Admin Panel')

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
        grid-template-columns: 1fr 180px 180px auto;
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
        <h1 class="pub-title">Publications</h1>
        <p class="pub-subtitle">
            Kelola jurnal, publikasi, DOI, SINTA, Scholar, Scopus, dan metadata akademik.
        </p>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
    <a href="{{ route('admin.publications.import') }}" class="pub-btn" style="background:#18382c;">
        Import BibTeX
    </a>

    <a href="{{ route('admin.publications.create') }}" class="pub-btn">
        + Add Publication
    </a>
</div>
</div>

<form method="GET" action="{{ route('admin.publications.index') }}" class="pub-panel pub-filter">
    <input
        type="search"
        name="q"
        value="{{ request('q') }}"
        class="pub-input"
        placeholder="Search title, authors, venue, DOI..."
    >

    <select name="type" class="pub-select">
        <option value="">All Types</option>
        <option value="journal" @selected(request('type') === 'journal')>Journal</option>
        <option value="conference" @selected(request('type') === 'conference')>Conference</option>
        <option value="book_chapter" @selected(request('type') === 'book_chapter')>Book Chapter</option>
        <option value="proceeding" @selected(request('type') === 'proceeding')>Proceeding</option>
        <option value="thesis" @selected(request('type') === 'thesis')>Thesis</option>
        <option value="other" @selected(request('type') === 'other')>Other</option>
    </select>

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
                    <th>Publication</th>
                    <th>Year</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Citations</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($publications as $publication)
                    <tr>
                        <td>
                            <p class="pub-name">{{ $publication->title }}</p>
                            <div class="pub-meta">
                                {{ $publication->authors }}
                                @if ($publication->venue)
                                    <br>{{ $publication->venue }}
                                @endif
                                @if ($publication->doi)
                                    <br>DOI: {{ $publication->doi }}
                                @endif
                            </div>
                        </td>

                        <td>
                            <span class="pub-badge gray">{{ $publication->year ?? '-' }}</span>
                        </td>

                        <td>
                            <span class="pub-badge gold">{{ str_replace('_', ' ', ucfirst($publication->type)) }}</span>
                        </td>

                        <td>
                            @if ($publication->is_published)
                                <span class="pub-badge">Published</span>
                            @else
                                <span class="pub-badge gray">Draft</span>
                            @endif

                            @if ($publication->is_featured)
                                <span class="pub-badge gold" style="margin-left:4px;">Featured</span>
                            @endif
                        </td>

                        <td>
                            <span class="pub-badge gray">{{ $publication->citation_count }}</span>
                        </td>

                        <td>
                            <div class="pub-actions">
                                <a href="{{ route('admin.publications.edit', $publication) }}" class="pub-action">
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.publications.destroy', $publication) }}"
                                    onsubmit="return confirm('Hapus publication ini?')"
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
                                Belum ada publication. Klik <strong>Add Publication</strong> untuk menambahkan data pertama.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($publications->hasPages())
        <div class="pub-pagination">
            <div class="pub-meta">
                Showing {{ $publications->firstItem() }} - {{ $publications->lastItem() }} of {{ $publications->total() }}
            </div>

            <div style="display:flex;gap:8px;">
                @if ($publications->onFirstPage())
                    <span class="pub-page-link" style="opacity:.45;">Previous</span>
                @else
                    <a href="{{ $publications->previousPageUrl() }}" class="pub-page-link">Previous</a>
                @endif

                @if ($publications->hasMorePages())
                    <a href="{{ $publications->nextPageUrl() }}" class="pub-page-link">Next</a>
                @else
                    <span class="pub-page-link" style="opacity:.45;">Next</span>
                @endif
            </div>
        </div>
    @endif
</section>
@endsection