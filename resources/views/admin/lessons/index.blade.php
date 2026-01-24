@extends('admin.layouts.app')
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
                            <th>Показать</th>
                            <th>Изменить</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lessons as $lesson)
                        <tr class="align-middle">
                            <td>{{$lesson->id}}</td>
                            <td>{{$lesson->course_id}}</td>
                            <td>{{$lesson->title}}</td>
                            <td>{{$lesson->theory_text}}</td>
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

            </div>

        </div>
    </div>
@endsection
