@extends('admin.layouts.app')

@section('title', 'Редактирование курса — SQLMastery Admin')

@section('page-header')
    <div>
        <div class="admin-breadcrumbs">
            <a href="{{ route('dashboard') }}">Главная</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('courses.index') }}">Курсы</a>
            <i class="bi bi-chevron-right"></i>
            <span>Редактирование курса</span>
        </div>

        <h1 class="admin-page-title">Редактирование <span>курса</span></h1>
        <p class="admin-page-subtitle">
            Обновите название, описание и уровень курса, сохранив текущую структуру и контент.
        </p>
    </div>
@endsection

@section('content')
    <style>
        .admin-form-page {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 1rem;
        }

        .admin-form-card {
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

        .admin-form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.2rem;
        }

        .admin-form-group {
            display: flex;
            flex-direction: column;
            gap: .55rem;
        }

        .admin-form-label {
            color: var(--text-primary);
            font-size: .95rem;
            font-weight: 600;
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
            min-height: 160px;
            resize: vertical;
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

        .admin-errors li + li {
            margin-top: .35rem;
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
            border-color: rgba(59,130,246,0.18);
        }

        .admin-btn-success {
            color: #fff;
            background: linear-gradient(135deg, #22c55e, #059669);
            box-shadow: 0 12px 28px rgba(34,197,94,0.22);
        }

        .admin-btn-success:hover {
            transform: translateY(-2px);
        }

        .admin-side-card {
            position: relative;
            border-radius: 24px;
            border: 1px solid var(--border-color);
            background: var(--panel-bg);
            overflow: hidden;
            backdrop-filter: blur(14px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.18);
            height: fit-content;
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

        #input {
            width: 100%;
            min-height: 220px;
        }

        @media (max-width: 1200px) {
            .admin-form-page {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .admin-form-body,
            .admin-form-head,
            .admin-form-actions {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>

    <div class="admin-form-page">
        <div class="admin-form-card">
            <div class="admin-form-head">
                <h2>Редактирование курса</h2>
                <p>Измените информацию о курсе и сохраните обновления.</p>
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

                <form action="{{ route('courses.update', $course) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="admin-form-grid">
                        <div class="admin-form-group">
                            <label class="admin-form-label" for="title">Название курса</label>
                            <input
                                name="title"
                                id="title"
                                type="text"
                                class="admin-input"
                                value="{{ old('title', $course->title) }}"
                                placeholder="Введите название курса"
                            />
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="input">Описание курса</label>

                            <script>
                                $(document).ready(function () {
                                    $("#input").cleditor();
                                });
                            </script>

                            <textarea id="input" name="description">{{ old('description', $course->description) }}</textarea>
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="level">Уровень</label>
                            <select class="admin-select" name="level" id="level" required>
                                <option disabled value="">Выберите уровень...</option>
                                <option value="beginner" {{ old('level', $course->level) == 'beginner' ? 'selected' : '' }}>
                                    Beginner
                                </option>
                                <option value="middle" {{ old('level', $course->level) == 'middle' ? 'selected' : '' }}>
                                    Middle
                                </option>
                                <option value="advanced" {{ old('level', $course->level) == 'advanced' ? 'selected' : '' }}>
                                    Advanced
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="admin-form-actions">
                        <a href="{{ route('courses.index') }}" class="admin-btn admin-btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            <span>Отмена</span>
                        </a>

                        <button type="submit" class="admin-btn admin-btn-success">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Сохранить</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="admin-side-card">
            <div class="admin-side-body">
                <div class="admin-side-title">Информация</div>

                <div class="admin-side-list">
                    <div class="admin-side-item">
                        <i class="bi bi-pencil-square"></i>
                        <div>
                            <strong>Редактирование названия</strong>
                            <span>Обновите название так, чтобы оно оставалось понятным и последовательным для пользователей.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-text-paragraph"></i>
                        <div>
                            <strong>Описание курса</strong>
                            <span>В описании можно уточнить пользу, структуру курса и ключевые темы обучения.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-bar-chart-steps"></i>
                        <div>
                            <strong>Уровень сложности</strong>
                            <span>Следите, чтобы уровень курса соответствовал реальному содержанию и задачам.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
