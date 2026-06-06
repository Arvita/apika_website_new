<style>
    .form-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
    }

    .form-title {
        margin: 0;
        color: #18382c;
        font-size: 32px;
        line-height: 1.1;
        letter-spacing: -0.035em;
        font-weight: 950;
    }

    .dark .form-title {
        color: #f6f1e8;
    }

    .form-subtitle {
        margin: 8px 0 0;
        color: #6b6258;
        font-size: 14px;
        font-weight: 650;
    }

    .dark .form-subtitle {
        color: rgba(215,206,192,.66);
    }

    .form-panel {
        background: #fff;
        border: 1px solid #e7ded1;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(31,41,51,.04);
        padding: 22px;
    }

    .dark .form-panel {
        background: rgba(255,255,255,.06);
        border-color: rgba(255,255,255,.1);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .form-full {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #17212b;
        font-size: 13px;
        font-weight: 950;
    }

    .dark .form-label {
        color: #f6f1e8;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        border-radius: 13px;
        border: 1px solid #e7ded1;
        background: #fbfaf7;
        color: #17212b;
        padding: 11px 13px;
        font-size: 14px;
        font-weight: 650;
        outline: none;
    }

    .form-input,
    .form-select {
        height: 44px;
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .dark .form-input,
    .dark .form-select,
    .dark .form-textarea {
        border-color: rgba(255,255,255,.1);
        background: rgba(255,255,255,.06);
        color: #f6f1e8;
    }

    .form-error {
        margin-top: 6px;
        color: #b42318;
        font-size: 12px;
        font-weight: 800;
    }

    .form-section-title {
        grid-column: 1 / -1;
        margin: 8px 0 0;
        padding-top: 18px;
        border-top: 1px solid #eee8de;
        color: #18382c;
        font-size: 18px;
        font-weight: 950;
    }

    .dark .form-section-title {
        color: #f6f1e8;
        border-top-color: rgba(255,255,255,.1);
    }

    .form-checks {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    .form-check {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        border-radius: 14px;
        border: 1px solid #e7ded1;
        background: #fbfaf7;
        color: #17212b;
        font-size: 14px;
        font-weight: 850;
    }

    .dark .form-check {
        border-color: rgba(255,255,255,.1);
        background: rgba(255,255,255,.06);
        color: #f6f1e8;
    }

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 22px;
        padding-top: 20px;
        border-top: 1px solid #eee8de;
    }

    .dark .form-actions {
        border-top-color: rgba(255,255,255,.1);
    }

    .btn-primary,
    .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 42px;
        padding: 0 18px;
        border-radius: 13px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 950;
        cursor: pointer;
    }

    .btn-primary {
        border: 0;
        background: #4f6f52;
        color: white;
    }

    .btn-secondary {
        border: 1px solid #e7ded1;
        background: #fff;
        color: #17212b;
    }

    .dark .btn-secondary {
        border-color: rgba(255,255,255,.1);
        background: rgba(255,255,255,.06);
        color: #f6f1e8;
    }

    @media (max-width: 800px) {
        .form-head {
            flex-direction: column;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="form-head">
    <div>
        <h1 class="form-title">{{ $formTitle }}</h1>
        <p class="form-subtitle">{{ $formSubtitle }}</p>
    </div>

    <a href="{{ route('admin.publications.index') }}" class="btn-secondary">
        Back
    </a>
</div>

@if ($errors->any())
    <div class="form-panel" style="margin-bottom:18px;border-color:#f3b4ad;background:#fff5f4;color:#b42318;">
        <strong>Form belum valid.</strong>
        <div style="margin-top:6px;font-size:13px;font-weight:700;">
            Periksa kembali field yang bertanda error.
        </div>
    </div>
@endif

<form method="POST" action="{{ $action }}" class="form-panel">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="form-grid">
        <div class="form-full">
            <label class="form-label" for="title">Title *</label>
            <input id="title" name="title" class="form-input" value="{{ old('title', $publication->title) }}" required>
            @error('title') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-full">
            <label class="form-label" for="title_en">Title English</label>
            <input id="title_en" name="title_en" class="form-input" value="{{ old('title_en', $publication->title_en) }}">
            @error('title_en') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-full">
            <label class="form-label" for="authors">Authors *</label>
            <textarea id="authors" name="authors" class="form-textarea" style="min-height:90px;" required>{{ old('authors', $publication->authors) }}</textarea>
            @error('authors') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="year">Year</label>
            <input id="year" name="year" type="number" class="form-input" value="{{ old('year', $publication->year) }}">
            @error('year') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="type">Type</label>
            <select id="type" name="type" class="form-select">
                <option value="journal" @selected(old('type', $publication->type) === 'journal')>Journal</option>
                <option value="conference" @selected(old('type', $publication->type) === 'conference')>Conference</option>
                <option value="book_chapter" @selected(old('type', $publication->type) === 'book_chapter')>Book Chapter</option>
                <option value="proceeding" @selected(old('type', $publication->type) === 'proceeding')>Proceeding</option>
                <option value="thesis" @selected(old('type', $publication->type) === 'thesis')>Thesis</option>
                <option value="other" @selected(old('type', $publication->type) === 'other')>Other</option>
            </select>
            @error('type') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="venue">Venue / Journal / Conference</label>
            <input id="venue" name="venue" class="form-input" value="{{ old('venue', $publication->venue) }}">
            @error('venue') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="publisher">Publisher</label>
            <input id="publisher" name="publisher" class="form-input" value="{{ old('publisher', $publication->publisher) }}">
            @error('publisher') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="volume">Volume</label>
            <input id="volume" name="volume" class="form-input" value="{{ old('volume', $publication->volume) }}">
            @error('volume') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="issue">Issue</label>
            <input id="issue" name="issue" class="form-input" value="{{ old('issue', $publication->issue) }}">
            @error('issue') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="pages">Pages</label>
            <input id="pages" name="pages" class="form-input" value="{{ old('pages', $publication->pages) }}">
            @error('pages') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="doi">DOI</label>
            <input id="doi" name="doi" class="form-input" value="{{ old('doi', $publication->doi) }}">
            @error('doi') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="research_area">Research Area</label>
            <input id="research_area" name="research_area" class="form-input" value="{{ old('research_area', $publication->research_area) }}">
            @error('research_area') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-full">
            <label class="form-label" for="keywords">Keywords</label>
            <input id="keywords" name="keywords" class="form-input" value="{{ old('keywords', $publication->keywords) }}" placeholder="web development, IoT, image processing">
            @error('keywords') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-full">
            <label class="form-label" for="abstract">Abstract / Summary</label>
            <textarea id="abstract" name="abstract" class="form-textarea">{{ old('abstract', $publication->abstract) }}</textarea>
            @error('abstract') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-full">
            <label class="form-label" for="abstract_en">Abstract English</label>
            <textarea id="abstract_en" name="abstract_en" class="form-textarea">{{ old('abstract_en', $publication->abstract_en) }}</textarea>
            @error('abstract_en') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section-title">Academic Links</div>

        <div>
            <label class="form-label" for="source">Source</label>
            <select id="source" name="source" class="form-select">
                <option value="manual" @selected(old('source', $publication->source) === 'manual')>Manual</option>
                <option value="google_scholar" @selected(old('source', $publication->source) === 'google_scholar')>Google Scholar</option>
                <option value="sinta" @selected(old('source', $publication->source) === 'sinta')>SINTA</option>
                <option value="scopus" @selected(old('source', $publication->source) === 'scopus')>Scopus</option>
                <option value="crossref" @selected(old('source', $publication->source) === 'crossref')>Crossref</option>
            </select>
            @error('source') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="citation_count">Citation Count</label>
            <input id="citation_count" name="citation_count" type="number" min="0" class="form-input" value="{{ old('citation_count', $publication->citation_count ?? 0) }}">
            @error('citation_count') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="google_scholar_url">Google Scholar URL</label>
            <input id="google_scholar_url" name="google_scholar_url" class="form-input" value="{{ old('google_scholar_url', $publication->google_scholar_url) }}">
            @error('google_scholar_url') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="sinta_url">SINTA URL</label>
            <input id="sinta_url" name="sinta_url" class="form-input" value="{{ old('sinta_url', $publication->sinta_url) }}">
            @error('sinta_url') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="scopus_url">Scopus URL</label>
            <input id="scopus_url" name="scopus_url" class="form-input" value="{{ old('scopus_url', $publication->scopus_url) }}">
            @error('scopus_url') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="journal_url">Journal URL</label>
            <input id="journal_url" name="journal_url" class="form-input" value="{{ old('journal_url', $publication->journal_url) }}">
            @error('journal_url') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-full">
            <label class="form-label" for="pdf_url">PDF URL</label>
            <input id="pdf_url" name="pdf_url" class="form-input" value="{{ old('pdf_url', $publication->pdf_url) }}">
            @error('pdf_url') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section-title">Publishing</div>

        <div>
            <label class="form-label" for="sort_order">Sort Order</label>
            <input id="sort_order" name="sort_order" type="number" class="form-input" value="{{ old('sort_order', $publication->sort_order ?? 0) }}">
            @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="published_at">Published At</label>
            <input
                id="published_at"
                name="published_at"
                type="datetime-local"
                class="form-input"
                value="{{ old('published_at', optional($publication->published_at)->format('Y-m-d\TH:i')) }}"
            >
            @error('published_at') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-full">
            <div class="form-checks">
                <label class="form-check">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $publication->is_published ?? true))>
                    Published
                </label>

                <label class="form-check">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $publication->is_featured ?? false))>
                    Featured
                </label>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('admin.publications.index') }}" class="btn-secondary">
            Cancel
        </a>

        <button type="submit" class="btn-primary">
            {{ $buttonText }}
        </button>
    </div>
</form>