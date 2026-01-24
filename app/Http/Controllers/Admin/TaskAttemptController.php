<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\TaskAttempt;
use Illuminate\Http\Request;

class TaskAttemptController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'user_sql' => 'required',
        ]);

        $correctSql = trim(strtolower($task->answer->correct_sql));
        $userSql = trim(strtolower($request->user_sql));

        $isCorrect = $correctSql === $userSql;

        TaskAttempt::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'user_sql' => $request->user_sql,
            'is_correct' => $isCorrect,
        ]);

        return back()->with('result', $isCorrect);
    }
}
