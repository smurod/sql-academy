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


Route::get('/tasks/{id}', function ($id) {
    return view('public.tasks.show', ['id' => $id]);
});


Route::get('test', function () {
    return view('test');
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
    Route::resource('tasks', AdminTaskController::class);
    Route::resource('lessons-progress', LessonProgressController::class);
    Route::resource('modules.lessons', AdminLessonController::class)
        ->only(['index', 'create', 'store']);
    Route::resource('lessons', AdminLessonController::class)->except(['index']);

    Route::get('/dashboard', function () {
        return view('admin.home');
    })->middleware(['auth', 'verified'])->name('dashboard');

});


Route::prefix('public')->group(function () {
    Route::get('/tasks', [PublicTaskController::class, 'index'])->name('public.tasks.index');
    Route::get('/tasks/{task}', [PublicTaskController::class, 'show'])->name('public.tasks.show');
    Route::post('/tasks/{task}/check', [PublicTaskController::class, 'check'])->name('public.tasks.check');
    Route::post('/tasks/{task}/run', [PublicTaskController::class, 'run'])->name('public.tasks.run');
    Route::get('/course', [PublicCourseController::class, 'index'])->name('public.courses.index');
    Route::get('/course/{lesson}', [PublicCourseController::class, 'show'])->name('public.courses.show');
    Route::get('/home', [MainController::class, 'index'])->name('public.home');
    Route::controller(SqlSandboxController::class)
        ->prefix('sandbox')
        ->name('sandbox.')
        ->group(function () {
            Route::get('/', 'form')->name('form');
            Route::post('/', 'execute')->name('execute');
        });

});


require __DIR__.'/auth.php';
