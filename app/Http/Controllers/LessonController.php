<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        return Lesson::with('course')
            ->orderBy('lesson_order')
            ->get();
    }

    public function create()
    {
        return Course::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id'    => 'required|exists:courses,id',
            'title'        => 'required|string|max:255',
            'theory_text'  => 'required|string',
            'lesson_order' => 'required|integer|min:1',
        ]);

        return Lesson::create($validated);
    }

    public function show(Lesson $lesson)
    {
        return $lesson->load('course');
    }

    public function edit(Lesson $lesson)
    {
        return [
            'lesson'  => $lesson,
            'courses' => Course::all(),
        ];
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'course_id'    => 'required|exists:courses,id',
            'title'        => 'required|string|max:255',
            'theory_text'  => 'required|string',
            'lesson_order' => 'required|integer|min:1',
        ]);

        $lesson->update($validated);

        return $lesson;
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return response()->json([
            'message' => 'Lesson deleted successfully'
        ]);
    }
}
