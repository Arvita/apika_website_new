@extends('admin.layouts.app')

@section('title', 'Edit Publication - Admin Panel')

@section('content')
    @include('admin.publications._form', [
        'publication' => $publication,
        'formTitle' => 'Edit Publication',
        'formSubtitle' => 'Perbarui data publikasi akademik.',
        'action' => route('admin.publications.update', $publication),
        'method' => 'PUT',
        'buttonText' => 'Update Publication',
    ])
@endsection