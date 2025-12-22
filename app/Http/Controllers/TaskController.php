<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::with('lesson')->get();
    }

    public function store(Request $request)
    {
        return Task::create($request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string',
            'task_text' => 'required|string',
            'difficulty' => 'nullable|string',
        ]));
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->validate([
            'title' => 'required|string',
            'task_text' => 'required|string',
            'difficulty' => 'nullable|string',
        ]));

        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }
}
