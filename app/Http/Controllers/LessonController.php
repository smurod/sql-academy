<?php

namespace App\Http\Controllers;
use App\Models\Course;

use App\Models\Lesson;
use App\Models\TaskAttempt;
use Illuminate\Http\Request;

class LessonController extends Controller
{

    public function index()
    {
        $lessons = Lesson::all();
        return view('admin.lessons.index', compact('lessons'));
    }


    public function create()
    {
        $courses = Course::all();
        $lessons = Lesson::all();
        return view('admin.lessons.create', compact('lessons', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'nullable|string',
        ]);

        Lesson::create($request->all());

        return redirect()->route('lessons.index')
            ->with('success', 'Урок успешно добавлен');
    }


    public function show(Lesson $lesson){
        return view('admin.lessons.show', compact('lesson'));
    }


    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('lesson'));
    }


    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'nullable|string',
        ]);

        $lesson->update($request->all());

        return redirect()->route('lessons.index')
            ->with('success', 'Урок обновлён');
    }


    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('lessons.index')
            ->with('success', 'Урок удалён');
    }
}
