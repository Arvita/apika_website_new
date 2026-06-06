<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseMaterial;
use App\Models\CourseMaterialSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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

        if ($request->hasFile('demo_file')) {
            $data['media_url'] = $this->storeDemoFile($request);

            if (! in_array($data['type'] ?? null, ['slide', 'file', 'embed'], true)) {
                $data['type'] = 'slide';
            }
        }

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

        if ($request->hasFile('demo_file')) {
            $oldPath = $material_section->media_url;

            if ($oldPath && Str::startsWith($oldPath, 'course-section-files/') && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }

            $data['media_url'] = $this->storeDemoFile($request);

            if (! in_array($data['type'] ?? null, ['slide', 'file', 'embed'], true)) {
                $data['type'] = 'slide';
            }
        }

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
        $data = $request->validate([
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
            'demo_file' => ['nullable', 'file', 'max:10240'],
        ]);

        unset($data['demo_file']);

        return $data;
    }
    private function storeDemoFile(Request $request): string
    {
        $file = $request->file('demo_file');

        $extension = strtolower($file->getClientOriginalExtension());

        $allowedExtensions = [
            'html',
            'htm',
            'php',
            'pdf',
            'ppt',
            'pptx',
        ];

        if (! in_array($extension, $allowedExtensions, true)) {
            throw ValidationException::withMessages([
                'demo_file' => 'File harus berformat HTML, PHP static, PDF, PPT, atau PPTX.',
            ]);
        }

        $fileName = (string) Str::uuid() . '.' . $extension;

        return $file->storeAs('course-section-files', $fileName);
    }
}
