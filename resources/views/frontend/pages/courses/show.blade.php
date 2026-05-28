@extends('frontend.layouts.app')

@include('frontend.pages.courses._styles')

@php
    $locale = session('locale', app()->getLocale() ?: 'id');
    $locale = in_array($locale, ['id', 'en']) ? $locale : 'id';

    $title = $locale === 'en' && filled($course->title_en) ? $course->title_en : $course->title;
    $summary = $locale === 'en' && filled($course->summary_en) ? $course->summary_en : $course->summary;
    $intro = $locale === 'en' && filled($course->intro_en) ? $course->intro_en : $course->intro;

    $metaTitle = $locale === 'en' && filled($course->meta_title_en)
        ? $course->meta_title_en
        : ($course->meta_title ?: $title);

    $metaDescription = $locale === 'en' && filled($course->meta_description_en)
        ? $course->meta_description_en
        : ($course->meta_description ?: ($summary ?: 'Materi course akademik.'));

    $copy = [
        'id' => [
            'kicker' => 'Course',
            'back' => 'Kembali ke Belajar',
            'intro' => 'Pengantar',
            'materials' => 'Daftar Materi',
            'material' => 'Materi',
            'open' => 'Buka Materi',
            'empty' => 'Belum ada materi untuk course ini.',
            'fallbackIntro' => 'Course ini disusun sebagai ruang belajar terstruktur. Materi dapat dibaca per minggu atau per topik, lalu dilanjutkan ke sub materi yang lebih detail.',
        ],
        'en' => [
            'kicker' => 'Course',
            'back' => 'Back to Courses',
            'intro' => 'Introduction',
            'materials' => 'Materials',
            'material' => 'Material',
            'open' => 'Open Material',
            'empty' => 'No materials available for this course yet.',
            'fallbackIntro' => 'This course is designed as a structured learning space. Materials can be read by week or topic, then continued into more detailed sub-materials.',
        ],
    ];

    $t = $copy[$locale];
@endphp

@section('title', $metaTitle . ' | Arvita Agus Kurniasari')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($metaDescription), 155))

@section('content')
<div class="academic-page">
    <section class="academic-shell academic-hero">
        <div class="academic-breadcrumb">
            <a href="{{ route('courses.index') }}">{{ $locale === 'en' ? 'Courses' : 'Belajar' }}</a>
            <span>/</span>
            <span>{{ $title }}</span>
        </div>

        <p class="academic-kicker">{{ $t['kicker'] }}</p>

        <h1 class="academic-title">
            {{ $title }}
        </h1>

        @if ($summary)
            <p class="academic-lead">
                {{ $summary }}
            </p>
        @endif

        <div class="academic-actions">
            <a href="{{ route('courses.index') }}" class="academic-btn secondary">
                ← {{ $t['back'] }}
            </a>
        </div>
    </section>

    <section class="academic-shell" style="padding:20px 0 78px;">
        <main class="academic-panel academic-main">
            <section style="margin-bottom:30px;">
                <h2 class="academic-section-title">
                    {{ $t['intro'] }}
                </h2>

                <div class="academic-readable" style="margin-top:16px;">
                    @if ($intro)
                        {!! nl2br(e($intro)) !!}
                    @else
                        {{ $t['fallbackIntro'] }}
                    @endif
                </div>
            </section>

            <section>
                <h2 class="academic-section-title">
                    {{ $t['materials'] }}
                </h2>

                @if ($course->publishedMaterials->count())
                    <div class="academic-list">
                        @foreach ($course->publishedMaterials as $material)
                            @php
                                $materialTitle = $locale === 'en' && filled($material->title_en) ? $material->title_en : $material->title;
                                $materialSummary = $locale === 'en' && filled($material->summary_en) ? $material->summary_en : $material->summary;
                            @endphp

                            <article class="academic-list-item">
                                <div class="academic-meta">
                                    <span class="academic-chip">
                                        {{ $material->week_label ?: $t['material'] }}
                                    </span>

                                    @if ($material->material_type)
                                        <span class="academic-chip gold">
                                            {{ ucfirst($material->material_type) }}
                                        </span>
                                    @endif
                                </div>

                                <h3 class="academic-list-title">
                                    {{ $materialTitle }}
                                </h3>

                                @if ($materialSummary)
                                    <p class="academic-list-text">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($materialSummary), 170) }}
                                    </p>
                                @endif

                                <div class="academic-actions">
                                    <a href="{{ route('materials.show', [$course, $material]) }}" class="academic-btn">
                                        {{ $t['open'] }}
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="academic-empty" style="margin-top:18px;margin-bottom:0;">
                        {{ $t['empty'] }}
                    </div>
                @endif
            </section>
        </main>
    </section>
</div>
@endsection