@extends('admin.layouts.app')

@section('title', 'Edit Video - Admin Panel')

@section('content')
    @include('admin.videos._form', [
        'video' => $video,
        'formTitle' => 'Edit Video',
        'formSubtitle' => 'Perbarui data video YouTube.',
        'action' => route('admin.videos.update', $video),
        'method' => 'PUT',
        'buttonText' => 'Update Video',
    ])
@endsection