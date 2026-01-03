<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskAttemptController;
use App\Http\Controllers\LessonProgressController;
use App\Http\Controllers\TaskAnswerController;



Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::get('/courses', [CourseController::class, 'index'])
    ->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

Route::get('auth/{provider}', [SocialController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [SocialController::class, 'handleProviderCallback']);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/lessons/{lesson}', [LessonController::class, 'show'])
        ->name('lessons.show');
    Route::post('/lessons/{lesson}/complete', [LessonProgressController::class, 'store'])
        ->name('lessons.complete');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])
        ->name('tasks.show');
    Route::post('/tasks/{task}/attempt', [TaskAttemptController::class, 'store'])
        ->name('tasks.attempt');
});


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.home');
        })->name('dashboard');
        Route::resource('courses', CourseController::class);
        Route::resource('lessons', LessonController::class);
        Route::resource('tasks', TaskController::class);
        Route::resource('task-answers', TaskAnswerController::class);

    });

require __DIR__.'/auth.php';
