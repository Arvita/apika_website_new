@extends('admin.layouts.app')

@section('title', 'Edit Sub Material - Admin Panel')

@section('content')
@include('admin.material-sections._form', [
    'section' => $section,
    'materials' => $materials,
    'selectedMaterialId' => $selectedMaterialId ?? $section->course_material_id,
    'formTitle' => 'Edit Sub Material',
    'formSubtitle' => 'Perbarui sub materi, konten bilingual, code block, media, link, dan urutan tampil.',
    'action' => route('admin.material-sections.update', $section),
    'method' => 'PUT',
    'buttonText' => 'Update Sub Material',
])
@endsection