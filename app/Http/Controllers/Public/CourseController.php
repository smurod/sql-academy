<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Module;

class CourseController extends Controller
{
    public function index()
    {
        $modules = Module::with(['lessons' => function ($query) {
            $query->orderBy('lesson_order');
        }])->orderBy('order_index')->get();
        return view('public.courses.index', compact('modules'));
    }

    public function show(Lesson $lesson)
    {
        $lesson->load(['module', 'course']);
        $module = $lesson->module;
        $moduleLessons = Lesson::where('module_id', $module->id)->orderBy('lesson_order')->get();
        $previousLesson = Lesson::where('module_id', $lesson->module_id)->where('lesson_order', '<', $lesson->lesson_order)->orderByDesc('lesson_order')->first();
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

        // Если нет следующего в текущем модуле — берём первый урок следующего модуля
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

        return view('public.courses.show', compact(
            'lesson',
            'module',
            'moduleLessons',
            'previousLesson',
            'nextLesson'
        ));
    }
}
