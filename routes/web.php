<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonProgressController;


Route::resource('lesson-progress', LessonProgressController::class);
Route::resource('lesson-progress', LessonProgressController::class);
Route::resource('lessons', LessonController::class);
Route::get('/', function () {
    return view('public.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/app', function () {
    return view('public.layouts.app');
});

Route::get('/admin', function () {
    return view('admin.layouts.app');
});


Route::get('auth/{provider}', [SocialController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [SocialController::class, 'handleProviderCallback']);



require __DIR__.'/auth.php';
