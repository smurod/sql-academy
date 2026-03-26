<?php

namespace App\Http\Controllers\Public;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class MainController
{
    public function index(){
        $users = User:: all();
        $lessons = Lesson:: all();
        $tasks = Task::all();
        return view('public.home', compact('users', 'lessons', 'tasks'));
    }
    public function sandbox(){
        return view('public.sandbox');
    }
}
