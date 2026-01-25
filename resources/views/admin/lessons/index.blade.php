@extends('admin.layouts.app')
@section('page-header')
    <x-breadcrumb
        title="Список уроков"
        :items="[
    ['label' => 'Home', 'url'=> route('dashboard')],
    ['label' => 'Курсы', 'url'=> route('courses.index')],
    ['label' => 'Список уроков', 'url'=> route('courses.lessons.index', $course)],
]"
    ></x-breadcrumb>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-12">
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">ID-урока</th>
                            <th>Название урока</th>
                            <th>Теория урока</th>
                            <th>Позиция урока</th>
                            <th>Показать</th>
                            <th>Изменить</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($course->lessons as $lesson)
                        <tr class="align-middle">
                            <td>{{$lesson->id}}</td>
                            <td>{{$lesson->title}}</td>
                            <td>{{ Str::limit($lesson->theory_text, 70) }}</td>
                            <td>{{$lesson->lesson_order}}</td>
                            <td><a class="btn btn-outline-info" href="{{route('lessons.show', $lesson)}}">Смотреть</a></td>
                            <td><a class="btn btn-outline-primary" href="{{route('lessons.edit', $lesson)}}">Изменить</a></td>
                            <td>
                                <form action="{{route('lessons.destroy', $lesson)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Удалить" class="btn btn-outline-danger">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                </div>
        </div>
            <br><div class="col-md-12">
                <a href="{{ route('courses.lessons.create', $course->id) }}"
                   class="btn btn-outline-success">
                    ➕ Добавить урок
                </a>
            </div>
        </div>
@endsection
