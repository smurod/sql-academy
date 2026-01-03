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
                        <th>Смотреть</th>
                        <th>Изменить</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($progresses as $progress)
                        <tr class="align-middle">
                            <td>{{ $progress->id }}</td>
                            <td>{{ $progress->user_id }}</td>
                            <td>{{ $progress->lesson_id }}</td>
                            <td>{{ $progress->completed ? 'Да' : 'Нет' }}</td>
                            <td>
                                <a href="{{ route('lessons-progress.show', $progress) }}"
                                   class="btn btn-outline-primary">
                                    Смотреть
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('lessons-progress.edit', $progress) }}"
                                   class="btn btn-outline-info">
                                    Изменить
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('lessons-progress.destroy', $progress) }}" method="post">
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
        </div>
    </div>
@endsection

