<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PublicationController;
use App\Models\Publication;
use App\Http\Controllers\Admin\VideoController;
use App\Models\Video;

Route::get('/', function () {
    return view('frontend.pages.home');
})->name('home');

Route::view('/about', 'frontend.pages.about')->name('about');
Route::view('/research', 'frontend.pages.research')->name('research');
Route::view('/courses', 'frontend.pages.courses')->name('courses.index');
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
    if (! in_array($locale, ['id', 'en'])) {
        abort(404);
    }

    session(['locale' => $locale]);

    return back();
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
    });



require __DIR__ . '/auth.php';
