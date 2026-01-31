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
            'title' => 'required|string|max:255',
            'lesson_order' => 'required|integer',
            'lecture' => 'nullable|string',
            'code' => 'nullable|string',
            'presentation' => 'nullable|file|mimes:pdf,ppt,pptx',
            'video' => 'nullable|file|mimes:mp4,mov,avi',
        ]);

        $content = [
            'lecture' => $data['lecture'] ?? null,
            'code' => $data['code'] ?? null,
            'presentation' => $request->hasFile('presentation')
                ? $request->file('presentation')->store('presentations', 'public')
                : null,
            'video' => $request->hasFile('video')
                ? $request->file('video')->store('videos', 'public')
                : null,
        ];

        $module->lessons()->create([
            'course_id' => 1,
            'title' => $data['title'],
            'slug' => \Str::slug($data['title']),
            'lesson_order' => $data['lesson_order'],
            'content' => json_encode($content),
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
            'title' => 'required|string|max:255',
            'lesson_order' => 'required|integer',
            'lecture' => 'nullable|string',
            'code' => 'nullable|string',
            'presentation' => 'nullable|file|mimes:pdf,ppt,pptx',
            'video' => 'nullable|file|mimes:mp4,mov,avi',
        ]);

         $content = $lesson->content ?? [
            'lecture' => null,
            'code' => null,
            'presentation' => null,
            'video' => null,
        ];

        $content['lecture'] = $data['lecture'] ?? $content['lecture'];
        $content['code'] = $data['code'] ?? $content['code'];

        if ($request->hasFile('presentation')) {
            $content['presentation'] = $request->file('presentation')->store('presentations', 'public');
        }

        if ($request->hasFile('video')) {
            $content['video'] = $request->file('video')->store('videos', 'public');
        }

        $lesson->update([
            'title' => $data['title'],
            'slug' => \Str::slug($data['title']),
            'lesson_order' => $data['lesson_order'],
            'content' => $content,
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
