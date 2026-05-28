@extends('frontend.layouts.app')

@include('frontend.pages.courses._styles')

@php
    $locale = session('locale', app()->getLocale() ?: 'id');
    $locale = in_array($locale, ['id', 'en']) ? $locale : 'id';

    $courseTitle = $locale === 'en' && filled($course->title_en) ? $course->title_en : $course->title;
    $title = $locale === 'en' && filled($material->title_en) ? $material->title_en : $material->title;
    $summary = $locale === 'en' && filled($material->summary_en) ? $material->summary_en : $material->summary;
    $content = $locale === 'en' && filled($material->content_en) ? $material->content_en : $material->content;

    $metaTitle = $locale === 'en' && filled($material->meta_title_en)
        ? $material->meta_title_en
        : ($material->meta_title ?: $title);

    $metaDescription = $locale === 'en' && filled($material->meta_description_en)
        ? $material->meta_description_en
        : ($material->meta_description ?: ($summary ?: 'Detail materi pembelajaran.'));

    $copy = [
        'id' => [
            'backCourses' => 'Belajar',
            'backCourse' => 'Kembali ke Course',
            'material' => 'Materi',
            'overview' => 'Overview',
            'content' => 'Isi Materi',
            'sections' => 'Sub Materi',
            'previous' => 'Sebelumnya',
            'next' => 'Berikutnya',
            'openLink' => 'Buka Link',
            'relatedVideo' => 'Video Terkait',
            'noSections' => 'Sub materi belum tersedia.',
        ],
        'en' => [
            'backCourses' => 'Courses',
            'backCourse' => 'Back to Course',
            'material' => 'Material',
            'overview' => 'Overview',
            'content' => 'Material Content',
            'sections' => 'Sub Materials',
            'previous' => 'Previous',
            'next' => 'Next',
            'openLink' => 'Open Link',
            'relatedVideo' => 'Related Video',
            'noSections' => 'No sub materials available yet.',
        ],
    ];

    $t = $copy[$locale];
@endphp

@section('title', $metaTitle . ' | ' . $courseTitle)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($metaDescription), 155))

@section('content')
<div class="academic-page">
    <section class="academic-shell academic-hero">
        <div class="academic-breadcrumb">
            <a href="{{ route('courses.index') }}">{{ $t['backCourses'] }}</a>
            <span>/</span>
            <a href="{{ route('courses.show', $course) }}">{{ $courseTitle }}</a>
            <span>/</span>
            <span>{{ $title }}</span>
        </div>

        <p class="academic-kicker">
            {{ $material->week_label ?: $t['material'] }}
        </p>

        <h1 class="academic-title">
            {{ $title }}
        </h1>

        @if ($summary)
            <p class="academic-lead">
                {{ $summary }}
            </p>
        @endif

        <div class="academic-actions">
            <a href="{{ route('courses.show', $course) }}" class="academic-btn secondary">
                ← {{ $t['backCourse'] }}
            </a>

            @if ($material->related_video_url)
                <a href="{{ $material->related_video_url }}" target="_blank" rel="noopener" class="academic-btn">
                    {{ $t['relatedVideo'] }}
                </a>
            @endif
        </div>
    </section>

    <section class="academic-shell" style="padding:20px 0 78px;">
        <main class="academic-panel academic-main">
            <section style="margin-bottom:30px;">
                <div class="academic-meta">
                    <span class="academic-chip">
                        {{ $material->week_label ?: $t['material'] }}
                    </span>

                    @if ($material->material_type)
                        <span class="academic-chip gold">
                            {{ ucfirst($material->material_type) }}
                        </span>
                    @endif

                    @if ($material->week_number)
                        <span class="academic-chip muted">
                            Week {{ $material->week_number }}
                        </span>
                    @endif
                </div>

                <h2 class="academic-section-title" style="margin-top:18px;">
                    {{ $t['overview'] }}
                </h2>

                @if ($summary)
                    <div class="academic-readable" style="margin-top:16px;">
                        {{ $summary }}
                    </div>
                @endif
            </section>

            @if ($content)
                <section style="margin-bottom:30px;">
                    <h2 class="academic-section-title">
                        {{ $t['content'] }}
                    </h2>

                    <div class="academic-readable" style="margin-top:16px;">
                        {!! nl2br(e($content)) !!}
                    </div>
                </section>
            @endif

            <section>
                <h2 class="academic-section-title">
                    {{ $t['sections'] }}
                </h2>

                @if ($material->publishedSections->count())
                    <div class="academic-list">
                        @foreach ($material->publishedSections as $section)
                            @php
                                $sectionTitle = $locale === 'en' && filled($section->title_en) ? $section->title_en : $section->title;
                                $sectionBody = $locale === 'en' && filled($section->body_en) ? $section->body_en : $section->body;
                            @endphp

                            <article class="academic-list-item">
                                <div class="academic-meta">
                                    <span class="academic-chip">
                                        {{ ucfirst($section->type) }}
                                    </span>

                                    @if ($section->code_language)
                                        <span class="academic-chip gold">
                                            {{ strtoupper($section->code_language) }}
                                        </span>
                                    @endif
                                </div>

                                <h3 class="academic-list-title">
                                    {{ $sectionTitle }}
                                </h3>

                                @if ($sectionBody)
                                    <div class="academic-readable" style="margin-top:14px;">
                                        {!! nl2br(e($sectionBody)) !!}
                                    </div>
                                @endif

                                @if ($section->type === 'code' && $section->code)
                                    <pre class="reader-code"><code>{{ $section->code }}</code></pre>
                                @endif

                                @if ($section->type === 'image' && $section->media_url)
                                    <img src="{{ $section->media_url }}" alt="{{ $sectionTitle }}" class="reader-image">
                                @endif

                                @if ($section->type === 'video' && $section->media_url)
                                    <div class="reader-embed">
                                        <iframe src="{{ $section->media_url }}" allowfullscreen loading="lazy"></iframe>
                                    </div>
                                @endif

                                @if ($section->button_url)
                                    <div class="academic-actions">
                                        <a href="{{ $section->button_url }}" target="_blank" rel="noopener" class="academic-btn">
                                            {{ $section->button_label ?: $t['openLink'] }}
                                        </a>
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="academic-empty" style="margin-top:18px;margin-bottom:0;">
                        {{ $t['noSections'] }}
                    </div>
                @endif
            </section>

            <nav class="reader-nav">
                <div>
                    @if ($previousMaterial)
                        @php
                            $prevTitle = $locale === 'en' && filled($previousMaterial->title_en) ? $previousMaterial->title_en : $previousMaterial->title;
                        @endphp

                        <a href="{{ route('materials.show', [$course, $previousMaterial]) }}" class="academic-btn secondary">
                            ← {{ $t['previous'] }}: {{ $prevTitle }}
                        </a>
                    @endif
                </div>

                <div>
                    @if ($nextMaterial)
                        @php
                            $nextTitle = $locale === 'en' && filled($nextMaterial->title_en) ? $nextMaterial->title_en : $nextMaterial->title;
                        @endphp

                        <a href="{{ route('materials.show', [$course, $nextMaterial]) }}" class="academic-btn">
                            {{ $t['next'] }}: {{ $nextTitle }} →
                        </a>
                    @endif
                </div>
            </nav>
        </main>
    </section>
</div>
@endsection