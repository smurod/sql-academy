<?php

use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\LessonProgressController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SqlSandboxController;
use App\Http\Controllers\Admin\TaskAttemptController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Public\CourseController as PublicCourseController;
use App\Http\Controllers\Public\MainController;
use App\Http\Controllers\Public\TaskController as PublicTaskController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/public/home');

Route::get('/interviews', function () {
    return view('public.interviews');
});

Route::get('/test', function () {
    return view('test');
});
Route::get('/preview', function () {
    return view('admin.preview');
});

Route::get('/app', function () {
    return view('admin.layouts.app');
});


Route::get('auth/{provider}', [SocialController::class, 'redirectToProvider'])
    ->name('social.redirect');

Route::get('auth/{provider}/callback', [SocialController::class, 'handleProviderCallback'])
    ->name('social.callback');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('public')->group(function () {
    Route::get('/home', [MainController::class, 'index'])->name('public.home');

    Route::get('/course', [PublicCourseController::class, 'index'])->name('public.courses.index');
    Route::get('/course/{lesson}', [PublicCourseController::class, 'show'])->name('public.courses.show');

    Route::get('/tasks', [PublicTaskController::class, 'index'])->name('public.tasks.index');
    Route::get('/tasks/{task}', [PublicTaskController::class, 'show'])->name('public.tasks.show');

    Route::controller(SqlSandboxController::class)
        ->prefix('sandbox')
        ->name('sandbox.')
        ->group(function () {
            Route::get('/', 'form')->name('form');
            Route::post('/', 'execute')->middleware('auth')->name('execute');
        });

    Route::middleware(['auth', 'permission:solve tasks'])->group(function () {
        Route::post('/tasks/{task}/check', [PublicTaskController::class, 'check'])->name('public.tasks.check');
        Route::post('/tasks/{task}/run', [PublicTaskController::class, 'run'])->name('public.tasks.run');
    });
});


Route::post('/tasks/{task}/attempt', [TaskAttemptController::class, 'store'])
    ->middleware(['auth', 'permission:solve tasks'])
    ->name('tasks.attempt');


Route::get('/admin', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'role:admin']);

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.home');
        })->name('dashboard');

        Route::resource('modules', ModuleController::class);
        Route::resource('courses', AdminCourseController::class);
        Route::resource('tasks', AdminTaskController::class);
        Route::resource('lessons-progress', LessonProgressController::class);

        Route::resource('modules.lessons', AdminLessonController::class)
            ->only(['index', 'create', 'store']);

        Route::resource('lessons', AdminLessonController::class)->except(['index']);
    });

require __DIR__.'/auth.php';
