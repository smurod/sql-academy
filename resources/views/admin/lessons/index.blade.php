@extends('admin.layouts.app')

@section('title', 'Список уроков — SQLMastery Admin')

@section('page-header')
    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:1rem;flex-wrap:wrap;">
        <div>
            <div class="admin-breadcrumbs">
                <a href="{{ route('dashboard') }}">Главная</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('modules.index') }}">Модули</a>
                <i class="bi bi-chevron-right"></i>
                <span>Список уроков</span>
            </div>

            <h1 class="admin-page-title">Список <span>уроков</span></h1>
            <p class="admin-page-subtitle">
                Уроки модуля <strong>{{ $module->title }}</strong>: просмотр, редактирование, удаление и управление порядком.
            </p>
        </div>

        <div>
            <a href="{{ route('modules.lessons.create', $module->id) }}" class="admin-index-create-btn">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Добавить урок</span>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <style>
        .admin-index-create-btn {
            display: inline-flex;
            align-items: center;
            gap: .65rem;
            padding: .95rem 1.2rem;
            border-radius: 14px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 12px 28px rgba(59,130,246,0.24);
            transition: all .25s ease;
        }

        .admin-index-create-btn:hover {
            transform: translateY(-2px);
        }

        .admin-table-card {
            position: relative;
            border-radius: 24px;
            border: 1px solid var(--border-color);
            background: var(--panel-bg);
            overflow: hidden;
            backdrop-filter: blur(14px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.22);
        }

        .admin-table-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59,130,246,0.07), rgba(147,51,234,0.04), transparent 60%);
            pointer-events: none;
        }

        .admin-table-head {
            position: relative;
            z-index: 1;
            padding: 1.3rem 1.4rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-table-head h2 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .admin-table-head p {
            margin-top: .35rem;
            color: var(--text-secondary);
            font-size: .88rem;
        }

        .admin-table-wrap {
            position: relative;
            z-index: 1;
            overflow-x: auto;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        .admin-table th {
            text-align: left;
            padding: .95rem 1rem;
            color: var(--text-muted);
            font-size: .76rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }

        .admin-table td {
            padding: 1rem;
            color: var(--text-primary);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: .94rem;
            vertical-align: middle;
        }

        .admin-table tr:hover td {
            background: rgba(255,255,255,0.02);
        }

        .admin-id-badge,
        .admin-order-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            padding: .42rem .6rem;
            border-radius: 999px;
            background: var(--bg-soft);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            font-family: 'JetBrains Mono', monospace;
            font-size: .8rem;
        }

        .admin-lesson-title {
            font-weight: 700;
            color: var(--text-primary);
        }

        .admin-lesson-desc {
            color: var(--text-secondary);
            line-height: 1.55;
            max-width: 340px;
            font-size: .88rem;
        }

        .admin-lesson-type {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            padding: .3rem .65rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 600;
        }

        .admin-lesson-type.theory {
            background: rgba(59,130,246,0.12);
            color: #60a5fa;
            border: 1px solid rgba(59,130,246,0.2);
        }

        .admin-lesson-type.practice {
            background: rgba(34,197,94,0.12);
            color: #4ade80;
            border: 1px solid rgba(34,197,94,0.2);
        }

        .admin-lesson-type.parent {
            background: rgba(168,85,247,0.12);
            color: #c084fc;
            border: 1px solid rgba(168,85,247,0.2);
        }

        .admin-action-btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .75rem .95rem;
            border-radius: 12px;
            font-size: .86rem;
            font-weight: 600;
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            color: var(--text-primary);
            transition: all .22s ease;
            cursor: pointer;
        }

        .admin-action-btn:hover { transform: translateY(-2px); }

        .admin-action-btn.info:hover {
            border-color: rgba(6,182,212,0.2);
            background: rgba(6,182,212,0.08);
        }

        .admin-action-btn.danger:hover {
            border-color: rgba(239,68,68,0.2);
            background: rgba(239,68,68,0.08);
        }

        .admin-inline-form { margin: 0; }

        .admin-empty-state {
            position: relative;
            z-index: 1;
            padding: 2rem 1.5rem;
            color: var(--text-secondary);
        }
    </style>

    <div class="admin-table-card">
        <div class="admin-table-head">
            <h2>Уроки модуля</h2>
            <p>Модуль: {{ $module->title }} · Всего уроков: {{ $module->lessons->count() }}</p>
        </div>

        @if($module->lessons->count())
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название урока</th>
                        <th>Содержимое</th>
                        <th>Тип</th>
                        <th>Позиция</th>
                        <th>XP</th>
                        <th>Изменить</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($module->lessons as $lesson)
                        <tr>
                            <td>
                                <span class="admin-id-badge">#{{ $lesson->id }}</span>
                            </td>

                            <td>
                                <div class="admin-lesson-title">{{ $lesson->title }}</div>
                            </td>

                            <td>
                                @php
                                    $preview = $lesson->content
                                        ? \Illuminate\Support\Str::limit(
                                            strip_tags($lesson->content),
                                            80
                                          )
                                        : '— нет содержимого —';
                                @endphp
                                <div class="admin-lesson-desc">
                                    {{ $preview }}
                                </div>
                            </td>

                            <td>
                                @php
                                    $typeMap = [
                                        'theory'   => ['label' => 'Теория',       'class' => 'theory'],
                                        'practice' => ['label' => 'Практика',     'class' => 'practice'],
                                        'parent'   => ['label' => 'Родительский', 'class' => 'parent'],
                                    ];
                                    $type = $typeMap[$lesson->lesson_type]
                                        ?? ['label' => $lesson->lesson_type, 'class' => 'theory'];
                                @endphp
                                <span class="admin-lesson-type {{ $type['class'] }}">
                                        {{ $type['label'] }}
                                    </span>
                            </td>

                            <td>
                                <span class="admin-order-badge">{{ $lesson->lesson_order }}</span>
                            </td>

                            <td>
                                <span class="admin-order-badge">{{ $lesson->xp }}</span>
                            </td>

                            <td>
                                <a class="admin-action-btn info" href="{{ route('lessons.edit', $lesson) }}">
                                    <i class="bi bi-pencil-square"></i>
                                    <span>Изменить</span>
                                </a>
                            </td>

                            <td>
                                <form
                                    action="{{ route('lessons.destroy', $lesson) }}"
                                    method="POST"
                                    class="admin-inline-form"
                                    onsubmit="return confirm('Удалить урок «{{ $lesson->title }}»?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-action-btn danger">
                                        <i class="bi bi-trash3"></i>
                                        <span>Удалить</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="admin-empty-state">
                В этом модуле пока нет уроков.
            </div>
        @endif
    </div>
@endsection
