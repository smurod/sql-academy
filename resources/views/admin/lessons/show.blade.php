@extends('admin.layouts.app')
@section('content')

    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <h3>{{ $lesson->title }}</h3>
            </div>

            <div class="card-body">

                @if($lesson->lecture())
                    <h5>Лекция</h5>
                    <p>{{ $lesson->lecture() }}</p>
                    <hr>
                @endif

                @if($lesson->hasCode())
                    <h5>Код</h5>
                    <pre><code>{{ $lesson->code() }}</code></pre>
                    <hr>
                @endif

                @if($lesson->hasPresentation())
                    <h5>Презентация</h5>
                    <a href="{{ asset('storage/'.$lesson->presentation()) }}"
                       class="btn btn-outline-secondary"
                       target="_blank">
                        Скачать презентацию
                    </a>
                    <hr>
                @endif

                @if($lesson->hasVideo())
                    <h5>Видео</h5>
                    <video width="600" controls>
                        <source src="{{ asset('storage/'.$lesson->video()) }}">
                        Ваш браузер не поддерживает видео
                    </video>
                    <hr>
                @endif

                <a href="{{ route('courses.show', $lesson->course_id) }}"
                   class="btn btn-outline-primary">
                    ← Назад к курсу
                </a>

            </div>
        </div>
    </div>

@endsection
