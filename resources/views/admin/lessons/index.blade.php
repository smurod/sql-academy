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
                        <th>Смотреть</th>
                        <th>Изменить</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lessons as $lesson)
                        <tr class="align-middle">
                            <td>{{ $lesson->id }}</td>
                            <td>{{ $lesson->title }}</td>
                            <td>{{ $lesson->theory_text }}</td>
                            <td>{{ $lesson->lesson_order }}</td>
                            <td>
                                <a href="{{ route('lessons.show', $lesson) }}"
                                   class="btn btn-outline-primary">
                                    Смотреть
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('lessons.edit', $lesson) }}"
                                   class="btn btn-outline-info">
                                    Изменить
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('lessons.destroy', $lesson) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit"
                                           value="Удалить"
                                           class="btn btn-outline-danger">
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
