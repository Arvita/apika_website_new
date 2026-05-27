<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.pages.home');
})->name('home');

Route::view('/about', 'frontend.pages.about')->name('about');
Route::view('/research', 'frontend.pages.research')->name('research');
Route::view('/courses', 'frontend.pages.courses')->name('courses.index');
Route::view('/publications', 'frontend.pages.publications')->name('publications.index');
Route::view('/videos', 'frontend.pages.videos')->name('videos.index');
Route::view('/portfolio', 'frontend.pages.portfolio')->name('portfolio.index');
Route::view('/supervisions', 'frontend.pages.supervisions')->name('supervisions.index');
Route::view('/contact', 'frontend.pages.contact')->name('contact');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');
});

require __DIR__.'/auth.php';