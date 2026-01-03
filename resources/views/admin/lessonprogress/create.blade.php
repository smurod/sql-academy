@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card card-primary card-outline mb-12">
            <div class="card-header">
                <div class="card-title">Добавление прогресса</div>
            </div>

            <form action="{{ route('lessons-progress.store') }}" method="post">
                @csrf
                <div class="card-body">

                    <div class="mb-12">
                        <label class="form-label">User ID</label>
                        <input name="user_id" type="number" class="form-control">
                    </div>

                    <div class="mb-12">
                        <label class="form-label">Lesson ID</label>
                        <input name="lesson_id" type="number" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Пройден</label>
                        <select name="completed" class="form-select">
                            <option value="0">Нет</option>
                            <option value="1">Да</option>
                        </select>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
