<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Controller;
use App\Models\TaskAnswer;
use Illuminate\Http\Request;

class TaskAnswerController extends Controller
{
    public function store(Request $request)
    {
        return TaskAnswer::updateOrCreate(
            ['task_id' => $request->task_id],
            $request->validate([
                'task_id' => 'required|exists:tasks,id',
                'correct_sql' => 'required|string',
            ])
        );
    }

    public function show(TaskAnswer $taskAnswer)
    {
        return $taskAnswer;
    }

    public function destroy(TaskAnswer $taskAnswer)
    {
        $taskAnswer->delete();
        return response()->noContent();
    }
}
