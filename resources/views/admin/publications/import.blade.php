@extends('admin.layouts.app')

@section('title', 'Import BibTeX - Admin Panel')

@section('content')
<style>
    .import-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
    }

    .import-title {
        margin: 0;
        color: #18382c;
        font-size: 32px;
        line-height: 1.1;
        letter-spacing: -0.035em;
        font-weight: 950;
    }

    .dark .import-title {
        color: #f6f1e8;
    }

    .import-subtitle {
        margin: 8px 0 0;
        color: #6b6258;
        font-size: 14px;
        font-weight: 650;
        max-width: 720px;
    }

    .dark .import-subtitle {
        color: rgba(215,206,192,.66);
    }

    .import-grid {
        display: grid;
        grid-template-columns: 1fr 0.72fr;
        gap: 20px;
    }

    .import-panel {
        background: #fff;
        border: 1px solid #e7ded1;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(31,41,51,.04);
        padding: 22px;
    }

    .dark .import-panel {
        background: rgba(255,255,255,.06);
        border-color: rgba(255,255,255,.1);
    }

    .import-label {
        display: block;
        margin-bottom: 8px;
        color: #17212b;
        font-size: 13px;
        font-weight: 950;
    }

    .dark .import-label {
        color: #f6f1e8;
    }

    .import-textarea,
    .import-select {
        width: 100%;
        border-radius: 13px;
        border: 1px solid #e7ded1;
        background: #fbfaf7;
        color: #17212b;
        padding: 12px 14px;
        font-size: 14px;
        font-weight: 650;
        outline: none;
    }

    .import-textarea {
        min-height: 430px;
        resize: vertical;
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
        line-height: 1.65;
    }

    .import-select {
        height: 44px;
    }

    .dark .import-textarea,
    .dark .import-select {
        border-color: rgba(255,255,255,.1);
        background: rgba(255,255,255,.06);
        color: #f6f1e8;
    }

    .import-error {
        margin-top: 8px;
        color: #b42318;
        font-size: 13px;
        font-weight: 800;
    }

    .import-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 18px;
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

    .guide-title {
        margin: 0 0 12px;
        color: #18382c;
        font-size: 20px;
        font-weight: 950;
    }

    .dark .guide-title {
        color: #f6f1e8;
    }

    .guide-list {
        margin: 0;
        padding-left: 18px;
        color: #6b6258;
        font-size: 14px;
        font-weight: 650;
        line-height: 1.9;
    }

    .dark .guide-list {
        color: rgba(215,206,192,.72);
    }

    .sample-box {
        margin-top: 18px;
        border-radius: 14px;
        background: #fbfaf7;
        border: 1px solid #e7ded1;
        padding: 14px;
        overflow-x: auto;
    }

    .dark .sample-box {
        background: rgba(255,255,255,.06);
        border-color: rgba(255,255,255,.1);
    }

    .sample-box pre {
        margin: 0;
        color: #4b5563;
        font-size: 12px;
        line-height: 1.65;
        white-space: pre-wrap;
    }

    .dark .sample-box pre {
        color: rgba(246,241,232,.76);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-top: 16px;
    }

    @media (max-width: 980px) {
        .import-grid,
        .form-row {
            grid-template-columns: 1fr;
        }

        .import-head {
            flex-direction: column;
        }
    }
</style>

<div class="import-head">
    <div>
        <h1 class="import-title">Import BibTeX</h1>
        <p class="import-subtitle">
            Paste data BibTeX dari Google Scholar. Sistem akan membaca title, author, year, journal/conference, volume, issue, pages, DOI, publisher, dan URL jika tersedia.
        </p>
    </div>

    <a href="{{ route('admin.publications.index') }}" class="btn-secondary">
        Back
    </a>
</div>

<div class="import-grid">
    <form method="POST" action="{{ route('admin.publications.import.store') }}" class="import-panel">
        @csrf

        <label for="bibtex" class="import-label">BibTeX Content *</label>
        <textarea
            id="bibtex"
            name="bibtex"
            class="import-textarea"
            required
            placeholder="@article{example2024,&#10;  title={Example Publication Title},&#10;  author={Author One and Author Two},&#10;  journal={Journal Name},&#10;  year={2024}&#10;}">{{ old('bibtex') }}</textarea>

        @error('bibtex')
            <div class="import-error">{{ $message }}</div>
        @enderror

        <div class="form-row">
            <div>
                <label for="default_status" class="import-label">Default Status</label>
                <select id="default_status" name="default_status" class="import-select">
                    <option value="published" @selected(old('default_status') === 'published')>Published</option>
                    <option value="draft" @selected(old('default_status') === 'draft')>Draft</option>
                </select>
            </div>

            <div>
                <label for="duplicate_strategy" class="import-label">Duplicate Strategy</label>
                <select id="duplicate_strategy" name="duplicate_strategy" class="import-select">
                    <option value="skip" @selected(old('duplicate_strategy') === 'skip')>Skip existing</option>
                    <option value="update" @selected(old('duplicate_strategy') === 'update')>Update existing</option>
                    <option value="create" @selected(old('duplicate_strategy') === 'create')>Always create new</option>
                </select>
            </div>
        </div>

        <div class="import-actions">
            <a href="{{ route('admin.publications.index') }}" class="btn-secondary">Cancel</a>
            <button type="submit" class="btn-primary">Import Publications</button>
        </div>
    </form>

    <aside class="import-panel">
        <h2 class="guide-title">Cara ambil BibTeX dari Google Scholar</h2>

        <ol class="guide-list">
            <li>Buka profil Google Scholar.</li>
            <li>Pilih salah satu publikasi.</li>
            <li>Klik ikon kutip/cite.</li>
            <li>Pilih BibTeX.</li>
            <li>Copy isi BibTeX.</li>
            <li>Paste ke form ini.</li>
            <li>Untuk banyak data, paste beberapa entry BibTeX sekaligus.</li>
        </ol>

        <div class="sample-box">
<pre>@article{kurniasari2024example,
  title={Example academic publication title},
  author={Kurniasari, Arvita Agus and Other Author},
  journal={Journal of Applied Informatics},
  volume={12},
  number={2},
  pages={100--110},
  year={2024},
  publisher={Example Publisher},
  doi={10.1234/example.doi},
  url={https://example.com/article}
}</pre>
        </div>

        <p class="import-subtitle" style="margin-top:18px;">
            Catatan: Google Scholar kadang tidak menyediakan DOI atau URL lengkap. Setelah import, data masih bisa diedit manual dari halaman Publications.
        </p>
    </aside>
</div>
@endsection