@extends('admin.layouts.app')

@section('title', 'Add Material - Admin Panel')

@section('content')
@include('admin.materials._form', [
    'material' => $material,
    'courses' => $courses,
    'formTitle' => 'Add Material',
    'formSubtitle' => 'Tambahkan materi untuk course tertentu. Sub materi bisa ditambahkan setelah materi dibuat.',
    'action' => route('admin.materials.store'),
    'method' => 'POST',
    'buttonText' => 'Save Material',
])
@endsection