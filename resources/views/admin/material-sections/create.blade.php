@extends('admin.layouts.app')

@section('title', 'Add Sub Material - Admin Panel')

@section('content')
@include('admin.material-sections._form', [
    'section' => $section,
    'materials' => $materials,
    'selectedMaterialId' => $selectedMaterialId ?? request('material_id'),
    'formTitle' => 'Add Sub Material',
    'formSubtitle' => 'Tambahkan sub materi seperti konten, heading, code block, gambar, video, link, atau file ke dalam materi utama.',
    'action' => route('admin.material-sections.store'),
    'method' => 'POST',
    'buttonText' => 'Save Sub Material',
])
@endsection