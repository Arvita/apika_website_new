@extends('frontend.layouts.app')

@include('frontend.pages.courses._styles')

@php
    $locale = session('locale', app()->getLocale() ?: 'id');
    $locale = in_array($locale, ['id', 'en']) ? $locale : 'id';

    $courseTitle = $locale === 'en' && filled($course->title_en) ? $course->title_en : $course->title;
    $title = $locale === 'en' && filled($material->title_en) ? $material->title_en : $material->title;
    $summary = $locale === 'en' && filled($material->summary_en) ? $material->summary_en : $material->summary;
    $content = $locale === 'en' && filled($material->content_en) ? $material->content_en : $material->content;

    $metaTitle =
        $locale === 'en' && filled($material->meta_title_en)
            ? $material->meta_title_en
            : ($material->meta_title ?: $title);

    $metaDescription =
        $locale === 'en' && filled($material->meta_description_en)
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
            'items' => 'bagian',
            'openPreview' => 'Buka Preview Penuh',
            'openFile' => 'Buka File',
            'fileAvailable' => 'File materi tersedia untuk dibuka atau diunduh.',
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
            'items' => 'items',
            'openPreview' => 'Open Full Preview',
            'openFile' => 'Open File',
            'fileAvailable' => 'The learning file is available to open or download.',
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

                <section class="submaterial-section">
                    @php
                        $sectionCount = $material->publishedSections->count();
                    @endphp

                    <div class="submaterial-title-row">
                        <div>
                            <p class="submaterial-kicker">
                                {{ $t['material'] }}
                            </p>

                            <h2 class="academic-section-title">
                                {{ $t['sections'] }}
                            </h2>
                        </div>

                        @if ($sectionCount)
                            <span class="submaterial-count">
                                {{ $sectionCount }} {{ $t['items'] }}
                            </span>
                        @endif
                    </div>

                    @if ($sectionCount)
                        <div class="submaterial-list">
                            @foreach ($material->publishedSections as $section)
                                @php
                                    $sectionTitle =
                                        $locale === 'en' && filled($section->title_en)
                                            ? $section->title_en
                                            : $section->title;

                                    $sectionBody =
                                        $locale === 'en' && filled($section->body_en)
                                            ? $section->body_en
                                            : $section->body;

                                    $sectionType = $section->type ?: 'text';

                                    $codeLanguage = $section->code_language
                                        ? strtoupper($section->code_language)
                                        : 'CODE';

                                    $fileExtension = strtolower(pathinfo($section->media_url ?? '', PATHINFO_EXTENSION));

                                    $isUploadedFile =
                                        $section->media_url &&
                                        ! preg_match('/^https?:\/\//', $section->media_url);

                                    $isPreviewableFile =
                                        $isUploadedFile &&
                                        in_array($fileExtension, ['html', 'htm', 'php', 'pdf'], true);
                                @endphp

                                <article class="submaterial-card">
                                    <div class="submaterial-card-head">
                                        <div class="submaterial-number">
                                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                        </div>

                                        <div class="submaterial-head-content">
                                            <div class="academic-meta">
                                                <span class="academic-chip">
                                                    {{ ucfirst($sectionType) }}
                                                </span>

                                                @if ($section->code_language)
                                                    <span class="academic-chip gold">
                                                        {{ strtoupper($section->code_language) }}
                                                    </span>
                                                @endif
                                            </div>

                                            <h3 class="submaterial-heading">
                                                {{ $sectionTitle }}
                                            </h3>
                                        </div>
                                    </div>

                                    @if ($sectionBody)
                                        <div class="submaterial-body">
                                            {!! nl2br(e($sectionBody)) !!}
                                        </div>
                                    @endif

                                    @if ($sectionType === 'code' && $section->code)
                                        <div class="submaterial-code-box">
                                            <div class="submaterial-code-top">
                                                <span>{{ $codeLanguage }}</span>
                                            </div>

                                            <pre class="submaterial-code"><code>{{ $section->code }}</code></pre>
                                        </div>
                                    @endif

                                    @if ($sectionType === 'image' && $section->media_url)
                                        <img
                                            src="{{ $section->media_url }}"
                                            alt="{{ $sectionTitle }}"
                                            class="reader-image"
                                        >
                                    @endif

                                    @if ($sectionType === 'video' && $section->media_url)
                                        <div class="reader-embed">
                                            <iframe
                                                src="{{ $section->media_url }}"
                                                allowfullscreen
                                                loading="lazy"
                                            ></iframe>
                                        </div>
                                    @endif

                                    @if ($section->media_url && ! in_array($sectionType, ['image', 'video'], true))
                                        @if ($isPreviewableFile)
                                            <div class="reader-demo-frame">
                                                <iframe
                                                    src="{{ route('course-section-files.preview', $section) }}"
                                                    loading="lazy"
                                                    sandbox="allow-scripts allow-forms allow-popups"
                                                ></iframe>
                                            </div>

                                            <div class="academic-actions reader-section-actions">
                                                <a
                                                    href="{{ route('course-section-files.preview', $section) }}"
                                                    target="_blank"
                                                    rel="noopener"
                                                    class="academic-btn"
                                                >
                                                    {{ $t['openPreview'] }}
                                                </a>
                                            </div>
                                        @else
                                            <div class="reader-file-card">
                                                <div>
                                                    <strong>{{ strtoupper($fileExtension ?: 'FILE') }}</strong>
                                                    <p>{{ $t['fileAvailable'] }}</p>
                                                </div>

                                                <a
                                                    href="{{ $isUploadedFile ? route('course-section-files.preview', $section) : $section->media_url }}"
                                                    target="_blank"
                                                    rel="noopener"
                                                    class="academic-btn"
                                                >
                                                    {{ $t['openFile'] }}
                                                </a>
                                            </div>
                                        @endif
                                    @endif

                                    @if ($section->button_url)
                                        <div class="submaterial-actions">
                                            <a
                                                href="{{ $section->button_url }}"
                                                target="_blank"
                                                rel="noopener"
                                                class="academic-btn"
                                            >
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
                                $prevTitle =
                                    $locale === 'en' && filled($previousMaterial->title_en)
                                        ? $previousMaterial->title_en
                                        : $previousMaterial->title;
                            @endphp

                            <a
                                href="{{ route('materials.show', [$course, $previousMaterial]) }}"
                                class="academic-btn secondary"
                            >
                                ← {{ $t['previous'] }}: {{ $prevTitle }}
                            </a>
                        @endif
                    </div>

                    <div>
                        @if ($nextMaterial)
                            @php
                                $nextTitle =
                                    $locale === 'en' && filled($nextMaterial->title_en)
                                        ? $nextMaterial->title_en
                                        : $nextMaterial->title;
                            @endphp

                            <a
                                href="{{ route('materials.show', [$course, $nextMaterial]) }}"
                                class="academic-btn"
                            >
                                {{ $t['next'] }}: {{ $nextTitle }} →
                            </a>
                        @endif
                    </div>
                </nav>
            </main>
        </section>
    </div>
@endsection