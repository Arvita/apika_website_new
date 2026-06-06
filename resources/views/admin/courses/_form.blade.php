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
        max-width: 720px;
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
    }

    .pub-btn.secondary {
        background: #fff;
        color: #18382c;
        border: 1px solid #e7ded1;
    }

    .pub-btn.secondary:hover {
        background: #fbfaf7;
    }

    .dark .pub-btn.secondary {
        background: rgba(255, 255, 255, .06);
        color: #f6f1e8;
        border-color: rgba(255, 255, 255, .1);
    }

    .dark .pub-btn.secondary:hover {
        background: rgba(255, 255, 255, .1);
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

    <a href="{{ route('admin.courses.index') }}" class="pub-btn secondary">
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

        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="pub-section">
            <h2 class="pub-section-title">Basic Information</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="title" class="pub-label">Title ID *</label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        required
                        value="{{ old('title', $course->title) }}"
                        class="pub-input"
                        placeholder="Pemrograman Dasar"
                    >
                    @error('title')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="title_en" class="pub-label">Title English</label>
                    <input
                        id="title_en"
                        name="title_en"
                        type="text"
                        value="{{ old('title_en', $course->title_en) }}"
                        class="pub-input"
                        placeholder="Basic Programming"
                    >
                    @error('title_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-grid three" style="margin-top:16px;">
                <div class="pub-field">
                    <label for="category" class="pub-label">Category</label>
                    <input
                        id="category"
                        name="category"
                        type="text"
                        value="{{ old('category', $course->category) }}"
                        class="pub-input"
                        placeholder="Programming"
                    >
                    @error('category')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="level" class="pub-label">Level</label>
                    <input
                        id="level"
                        name="level"
                        type="text"
                        value="{{ old('level', $course->level) }}"
                        class="pub-input"
                        placeholder="Beginner"
                    >
                    @error('level')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="sort_order" class="pub-label">Sort Order</label>
                    <input
                        id="sort_order"
                        name="sort_order"
                        type="number"
                        min="0"
                        value="{{ old('sort_order', $course->sort_order ?? 0) }}"
                        class="pub-input"
                    >
                    @error('sort_order')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-field" style="margin-top:16px;">
                <label for="cover_image" class="pub-label">Cover Image URL / Path</label>
                <input
                    id="cover_image"
                    name="cover_image"
                    type="text"
                    value="{{ old('cover_image', $course->cover_image) }}"
                    class="pub-input"
                    placeholder="/storage/courses/pemrograman-dasar.jpg"
                >
                <div class="pub-help">Boleh kosong dulu. Nanti bisa dihubungkan ke media library.</div>
                @error('cover_image')
                    <div class="pub-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">Summary</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="summary" class="pub-label">Summary ID</label>
                    <textarea
                        id="summary"
                        name="summary"
                        class="pub-textarea"
                        placeholder="Ringkasan singkat course..."
                    >{{ old('summary', $course->summary) }}</textarea>
                    @error('summary')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="summary_en" class="pub-label">Summary English</label>
                    <textarea
                        id="summary_en"
                        name="summary_en"
                        class="pub-textarea"
                        placeholder="Short course summary..."
                    >{{ old('summary_en', $course->summary_en) }}</textarea>
                    @error('summary_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">Course Intro</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="intro" class="pub-label">Intro ID</label>
                    <textarea
                        id="intro"
                        name="intro"
                        class="pub-textarea tall"
                        placeholder="Intro 300–500 kata untuk halaman course..."
                    >{{ old('intro', $course->intro) }}</textarea>
                    @error('intro')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="intro_en" class="pub-label">Intro English</label>
                    <textarea
                        id="intro_en"
                        name="intro_en"
                        class="pub-textarea tall"
                        placeholder="English course intro..."
                    >{{ old('intro_en', $course->intro_en) }}</textarea>
                    @error('intro_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">Learning Objectives</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="learning_objectives" class="pub-label">Learning Objectives ID</label>
                    <textarea
                        id="learning_objectives"
                        name="learning_objectives"
                        class="pub-textarea"
                        placeholder="- Memahami konsep dasar algoritma&#10;- Mampu membuat program sederhana"
                    >{{ old('learning_objectives', $course->learning_objectives) }}</textarea>
                    <div class="pub-help">Gunakan baris baru untuk tiap tujuan pembelajaran.</div>
                    @error('learning_objectives')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="learning_objectives_en" class="pub-label">Learning Objectives English</label>
                    <textarea
                        id="learning_objectives_en"
                        name="learning_objectives_en"
                        class="pub-textarea"
                        placeholder="- Understand basic algorithm concepts&#10;- Build simple programs"
                    >{{ old('learning_objectives_en', $course->learning_objectives_en) }}</textarea>
                    @error('learning_objectives_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="pub-section">
            <h2 class="pub-section-title">SEO</h2>

            <div class="pub-grid">
                <div class="pub-field">
                    <label for="meta_title" class="pub-label">Meta Title ID</label>
                    <input
                        id="meta_title"
                        name="meta_title"
                        type="text"
                        value="{{ old('meta_title', $course->meta_title) }}"
                        class="pub-input"
                    >
                    @error('meta_title')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="meta_title_en" class="pub-label">Meta Title English</label>
                    <input
                        id="meta_title_en"
                        name="meta_title_en"
                        type="text"
                        value="{{ old('meta_title_en', $course->meta_title_en) }}"
                        class="pub-input"
                    >
                    @error('meta_title_en')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="pub-grid" style="margin-top:16px;">
                <div class="pub-field">
                    <label for="meta_description" class="pub-label">Meta Description ID</label>
                    <textarea
                        id="meta_description"
                        name="meta_description"
                        class="pub-textarea"
                    >{{ old('meta_description', $course->meta_description) }}</textarea>
                    @error('meta_description')
                        <div class="pub-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pub-field">
                    <label for="meta_description_en" class="pub-label">Meta Description English</label>
                    <textarea
                        id="meta_description_en"
                        name="meta_description_en"
                        class="pub-textarea"
                    >{{ old('meta_description_en', $course->meta_description_en) }}</textarea>
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
                    <input
                        type="checkbox"
                        name="is_published"
                        value="1"
                        @checked(old('is_published', $course->exists ? $course->is_published : true))
                    >
                    Published
                </label>

                <label class="pub-check">
                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        @checked(old('is_featured', $course->is_featured ?? false))
                    >
                    Featured
                </label>
            </div>
        </div>

        <div class="pub-form-actions">
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="{{ route('admin.courses.index') }}" class="pub-btn secondary">
                    Cancel
                </a>

                @if ($course->exists && Route::has('admin.materials.index'))
                    <a href="{{ route('admin.materials.index', ['course_id' => $course->id]) }}" class="pub-btn secondary">
                        Manage Materials
                    </a>
                @endif
            </div>

            <button type="submit" class="pub-btn">
                {{ $buttonText }}
            </button>
        </div>
    </form>
</div>