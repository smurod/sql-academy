<?php

use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\LessonProgressController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TaskAttemptController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Public\MainController;
use App\Http\Controllers\TaskAnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\CourseController as PublicCourseController;



Route::redirect('/', '/public/home');


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
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('courses', AdminCourseController::class);
    Route::resource('/tasks', TaskController::class);
    Route::resource('lessons-progress', LessonProgressController::class);
    Route::resource('courses.lessons', AdminLessonController::class)
        ->only(['index', 'create', 'store']);
    Route::resource('lessons', AdminLessonController::class)->except(['index']);

    Route::get('/dashboard', function () {
        return view('admin.home');
    })->middleware(['auth', 'verified'])->name('dashboard');

});

Route::get('/public/courses', [PublicCourseController::class, 'index'])->name('public.courses.index');
Route::get('/public/courses/grid-view', [PublicCourseController::class, 'gridView'])->name('public.courses.grid-view');

Route::get('/public/home', [MainController::class, 'index'])->name('public.home');
require __DIR__.'/auth.php';
