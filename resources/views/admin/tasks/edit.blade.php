@extends('admin.layouts.app')

@section('page-header')
    <x-breadcrumb
        title="Редактирование задания"
        :items="[
            ['label' => 'Home', 'url'=> route('dashboard')],
            ['label' => 'Задания', 'url'=> route('tasks.index')],
            ['label' => 'Редактирование задания', 'url'=> '#'],
        ]"
    ></x-breadcrumb>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card card-primary card-outline mb-12">
            <div class="card-header">
                <div class="card-title">Редактирование задания #{{ $task->task_number }}</div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mx-3 mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Урок</label>
                                <select class="form-select" name="lesson_id">
                                    <option value="">Без урока</option>
                                    @foreach($lessons as $lesson)
                                        <option value="{{ $lesson->id }}" @selected(old('lesson_id', $task->lesson_id) == $lesson->id)>{{ $lesson->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Номер задания <span class="text-danger">*</span></label>
                                <input name="task_number" type="number" class="form-control" value="{{ old('task_number', $task->task_number) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Название задания <span class="text-danger">*</span></label>
                        <input name="title" type="text" class="form-control" value="{{ old('title', $task->title) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Короткое описание</label>
                        <input name="description" type="text" class="form-control" value="{{ old('description', $task->description) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Полный текст задания <span class="text-danger">*</span></label>
                        <textarea name="task_text" class="form-control" rows="5">{{ old('task_text', $task->task_text) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Схема базы данных <span class="text-danger">*</span></label>
                                <select class="form-select" name="database_schema">
                                    <option selected disabled value="">Выберите схему</option>
                                    <option value="aviation" @selected(old('database_schema', $task->database_schema) == 'aviation')>aviation</option>
                                    <option value="family" @selected(old('database_schema', $task->database_schema) == 'family')>family</option>
                                    <option value="schedule" @selected(old('database_schema', $task->database_schema) == 'schedule')>schedule</option>
                                    <option value="booking" @selected(old('database_schema', $task->database_schema) == 'booking')>booking</option>
                                    <option value="ecommerce" @selected(old('database_schema', $task->database_schema) == 'ecommerce')>ecommerce</option>
                                    <option value="flights" @selected(old('database_schema', $task->database_schema) == 'flights')>flights</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Тип запроса</label>
                                <select class="form-select" name="sql_type">
                                    <option value="select" @selected(old('sql_type', $task->sql_type) == 'select')>SELECT</option>
                                    <option value="join" @selected(old('sql_type', $task->sql_type) == 'join')>JOIN</option>
                                    <option value="group" @selected(old('sql_type', $task->sql_type) == 'group')>GROUP BY</option>
                                    <option value="update" @selected(old('sql_type', $task->sql_type) == 'update')>UPDATE</option>
                                    <option value="delete" @selected(old('sql_type', $task->sql_type) == 'delete')>DELETE</option>
                                    <option value="insert" @selected(old('sql_type', $task->sql_type) == 'insert')>INSERT</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Правильное решение SQL <span class="text-danger">*</span></label>
                        <textarea name="solution_sql" class="form-control font-monospace" rows="4">{{ old('solution_sql', $task->solution_sql) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ожидаемый результат JSON <span class="text-danger">*</span></label>
                        <textarea name="expected_results" class="form-control font-monospace" rows="3">{{ old('expected_results', json_encode($task->expected_results, JSON_PRETTY_PRINT)) }}</textarea>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Сложность % <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="difficulty_percent" type="number" min="0" max="100" class="form-control"
                                           value="{{ old('difficulty_percent', $task->difficulty_percent) }}">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Порядок</label>
                                <input name="task_order" type="number" class="form-control" value="{{ old('task_order', $task->task_order) }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Очки</label>
                                <input name="points" type="number" class="form-control" value="{{ old('points', $task->points) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_free" value="1" id="is_free"
                                        @checked(old('is_free', $task->is_free))>
                                    <label class="form-check-label" for="is_free">
                                        Бесплатное задание
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label">Подсказка</label>
                        <textarea name="hint" class="form-control" rows="2">{{ old('hint', $task->hint) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Теги</label>
                                <input name="tags" type="text" class="form-control" value="{{ old('tags', $task->tags) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Компания</label>
                                <input name="company" type="text" class="form-control" value="{{ old('company', $task->company) }}">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        Сохранить задание
                    </button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-default float-end">
                        <i class="bi bi-x-circle me-1"></i>
                        Отмена
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection
