@extends('admin.layouts.app')

@section('title', 'Добавление курса — SQLMastery Admin')

@section('page-header')
    <div>
        <div class="admin-breadcrumbs">
            <a href="{{ route('dashboard') }}">Главная</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('courses.index') }}">Курсы</a>
            <i class="bi bi-chevron-right"></i>
            <span>Добавление курса</span>
        </div>

        <h1 class="admin-page-title">Добавление <span>курса</span></h1>
        <p class="admin-page-subtitle">
            Создайте новый курс, заполните основную информацию, описание, уровень и дополнительные данные.
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
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            align-items: center;
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

        .admin-form-label small {
            color: var(--text-muted);
            font-weight: 500;
            margin-left: .35rem;
        }

        .admin-input,
        .admin-select,
        .admin-textarea,
        .admin-file {
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
        .admin-textarea:focus,
        .admin-file:focus {
            border-color: rgba(59,130,246,0.28);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.08);
        }

        .admin-textarea {
            min-height: 140px;
            resize: vertical;
        }

        .admin-help-text {
            color: var(--text-muted);
            font-size: .82rem;
            line-height: 1.5;
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

        .admin-btn-primary {
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 12px 28px rgba(59,130,246,0.24);
        }

        .admin-btn-primary:hover {
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
            color: var(--primary);
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

        @media (max-width: 1200px) {
            .admin-form-page {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .admin-form-grid {
                grid-template-columns: 1fr;
            }

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
                <div>
                    <h2>Новый курс</h2>
                    <p>Заполните данные курса перед публикацией.</p>
                </div>
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

                <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="admin-form-grid">
                        <div class="admin-form-group full">
                            <label class="admin-form-label" for="title">Название курса</label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="admin-input"
                                value="{{ old('title') }}"
                                placeholder="Например: SQL с нуля до продвинутого уровня"
                            >
                        </div>

                        <div class="admin-form-group full">
                            <label class="admin-form-label" for="description">Описание</label>
                            <textarea
                                name="description"
                                id="description"
                                rows="6"
                                class="admin-textarea"
                                placeholder="Кратко опишите содержание и цель курса"
                            >{{ old('description') }}</textarea>
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="start_date">Дата начала</label>
                            <input
                                type="date"
                                name="start_date"
                                id="start_date"
                                class="admin-input"
                                value="{{ old('start_date') }}"
                            >
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="duration">Продолжительность <small>(в месяцах)</small></label>
                            <input
                                type="number"
                                name="duration"
                                id="duration"
                                class="admin-input"
                                value="{{ old('duration') }}"
                                placeholder="Например: 3"
                            >
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="level">Уровень</label>
                            <select name="level" id="level" class="admin-select" required>
                                <option disabled {{ old('level') ? '' : 'selected' }} value="">Выберите уровень...</option>
                                <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="middle" {{ old('level') == 'middle' ? 'selected' : '' }}>Middle</option>
                                <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label" for="image">Изображение курса</label>
                            <input
                                type="file"
                                name="image"
                                id="image"
                                class="admin-file"
                            >
                            <div class="admin-help-text">Рекомендуется загрузить обложку курса.</div>
                        </div>

                        <div class="admin-form-group full">
                            <label class="admin-form-label" for="extra_info">Дополнительная информация</label>
                            <textarea
                                name="extra_info"
                                id="extra_info"
                                rows="5"
                                class="admin-textarea"
                                placeholder="Введите дополнительные детали, условия или особенности курса"
                            >{{ old('extra_info') }}</textarea>
                        </div>
                    </div>

                    <div class="admin-form-actions">
                        <a href="{{ route('courses.index') }}" class="admin-btn admin-btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            <span>Отмена</span>
                        </a>

                        <button type="submit" class="admin-btn admin-btn-primary">
                            <i class="bi bi-plus-circle-fill"></i>
                            <span>Добавить курс</span>
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
                        <i class="bi bi-card-heading"></i>
                        <div>
                            <strong>Чёткое название</strong>
                            <span>Название курса должно сразу объяснять его тему и уровень сложности.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-journal-text"></i>
                        <div>
                            <strong>Полезное описание</strong>
                            <span>Опишите, что изучит пользователь и какую практику получит в курсе.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-bar-chart"></i>
                        <div>
                            <strong>Корректный уровень</strong>
                            <span>Уровень курса помогает пользователю быстрее понять, подходит ли ему материал.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-image"></i>
                        <div>
                            <strong>Обложка курса</strong>
                            <span>Хорошее изображение делает список курсов визуально аккуратнее и понятнее.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
