@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card mb-12">
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width:10px">ID</th>
                        <th>User ID</th>
                        <th>Lesson ID</th>
                        <th>Пройден</th>
                        <th>Вернутся назад</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="align-middle">
                        <td>{{ $progress->id }}</td>
                        <td>{{ $progress->user_id }}</td>
                        <td>{{ $progress->lesson_id }}</td>
                        <td>{{ $progress->completed ? 'Да' : 'Нет' }}</td>
                        <td>
                            <a href="{{ route('lessons-progress.index') }}" class="btn btn-outline-primary">
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
