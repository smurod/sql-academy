<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.lessons.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'lesson_order' => 'required|integer',
            'lecture' => 'nullable|string',
            'code' => 'nullable|string',
            'presentation' => 'nullable|file|mimes:pdf,ppt,pptx',
            'video' => 'nullable|file|mimes:mp4,mov,avi',
        ]);

        $presentationPath = null;
        $videoPath = null;

        if ($request->hasFile('presentation')) {
            $presentationPath = $request->file('presentation')->store('presentations', 'public');
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
        }

        $content = [
            'lecture' => $data['lecture'] ?? null,
            'code' => $data['code'] ?? null,
            'presentation' => $presentationPath,
            'video' => $videoPath,
        ];

        Lesson::create([
            'course_id' => $data['course_id'],
            'title' => $data['title'],
            'lesson_order' => $data['lesson_order'],
            'theory_text' => json_encode($content),
        ]);

        return redirect()->route('lessons.index')
            ->with('success', 'Урок создан');
    }

    public function show(Lesson $lesson)
    {
        return view('admin.lessons.show', compact('lesson'));
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::all();
        return view('admin.lessons.edit', compact('lesson', 'courses'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'theory_text' => 'nullable|string',
            'lesson_order' => 'required|integer',
            'lecture' => 'nullable|string',
            'code' => 'nullable|string',
            'presentation' => 'nullable|file|mimes:pdf,ppt,pptx',
            'video' => 'nullable|file|mimes:mp4,mov,avi',
        ]);

        $content = $lesson->content();

        if ($request->hasFile('presentation')) {
            $content['presentation'] = $request->file('presentation')->store('presentations', 'public');
        }

        if ($request->hasFile('video')) {
            $content['video'] = $request->file('video')->store('videos', 'public');
        }

        $content['lecture'] = $data['lecture'] ?? $content['lecture'];
        $content['code'] = $data['code'] ?? $content['code'];

        $lesson->update([
            'course_id' => $data['course_id'],
            'title' => $data['title'],
            'lesson_order' => $data['lesson_order'],
            'theory_text' => json_encode($content),
        ]);

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
