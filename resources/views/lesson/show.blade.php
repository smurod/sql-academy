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
                        <th>Теория</th>
                        <th style="width: 40px">Порядок</th>
                        <th>Вернутся назад</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="align-middle">
                        <td>{{ $lesson->id }}</td>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ $lesson->theory_text }}</td>
                        <td>{{ $lesson->lesson_order }}</td>
                        <td>
                            <a href="{{ route('lessons.index') }}" class="btn btn-outline-primary">
                                <-Назад
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
