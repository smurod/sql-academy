<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('admin.tasks.index', compact('tasks'));
    }
    public function create(){
        $tasks = Task::all();
        $lessons = Lesson::all();
        return view('admin.tasks.create', compact('tasks', 'lessons'));
    }
    public function store(Request $request){

        $data = $request->validate([
            'lesson_id' => 'required',
            'title' => 'required',
            'task_text' => 'required',
            'difficulty' => 'nullable',
        ]);
        Task::create($data);
        return redirect()->route('tasks.index');
    }
    public function show(Task $task){
        return view('admin.tasks.show', compact('task'));
    }
    public function edit(Task $task){
        return view('admin.tasks.edit', compact('task'));
    }
    public function update(Request $request, Task $task){
        $data = $request->validate([
            'lesson_id' => 'required',
            'title' => 'required',
            'task_text' => 'required',
            'difficulty' => 'required',
        ]);
        $task->update($data);
        return redirect()->route('tasks.index');
    }
    public function destroy(Task $task){
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
