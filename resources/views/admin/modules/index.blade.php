@extends('admin.layouts.app')
@section('page-header')
    <x-breadcrumb
        title="Список модулей"
        :items="[
    ['label' => 'Home', 'url'=> route('dashboard')],
    ['label' => 'Модули', 'url'=> route('modules.index')],
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
                        <th>ID-курса</th>
                        <th>Название</th>
                        <th>Описание(кратко)</th>
                        <th style="width: 40px">Очередность</th>
                        <th>Список уроков</th>
                        <th>Изменить</th>
                        <th>Удалить</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modules as $module)
                        <tr class="align-middle">
                            <td>{{$module->id}}</td>
                            <td>{{$module->course_id}}</td>
                            <td>{{$module->title}}</td>
                            <td>{{ Str::limit($module->description, 80) }}</td>
                            <td>{{$module->order_index}}</td>
                            <td><a href="{{route('modules.show', $module)}}" class="btn btn-outline-primary">Список
                                    уроков</a></td>
                            <td><a href="{{route('modules.edit', $module)}}" class="btn btn-outline-info">Изменить</a>
                            </td>
                            <td>
                                <form action="{{route('modules.destroy', $module)}}" method="post">
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
