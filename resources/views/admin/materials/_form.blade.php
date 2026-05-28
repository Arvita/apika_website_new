@php
    $selectedCourseId = old('course_id', $material->course_id ?? request('course_id'));
    $currentMethod = $method ?? 'POST';
@endphp

<style>
    .pub-form-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 22px;
    }

    .pub-form-title {
        margin: 0;
        color: #18382c;
        font-size: 32px;
        line-height: 1.1;
        letter-spacing: -0.035em;
        font-weight: 950;
    }

    .dark .pub-form-title {
        color: #f6f1e8;
    }

    .pub-form-subtitle {
        margin: 8px 0 0;
        color: #6b6258;
        font-size: 14px;
        font-weight: 650;
        max-width: 760px;
        line-height: 1.6;
    }

    .dark .pub-form-subtitle {
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
        white-space: nowrap;
    }

    .pub-btn:hover {
        background: #18382c;
        color: white;
    }

    .pub-btn.secondary {
        background: #fff;
        color: #18382c;
        border: 1px solid #e7ded1;
    }

    .pub-btn.secondary:hover {
        background: #fbfaf7;
        color: #18382c;
    }

    .dark .pub-btn.secondary {
        background: rgba(255, 255, 255, .06);
        color: #f6f1e8;
        border-color: rgba(255, 255, 255, .1);
    }

    .dark .pub-btn.secondary:hover {
        background: rgba(255, 255, 255, .1);
        color: #f6f1e8;
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

    .pub-form {
        padding: 22px;
    }

    .pub-section {
        padding: 22px 0;
        border-top: 1px solid #eee8de;
    }

    .pub-section:first-child {
        padding-top: 0;
        border-top: 0;
    }

    .dark .pub-section {
        border-top-color: rgba(255, 255, 255, .1);
    }

    .pub-section-title {
        margin: 0 0 16px;
        color: #18382c;
        font-size: 13px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: .12em;
    }

    .dark .pub-section-title {
        color: #f3d998;
    }

    .pub-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .pub-grid.three {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .pub-field {
        min-width: 0;
    }

    .pub-field.full {
        grid-column: 1 / -1;
    }

    .pub-label {
        display: block;
        color: #3c3a35;
        font-size: 13px;
        font-weight: 900;
        margin-bottom: 7px;
    }

    .dark .pub-label {
        color: rgba(246, 241, 232, .86);
    }

    .pub-input,
    .pub-select,
    .pub-textarea {
        width: 100%;
        border-radius: 13px;
        border: 1px solid #e7ded1;
        background: #fbfaf7;
        color: #17212b;
        padding: 0 13px;
        font-size: 14px;
        font-weight: 650;
        outline: none;
    }

    .pub-input,
    .pub-select {
        height: 42px;
    }

    .pub-textarea {
        min-height: 118px;
        padding-top: 12px;
        padding-bottom: 12px;
        line-height: 1.65;
        resize: vertical;
    }

    .pub-textarea.tall {
        min-height: 180px;
    }

    .pub-input:focus,
    .pub-select:focus,
    .pub-textarea:focus {
        border-color: #4f6f52;
        box-shadow: 0 0 0 3px rgba(79, 111, 82, .12);
    }

    .dark .pub-input,
    .dark .pub-select,
    .dark .pub-textarea {
        border-color: rgba(255, 255, 255, .1);
        background: rgba(255, 255, 255, .06);
        color: #f6f1e8;
    }

    .pub-help {
        margin-top: 7px;
        color: #6b6258;
        font-size: 12px;
        font-weight: 650;
        line-height: 1.5;
    }

    .dark .pub-help {
        color: rgba(215, 206, 192, .58);
    }

    .pub-error {
        margin-top: 7px;
        color: #b42318;
        font-size: 12px;
        font-weight: 850;
    }

    .dark .pub-error {
        color: #fca5a5;
    }

    .pub-alert {
        padding: 14px 16px;
        border-radius: 15px;
        margin-bottom: 18px;
        border: 1px solid #f3b4ad;
        background: #fff1f0;
        color: #b42318;
        font-size: 14px;
        font-weight: 750;
    }

    .dark .pub-alert {
        border-color: rgba(252, 165, 165, .25);
        background: rgba(127, 29, 29, .25);
        color: #fecaca;
    }

    .pub-check-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .pub-check {
        display: flex;
        align-items: center;
        gap: 10px;
        min-height: 48px;
        padding: 0 14px;
        border-radius: 14px;
        border: 1px solid #e7ded1;
        background: #fbfaf7;
        color: #3c3a35;
        font-size: 14px;
        font-weight: 900;
    }

    .dark .pub-check {
        border-color: rgba(255, 255, 255, .1);
        background: rgba(255, 255, 255, .06);
        color: rgba(246, 241, 232, .86);
    }

    .pub-check input {
        width: 16px;
        height: 16px;
        accent-color: #4f6f52;
    }

    .pub-form-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding-top: 20px;
        border-top: 1px solid #eee8de;
    }

    .dark .pub-form-actions {
        border-top-color: rgba(255, 255, 255, .1);
    }

    .sub-material-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 16px;
    }

    .sub-material-subtitle {
        margin: 0;
        color: #6b6258;
        font-size: 13px;
        line-height: 1.55;
        font-weight: 650;
    }

    .dark .sub-material-subtitle {
        color: rgba(215, 206, 192, .64);
    }

    .sub-material-list {
        display: grid;
        gap: 12px;
    }

    .sub-material-item {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
        padding: 16px;
        border-radius: 16px;
        border: 1px solid #e7ded1;
        background: #fbfaf7;
    }

    .dark .sub-material-item {
        border-color: rgba(255, 255, 255, .10);
        background: rgba(255, 255, 255, .05);
    }

    .sub-material-main {
        min-width: 0;
    }

    .sub-material-top {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-bottom: 9px;
    }

    .sub-material-badge {
        display: inline-flex;
        align-items: center;
        min-height: 24px;
        padding: 0 9px;
        border-radius: 999px;
        background: #eef3e8;
        color: #4f6f52;
        font-size: 11px;
        font-weight: 950;
    }

    .sub-material-badge.gold {
        background: #fbf4e7;
        color: #9a761c;
    }

    .sub-material-badge.muted {
        background: #f1f1ef;
        color: #6b6258;
    }

    .sub-material-badge.danger {
        background: #fff1f0;
        color: #b42318;
    }

    .dark .sub-material-badge {
        background: rgba(79, 111, 82, .22);
        color: #dbe8d4;
    }

    .dark .sub-material-badge.gold {
        background: rgba(154, 118, 28, .22);
        color: #f3d998;
    }

    .dark .sub-material-badge.muted {
        background: rgba(255, 255, 255, .08);
        color: rgba(215, 206, 192, .72);
    }

    .dark .sub-material-badge.danger {
        background: rgba(127, 29, 29, .28);
        color: #fecaca;
    }

    .sub-material-title {
        margin: 0;
        color: #18382c;
        font-size: 16px;
        line-height: 1.35;
        font-weight: 950;
    }

    .dark .sub-material-title {
        color: #f6f1e8;
    }

    .sub-material-text {
        margin: 6px 0 0;
        color: #6b6258;
        font-size: 13px;
        line-height: 1.55;
        font-weight: 650;
    }

    .dark .sub-material-text {
        color: rgba(215, 206, 192, .65);
    }

    .sub-material-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .sub-material-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 36px;
        padding: 0 14px;
        border-radius: 999px;
        border: 1px solid #e7ded1;
        background: #fff;
        color: #18382c;
        text-decoration: none;
        font-size: 13px;
        font-weight: 900;
        cursor: pointer;
    }

    .sub-material-action:hover {
        background: #fbfaf7;
    }

    .sub-material-action.danger {
        color: #b42318;
    }

    .dark .sub-material-action {
        border-color: rgba(255, 255, 255, .10);
        background: rgba(255, 255, 255, .06);
        color: #f6f1e8;
    }

    .dark .sub-material-action.danger {
        color: #fca5a5;
    }

    .sub-material-empty {
        padding: 22px;
        border-radius: 16px;
        border: 1px dashed #d8cbb8;
        background: #fbfaf7;
        color: #6b6258;
        font-size: 14px;
        font-weight: 650;
    }

    .dark .sub-material-empty {
        border-color: rgba(255, 255, 255, .15);
        background: rgba(255, 255, 255, .05);
        color: rgba(215, 206, 192, .68);
    }

    @media (max-width: 900px) {

        .pub-form-head,
        .sub-material-head,
        .sub-material-item {
            flex-direction: column;
        }

        .pub-grid,
        .pub-grid.three,
        .pub-check-grid {
            grid-template-columns: 1fr;
        }

        .pub-form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .pub-btn {
            width: 100%;
        }

        .sub-material-actions {
            width: 100%;
        }

        .sub-material-action {
            flex: 1;
        }
    }
</style>

<div class="pub-form-head">
    <div>
        <h1 class="pub-form-title">{{ $formTitle }}</h1>
        <p class="pub-form-subtitle">{{ $formSubtitle }}</p>
    </div>

    <a href="{{ $selectedCourseId ? route('admin.materials.index', ['course_id' => $selectedCourseId]) : route('admin.materials.index') }}"
        class="pub-btn secondary">
        Back
    </a>
</div>

@if ($errors->any())
    <div class="pub-alert">
        <strong>Form belum valid.</strong>
        <div>Periksa kembali field yang bertanda error.</div>
    </div>
@endif

<div class="pub-panel">
    <form method="POST" action="{{ $action }}" class="pub-form">
        @csrf

        @if ($currentMethod !== 'POST')
            @method($currentMethod)
        @endif

        <div class="pub-section">
            <h2 class="pub-section-title">Basic Information</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="course_id" class="pub-label">Course *</label>
                    <select id="course_id" name="course_id" required class="pub-select">
                        <option value="">Pilih Course</option>

                        @foreach ($courses as $courseOption)
                            <option value="{{ $courseOption->id }}" @selected((string) $selectedCourseId === (string) $courseOption->id)>
                                {{ $courseOption->title }}
                            </option>
                        @endforeach
                    </select>

                    @error('course_id')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="material_type" class="pub-label">Material Type *</label>
                    <select id="material_type" name="material_type" required class="pub-select">
                        @foreach (['lesson' => 'Lesson', 'quiz' => 'Quiz', 'game' => 'Game', 'project' => 'Project', 'link' => 'Link', 'file' => 'File'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('material_type', $material->material_type ?: 'lesson') === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    @error('material_type')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-grid" style="margin-top:16px;">
                <div class="pub-field">
                    <label for="title" class="pub-label">Title ID *</label>
                    <input id="title" name="title" type="text" required
                        value="{{ old('title', $material->title) }}" class="pub-input" placeholder="File Handling">

                    @error('title')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="title_en" class="pub-label">Title English</label>
                    <input id="title_en" name="title_en" type="text"
                        value="{{ old('title_en', $material->title_en) }}" class="pub-input"
                        placeholder="File Handling">

                    @error('title_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-grid three" style="margin-top:16px;">
                <div class="pub-field">
                    <label for="week_label" class="pub-label">Week Label</label>
                    <input id="week_label" name="week_label" type="text"
                        value="{{ old('week_label', $material->week_label) }}" class="pub-input"
                        placeholder="Minggu 12">

                    @error('week_label')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="week_number" class="pub-label">Week Number</label>
                    <input id="week_number" name="week_number" type="number" min="1"
                        value="{{ old('week_number', $material->week_number) }}" class="pub-input" placeholder="12">

                    @error('week_number')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="sort_order" class="pub-label">Sort Order</label>
                    <input id="sort_order" name="sort_order" type="number" min="0"
                        value="{{ old('sort_order', $material->sort_order ?? 0) }}" class="pub-input">

                    @error('sort_order')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">Summary</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="summary" class="pub-label">Summary ID</label>
                    <textarea id="summary" name="summary" class="pub-textarea" placeholder="Ringkasan singkat materi...">{{ old('summary', $material->summary) }}</textarea>

                    @error('summary')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="summary_en" class="pub-label">Summary English</label>
                    <textarea id="summary_en" name="summary_en" class="pub-textarea" placeholder="Short material summary...">{{ old('summary_en', $material->summary_en) }}</textarea>

                    @error('summary_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">Main Content</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="content" class="pub-label">Content ID</label>
                    <textarea id="content" name="content" class="pub-textarea tall" placeholder="Isi utama materi...">{{ old('content', $material->content) }}</textarea>

                    @error('content')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="content_en" class="pub-label">Content English</label>
                    <textarea id="content_en" name="content_en" class="pub-textarea tall" placeholder="English material content...">{{ old('content_en', $material->content_en) }}</textarea>

                    @error('content_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-help">
                Sub materi seperti heading, code, image, video, dan link bisa ditambahkan setelah material disimpan.
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">Resources</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="external_url" class="pub-label">External URL</label>
                    <input id="external_url" name="external_url" type="url"
                        value="{{ old('external_url', $material->external_url) }}" class="pub-input"
                        placeholder="https://...">

                    @error('external_url')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="related_video_url" class="pub-label">Related Video URL</label>
                    <input id="related_video_url" name="related_video_url" type="url"
                        value="{{ old('related_video_url', $material->related_video_url) }}" class="pub-input"
                        placeholder="https://www.youtube.com/watch?v=...">

                    @error('related_video_url')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-field" style="margin-top:16px;">
                <label for="file_path" class="pub-label">File Path</label>
                <input id="file_path" name="file_path" type="text"
                    value="{{ old('file_path', $material->file_path) }}" class="pub-input"
                    placeholder="/storage/materials/file.pdf">

                <div class="pub-help">
                    Bisa diisi path file manual dulu. Nanti bisa dihubungkan ke media library.
                </div>

                @error('file_path')
                    <div class="pub-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">SEO</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="meta_title" class="pub-label">Meta Title ID</label>
                    <input id="meta_title" name="meta_title" type="text"
                        value="{{ old('meta_title', $material->meta_title) }}" class="pub-input">

                    @error('meta_title')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="meta_title_en" class="pub-label">Meta Title English</label>
                    <input id="meta_title_en" name="meta_title_en" type="text"
                        value="{{ old('meta_title_en', $material->meta_title_en) }}" class="pub-input">

                    @error('meta_title_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-grid" style="margin-top:16px;">
                <div class="pub-field">
                    <label for="meta_description" class="pub-label">Meta Description ID</label>
                    <textarea id="meta_description" name="meta_description" class="pub-textarea">{{ old('meta_description', $material->meta_description) }}</textarea>

                    @error('meta_description')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="meta_description_en" class="pub-label">Meta Description English</label>
                    <textarea id="meta_description_en" name="meta_description_en" class="pub-textarea">{{ old('meta_description_en', $material->meta_description_en) }}</textarea>

                    @error('meta_description_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">Publishing</h2>

            <div class="pub-check-grid">
                <label class="pub-check">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $material->exists ? $material->is_published : true))>
                    Published
                </label>
            </div>
        </div>

        @if ($material->exists)
            <div class="pub-section">
                <div class="sub-material-head">
                    <div>
                        <h2 class="pub-section-title" style="margin-bottom:6px;">Sub Materials</h2>
                        <p class="sub-material-subtitle">
                            Kelola bagian-bagian kecil di dalam materi ini, seperti content, code, image, video, link,
                            atau file.
                        </p>
                    </div>

                    <a href="{{ route('admin.material-sections.create', ['material_id' => $material->id]) }}"
                        class="pub-btn secondary" style="min-height:38px;padding:0 14px;font-size:13px;">
                        + Add Sub Material
                    </a>
                </div>

                @if ($material->sections->count())
                    <div class="sub-material-list">
                        @foreach ($material->sections->sortBy('sort_order') as $section)
                            <div class="sub-material-item">
                                <div class="sub-material-main">
                                    <div class="sub-material-top">
                                        <span class="sub-material-badge">
                                            {{ ucfirst($section->type) }}
                                        </span>

                                        @if ($section->code_language)
                                            <span class="sub-material-badge gold">
                                                {{ strtoupper($section->code_language) }}
                                            </span>
                                        @endif

                                        <span class="sub-material-badge muted">
                                            Sort {{ $section->sort_order }}
                                        </span>

                                        @if (!$section->is_published)
                                            <span class="sub-material-badge danger">
                                                Draft
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="sub-material-title">
                                        {{ $section->title }}
                                    </h3>

                                    @if ($section->body)
                                        <p class="sub-material-text">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($section->body), 120) }}
                                        </p>
                                    @elseif ($section->code)
                                        <p class="sub-material-text">
                                            Code block tersedia.
                                        </p>
                                    @elseif ($section->media_url)
                                        <p class="sub-material-text">
                                            Media: {{ \Illuminate\Support\Str::limit($section->media_url, 80) }}
                                        </p>
                                    @endif
                                </div>

                                <div class="sub-material-actions">
                                    <a href="{{ route('admin.material-sections.edit', $section) }}"
                                        class="sub-material-action">
                                        Edit
                                    </a>

                                    <button type="button" class="sub-material-action danger"
                                        onclick="deleteSubMaterial({{ $section->id }})">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="sub-material-empty">
                        Belum ada sub materi. Klik <strong>+ Add Sub Material</strong> untuk menambahkan konten pertama.
                    </div>
                @endif
            </div>
        @endif

        <div class="pub-form-actions">
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="{{ $selectedCourseId ? route('admin.materials.index', ['course_id' => $selectedCourseId]) : route('admin.materials.index') }}"
                    class="pub-btn secondary">
                    Cancel
                </a>

                @if ($material->exists && $material->course && Route::has('materials.show'))
                    <a href="{{ route('materials.show', [$material->course, $material]) }}" target="_blank"
                        rel="noopener" class="pub-btn secondary">
                        View Frontend
                    </a>
                @endif
            </div>

            <button type="submit" class="pub-btn">
                {{ $buttonText }}
            </button>
        </div>
    </form>
</div>

@if ($material->exists && $material->sections->count())
    @foreach ($material->sections as $section)
        <form id="delete-sub-material-{{ $section->id }}" method="POST"
            action="{{ route('admin.material-sections.destroy', $section) }}" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
@endif

<script>
    function deleteSubMaterial(sectionId) {
        if (!confirm('Hapus sub materi ini? Materi utama tidak akan ikut terhapus.')) {
            return;
        }

        const form = document.getElementById('delete-sub-material-' + sectionId);

        if (!form) {
            alert('Form delete sub materi tidak ditemukan.');
            return;
        }

        form.submit();
    }
</script>
