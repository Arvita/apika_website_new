@extends('admin.layouts.app')

@section('title', 'Add Video - Admin Panel')

@section('content')
    @include('admin.videos._form', [
        'video' => $video,
        'formTitle' => 'Add Video',
        'formSubtitle' => 'Tambahkan video YouTube baru untuk halaman pembelajaran.',
        'action' => route('admin.videos.store'),
        'method' => 'POST',
        'buttonText' => 'Save Video',
    ])
@endsection