@extends('admin.layouts.app')
@section('page-header')
    <x-breadcrumb
    title="Список курсов"
    :items="[
    ['label' => 'Home', 'url'=> route('dashboard')],
    ['label' => 'Курсы', 'url'=> route('courses.index')],
]"
    ></x-breadcrumb>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mb-12">
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Название</th>
                        <th>Описание(кратко)</th>
                        <th style="width: 40px">Уровень</th>
                        <th>Список уроков</th>
                        <th>Изменить</th>
                        <th>Удалить</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                    <tr class="align-middle">
                        <td>{{$course->id}}</td>
                        <td>{{$course->title}}</td>
                        <td>{{ Str::limit($course->description, 80) }}</td>
                        <td>
                            @if(!empty($course->level))
                                <span>{{$course->level}}</span>
                            @else
                                Не указано
                            @endif
                        </td>
                        <td><a href="{{route('courses.show', $course)}}" class="btn btn-outline-primary">Список уроков</a></td>
                        <td><a href="{{route('courses.edit', $course)}}" class="btn btn-outline-info">Изменить</a></td>
                        <td>
                            <form action="{{route('courses.destroy', $course)}}" method="post">
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
