@extends('admin.layouts.app')

@section('title', 'Просмотр урока — SQLMastery Admin')

@section('page-header')
    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:1rem;flex-wrap:wrap;">
        <div>
            <div class="admin-breadcrumbs">
                <a href="{{ route('dashboard') }}">Главная</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('modules.index') }}">Модули</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('modules.show', $lesson->module_id) }}">Уроки</a>
                <i class="bi bi-chevron-right"></i>
                <span>Просмотр урока</span>
            </div>

            <h1 class="admin-page-title">Просмотр <span>урока</span></h1>
            <p class="admin-page-subtitle">
                Детальная информация по уроку и его содержимое.
            </p>
        </div>

        <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
            <a href="{{ route('lessons.edit', $lesson) }}" class="admin-show-btn primary">
                <i class="bi bi-pencil-square"></i>
                <span>Редактировать</span>
            </a>
        </div>
    </div>
@endsection

@section('content')
    {{-- Prism.js — подсветка кода который генерирует TinyMCE codesample --}}
    {{-- TinyMCE создаёт: <pre><code class="language-sql">...</code></pre> --}}
    {{-- Prism.js автоматически подсвечивает такие блоки --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css"
    />

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
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            align-items: flex-start;
            flex-wrap: wrap;
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

        /* ── Инфо-блоки ── */
        .admin-show-info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
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

        /* Бейдж типа урока */
        .lesson-type-badge {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .3rem .75rem;
            border-radius: 999px;
            font-size: .82rem;
            font-weight: 600;
        }

        .lesson-type-badge.theory {
            background: rgba(59,130,246,0.12);
            color: #60a5fa;
            border: 1px solid rgba(59,130,246,0.2);
        }

        .lesson-type-badge.practice {
            background: rgba(34,197,94,0.12);
            color: #4ade80;
            border: 1px solid rgba(34,197,94,0.2);
        }

        .lesson-type-badge.parent {
            background: rgba(168,85,247,0.12);
            color: #c084fc;
            border: 1px solid rgba(168,85,247,0.2);
        }

        /* ── Контент урока (HTML из TinyMCE) ── */
        .admin-lesson-content {
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            border-radius: 18px;
            padding: 1.5rem 1.75rem;
            line-height: 1.85;
            color: var(--text-primary);
        }

        .admin-lesson-content h1,
        .admin-lesson-content h2,
        .admin-lesson-content h3,
        .admin-lesson-content h4 {
            font-weight: 700;
            margin-top: 1.75rem;
            margin-bottom: .75rem;
            color: var(--text-primary);
        }

        .admin-lesson-content h2 {
            font-size: 1.25rem;
            padding-bottom: .5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-lesson-content h3 {
            font-size: 1.05rem;
        }

        .admin-lesson-content p {
            margin-bottom: 1rem;
            color: var(--text-secondary);
        }

        .admin-lesson-content ul,
        .admin-lesson-content ol {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .admin-lesson-content li {
            margin-bottom: .4rem;
            color: var(--text-secondary);
        }

        /* Инлайн код */
        .admin-lesson-content code:not(pre code) {
            background: rgba(59,130,246,0.1);
            color: #60a5fa;
            padding: .2rem .45rem;
            border-radius: 6px;
            font-family: 'JetBrains Mono', monospace;
            font-size: .88em;
        }

        /* Блоки кода от TinyMCE codesample + Prism.js */
        .admin-lesson-content pre {
            border-radius: 14px !important;
            margin: 1.25rem 0 !important;
            overflow-x: auto;
        }

        .admin-lesson-content pre code {
            font-family: 'JetBrains Mono', monospace !important;
            font-size: .88rem !important;
        }

        /* Таблицы */
        .admin-lesson-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.25rem 0;
            font-size: .92rem;
        }

        .admin-lesson-content th {
            background: var(--bg-soft);
            border: 1px solid var(--border-color);
            padding: .65rem 1rem;
            text-align: left;
            font-weight: 700;
            color: var(--text-primary);
        }

        .admin-lesson-content td {
            border: 1px solid var(--border-color);
            padding: .6rem 1rem;
            color: var(--text-secondary);
        }

        .admin-lesson-content tr:hover td {
            background: rgba(255,255,255,0.02);
        }

        /* Пустой контент */
        .admin-content-empty {
            border: 2px dashed var(--border-color);
            border-radius: 18px;
            padding: 2.5rem;
            text-align: center;
            color: var(--text-muted);
        }

        .admin-content-empty i {
            font-size: 2rem;
            display: block;
            margin-bottom: .75rem;
            opacity: .5;
        }

        /* ── Футер ── */
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
            cursor: pointer;
        }

        .admin-show-btn.secondary {
            background: var(--bg-soft);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .admin-show-btn.secondary:hover { transform: translateY(-2px); }

        .admin-show-btn.primary {
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 12px 28px rgba(59,130,246,0.24);
        }

        .admin-show-btn.primary:hover { transform: translateY(-2px); }

        .admin-show-btn.danger {
            color: #fff;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            box-shadow: 0 12px 28px rgba(239,68,68,0.20);
        }

        .admin-show-btn.danger:hover { transform: translateY(-2px); }

        .admin-delete-form { margin: 0; }

        /* ── Боковая панель ── */
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
            .admin-show-layout { grid-template-columns: 1fr; }
        }

        @media (max-width: 900px) {
            .admin-show-info-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 500px) {
            .admin-show-info-grid { grid-template-columns: 1fr; }
        }
    </style>

    <div class="admin-show-layout">

        {{-- ── Основная карточка ── --}}
        <div class="admin-show-card">
            <div class="admin-show-head">
                <div>
                    <h2>{{ $lesson->title }}</h2>
                    <p>Модуль: <strong>{{ $lesson->module->title }}</strong></p>
                </div>
            </div>

            <div class="admin-show-body">

                {{-- Инфо-блоки --}}
                <div class="admin-show-info-grid">
                    <div class="admin-info-box">
                        <label>ID урока</label>
                        <div>#{{ $lesson->id }}</div>
                    </div>

                    <div class="admin-info-box">
                        <label>Порядок</label>
                        <div>{{ $lesson->lesson_order }}</div>
                    </div>

                    <div class="admin-info-box">
                        <label>Тип</label>
                        <div>
                            @php
                                $typeMap = [
                                    'theory'   => ['label' => 'Теория',       'class' => 'theory'],
                                    'practice' => ['label' => 'Практика',     'class' => 'practice'],
                                    'parent'   => ['label' => 'Родительский', 'class' => 'parent'],
                                ];
                                $type = $typeMap[$lesson->lesson_type] ?? ['label' => $lesson->lesson_type, 'class' => 'theory'];
                            @endphp
                            <span class="lesson-type-badge {{ $type['class'] }}">
                                {{ $type['label'] }}
                            </span>
                        </div>
                    </div>

                    <div class="admin-info-box">
                        <label>Обновлён</label>
                        <div>{{ $lesson->updated_at->format('d.m.Y') }}</div>
                    </div>
                </div>

                {{-- HTML контент урока --}}
                @if($lesson->content)
                    {{--
                        {!! !!} — выводим HTML как есть, без экранирования
                        Безопасно т.к. контент вводит только admin через TinyMCE
                    --}}
                    <div class="admin-lesson-content">
                        {!! $lesson->content !!}
                    </div>
                @else
                    <div class="admin-content-empty">
                        <i class="bi bi-file-earmark-x"></i>
                        <p>Содержимое урока ещё не добавлено.</p>
                        <a href="{{ route('lessons.edit', $lesson) }}" class="admin-show-btn primary" style="margin-top:.75rem;display:inline-flex;">
                            <i class="bi bi-pencil"></i>
                            <span>Добавить содержимое</span>
                        </a>
                    </div>
                @endif

            </div>

            <div class="admin-show-footer">
                <a href="{{ route('modules.show', $lesson->module_id) }}" class="admin-show-btn secondary">
                    <i class="bi bi-arrow-left"></i>
                    <span>Назад к списку уроков</span>
                </a>

                <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
                    <a href="{{ route('lessons.edit', $lesson) }}" class="admin-show-btn primary">
                        <i class="bi bi-pencil"></i>
                        <span>Редактировать</span>
                    </a>

                    <form
                        action="{{ route('lessons.destroy', $lesson) }}"
                        method="POST"
                        class="admin-delete-form"
                        onsubmit="return confirm('Удалить урок «{{ $lesson->title }}»? Это действие необратимо.');"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin-show-btn danger">
                            <i class="bi bi-trash"></i>
                            <span>Удалить</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ── Боковая панель ── --}}
        <div class="admin-show-side">
            <div class="admin-side-body">
                <div class="admin-side-title">Информация</div>

                <div class="admin-side-list">
                    <div class="admin-side-item">
                        <i class="bi bi-journal-text"></i>
                        <div>
                            <strong>Содержимое урока</strong>
                            <span>Здесь отображается HTML-контент урока в том виде, в котором его увидят студенты.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-code-slash"></i>
                        <div>
                            <strong>Подсветка кода</strong>
                            <span>Блоки кода, добавленные через «Code Sample» в редакторе, автоматически подсвечиваются.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-pencil-square"></i>
                        <div>
                            <strong>Редактирование</strong>
                            <span>Нажмите «Редактировать» чтобы изменить содержимое урока через визуальный редактор.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-trash3"></i>
                        <div>
                            <strong>Удаление</strong>
                            <span>Удаляйте урок только если уверены — это действие необратимо.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Prism.js скрипты — подсвечивают код после загрузки страницы --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-sql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-json.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-bash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup.min.js"></script>

    <script>
        // Запускаем подсветку после загрузки
        document.addEventListener('DOMContentLoaded', () => {
            Prism.highlightAll();
        });
    </script>
@endsection
