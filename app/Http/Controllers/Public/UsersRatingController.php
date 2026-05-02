<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Task;
use App\Models\UsersRating;

class UsersRatingController extends Controller
{
    public function taskXp(Task $task)
    {
        UsersRating::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'type' => 'task',
                'source_id' => $task->id,
            ],
            [
                'xp' => $task->points,
            ]
        );
        return back()->with('success', "Задача #{$task->id} решена, очки начислены");
    }

    public function lessonXp(Lesson $lesson)
    {
        UsersRating::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'type' => 'lesson',
                'source_id' => $lesson->id,
            ],
            [
                'xp' => $lesson->xp,
            ]
        );
        return back()->with('Урок пройден, очки начислены');
    }

    public function moduleXp(Module $module)
    {
        UsersRating::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'type' => 'module',
                'source_id' => $module->id,
            ],
            [
                'xp' => $module->xp,
            ]
        );
        return back()->with('Модуль пройден, очки начислены');
    }

    public function index()
    {
        $topThree = UsersRating::selectRaw('user_id, SUM(xp) as total_xp')
            ->groupBy('user_id')
            ->orderByDesc('total_xp')
            ->with('user')
            ->limit(3)
            ->get();

        $leaders = UsersRating::selectRaw('user_id, SUM(xp) as total_xp')
            ->groupBy('user_id')
            ->orderByDesc('total_xp')
            ->with('user')
            ->paginate(100);

        return view('public.rating.index', compact('leaders', 'topThree'));
    }

}
