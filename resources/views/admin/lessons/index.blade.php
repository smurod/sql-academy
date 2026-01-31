@extends('admin.layouts.app')
@section('page-header')
    <x-breadcrumb
        title="Список уроков"
        :items="[
    ['label' => 'Home', 'url'=> route('dashboard')],
    ['label' => 'Модули', 'url'=> route('modules.index')],
    ['label' => 'Список уроков', 'url'=> route('modules.lessons.index', $module)],
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
                            <th>Изменить</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($module->lessons as $lesson)
                        <tr class="align-middle">
                            <td>{{$lesson->id}}</td>
                            <td>{{$lesson->title}}</td>
                            <td>{{ Str::limit($lesson->theory_text, 70) }}</td>
                            <td>{{$lesson->lesson_order}}</td>
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
                <a href="{{ route('modules.lessons.create', $module->id) }}"
                   class="btn btn-outline-success">
                    + Добавить урок
                </a>
            </div>
        </div>
@endsection
