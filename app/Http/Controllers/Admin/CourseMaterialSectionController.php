<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseMaterial;
use App\Models\CourseMaterialSection;
use Illuminate\Http\Request;

class CourseMaterialSectionController extends Controller
{
    public function create(Request $request)
    {
        return view('admin.material-sections.create', [
            'section' => new CourseMaterialSection(),
            'materials' => CourseMaterial::with('course')
                ->orderBy('course_id')
                ->orderBy('sort_order')
                ->get(),
            'selectedMaterialId' => $request->material_id,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['is_published'] = $request->boolean('is_published');

        CourseMaterialSection::create($data);

        return redirect()
            ->route('admin.materials.edit', $data['course_material_id'])
            ->with('success', 'Sub materi berhasil ditambahkan.');
    }

    public function edit(CourseMaterialSection $material_section)
    {
        return view('admin.material-sections.edit', [
            'section' => $material_section,
            'materials' => CourseMaterial::with('course')
                ->orderBy('course_id')
                ->orderBy('sort_order')
                ->get(),
            'selectedMaterialId' => $material_section->course_material_id,
        ]);
    }

    public function update(Request $request, CourseMaterialSection $material_section)
    {
        $data = $this->validatedData($request);
        $data['is_published'] = $request->boolean('is_published');

        $material_section->update($data);

        return redirect()
            ->route('admin.materials.edit', $data['course_material_id'])
            ->with('success', 'Sub materi berhasil diperbarui.');
    }

    public function destroy(CourseMaterialSection $material_section)
    {
        $materialId = $material_section->course_material_id;

        $material_section->delete();

        return redirect()
            ->route('admin.materials.edit', $materialId)
            ->with('success', 'Sub materi berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'course_material_id' => ['required', 'exists:course_materials,id'],
            'title' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:50'],
            'body' => ['nullable', 'string'],
            'body_en' => ['nullable', 'string'],
            'code' => ['nullable', 'string'],
            'code_language' => ['nullable', 'string', 'max:50'],
            'media_url' => ['nullable', 'string', 'max:255'],
            'button_label' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}