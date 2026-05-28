<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseMaterial;
use Illuminate\Http\Request;

class CourseMaterialController extends Controller
{
    public function index(Request $request)
    {
        $materials = CourseMaterial::query()
            ->with('course')
            ->withCount('sections')
            ->when($request->course_id, fn($q, $courseId) => $q->where('course_id', $courseId))
            ->when($request->q, function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('title_en', 'like', "%{$q}%")
                        ->orWhere('week_label', 'like', "%{$q}%")
                        ->orWhere('topic', 'like', "%{$q}%");
                });
            })
            ->when($request->status === 'published', fn($q) => $q->where('is_published', true))
            ->when($request->status === 'draft', fn($q) => $q->where('is_published', false))
            ->orderBy('course_id')
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $courses = Course::orderBy('sort_order')->orderBy('title')->get();

        return view('admin.materials.index', compact('materials', 'courses'));
    }

    public function create()
    {
        return view('admin.materials.create', [
            'material' => new CourseMaterial(),
            'courses' => Course::orderBy('sort_order')->orderBy('title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        $data['slug'] = CourseMaterial::uniqueSlug($data['title'], (int) $data['course_id']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        CourseMaterial::create($data);

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(CourseMaterial $material)
    {
        $material->load(['course', 'sections']);

        return view('admin.materials.edit', [
            'material' => $material,
            'courses' => Course::orderBy('sort_order')->orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, CourseMaterial $material)
    {
        $data = $this->validatedData($request);

        $data['slug'] = CourseMaterial::uniqueSlug($data['title'], (int) $data['course_id'], $material->id);
        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && ! $material->published_at) {
            $data['published_at'] = now();
        }

        if (! $data['is_published']) {
            $data['published_at'] = null;
        }

        $material->update($data);

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(CourseMaterial $material)
    {
        $material->sections()->delete();
        $material->delete();

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'title' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'week_label' => ['nullable', 'string', 'max:100'],
            'week_number' => ['nullable', 'integer', 'min:1'],
            'summary' => ['nullable', 'string'],
            'summary_en' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'material_type' => ['required', 'string', 'max:50'],
            'external_url' => ['nullable', 'url', 'max:255'],
            'file_path' => ['nullable', 'string', 'max:255'],
            'related_video_url' => ['nullable', 'url', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_title_en' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_description_en' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
