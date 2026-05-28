@extends('frontend.layouts.app')

@include('frontend.pages.courses._styles')

@php
    $locale = session('locale', app()->getLocale() ?: 'id');
    $locale = in_array($locale, ['id', 'en']) ? $locale : 'id';

    $copy = [
        'id' => [
            'kicker' => 'Course Materials',
            'title' => 'Materi pembelajaran akademik.',
            'lead' =>
                'Telusuri course dan materi kuliah yang disusun per topik, per minggu, dan sub materi agar proses belajar lebih nyaman.',
            'open' => 'Buka Course',
            'materials' => 'materi',
            'empty' => 'Belum ada course yang dipublikasikan.',
            'featured' => 'Featured',
        ],
        'en' => [
            'kicker' => 'Course Materials',
            'title' => 'Academic learning materials.',
            'lead' =>
                'Explore courses and lecture materials organized by topic, week, and sub-material for a more comfortable learning experience.',
            'open' => 'Open Course',
            'materials' => 'materials',
            'empty' => 'No published courses yet.',
            'featured' => 'Featured',
        ],
    ];

    $t = $copy[$locale];
@endphp

@section('title', $locale === 'en' ? 'Courses | Arvita Agus Kurniasari' : 'Belajar | Arvita Agus Kurniasari')
@section('meta_description', $locale === 'en' ? 'Academic course materials and learning resources by Arvita Agus
    Kurniasari.' : 'Materi kuliah dan sumber pembelajaran akademik Arvita Agus Kurniasari.')

@section('content')
    <div class="academic-page">
        <section class="academic-shell academic-hero">
            <p class="academic-kicker">{{ $t['kicker'] }}</p>

            <h1 class="academic-title">
                {{ $t['title'] }}
            </h1>

            <p class="academic-lead">
                {{ $t['lead'] }}
            </p>
        </section>

        <section class="academic-shell">
            @if ($courses->count())
                <div class="academic-grid">
                    @foreach ($courses as $course)
                        @php
                            $title = $locale === 'en' && filled($course->title_en) ? $course->title_en : $course->title;
                            $summary =
                                $locale === 'en' && filled($course->summary_en)
                                    ? $course->summary_en
                                    : $course->summary;
                        @endphp

                        <article class="academic-card">
                            <div class="academic-meta">
                                @if ($course->category)
                                    <span class="academic-chip gold">{{ $course->category }}</span>
                                @endif

                                <span class="academic-chip">
                                    {{ $course->materials_count ?? 0 }} {{ $t['materials'] }}
                                </span>

                                @if ($course->is_featured)
                                    <span class="academic-chip muted">{{ $t['featured'] }}</span>
                                @endif
                            </div>

                            <h2 class="academic-card-title">
                                {{ $title }}
                            </h2>

                            @if ($summary)
                                <p class="academic-card-text">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($summary), 170) }}
                                </p>
                            @endif

                            <div class="academic-actions">
                                <a href="{{ route('courses.show', $course) }}" class="academic-btn">
                                    {{ $t['open'] }}
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($courses->hasPages())
                    <div style="padding-bottom:78px;">
                        {{ $courses->onEachSide(1)->links('vendor.pagination.academic') }}
                    </div>
                @endif
            @else
                <div class="academic-empty">
                    {{ $t['empty'] }}
                </div>
            @endif
        </section>
    </div>
@endsection
