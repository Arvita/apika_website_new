@php
    $selectedMaterialId = old(
        'course_material_id',
        $selectedMaterialId ?? ($section->course_material_id ?? request('material_id')),
    );
    $currentMethod = $method ?? 'POST';

    $selectedMaterial = $materials->firstWhere('id', (int) $selectedMaterialId);
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
        min-height: 190px;
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

    .pub-context {
        margin-bottom: 18px;
        padding: 14px 16px;
        border-radius: 16px;
        background: #fbf4e7;
        color: #6b4a1f;
        font-size: 13px;
        line-height: 1.6;
        font-weight: 750;
    }

    .dark .pub-context {
        background: rgba(154, 118, 28, .16);
        color: #f3d998;
    }

    @media (max-width: 900px) {
        .pub-form-head {
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
    }
</style>

<div class="pub-form-head">
    <div>
        <h1 class="pub-form-title">{{ $formTitle }}</h1>
        <p class="pub-form-subtitle">{{ $formSubtitle }}</p>
    </div>

    <a href="{{ $selectedMaterialId ? route('admin.materials.edit', $selectedMaterialId) : route('admin.materials.index') }}"
        class="pub-btn secondary">
        Back
    </a>
</div>

@if ($selectedMaterial)
    <div class="pub-context">
        Sub materi ini akan masuk ke materi:
        <strong>{{ $selectedMaterial->course?->title ?? 'Course' }} / {{ $selectedMaterial->title }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="pub-alert">
        <strong>Form belum valid.</strong>
        <div>Periksa kembali field yang bertanda error.</div>
    </div>
@endif

<div class="pub-panel">
    <form method="POST" action="{{ $action }}" class="pub-form" enctype="multipart/form-data">
        @csrf

        @if ($currentMethod !== 'POST')
            @method($currentMethod)
        @endif

        <div class="pub-section">
            <h2 class="pub-section-title">Basic Information</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="course_material_id" class="pub-label">Material *</label>
                    <select id="course_material_id" name="course_material_id" required class="pub-select">
                        <option value="">Pilih Material</option>

                        @foreach ($materials as $materialOption)
                            <option value="{{ $materialOption->id }}" @selected((string) $selectedMaterialId === (string) $materialOption->id)>
                                {{ $materialOption->course?->title ?? 'Course' }} — {{ $materialOption->title }}
                            </option>
                        @endforeach
                    </select>

                    @error('course_material_id')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="type" class="pub-label">Section Type *</label>
                    <select id="type" name="type" required class="pub-select">
                        @foreach ([
        'content' => 'Content',
        'heading' => 'Heading',
        'code' => 'Code',
        'callout' => 'Callout',
        'image' => 'Image',
        'video' => 'Video',
        'embed' => 'Embed',
        'quiz' => 'Quiz',
        'file' => 'File',
        'link' => 'Link',
        'slide' => 'Slide / Demo File',
    ] as $value => $label)
                            <option value="{{ $value }}" @selected(old('type', $section->type ?: 'content') === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    @error('type')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-grid" style="margin-top:16px;">
                <div class="pub-field">
                    <label for="title" class="pub-label">Title ID *</label>
                    <input id="title" name="title" type="text" required
                        value="{{ old('title', $section->title) }}" class="pub-input"
                        placeholder="Pengantar File Handling">

                    @error('title')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="title_en" class="pub-label">Title English</label>
                    <input id="title_en" name="title_en" type="text"
                        value="{{ old('title_en', $section->title_en) }}" class="pub-input"
                        placeholder="Introduction to File Handling">

                    @error('title_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-grid" style="margin-top:16px;">
                <div class="pub-field">
                    <label for="sort_order" class="pub-label">Sort Order</label>
                    <input id="sort_order" name="sort_order" type="number" min="0"
                        value="{{ old('sort_order', $section->sort_order ?? 0) }}" class="pub-input">

                    @error('sort_order')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="code_language" class="pub-label">Code Language</label>
                    <input id="code_language" name="code_language" type="text"
                        value="{{ old('code_language', $section->code_language) }}" class="pub-input"
                        placeholder="php, javascript, html, css">

                    <div class="pub-help">Isi hanya kalau type = code.</div>

                    @error('code_language')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">Body Content</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="body" class="pub-label">Body ID</label>
                    <textarea id="body" name="body" class="pub-textarea tall"
                        placeholder="Isi sub materi dalam Bahasa Indonesia...">{{ old('body', $section->body) }}</textarea>

                    @error('body')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="body_en" class="pub-label">Body English</label>
                    <textarea id="body_en" name="body_en" class="pub-textarea tall" placeholder="English sub material content...">{{ old('body_en', $section->body_en) }}</textarea>

                    @error('body_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">Code / Media / Link</h2>

            <div class="pub-field">
                <label for="code" class="pub-label">Code</label>
                <textarea id="code" name="code" class="pub-textarea tall" placeholder="$file = fopen('data.txt', 'r');">{{ old('code', $section->code) }}</textarea>

                @error('code')
                    <div class="pub-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="pub-grid" style="margin-top:16px;">
                <div class="pub-field">
                    <label for="media_url" class="pub-label">Media URL</label>
                    <input id="media_url" name="media_url" type="text"
                        value="{{ old('media_url', $section->media_url) }}" class="pub-input"
                        placeholder="Image URL, YouTube embed URL, file URL...">

                    @error('media_url')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="button_label" class="pub-label">Button Label</label>
                    <input id="button_label" name="button_label" type="text"
                        value="{{ old('button_label', $section->button_label) }}" class="pub-input"
                        placeholder="Download Materi">

                    @error('button_label')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-grid" style="margin-top:16px;">
                <div class="pub-field">
                    <label for="media_url" class="pub-label">Media URL</label>
                    <input id="media_url" name="media_url" type="text"
                        value="{{ old('media_url', $section->media_url) }}" class="pub-input"
                        placeholder="Image URL, YouTube embed URL, file URL...">

                    @error('media_url')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field full" style="margin-top:16px;">
                    <label for="demo_file" class="pub-label">Upload Slide / Demo File</label>

                    <input id="demo_file" name="demo_file" type="file" accept=".html,.htm,.php,.pdf,.ppt,.pptx"
                        class="pub-input" style="padding-top:9px;">

                    <div class="pub-help">
                        Upload file HTML, PHP static, PDF, PPT, atau PPTX. Untuk contoh seperti minggu-9.php, pilih type
                        <strong>Slide / Demo File</strong>.
                        File PHP yang berisi tag aktif &lt;?php tidak akan dijalankan demi keamanan.
                    </div>

                    @if ($section->media_url)
                        <div class="pub-help">
                            File saat ini:
                            <strong>{{ basename($section->media_url) }}</strong>
                        </div>
                    @endif

                    @error('demo_file')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="button_label" class="pub-label">Button Label</label>
                    <input id="button_label" name="button_label" type="text"
                        value="{{ old('button_label', $section->button_label) }}" class="pub-input"
                        placeholder="Open resource">

                    @error('button_label')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-field" style="margin-top:16px;">
                <label for="button_url" class="pub-label">Button URL</label>
                <input id="button_url" name="button_url" type="text"
                    value="{{ old('button_url', $section->button_url) }}" class="pub-input"
                    placeholder="https://...">

                @error('button_url')
                    <div class="pub-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">Publishing</h2>

            <div class="pub-check-grid">
                <label class="pub-check">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $section->exists ? $section->is_published : true))>
                    Published
                </label>
            </div>
        </div>

        <div class="pub-form-actions">
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="{{ $selectedMaterialId ? route('admin.materials.edit', $selectedMaterialId) : route('admin.materials.index') }}"
                    class="pub-btn secondary">
                    Cancel
                </a>

                @if ($section->exists && $section->material && $section->material->course && Route::has('materials.show'))
                    <a href="{{ route('materials.show', [$section->material->course, $section->material]) }}"
                        target="_blank" rel="noopener" class="pub-btn secondary">
                        View Material
                    </a>
                @endif
            </div>

            <button type="submit" class="pub-btn">
                {{ $buttonText }}
            </button>
        </div>
    </form>
</div>
