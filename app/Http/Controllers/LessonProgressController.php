<?php

namespace App\Http\Controllers;

use App\Models\LessonProgress;
use Illuminate\Http\Request;

class LessonProgressController extends Controller
{

    public function index()
    {
        return LessonProgress::all();
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'   => 'required|exists:users,id',
            'lesson_id' => 'required|exists:lessons,id',
            'completed' => 'boolean',
        ]);

        return LessonProgress::create($validated);
    }


    public function show($id)
    {
        return LessonProgress::findOrFail($id);
    }


    public function update(Request $request, $id)
    {
        $progress = LessonProgress::findOrFail($id);

        $validated = $request->validate([
            'completed' => 'boolean',
        ]);

        $progress->update($validated);

        return $progress;
    }


    public function destroy($id)
    {
        $progress = LessonProgress::findOrFail($id);
        $progress->delete();

        return response()->json([
            'message' => 'Lesson progress deleted'
        ]);
    }
}
