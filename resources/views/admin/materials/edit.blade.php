@extends('admin.layouts.app')

@section('title', 'Edit Material - Admin Panel')

@section('content')
@include('admin.materials._form', [
    'material' => $material,
    'courses' => $courses,
    'formTitle' => 'Edit Material',
    'formSubtitle' => 'Perbarui materi, konten bilingual, SEO, dan kelola sub materi.',
    'action' => route('admin.materials.update', $material),
    'method' => 'PUT',
    'buttonText' => 'Update Material',
])
@endsection