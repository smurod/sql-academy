@extends('admin.layouts.app')

@section('title', 'Редактирование модуля — SQLMastery Admin')

@section('page-header')
    <div>
        <div class="admin-breadcrumbs">
            <a href="{{ route('dashboard') }}">Главная</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('modules.index') }}">Модули</a>
            <i class="bi bi-chevron-right"></i>
            <span>Редактирование модуля</span>
        </div>

        <h1 class="admin-page-title">Редактирование <span>модуля</span></h1>
        <p class="admin-page-subtitle">
            Обновите информацию о модуле, его slug, порядок отображения и описание.
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
        .admin-textarea:focus {
            border-color: rgba(59,130,246,0.28);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.08);
        }

        .admin-textarea {
            min-height: 160px;
            resize: vertical;
        }

        .admin-help-text {
            color: var(--text-muted);
            font-size: .82rem;
            line-height: 1.5;
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

        @media (max-width: 1200px) {
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
                <h2>Редактирование модуля: {{ $module->title }}</h2>
                <p>Измените основные параметры модуля и сохраните обновления.</p>
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

                <form action="{{ route('modules.update', $module) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="course_id" value="1">

                    <div class="admin-form-grid">
                        <div class="admin-form-group">
                            <label for="title" class="admin-form-label">
                                Название модуля <span class="admin-required">*</span>
                            </label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="admin-input"
                                placeholder="Введите название модуля"
                                value="{{ old('title', $module->title) }}"
                                required
                            />
                        </div>

                        <div class="admin-form-group">
                            <label for="slug" class="admin-form-label">
                                Slug модуля <span class="admin-required">*</span>
                            </label>
                            <input
                                type="text"
                                name="slug"
                                id="slug"
                                class="admin-input"
                                placeholder="Введите slug модуля"
                                value="{{ old('slug', $module->slug) }}"
                                required
                            />
                            <div class="admin-help-text">Например: sql-joins-basics</div>
                        </div>

                        <div class="admin-form-group">
                            <label for="order_index" class="admin-form-label">
                                Порядковый номер <span class="admin-required">*</span>
                            </label>
                            <input
                                type="number"
                                name="order_index"
                                id="order_index"
                                class="admin-input"
                                placeholder="Введите порядковый номер"
                                value="{{ old('order_index', $module->order_index) }}"
                                min="1"
                                required
                            />
                        </div>

                        <div class="admin-form-group full">
                            <label for="description" class="admin-form-label">Описание</label>
                            <textarea
                                name="description"
                                id="description"
                                class="admin-textarea"
                                rows="6"
                                placeholder="Введите описание модуля"
                            >{{ old('description', $module->description) }}</textarea>
                        </div>
                    </div>

                    <div class="admin-form-actions">
                        <a href="{{ route('modules.index') }}" class="admin-btn admin-btn-secondary">
                            <i class="bi bi-x-circle"></i>
                            <span>Отмена</span>
                        </a>

                        <button type="submit" class="admin-btn admin-btn-primary">
                            <i class="bi bi-save"></i>
                            <span>Сохранить изменения</span>
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
                            <strong>Обновляйте структуру аккуратно</strong>
                            <span>Изменение slug и порядка может повлиять на логику отображения материалов курса.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-list-ol"></i>
                        <div>
                            <strong>Порядок модуля</strong>
                            <span>Проверьте, что после изменений модуль остаётся на нужной позиции в программе курса.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-journal-text"></i>
                        <div>
                            <strong>Описание</strong>
                            <span>Краткое и понятное описание поможет быстрее ориентироваться в структуре курса.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
