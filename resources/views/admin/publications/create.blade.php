@extends('admin.layouts.app')

@section('title', 'Add Publication - Admin Panel')

@section('content')
    @include('admin.publications._form', [
        'publication' => $publication,
        'formTitle' => 'Add Publication',
        'formSubtitle' => 'Tambahkan data publikasi akademik baru.',
        'action' => route('admin.publications.store'),
        'method' => 'POST',
        'buttonText' => 'Save Publication',
    ])
@endsection