<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $lessons = Lesson::all();
        return view('admin.tasks.create', compact('lessons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_number'       => ['required', 'integer', 'unique:tasks'], // Уникально!
            'lesson_id'         => ['nullable', 'exists:lessons,id'],
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'task_text'         => 'required|string',
            'database_schema'   => ['required', 'string', 'max:50'],
            'solution_sql'      => 'required|string',
            'expected_results'  => ['required', 'json'],
            'difficulty_percent'=> ['sometimes', 'integer', 'min:0', 'max:100'],
            'is_free'           => 'sometimes', // Обработаем в контроллере
            'hint'              => 'nullable|string',
            'points'            => 'sometimes',
            'sql_type'          => 'required|string|in:select,insert,update,delete,alter,drop',
            'task_order'        => 'sometimes',
            'tags'              => 'nullable|string|max:500',
            'company'           => 'nullable|string|max:100',
        ]);

        $validated['author_id'] = Auth::id();

        $validated['is_free'] = $request->filled('is_free') ? 1 : 0;
        if (empty($validated['difficulty_percent'])) $validated['difficulty_percent'] = 15;
        if (empty($validated['points'])) $validated['points'] = 0;
        if (empty($validated['task_order'])) $validated['task_order'] = 0;
        if (empty($validated['sql_type'])) $validated['sql_type'] = 'select';

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Задание успешно создано!');
    }

    public function show(Task $task) { /* ... */ }

    public function edit(Task $task)
    {
        $lessons = Lesson::all();
        return view('admin.tasks.edit', compact('task', 'lessons'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_number'       => ['required', 'integer',],
            'lesson_id'         => ['nullable', 'exists:lessons,id'],
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'task_text'         => 'required|string',
            'database_schema'   => ['required', 'string', 'max:50'],
            'solution_sql'      => 'required|string',
            'expected_results'  => ['required', 'json'],
            'difficulty_percent'=> ['sometimes', 'integer', 'min:0', 'max:100'],
            'is_free'           => 'sometimes',
            'hint'              => 'nullable|string',
            'points'            => 'sometimes',
            'sql_type'          => 'required|string|in:select,insert,update,delete,alter,drop',
            'task_order'        => 'sometimes',
            'tags'              => 'nullable|string|max:500',
            'company'           => 'nullable|string|max:100',
        ]);

        $task->update($validated);

        return back()->with('success', 'Обновлено');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Удалено');
    }
}
