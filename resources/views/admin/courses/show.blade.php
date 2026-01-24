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
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Начало</th>
                        <th>Продолжтельность</th>
                         <th>Фото</th>
                        <th>Доп. Инфо</th>
                        <th style="width: 40px">Уровень</th>
                        <th>Вернутся назад</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <td>{{$course->id}}</td>
                            <td>{{$course->title}}</td>
                            <td>{{$course->theory_text}}</td>
                            <td>{{$course->start_date}}</td>
                            <td>{{$course->duration}}</td>
                            <td><img src="{{ asset('storage/'.$course->image) }}" width="100px" alt=""></td>
                            <td>{{$course->extra_info}}</td>

                            <td>
                                @if(!empty($course->level))
                                    <span>{{$course->level}}</span>
                                @else
                                    Не указано
                                @endif
                            </td>
                            <td><a href="{{route('courses.index')}}" class="btn btn-outline-primary"><-Назад</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
