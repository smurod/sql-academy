@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card mb-12">
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>ID-урока</th>
                        <th>Название</th>
                        <th style="width: 40px">Текст задания</th>
                        <th>Сложность</th>
                        <th>Вернуться назад</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <td>{{$task->id}}</td>
                            <td>{{$task->lesson_id}}</td>
                            <td>{{$task->title}}</td>
                            <td>{{$task->task_text}}</td>
                            <td>
                                @if(!empty($task->difficulty))
                                    {{$task->difficulty}}
                                @else
                                    Не указано
                                @endif
                            </td>
                            <td><a class="btn btn-outline-primary" href="{{route('tasks.index')}}"><-Назад</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
