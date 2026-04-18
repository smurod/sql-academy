@extends('admin.layouts.app')

@section('title', 'Просмотр задания — SQLMastery Admin')

@section('page-header')
    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:1rem;flex-wrap:wrap;">
        <div>
            <div class="admin-breadcrumbs">
                <a href="{{ route('dashboard') }}">Главная</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('tasks.index') }}">Задания</a>
                <i class="bi bi-chevron-right"></i>
                <span>Просмотр задания</span>
            </div>

            <h1 class="admin-page-title">Просмотр <span>задания</span></h1>
            <p class="admin-page-subtitle">
                Детальный просмотр задания, связанного урока, текста и параметров сложности.
            </p>
        </div>

        <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
            <a href="{{ route('tasks.edit', $task) }}" class="admin-show-btn primary">
                <i class="bi bi-pencil-square"></i>
                <span>Редактировать</span>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <style>
        .admin-show-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 1rem;
        }

        .admin-show-card,
        .admin-show-side {
            position: relative;
            border-radius: 24px;
            border: 1px solid var(--border-color);
            background: var(--panel-bg);
            overflow: hidden;
            backdrop-filter: blur(14px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.22);
        }

        .admin-show-card::before,
        .admin-show-side::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59,130,246,0.07), rgba(147,51,234,0.04), transparent 60%);
            pointer-events: none;
        }

        .admin-show-head {
            position: relative;
            z-index: 1;
            padding: 1.35rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-show-head h2 {
            font-size: 1.2rem;
            font-weight: 800;
            margin: 0;
        }

        .admin-show-head p {
            margin-top: .35rem;
            color: var(--text-secondary);
            font-size: .9rem;
        }

        .admin-show-body {
            position: relative;
            z-index: 1;
            padding: 1.5rem;
        }

        .admin-show-info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.2rem;
        }

        .admin-info-box {
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            border-radius: 18px;
            padding: 1rem;
        }

        .admin-info-box label {
            display: block;
            color: var(--text-muted);
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: .45rem;
        }

        .admin-info-box div {
            color: var(--text-primary);
            font-weight: 600;
            line-height: 1.5;
        }

        .admin-show-section + .admin-show-section {
            margin-top: 1.2rem;
        }

        .admin-show-section-title {
            font-size: .98rem;
            font-weight: 700;
            margin-bottom: .65rem;
        }

        .admin-show-block {
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            border-radius: 18px;
            padding: 1rem 1.1rem;
            color: var(--text-secondary);
            line-height: 1.7;
            white-space: pre-wrap;
        }

        .admin-show-footer {
            position: relative;
            z-index: 1;
            padding: 1.25rem 1.5rem 1.5rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: .75rem;
            flex-wrap: wrap;
        }

        .admin-show-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .65rem;
            padding: .92rem 1.2rem;
            border-radius: 14px;
            font-weight: 600;
            border: 1px solid transparent;
            transition: all .25s ease;
        }

        .admin-show-btn.secondary {
            background: var(--bg-soft);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .admin-show-btn.secondary:hover {
            transform: translateY(-2px);
        }

        .admin-show-btn.primary {
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 12px 28px rgba(59,130,246,0.24);
        }

        .admin-show-btn.primary:hover {
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
            .admin-show-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .admin-show-info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="admin-show-layout">
        <div class="admin-show-card">
            <div class="admin-show-head">
                <h2>{{ $task->title }}</h2>
                <p>Просмотр содержимого задания и его основных параметров.</p>
            </div>

            <div class="admin-show-body">
                <div class="admin-show-info-grid">
                    <div class="admin-info-box">
                        <label>ID</label>
                        <div>#{{ $task->id }}</div>
                    </div>

                    <div class="admin-info-box">
                        <label>ID урока</label>
                        <div>{{ $task->lesson_id ?? 'Не указан' }}</div>
                    </div>

                    <div class="admin-info-box">
                        <label>Сложность</label>
                        <div>
                            @if(!empty($task->difficulty))
                                {{ $task->difficulty }}
                            @else
                                Не указано
                            @endif
                        </div>
                    </div>
                </div>

                <div class="admin-show-section">
                    <div class="admin-show-section-title">Название</div>
                    <div class="admin-show-block">{{ $task->title }}</div>
                </div>

                <div class="admin-show-section">
                    <div class="admin-show-section-title">Текст задания</div>
                    <div class="admin-show-block">{{ $task->task_text }}</div>
                </div>
            </div>

            <div class="admin-show-footer">
                <a href="{{ route('tasks.index') }}" class="admin-show-btn secondary">
                    <i class="bi bi-arrow-left"></i>
                    <span>Назад</span>
                </a>

                <a href="{{ route('tasks.edit', $task) }}" class="admin-show-btn primary">
                    <i class="bi bi-pencil-square"></i>
                    <span>Редактировать</span>
                </a>
            </div>
        </div>

        <div class="admin-show-side">
            <div class="admin-side-body">
                <div class="admin-side-title">Информация</div>

                <div class="admin-side-list">
                    <div class="admin-side-item">
                        <i class="bi bi-list-check"></i>
                        <div>
                            <strong>Просмотр задания</strong>
                            <span>На этой странице отображаются основные сведения о выбранном SQL-задании.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-pencil-square"></i>
                        <div>
                            <strong>Редактирование</strong>
                            <span>Если данные неактуальны, вы можете сразу перейти к редактированию задания.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-arrow-return-left"></i>
                        <div>
                            <strong>Навигация</strong>
                            <span>Используйте кнопку «Назад», чтобы быстро вернуться к общему списку заданий.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
