<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskAnswerController;
use App\Http\Controllers\TaskAttemptController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonProgressController;



Route::resource('lessons-progress', LessonProgressController::class);
Route::resource('lessons', LessonController::class);
Route::get('/', function () {
    return view('public.home');
});

Route::get('/dashboard', function () {
    return view('admin.home');
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

// попытки
Route::post('/tasks/{task}/attempt',
    [TaskAttemptController::class, 'store']
)->middleware('auth')->name('tasks.attempt');

// админ ответы
Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    Route::resource('task-answers', TaskAnswerController::class);
});

Route::get('auth/{provider}', [SocialController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
Route::resource('courses', CourseController::class);
Route::resource('/tasks', TaskController::class);


require __DIR__.'/auth.php';
