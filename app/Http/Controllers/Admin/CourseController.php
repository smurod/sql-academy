<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }
    public function create(){
        $course = Course::all();
        return view('admin.courses.create', compact('course'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'description' => 'required',
            'start_date' => 'nullable|date',
            'duration' => 'nullable|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'extra_info' => 'nullable|string',
            'level' => 'required|string|min:3|max:255',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Курс добавлен');
    }

    public function show(Course $course){
        $course->load('lessons');
        return view('admin.lessons.index', compact('course'));
    }
    public function edit(Course $course){
        return view('admin.courses.edit', compact('course'));
    }
    public function update(Request $request, Course $course){
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'level' => 'required',
        ]);
        $course->update($data);
        return redirect()->route('courses.index');
    }
    public function destroy(Course $course){
        $course->delete();
        return redirect()->route('courses.index');
    }

}
