@extends('admin.layouts.app')
@section('page-header')
    <x-breadcrumb
        title="Подробности урока"
        :items="[
    ['label' => 'Home', 'url'=> route('dashboard')],
    ['label' => 'Курсы', 'url'=> route('courses.index')],
    ['label' => 'Список уроков', 'url'=> route('courses.lessons.index', $course)],
    ['label' => 'Подробности урока', 'url'=> route('lessons.show', $lesson)]
]"
    ></x-breadcrumb>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-12">
                <div class="card-header"><h3 class="card-title">Список уроков</h3></div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Название курса/ID</th>
                            <th>Название урока</th>
                            <th>Теория урока</th>
                            <th>Позиция урока</th>
                            <th>Назад</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="align-middle">
                                <td>{{$lesson->id}}</td>
                                <td>{{$lesson->course_id}}</td>
                                <td>{{$lesson->title}}</td>
                                <td>{{$lesson->theory_text}}</td>
                                <td>{{$lesson->lesson_order}}</td>
                                <td><a class="btn btn-outline-primary" href="{{ route('courses.lessons.index', $course) }}">Назад</a></td>
                            </tr>
                        </tbody>

                    </table>

                </div>

            </div>
        </div>
@endsection
