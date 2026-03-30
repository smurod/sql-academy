@extends('admin.layouts.app')

@section('page-header')
    <x-breadcrumb
        title="Добавление задания"
        :items="[
            ['label' => 'Home', 'url'=> route('dashboard')],
            ['label' => 'Задания', 'url'=> route('tasks.index')],
            ['label' => 'Добавление задания', 'url'=> route('tasks.create')],
        ]"
    ></x-breadcrumb>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card card-primary card-outline mb-12">
            <div class="card-header">
                <div class="card-title">Добавление задания</div>
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

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Урок</label>
                                <!-- Снят атрибут required, так как lesson_id может быть NULL -->
                                <select class="form-select" name="lesson_id">
                                    <option selected disabled value="">Выберите урок</option>
                                    @foreach($lessons as $lesson)
                                        <option value="{{ $lesson->id }}" @selected(old('lesson_id') == $lesson->id)>{{ $lesson->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Номер задания <span class="text-danger">*</span></label>
                                <input name="task_number" type="number" class="form-control" value="{{ old('task_number') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Название задания <span class="text-danger">*</span></label>
                        <input name="title" type="text" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Короткое описание <span class="text-danger">*</span></label>
                        <!-- Изменено на textarea для соответствия типу COLUMN text -->
                        <textarea name="description" class="form-control" rows="2" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Полный текст задания <span class="text-danger">*</span></label>
                        <textarea name="task_text" class="form-control" rows="5" required>{{ old('task_text') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <!-- ИЗМЕНЕНИЕ: Схема БД теперь Select -->
                                <label class="form-label">Схема базы данных <span class="text-danger">*</span></label>
                                <select class="form-select" name="database_schema" required>
                                    <option selected disabled value="">Выберите схему...</option>
                                    <option value="aviation" {{ old('database_schema') == 'aviation' ? 'selected' : '' }}>Aviation</option>
                                    <option value="family" {{ old('database_schema') == 'family' ? 'selected' : '' }}>Family</option>
                                    <option value="schedule" {{ old('database_schema') == 'schedule' ? 'selected' : '' }}>Schedule</option>
                                    <option value="booking" {{ old('database_schema') == 'booking' ? 'selected' : '' }}>Booking</option>
                                    <option value="ecommerce" {{ old('database_schema') == 'ecommerce' ? 'selected' : '' }}>Ecommerce</option>
                                    <option value="flights" {{ old('database_schema') == 'flights' ? 'selected' : '' }}>Flights</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Тип запроса <span class="text-danger">*</span></label>
                                <!-- Обновленные типы согласно DDL и JSON -->
                                <select class="form-select" name="sql_type" required>
                                    <option value="select" @selected(old('sql_type', 'select') == 'select')>SELECT</option>
                                    <option value="insert" @selected(old('sql_type') == 'insert')>INSERT</option>
                                    <option value="update" @selected(old('sql_type') == 'update')>UPDATE</option>
                                    <option value="delete" @selected(old('sql_type') == 'delete')>DELETE</option>
                                    <option value="create_view" @selected(old('sql_type') == 'create_view')>CREATE VIEW</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Правильное решение SQL <span class="text-danger">*</span></label>
                        <textarea name="solution_sql" class="form-control font-monospace" rows="4" required>{{ old('solution_sql') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ожидаемый результат JSON <span class="text-danger">*</span></label>
                        <textarea name="expected_results" class="form-control font-monospace" rows="3" required>{{ old('expected_results') }}</textarea>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <!-- ИЗМЕНЕНИЕ: Сложность теперь проценты (число 0-100) -->
                                <label class="form-label">Сложность (%) <span class="text-danger">*</span></label>
                                <input name="difficulty_percent"
                                       type="number"
                                       class="form-control"
                                       min="0"
                                       max="100"
                                       step="1"
                                       value="{{ old('difficulty_percent', 15) }}"
                                       placeholder="Например: 15"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Порядок</label>
                                <input name="task_order" type="number" class="form-control" value="{{ old('task_order', 0) }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Очки</label>
                                <input name="points" type="number" class="form-control" value="{{ old('points', 0) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_free" value="1" id="is_free" @checked(old('is_free', true))>
                                    <label class="form-check-label" for="is_free">
                                        Бесплатное задание
                                    </label>
                                    <!-- Скрытый инпут для отправки 0, если чекбокс снят -->
                                    <input type="hidden" name="is_free" value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label">Подсказка</label>
                        <textarea name="hint" class="form-control" rows="2">{{ old('hint') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Теги</label>
                                <input name="tags" type="text" class="form-control" value="{{ old('tags') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Компания</label>
                                <input name="company" type="text" class="form-control" value="{{ old('company') }}">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        Добавить задание
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
