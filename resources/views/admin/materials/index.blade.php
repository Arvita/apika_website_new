@extends('admin.layouts.app')

@section('title', 'Materials - Admin Panel')

@section('content')
<style>
    .pub-head{display:flex;align-items:flex-start;justify-content:space-between;gap:20px;margin-bottom:22px}
    .pub-title{margin:0;color:#18382c;font-size:32px;line-height:1.1;letter-spacing:-.035em;font-weight:950}
    .dark .pub-title{color:#f6f1e8}
    .pub-subtitle{margin:8px 0 0;color:#6b6258;font-size:14px;font-weight:650}
    .dark .pub-subtitle{color:rgba(215,206,192,.66)}
    .pub-btn{display:inline-flex;align-items:center;justify-content:center;min-height:42px;padding:0 18px;border-radius:13px;background:#4f6f52;color:#fff;text-decoration:none;font-size:14px;font-weight:900;border:0;cursor:pointer}
    .pub-btn:hover{background:#18382c}
    .pub-btn.secondary{background:#fff;color:#18382c;border:1px solid #e7ded1}
    .dark .pub-btn.secondary{background:rgba(255,255,255,.06);color:#f6f1e8;border-color:rgba(255,255,255,.1)}
    .pub-panel{background:#fff;border:1px solid #e7ded1;border-radius:18px;box-shadow:0 8px 24px rgba(31,41,51,.04)}
    .dark .pub-panel{background:rgba(255,255,255,.06);border-color:rgba(255,255,255,.1)}
    .pub-filter{display:grid;grid-template-columns:1fr 220px 160px auto;gap:12px;padding:18px;margin-bottom:18px}
    .pub-input,.pub-select{width:100%;height:42px;border-radius:12px;border:1px solid #e7ded1;background:#fbfaf7;color:#17212b;padding:0 13px;font-size:14px;font-weight:650;outline:none}
    .pub-input:focus,.pub-select:focus{border-color:#4f6f52;box-shadow:0 0 0 3px rgba(79,111,82,.12)}
    .dark .pub-input,.dark .pub-select{border-color:rgba(255,255,255,.1);background:rgba(255,255,255,.06);color:#f6f1e8}
    .pub-table-wrap{overflow-x:auto}
    .pub-table{width:100%;border-collapse:collapse;text-align:left}
    .pub-table th{padding:14px 18px;background:#fbfaf7;color:#4b5563;font-size:12px;font-weight:950;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #eee8de;white-space:nowrap}
    .dark .pub-table th{background:rgba(255,255,255,.05);color:rgba(215,206,192,.6);border-bottom-color:rgba(255,255,255,.1)}
    .pub-table td{padding:16px 18px;border-bottom:1px solid #eee8de;vertical-align:top}
    .dark .pub-table td{border-bottom-color:rgba(255,255,255,.1)}
    .pub-name{margin:0;color:#17212b;font-size:14px;font-weight:950;line-height:1.45}
    .dark .pub-name{color:#f6f1e8}
    .pub-meta{margin-top:5px;color:#6b6258;font-size:13px;font-weight:650;line-height:1.45}
    .dark .pub-meta{color:rgba(215,206,192,.65)}
    .pub-badge{display:inline-flex;align-items:center;min-height:26px;padding:0 10px;border-radius:999px;font-size:12px;font-weight:900;background:#eef3e8;color:#4f6f52;white-space:nowrap}
    .pub-badge.gold{background:#fbf4e7;color:#9a761c}
    .pub-badge.gray{background:#f1f1ef;color:#6b6258}
    .dark .pub-badge{background:rgba(79,111,82,.22);color:#dbe8d4}
    .dark .pub-badge.gold{background:rgba(154,118,28,.22);color:#f3d998}
    .dark .pub-badge.gray{background:rgba(255,255,255,.08);color:rgba(215,206,192,.72)}
    .pub-actions{display:flex;align-items:center;justify-content:flex-end;gap:8px;flex-wrap:wrap}
    .pub-action{display:inline-flex;align-items:center;justify-content:center;min-height:34px;padding:0 12px;border-radius:10px;border:1px solid #e7ded1;background:#fff;color:#17212b;text-decoration:none;font-size:12px;font-weight:900;cursor:pointer}
    .pub-action:hover{background:#fbfaf7}
    .pub-action.danger{color:#b42318}
    .dark .pub-action{border-color:rgba(255,255,255,.1);background:rgba(255,255,255,.06);color:#f6f1e8}
    .dark .pub-action.danger{color:#fca5a5}
    .pub-empty{padding:44px 20px;text-align:center;color:#6b6258;font-size:14px;font-weight:650}
    .dark .pub-empty{color:rgba(215,206,192,.66)}
    @media(max-width:900px){.pub-head{flex-direction:column}.pub-filter{grid-template-columns:1fr}}
</style>

<div class="pub-head">
    <div>
        <h1 class="pub-title">Materials</h1>
        <p class="pub-subtitle">
            Kelola materi per course, termasuk minggu/pertemuan, konten utama, dan sub materi.
        </p>
    </div>

    <a href="{{ route('admin.materials.create') }}" class="pub-btn">
        + Add Material
    </a>
</div>

@if (session('success'))
    <div class="pub-panel" style="padding:14px 18px;margin-bottom:18px;color:#4f6f52;font-size:14px;font-weight:850;">
        {{ session('success') }}
    </div>
@endif

<form method="GET" action="{{ route('admin.materials.index') }}" class="pub-panel pub-filter">
    <input
        type="search"
        name="q"
        value="{{ request('q') }}"
        class="pub-input"
        placeholder="Search material..."
    >

    <select name="course_id" class="pub-select">
        <option value="">All Courses</option>
        @foreach ($courses as $course)
            <option value="{{ $course->id }}" @selected((string) request('course_id') === (string) $course->id)>
                {{ $course->title }}
            </option>
        @endforeach
    </select>

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
                    <th>Material</th>
                    <th>Course</th>
                    <th>Week</th>
                    <th>Sections</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($materials as $material)
                    <tr>
                        <td style="min-width:340px;">
                            <p class="pub-name">{{ $material->title }}</p>

                            @if ($material->title_en)
                                <div class="pub-meta">{{ $material->title_en }}</div>
                            @endif

                            @if ($material->summary)
                                <div class="pub-meta" style="max-width:620px;">
                                    {{ \Illuminate\Support\Str::limit($material->summary, 150) }}
                                </div>
                            @endif

                            <div class="pub-meta">Slug: {{ $material->slug }}</div>
                        </td>

                        <td>
                            <span class="pub-badge gold">
                                {{ $material->course?->title ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <span class="pub-badge gray">
                                {{ $material->week_label ?: 'Material' }}
                            </span>
                        </td>

                        <td>
                            <span class="pub-badge">
                                {{ $material->sections_count ?? 0 }} sections
                            </span>
                        </td>

                        <td>
                            @if ($material->is_published)
                                <span class="pub-badge">Published</span>
                            @else
                                <span class="pub-badge gray">Draft</span>
                            @endif
                        </td>

                        <td>
                            <div class="pub-actions">
                                @if ($material->course && Route::has('materials.show'))
                                    <a href="{{ route('materials.show', [$material->course, $material]) }}" target="_blank" rel="noopener" class="pub-action">
                                        View
                                    </a>
                                @endif

                                <a href="{{ route('admin.material-sections.create', ['material_id' => $material->id]) }}" class="pub-action">
                                    + Section
                                </a>

                                <a href="{{ route('admin.materials.edit', $material) }}" class="pub-action">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.materials.destroy', $material) }}" onsubmit="return confirm('Hapus materi ini? Sub materi di dalamnya juga ikut terhapus.')">
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
                                Belum ada materi. Klik Add Material untuk menambahkan data pertama.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($materials->hasPages())
        <div style="padding:16px 18px;">
            {{ $materials->onEachSide(1)->links() }}
        </div>
    @endif
</div>
@endsection