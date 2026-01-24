<?php

namespace App\Http\Controllers\Public;

use App\Models\Course;
use Illuminate\Http\Request;

class MainController
{
    public function index(){
        $courses = Course::inRandomOrder()->paginate(6);
        return view('public.home', compact('courses'));
    }
}
