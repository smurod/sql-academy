@extends('public.layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $task->title }}</h2>

        <div class="mb-4">
            <p>{{ $task->task_text }}</p>
        </div>

        <hr>

        <form method="POST" action="{{ route('tasks.attempt', $task) }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Ваш SQL-запрос</label>
                <textarea
                    name="user_sql"
                    class="form-control"
                    rows="5"
                    required
                ></textarea>
            </div>

            <button class="btn btn-primary">
                Проверить
            </button>
        </form>

        @if(session('result') !== null)
            <div class="mt-3">
                @if(session('result'))
                    <div class="alert alert-success">
                        Правильно!
                    </div>
                @else
                    <div class="alert alert-danger">
                        Неправильно, попробуй ещё раз
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection
