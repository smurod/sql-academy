<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function store(Request $request)
    {
        return Course::create($request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'level' => 'nullable|string',
        ]));
    }

    public function show(Course $course)
    {
        return $course;
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'level' => 'nullable|string',
        ]));

        return $course;
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->noContent();
    }
}
