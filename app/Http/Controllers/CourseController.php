<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'level' => 'required',
        ]);
        Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Курс успешно добавлен');
    }
    public function show(Course $course){
        return view('admin.courses.show', compact('course'));
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
