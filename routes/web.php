<?php

use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\LessonProgressController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TaskAttemptController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\Public\TaskController as PublicTaskController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Public\MainController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SqlSandboxController;
use App\Http\Controllers\Public\CourseController as PublicCourseController;

// Главная
Route::get('/', function () {
    return view('public.home');
});

// Тренажёр
Route::get('/tasks', function () {
    return view('public.tasks.index');
});

Route::get('/tasks/{id}', function ($id) {
    return view('public.tasks.show', ['id' => $id]);
});

// Курс
Route::get('/course', function () {
    return view('public.courses.index');
});

// Песочница
Route::get('/sandbox', function () {
    return view('public.sandbox');
});

// Собеседования
Route::get('/interviews', function () {
    return view('public.interviews');
});





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


Route::get('auth/{provider}', [SocialController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('modules', ModuleController::class);
    Route::resource('courses', AdminCourseController::class);
    //Route::resource('tasks', AdminTaskController::class);
    Route::resource('lessons-progress', LessonProgressController::class);
    Route::resource('modules.lessons', AdminLessonController::class)
        ->only(['index', 'create', 'store']);
    Route::resource('lessons', AdminLessonController::class)->except(['index']);

    Route::get('/dashboard', function () {
        return view('admin.home');
    })->middleware(['auth', 'verified'])->name('dashboard');

});

//Route::get('/sandbox', [SqlSandboxController::class, 'form']);
//Route::post('/sandbox', [SqlSandboxController::class, 'execute']);


Route::get('/public/courses', [PublicCourseController::class, 'index'])->name('public.courses.index');
Route::get('/public/courses/grid-view', [PublicCourseController::class, 'gridView'])->name('public.courses.grid-view');

Route::get('/public/home', [MainController::class, 'index'])->name('public.home');
require __DIR__.'/auth.php';
Route::prefix('public')->group(function () {
    Route::get('/tasks', [PublicTaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/{task}', [PublicTaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks/{task}/check', [PublicTaskController::class, 'check'])->name('tasks.check');
    Route::post('/tasks/{task}/run', [PublicTaskController::class, 'run'])->name('tasks.run');

});
