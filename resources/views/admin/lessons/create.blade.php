@extends('admin.layouts.app')
@section('content')

    <div class="container">
        <h2>Создать урок</h2>

        <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Курс</label>
                <select name="course_id" class="form-control" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Название</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Порядок</label>
                <input type="number" name="lesson_order" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Описание</label>
                <input type="text" name="theory_text" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Лекция (текст)</label>
                <textarea name="lecture" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Код</label>
                <textarea name="code" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Презентация (PDF/PPT)</label>
                <input type="file" name="presentation" class="form-control">
            </div>

            <div class="mb-3">
                <label>Видео (MP4)</label>
                <input type="file" name="video" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>

@endsection
