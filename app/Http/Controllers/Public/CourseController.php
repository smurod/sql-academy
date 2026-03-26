<?php

namespace App\Http\Controllers\Public;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;

class CourseController
{
    public function index(){
        $modules = Module:: all();
        $lessons = Lesson::with('module')->get();
        return view('public.courses.index', compact('modules','lessons'));
    }
    public function show(Lesson $lesson){
        return view('public.courses.show', compact('lesson'));
    }
}
