<?php


namespace App\Http\Controllers\Admin;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        $course->load('lessons');
        return view('admin.lessons.index', compact('course'));
    }


    public function create(Course $course){
        return view('admin.lessons.create', compact( 'course'));
    }

    public function store(Request $request, Course $course)
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
            'presentation' => null,
            'video' => null,
        ];

        if ($request->hasFile('presentation')) {
            $content['presentation'] =
                $request->file('presentation')->store('presentations', 'public');
        }

        if ($request->hasFile('video')) {
            $content['video'] =
                $request->file('video')->store('videos', 'public');
        }
        $course->lessons()->create([
            'title' => $data['title'],
            'lesson_order' => $data['lesson_order'],
            'theory_text' => json_encode($content),
        ]);

        return redirect()
            ->route('courses.lessons.index', $course)
            ->with('success', 'Урок создан');
    }


    public function show(Lesson $lesson)
    {
        $lesson->load('course');
        $course = $lesson->course;
        return view('admin.lessons.show', compact('lesson', 'course'));
    }

    public function edit(Lesson $lesson)
    {
        $lesson->load('course');
        $course = $lesson->course;
        return view('admin.lessons.edit', compact('lesson', 'course'));
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

        // гарантируем структуру
        $content = $lesson->content() ?? [];

        $content = array_merge([
            'lecture' => null,
            'code' => null,
            'presentation' => null,
            'video' => null,
        ], $content);

        if ($request->hasFile('presentation')) {
            $content['presentation'] =
                $request->file('presentation')->store('presentations', 'public');
        }

        if ($request->hasFile('video')) {
            $content['video'] =
                $request->file('video')->store('videos', 'public');
        }

        if (array_key_exists('lecture', $data)) {
            $content['lecture'] = $data['lecture'];
        }

        if (array_key_exists('code', $data)) {
            $content['code'] = $data['code'];
        }

        $lesson->update([
            'title' => $data['title'],
            'lesson_order' => $data['lesson_order'],
            'theory_text' => json_encode($content),
        ]);

        return redirect()
            ->route('courses.lessons.index', $lesson->course)
            ->with('success', 'Урок обновлён');
    }



    public function destroy(Lesson $lesson)
    {
        $course = $lesson->course;
        $lesson->delete();

        return redirect()
            ->route('courses.lessons.index', $course)
            ->with('success', 'Урок удалён');
    }
}
