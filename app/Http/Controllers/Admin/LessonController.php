<?php


namespace App\Http\Controllers\Admin;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index(Module $module)
    {
        $module->load('lessons');
        return view('admin.lessons.index', compact('module'));
    }


    public function create(Module $module)
    {
        return view('admin.lessons.create', compact('module'));
    }

    public function store(Request $request, Module $module)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'lesson_order' => 'required|integer',
            'lesson_type'  => 'required|in:theory,practice,parent',
            'content'      => 'nullable|string',
            'xp' => 'nullable|integer',
        ]);

        $module->lessons()->create([
            'course_id'    => 1,
            'title'        => $data['title'],
            'slug'         => \Str::slug($data['title']),
            'lesson_order' => $data['lesson_order'],
            'lesson_type'  => $data['lesson_type'],
            'content'      => $data['content'] ?? null,
            'xp'           => $data['xp'] ?? 0,
            // ❌ Убрали: json_encode, lecture, code, presentation, video
        ]);

        return redirect()
            ->route('modules.show', $module)
            ->with('success', 'Урок создан');
    }



    public function show(Lesson $lesson)
    {
        $lesson->load('module');
        $module = $lesson->module;
        return view('admin.lessons.show', compact('lesson', 'module'));
    }

    public function edit(Lesson $lesson)
    {
        $module = $lesson->module;
        return view('admin.lessons.edit', compact('lesson', 'module'));
    }


    public function update(Request $request, Lesson $lesson)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'lesson_order' => 'required|integer',
            'lesson_type'  => 'required|in:theory,practice,parent',
            'content'      => 'nullable|string',
            'xp' => 'nullable|integer',
        ]);

        $lesson->update([
            'title'        => $data['title'],
            'slug'         => \Str::slug($data['title']),
            'lesson_order' => $data['lesson_order'],
            'lesson_type'  => $data['lesson_type'],
            'content'      => $data['content'] ?? $lesson->content,
            'xp'           => $data['xp'] ?? 0,
        ]);

        return redirect()
            ->route('modules.show', $lesson->module_id)
            ->with('success', 'Урок успешно обновлён');
    }

    public function destroy(Lesson $lesson)
    {
        $module = $lesson->course;
        $lesson->delete();

        return redirect()
            ->route('modules.lessons.index', $module)
            ->with('success', 'Урок удалён');
    }
}
