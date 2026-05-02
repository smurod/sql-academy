<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\Module;
use App\Models\Task;

class CourseController extends Controller
{
    public function index()
    {
        $modules = Module::with(['lessons' => function ($query) {
            $query->orderBy('lesson_order');
        }])->orderBy('order_index')->get();
        $completedLessons = [];

        if(auth()->check()){
            $completedLessons = LessonProgress::where('user_id', auth()->id())
                ->pluck('lesson_id')
                ->toArray();
        }
        return view('public.courses.index', compact('modules', 'completedLessons'));
    }

    public function show(Lesson $lesson)
    {
        $lesson->load(['module', 'course']);
        $module = $lesson->module;
        $moduleLessons = Lesson::where('module_id', $module->id)->orderBy('lesson_order')->get();

        $previousLesson = Lesson::where('module_id', $lesson->module_id)
            ->where('lesson_order', '<', $lesson->lesson_order)
            ->orderByDesc('lesson_order')
            ->first();

        $isCompleted = false;

        if (auth()->check()) {
            $isCompleted = LessonProgress::where('user_id', auth()->id())
                ->where('lesson_id', $lesson->id)
                ->exists();
        }

        if (!$previousLesson) {
            $prevModule = Module::where('course_id', $lesson->course_id)
                ->where('order_index', '<', $module->order_index)
                ->orderByDesc('order_index')
                ->first();

            if ($prevModule) {
                $previousLesson = Lesson::where('module_id', $prevModule->id)
                    ->orderByDesc('lesson_order')
                    ->first();
            }
        }

        $nextLesson = Lesson::where('module_id', $lesson->module_id)
            ->where('lesson_order', '>', $lesson->lesson_order)
            ->orderBy('lesson_order')
            ->first();

        if (!$nextLesson) {
            $nextModule = Module::where('course_id', $lesson->course_id)
                ->where('order_index', '>', $module->order_index)
                ->orderBy('order_index')
                ->first();

            if ($nextModule) {
                $nextLesson = Lesson::where('module_id', $nextModule->id)
                    ->orderBy('lesson_order')
                    ->first();
            }
        }

        $lessonTasks = $lesson->tasks()->orderBy('task_order')->get();
        $taskSchemas = [];

        foreach ($lessonTasks as $task) {
            $taskSchemas[$task->id] = app(\App\Http\Controllers\Public\TaskController::class)
                ->getErdSchemaForTask($task);
        }

        return view('public.courses.show', compact(
            'lesson',
            'module',
            'moduleLessons',
            'previousLesson',
            'nextLesson',
            'isCompleted',
            'lessonTasks',
            'taskSchemas'
        ));
    }
}
