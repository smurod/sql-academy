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
                        <th>ID/Название урока</th>
                        <th>Название</th>
                        <th style="width: 40px">Текст задания</th>
                        <th>Сложность</th>
                        <th>Смотреть</th>
                        <th>Изменить</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
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
                            <td><a class="btn btn-outline-primary" href="{{route('tasks.show', $task)}}">Смотреть</a></td>
                            <td><a class="btn btn-outline-info" href="{{route('tasks.edit', $task)}}">Изменить</a></td>
                            <td>
                                <form action="{{route('tasks.destroy', $task)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Удалить" class="btn btn-outline-danger">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
