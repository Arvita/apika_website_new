@extends('admin.layouts.app')

@section('title', 'Add Course - Admin Panel')

@section('content')
@include('admin.courses._form', [
    'course' => $course,
    'formTitle' => 'Add Course',
    'formSubtitle' => 'Tambahkan course utama seperti Pemrograman Dasar, OOP, Microsoft Office, atau learning path lainnya.',
    'action' => route('admin.courses.store'),
    'method' => 'POST',
    'buttonText' => 'Save Course',
])
@endsection