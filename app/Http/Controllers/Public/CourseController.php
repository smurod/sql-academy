<?php

namespace App\Http\Controllers\Public;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController
{
    public function index(Request $request){
        // 1. Создаем заготовку запроса
        $query = Course::query();
        // 2. Логика поиска по названию (Title)
        if ($request->filled('search')) {
            $search = $request->input('search');
            // Ищем вхождение строки в title
            $query->where('title', 'like', "%{$search}%");
        }

        // 3. Логика фильтрации по уровню (Level)
        // Мы проверяем, выбрал ли пользователь хоть один чекбокс
        if ($request->filled('level')) {
            // level передается как массив (например: ?level[]=beginner&level[]=middle)
            $levels = $request->input('level');
            // Если пришла строка (один выбор), превращаем в массив, если массив - оставляем
            if(!is_array($levels)) $levels = [$levels];

            $query->whereIn('level', $levels);
        }

        // 4. Получаем результаты с пагинацией
        // withQueryString() нужен, чтобы при переходе на стр. 2 фильтры не слетали
        $courses = $query->withCount('lessons')->latest()->paginate(5)->withQueryString();
        return view('public.courses.index', compact('courses'));
    }
    public function gridView(){
        $courses = Course::paginate(18);
        return view('public.courses.grid-view', compact('courses'));
    }
}
