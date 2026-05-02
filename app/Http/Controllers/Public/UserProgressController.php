<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\UsersRating;

class UserProgressController extends Controller
{
    public function complete(Lesson $lesson)
    {
        LessonProgress::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'lesson_id' => $lesson->id,
            ]
        );
        UsersRating::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'type' => 'lesson',
                'source_id' => $lesson->id,
            ],
            [
                'xp' => $lesson->xp,
                'coins' => 1,
            ]
        );
        return back()->with('success', 'Урок пройден, очки добавлены');
    }
}
