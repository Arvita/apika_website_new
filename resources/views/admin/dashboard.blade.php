@extends('admin.layouts.app')

@section('title', 'Admin Dashboard | Arvita Agus Kurniasari')
@section('page_title', 'Dashboard')

@section('content')
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach ([
            ['title' => 'Courses', 'desc' => 'Kelola course dan materi mingguan.'],
            ['title' => 'Publications', 'desc' => 'Kelola jurnal, DOI, SINTA, Scholar, Scopus.'],
            ['title' => 'Videos', 'desc' => 'Kelola video pembelajaran dan playlist.'],
            ['title' => 'Portfolio', 'desc' => 'Kelola project dan karya akademik.'],
            ['title' => 'Bimbinganku', 'desc' => 'Kelola data mahasiswa bimbingan.'],
            ['title' => 'Academic Links', 'desc' => 'Kelola link profil akademik.'],
        ] as $item)
            <div class="rounded-[1.5rem] border border-[#e3d8c8] bg-[#fffaf2] p-5 shadow-sm">
                <p class="text-lg font-black">{{ $item['title'] }}</p>
                <p class="mt-2 text-sm leading-6 text-[#6b6258]">
                    {{ $item['desc'] }}
                </p>
            </div>
        @endforeach
    </div>
@endsection