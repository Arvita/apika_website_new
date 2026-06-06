@extends('admin.layouts.app')

@section('title', 'Edit Course - Admin Panel')

@section('content')
@include('admin.courses._form', [
    'course' => $course,
    'formTitle' => 'Edit Course',
    'formSubtitle' => 'Perbarui informasi course, bilingual content, dan SEO metadata.',
    'action' => route('admin.courses.update', $course),
    'method' => 'PUT',
    'buttonText' => 'Update Course',
])
@endsection