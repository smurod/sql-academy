@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card card-primary card-outline mb-12">
            <div class="card-header">
                <div class="card-title">Редактирование прогресса</div>
            </div>

            <form action="{{ route('lessons-progress.update', $progress) }}" method="post">
                @csrf
                @method('put')

                <div class="card-body">

                    <div class="mb-12">
                        <label class="form-label">User ID</label>
                        <input name="user_id" type="number" value="{{ $progress->user_id }}" class="form-control">
                    </div>

                    <div class="mb-12">
                        <label class="form-label">Lesson ID</label>
                        <input name="lesson_id" type="number" value="{{ $progress->lesson_id }}" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Пройден</label>
                        <select name="completed" class="form-select">
                            <option value="0" @if(!$progress->completed) selected @endif>Нет</option>
                            <option value="1" @if($progress->completed) selected @endif>Да</option>
                        </select>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
