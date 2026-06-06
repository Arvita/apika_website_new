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

    .form-help {
        margin-top: 6px;
        color: #6b6258;
        font-size: 12px;
        font-weight: 650;
        line-height: 1.5;
    }

    .dark .form-help {
        color: rgba(215,206,192,.62);
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

    .video-preview {
        overflow: hidden;
        border-radius: 18px;
        border: 1px solid #e7ded1;
        background: #fbfaf7;
    }

    .video-preview-frame {
        aspect-ratio: 16 / 9;
        background: #17212b;
    }

    .video-preview-frame iframe {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    .video-preview-meta {
        padding: 14px 16px;
        color: #6b6258;
        font-size: 13px;
        font-weight: 650;
    }

    .dark .video-preview {
        border-color: rgba(255,255,255,.1);
        background: rgba(255,255,255,.06);
    }

    .dark .video-preview-meta {
        color: rgba(215,206,192,.65);
    }

    @media (max-width: 800px) {
        .form-head {
            flex-direction: column;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            justify-content: flex-start;
            flex-wrap: wrap;
        }
    }
</style>

<div class="form-head">
    <div>
        <h1 class="form-title">{{ $formTitle }}</h1>
        <p class="form-subtitle">{{ $formSubtitle }}</p>
    </div>

    <a href="{{ route('admin.videos.index') }}" class="btn-secondary">
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
            <input
                id="title"
                name="title"
                class="form-input"
                value="{{ old('title', $video->title) }}"
                required
            >
            @error('title') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-full">
            <label class="form-label" for="title_en">Title English</label>
            <input
                id="title_en"
                name="title_en"
                class="form-input"
                value="{{ old('title_en', $video->title_en) }}"
            >
            @error('title_en') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-full">
            <label class="form-label" for="youtube_url">YouTube URL *</label>
            <input
                id="youtube_url"
                name="youtube_url"
                type="url"
                class="form-input"
                value="{{ old('youtube_url', $video->youtube_url) }}"
                placeholder="https://www.youtube.com/watch?v=VIDEO_ID"
                required
            >
            <div class="form-help">
                Paste link video YouTube. Bisa format watch, youtu.be, embed, atau shorts.
            </div>
            @error('youtube_url') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        @if ($video->youtube_id)
            <div class="form-full">
                <div class="video-preview">
                    <div class="video-preview-frame">
                        <iframe
                            src="{{ $video->embed_url }}"
                            title="{{ $video->title }}"
                            loading="lazy"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <div class="video-preview-meta">
                        Current YouTube ID: <strong>{{ $video->youtube_id }}</strong>
                    </div>
                </div>
            </div>
        @endif

        <div>
            <label class="form-label" for="category">Category</label>
            <input
                id="category"
                name="category"
                class="form-input"
                value="{{ old('category', $video->category) }}"
                placeholder="Academic, Learning, Research"
            >
            @error('category') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="topic">Topic</label>
            <input
                id="topic"
                name="topic"
                class="form-input"
                value="{{ old('topic', $video->topic) }}"
                placeholder="Digital Citizenship"
            >
            @error('topic') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="year">Year</label>
            <input
                id="year"
                name="year"
                type="number"
                class="form-input"
                value="{{ old('year', $video->year) }}"
                min="1900"
                max="{{ now()->year }}"
            >
            @error('year') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="form-label" for="sort_order">Sort Order</label>
            <input
                id="sort_order"
                name="sort_order"
                type="number"
                class="form-input"
                value="{{ old('sort_order', $video->sort_order ?? 0) }}"
                min="0"
            >
            @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-full">
            <label class="form-label" for="description">Description</label>
            <textarea
                id="description"
                name="description"
                class="form-textarea"
            >{{ old('description', $video->description) }}</textarea>
            @error('description') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-full">
            <label class="form-label" for="description_en">Description English</label>
            <textarea
                id="description_en"
                name="description_en"
                class="form-textarea"
            >{{ old('description_en', $video->description_en) }}</textarea>
            @error('description_en') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section-title">Publishing</div>

        <div class="form-full">
            <div class="form-checks">
                <label class="form-check">
                    <input
                        type="checkbox"
                        name="is_published"
                        value="1"
                        @checked(old('is_published', $video->exists ? $video->is_published : true))
                    >
                    Published
                </label>

                <label class="form-check">
                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        @checked(old('is_featured', $video->is_featured ?? false))
                    >
                    Featured
                </label>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('admin.videos.index') }}" class="btn-secondary">
            Cancel
        </a>

        <button type="submit" class="btn-primary">
            {{ $buttonText }}
        </button>
    </div>
</form>