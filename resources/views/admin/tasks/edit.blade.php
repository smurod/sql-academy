@extends('admin.layouts.app')

@section('title', 'Редактирование задания — SQLMastery Admin')

@section('page-header')
    <div>
        <div class="admin-breadcrumbs">
            <a href="{{ route('dashboard') }}">Главная</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('tasks.index') }}">Задания</a>
            <i class="bi bi-chevron-right"></i>
            <span>Редактирование задания</span>
        </div>

        <h1 class="admin-page-title">Редактирование <span>задания</span></h1>
        <p class="admin-page-subtitle">
            Обновите параметры SQL-задания, текст, решение, ожидаемый JSON и дополнительные настройки.
        </p>
    </div>
@endsection

@section('content')
    <style>
        .admin-form-page {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 340px;
            gap: 1rem;
        }

        .admin-form-card,
        .admin-side-card {
            position: relative;
            border-radius: 24px;
            border: 1px solid var(--border-color);
            background: var(--panel-bg);
            overflow: hidden;
            backdrop-filter: blur(14px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.22);
        }

        .admin-form-card::before,
        .admin-side-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59,130,246,0.07), rgba(147,51,234,0.04), transparent 60%);
            pointer-events: none;
        }

        .admin-form-head {
            position: relative;
            z-index: 1;
            padding: 1.35rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-form-head h2 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
        }

        .admin-form-head p {
            margin-top: .35rem;
            color: var(--text-secondary);
            font-size: .9rem;
        }

        .admin-form-body {
            position: relative;
            z-index: 1;
            padding: 1.5rem;
        }

        .admin-errors {
            margin-bottom: 1rem;
            border: 1px solid rgba(239,68,68,0.22);
            background: rgba(239,68,68,0.08);
            color: #fca5a5;
            border-radius: 18px;
            padding: 1rem 1.1rem;
        }

        .admin-errors ul {
            margin: 0;
            padding-left: 1.1rem;
        }

        .admin-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
        }

        .admin-form-group {
            display: flex;
            flex-direction: column;
            gap: .55rem;
        }

        .admin-form-group.full {
            grid-column: 1 / -1;
        }

        .admin-form-label {
            color: var(--text-primary);
            font-size: .95rem;
            font-weight: 600;
        }

        .admin-required {
            color: #f87171;
        }

        .admin-input,
        .admin-select,
        .admin-textarea {
            width: 100%;
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            color: var(--text-primary);
            border-radius: 16px;
            padding: .95rem 1rem;
            outline: none;
            transition: all .25s ease;
            font-size: .95rem;
        }

        .admin-input:focus,
        .admin-select:focus,
        .admin-textarea:focus {
            border-color: rgba(59,130,246,0.28);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.08);
        }

        .admin-textarea {
            resize: vertical;
        }

        .admin-code {
            font-family: 'JetBrains Mono', monospace;
        }

        .admin-input-group {
            display: flex;
            align-items: stretch;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            background: var(--bg-soft);
        }

        .admin-input-group .admin-input {
            border: none;
            border-radius: 0;
            background: transparent;
            box-shadow: none !important;
        }

        .admin-input-group span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 52px;
            padding: 0 .9rem;
            color: var(--text-secondary);
            border-left: 1px solid var(--border-color);
            background: rgba(255,255,255,0.02);
            font-weight: 600;
        }

        .admin-divider {
            height: 1px;
            background: var(--border-color);
            margin: 1.4rem 0;
        }

        .admin-checkbox-row {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .95rem 1rem;
            border-radius: 16px;
            background: var(--bg-soft);
            border: 1px solid var(--border-color);
            min-height: 54px;
        }

        .admin-checkbox-row input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
        }

        .admin-checkbox-row label {
            color: var(--text-primary);
            font-weight: 500;
            margin: 0;
        }

        .admin-form-actions {
            position: relative;
            z-index: 1;
            padding: 1.25rem 1.5rem 1.5rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: .75rem;
            flex-wrap: wrap;
        }

        .admin-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .65rem;
            padding: .92rem 1.2rem;
            border-radius: 14px;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all .25s ease;
        }

        .admin-btn-secondary {
            background: var(--bg-soft);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .admin-btn-secondary:hover {
            transform: translateY(-2px);
        }

        .admin-btn-primary {
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 12px 28px rgba(59,130,246,0.24);
        }

        .admin-btn-primary:hover {
            transform: translateY(-2px);
        }

        .admin-side-body {
            position: relative;
            z-index: 1;
            padding: 1.4rem;
        }

        .admin-side-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: .8rem;
        }

        .admin-side-list {
            display: flex;
            flex-direction: column;
            gap: .85rem;
        }

        .admin-side-item {
            display: flex;
            gap: .75rem;
            align-items: flex-start;
            padding: .9rem;
            border-radius: 16px;
            background: var(--bg-soft);
            border: 1px solid var(--border-color);
        }

        .admin-side-item i {
            color: var(--accent);
            font-size: 1rem;
            margin-top: .1rem;
        }

        .admin-side-item strong {
            display: block;
            font-size: .92rem;
            margin-bottom: .25rem;
        }

        .admin-side-item span {
            color: var(--text-secondary);
            font-size: .84rem;
            line-height: 1.5;
        }

        @media (max-width: 1280px) {
            .admin-form-page {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .admin-form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="admin-form-page">
        <div class="admin-form-card">
            <div class="admin-form-head">
                <h2>Редактирование задания #{{ $task->task_number }}</h2>
                <p>Измените параметры задания и сохраните обновлённую версию.</p>
            </div>

            <div class="admin-form-body">
                @if ($errors->any())
                    <div class="admin-errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="admin-form-grid">
                        <div class="admin-form-group">
                            <label class="admin-form-label" for="lesson_id">Урок</label>
                            <select class="admin-select" name="lesson_id" id="lesson_id">
                                <option value="">Без урока</option>
                                @foreach($lessons as $lesson)
                                    <option value="{{ $lesson->id }}" @selected(old('lesson_id', $task->lesson_id) == $lesson->id)>
                                        {{ $lesson->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="task_number">
                                Номер задания <span class="admin-required">*</span>
                            </label>
                            <input
                                name="task_number"
                                id="task_number"
                                type="number"
                                class="admin-input"
                                value="{{ old('task_number', $task->task_number) }}"
                            >
                        </div>

                        <div class="admin-form-group full">
                            <label class="admin-form-label" for="title">
                                Название задания <span class="admin-required">*</span>
                            </label>
                            <input
                                name="title"
                                id="title"
                                type="text"
                                class="admin-input"
                                value="{{ old('title', $task->title) }}"
                            >
                        </div>

                        <div class="admin-form-group full">
                            <label class="admin-form-label" for="description">Короткое описание</label>
                            <input
                                name="description"
                                id="description"
                                type="text"
                                class="admin-input"
                                value="{{ old('description', $task->description) }}"
                            >
                        </div>

                        <div class="admin-form-group full">
                            <label class="admin-form-label" for="task_text">
                                Полный текст задания <span class="admin-required">*</span>
                            </label>
                            <textarea
                                name="task_text"
                                id="task_text"
                                class="admin-textarea"
                                rows="5"
                            >{{ old('task_text', $task->task_text) }}</textarea>
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="database_schema">
                                Схема базы данных <span class="admin-required">*</span>
                            </label>
                            <select class="admin-select" name="database_schema" id="database_schema">
                                <option selected disabled value="">Выберите схему</option>
                                <option value="aviation" @selected(old('database_schema', $task->database_schema) == 'aviation')>aviation</option>
                                <option value="family" @selected(old('database_schema', $task->database_schema) == 'family')>family</option>
                                <option value="schedule" @selected(old('database_schema', $task->database_schema) == 'schedule')>schedule</option>
                                <option value="booking" @selected(old('database_schema', $task->database_schema) == 'booking')>booking</option>
                                <option value="ecommerce" @selected(old('database_schema', $task->database_schema) == 'ecommerce')>ecommerce</option>
                                <option value="flights" @selected(old('database_schema', $task->database_schema) == 'flights')>flights</option>
                            </select>
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="sql_type">Тип запроса</label>
                            <select class="admin-select" name="sql_type" id="sql_type">
                                <option value="select" @selected(old('sql_type', $task->sql_type) == 'select')>SELECT</option>
                                <option value="join" @selected(old('sql_type', $task->sql_type) == 'join')>JOIN</option>
                                <option value="group" @selected(old('sql_type', $task->sql_type) == 'group')>GROUP BY</option>
                                <option value="update" @selected(old('sql_type', $task->sql_type) == 'update')>UPDATE</option>
                                <option value="delete" @selected(old('sql_type', $task->sql_type) == 'delete')>DELETE</option>
                                <option value="insert" @selected(old('sql_type', $task->sql_type) == 'insert')>INSERT</option>
                            </select>
                        </div>

                        <div class="admin-form-group full">
                            <label class="admin-form-label" for="solution_sql">
                                Правильное решение SQL <span class="admin-required">*</span>
                            </label>
                            <textarea
                                name="solution_sql"
                                id="solution_sql"
                                class="admin-textarea admin-code"
                                rows="5"
                            >{{ old('solution_sql', $task->solution_sql) }}</textarea>
                        </div>

                        <div class="admin-form-group full">
                            <label class="admin-form-label" for="expected_results">
                                Ожидаемый результат JSON <span class="admin-required">*</span>
                            </label>
                            <textarea
                                name="expected_results"
                                id="expected_results"
                                class="admin-textarea admin-code"
                                rows="4"
                            >{{ old('expected_results', json_encode($task->expected_results, JSON_PRETTY_PRINT)) }}</textarea>
                        </div>
                    </div>

                    <div class="admin-divider"></div>

                    <div class="admin-form-grid">
                        <div class="admin-form-group">
                            <label class="admin-form-label" for="difficulty_percent">
                                Сложность % <span class="admin-required">*</span>
                            </label>
                            <div class="admin-input-group">
                                <input
                                    name="difficulty_percent"
                                    id="difficulty_percent"
                                    type="number"
                                    min="0"
                                    max="100"
                                    class="admin-input"
                                    value="{{ old('difficulty_percent', $task->difficulty_percent) }}"
                                >
                                <span>%</span>
                            </div>
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="task_order">Порядок</label>
                            <input
                                name="task_order"
                                id="task_order"
                                type="number"
                                class="admin-input"
                                value="{{ old('task_order', $task->task_order) }}"
                            >
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="points">Очки</label>
                            <input
                                name="points"
                                id="points"
                                type="number"
                                class="admin-input"
                                value="{{ old('points', $task->points) }}"
                            >
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label">Доступность</label>
                            <div class="admin-checkbox-row">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="is_free"
                                    value="1"
                                    id="is_free"
                                    @checked(old('is_free', $task->is_free))
                                >
                                <label for="is_free">Бесплатное задание</label>
                            </div>
                        </div>
                    </div>

                    <div class="admin-divider"></div>

                    <div class="admin-form-grid">
                        <div class="admin-form-group full">
                            <label class="admin-form-label" for="hint">Подсказка</label>
                            <textarea
                                name="hint"
                                id="hint"
                                class="admin-textarea"
                                rows="2"
                            >{{ old('hint', $task->hint) }}</textarea>
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="tags">Теги</label>
                            <input
                                name="tags"
                                id="tags"
                                type="text"
                                class="admin-input"
                                value="{{ old('tags', $task->tags) }}"
                            >
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="company">Компания</label>
                            <input
                                name="company"
                                id="company"
                                type="text"
                                class="admin-input"
                                value="{{ old('company', $task->company) }}"
                            >
                        </div>
                    </div>

                    <div class="admin-form-actions">
                        <a href="{{ route('tasks.index') }}" class="admin-btn admin-btn-secondary">
                            <i class="bi bi-x-circle"></i>
                            <span>Отмена</span>
                        </a>

                        <button type="submit" class="admin-btn admin-btn-primary">
                            <i class="bi bi-check-circle"></i>
                            <span>Сохранить задание</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="admin-side-card">
            <div class="admin-side-body">
                <div class="admin-side-title">Подсказки</div>

                <div class="admin-side-list">
                    <div class="admin-side-item">
                        <i class="bi bi-pencil-square"></i>
                        <div>
                            <strong>Актуализируйте условие</strong>
                            <span>После редактирования проверьте, что текст задания соответствует решению и ожидаемому результату.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-code-slash"></i>
                        <div>
                            <strong>SQL-решение</strong>
                            <span>Поддерживайте эталонный SQL в рабочем состоянии, иначе автопроверка может давать неверный результат.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-braces"></i>
                        <div>
                            <strong>JSON-структура</strong>
                            <span>Проверяйте, чтобы expected_results был валидным и совпадал с фактическим выводом запроса.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-percent"></i>
                        <div>
                            <strong>Сложность и очки</strong>
                            <span>Оценка сложности и количества баллов должна соответствовать реальной трудности задания.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
