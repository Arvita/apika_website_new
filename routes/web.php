<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PublicationController;
use App\Models\Publication;
use App\Http\Controllers\Admin\VideoController;
use App\Models\Video;
use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\CourseMaterialSection;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseMaterialController;
use App\Http\Controllers\Admin\CourseMaterialSectionController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('frontend.pages.home');
})->name('home');

Route::view('/about', 'frontend.pages.about')->name('about');
Route::view('/research', 'frontend.pages.research')->name('research');
Route::get('/courses', function () {
    $courses = Course::published()
        ->withCount(['publishedMaterials as materials_count'])
        ->orderByDesc('is_featured')
        ->orderBy('sort_order')
        ->latest()
        ->paginate(9);

    return view('frontend.pages.courses.index', compact('courses'));
})->name('courses.index');

Route::get('/courses/{course:slug}', function (Course $course) {
    abort_unless($course->is_published, 404);

    $course->load(['publishedMaterials']);

    return view('frontend.pages.courses.show', compact('course'));
})->name('courses.show');
Route::match(['GET', 'POST'], '/course-section-files/{section}/preview', function (CourseMaterialSection $section) {
    $section->loadMissing('material.course');

    abort_unless($section->is_published, 404);
    abort_unless($section->material && $section->material->is_published, 404);
    abort_unless($section->material->course && $section->material->course->is_published, 404);
    abort_if(blank($section->media_url), 404);

    $path = ltrim($section->media_url, '/');

    abort_unless(Storage::exists($path), 404);

    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $fullPath = Storage::path($path);
    $content = Storage::get($path);

    $allowedBasePath = realpath(storage_path('app/course-section-files'));
    $realFullPath = realpath($fullPath);

    abort_unless($allowedBasePath && $realFullPath, 404);
    abort_unless(Str::startsWith($realFullPath, $allowedBasePath), 403);

    $downloadName = Str::slug($section->title ?: 'course-file') . '.' . $extension;

    if (in_array($extension, ['html', 'htm'], true)) {
        return response($content, 200)
            ->header('Content-Type', 'text/html; charset=UTF-8')
            ->header('X-Content-Type-Options', 'nosniff');
    }

    if ($extension === 'php') {
        $previousDirectory = getcwd();

        ob_start();

        try {
            chdir(dirname($realFullPath));

            include $realFullPath;

            $output = ob_get_clean();

            return response($output, 200)
                ->header('Content-Type', 'text/html; charset=UTF-8')
                ->header('X-Content-Type-Options', 'nosniff');
        } catch (\Throwable $e) {
            if (ob_get_level() > 0) {
                ob_end_clean();
            }

            report($e);

            return response(
                '<!doctype html>
                <html lang="id">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <style>
                        body {
                            margin: 0;
                            min-height: 100vh;
                            display: grid;
                            place-items: center;
                            background: #fbfaf7;
                            color: #18382c;
                            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
                            padding: 32px;
                        }
                        .box {
                            max-width: 720px;
                            padding: 28px;
                            border: 1px solid #e7ded1;
                            border-radius: 22px;
                            background: #fff;
                            box-shadow: 0 12px 30px rgba(31,41,51,.06);
                        }
                        h1 {
                            margin: 0 0 10px;
                            font-size: 24px;
                        }
                        p {
                            margin: 0;
                            line-height: 1.7;
                            color: #6b6258;
                            font-weight: 600;
                        }
                        code {
                            display: inline-block;
                            margin-top: 12px;
                            padding: 8px 10px;
                            border-radius: 10px;
                            background: #f6f1e8;
                            color: #9a761c;
                        }
                    </style>
                </head>
                <body>
                    <div class="box">
                        <h1>File PHP gagal dijalankan</h1>
                        <p>Ada error pada file PHP yang diupload. Cek syntax file atau lihat log Laravel.</p>
                        <code>' . e($e->getMessage()) . '</code>
                    </div>
                </body>
                </html>',
                500
            )->header('Content-Type', 'text/html; charset=UTF-8');
        } finally {
            if ($previousDirectory) {
                chdir($previousDirectory);
            }
        }
    }

    if ($extension === 'pdf') {
        return response($content, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $downloadName . '"')
            ->header('X-Content-Type-Options', 'nosniff');
    }

    return Storage::download($path, $downloadName);
})->name('course-section-files.preview');

Route::get('/courses/{course:slug}/{material:slug}', function (Course $course, CourseMaterial $material) {
    abort_unless($course->is_published, 404);
    abort_unless($material->course_id === $course->id && $material->is_published, 404);

    $material->load(['course', 'publishedSections']);

    $previousMaterial = CourseMaterial::published()
        ->where('course_id', $course->id)
        ->where('sort_order', '<', $material->sort_order)
        ->orderByDesc('sort_order')
        ->first();

    $nextMaterial = CourseMaterial::published()
        ->where('course_id', $course->id)
        ->where('sort_order', '>', $material->sort_order)
        ->orderBy('sort_order')
        ->first();

    return view('frontend.pages.courses.material', compact(
        'course',
        'material',
        'previousMaterial',
        'nextMaterial'
    ));
})->name('materials.show');
Route::get('/publications', function () {
    $publications = Publication::published()
        ->orderByDesc('year')
        ->orderBy('sort_order')
        ->latest()
        ->paginate(9);

    return view('frontend.pages.publications.index', compact('publications'));
})->name('publications.index');
Route::get('/videos', function () {
    $videos = Video::published()
        ->orderByDesc('is_featured')
        ->orderBy('sort_order')
        ->latest()
        ->paginate(9);

    return view('frontend.pages.videos', compact('videos'));
})->name('videos.index');
Route::view('/portfolio', 'frontend.pages.portfolio')->name('portfolio.index');
Route::view('/supervisions', 'frontend.pages.supervisions')->name('supervisions.index');
Route::view('/contact', 'frontend.pages.contact')->name('contact');
Route::get('/language/{locale}', function (Request $request, string $locale) {
    if (! in_array($locale, ['id', 'en'], true)) {
        abort(404);
    }

    session(['locale' => $locale]);
    app()->setLocale($locale);

    $request->session()->save();

    $redirectUrl = $request->query('redirect') ?: route('home');

    return redirect()
        ->to($redirectUrl)
        ->withCookie(cookie()->forever('locale', $locale));
})->name('language.switch');
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', function () {
            $publicationCount = Publication::count();

            return view('admin.dashboard', compact('publicationCount'));
        })->name('dashboard');
        Route::get('publications/import', [PublicationController::class, 'importForm'])
            ->name('publications.import');

        Route::post('publications/import', [PublicationController::class, 'importBibtex'])
            ->name('publications.import.store');
        Route::resource('publications', PublicationController::class)->except(['show']);
        Route::resource('videos', VideoController::class)->except(['show']);
        Route::post('videos/sync-youtube', [VideoController::class, 'syncYoutube'])
            ->name('videos.sync-youtube');
        Route::resource('courses', CourseController::class)->except(['show']);
        Route::resource('materials', CourseMaterialController::class)->except(['show']);
        Route::resource('material-sections', CourseMaterialSectionController::class)->except(['show']);
    });



require __DIR__ . '/auth.php';
