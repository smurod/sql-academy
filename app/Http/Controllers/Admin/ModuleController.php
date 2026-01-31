<?php

namespace App\Http\Controllers\Admin;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController
{
    public function index(){
        $modules = Module::all();
        return view('admin.modules.index', compact('modules'));
    }
    public function create(){
        $module = Module::all();
        return view('admin.modules.create', compact('module'));
    }

    public function store(Request $request)
    {
         $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'order_index' => 'integer|min:0',
        ]);
         $data['course_id'] = 1;

        Module::create($data);

        return redirect()->route('modules.index');
    }
    public function show(Module $module)
    {
        $lessons = $module->lessons()->orderBy('lesson_order', 'asc')->get();

        return view('admin.lessons.index', compact('module', 'lessons'));
    }

    public function edit(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'order_index' => 'required|integer',
        ]);

        $module->update($data);

        return redirect()->route('modules.index')->with('success', 'Модуль обновлен');
    }

    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Модуль удален');
    }
}
