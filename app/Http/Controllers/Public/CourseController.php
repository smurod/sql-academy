<?php

namespace App\Http\Controllers\Public;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController
{
    public function index(Request $request){
        $query = Course::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }
            if ($request->filled('level'))
            {
                $levels = $request->input('level');
                if(!is_array($levels)) $levels = [$levels];
                $query->whereIn('level', $levels);
            }
        $courses = $query->withCount('lessons')->latest()->paginate(5)->withQueryString();
        return view('public.courses.index', compact('courses'));
    }
    public function gridView(){
        $courses = Course::paginate(18);
        return view('public.courses.grid-view', compact('courses'));
    }
}
