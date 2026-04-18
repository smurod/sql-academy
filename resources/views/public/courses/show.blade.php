@extends('public.layouts.app')

@section('title', 'Урок: ' . $lesson->title)

@section('styles')
    {{-- Prism.js тема для подсветки кода --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css"
    />

    <style>
        .lesson-page {
            display: flex;
            height: calc(100vh - 72px);
            overflow: hidden;
        }

        /* ── Сайдбар ── */
        .lesson-sidebar {
            width: 320px;
            min-width: 320px;
            background: var(--bg-card);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .ls-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
        }

        .ls-back {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
            transition: color 0.3s ease;
        }

        .ls-back:hover { color: var(--primary); }

        .ls-module-title {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 0.375rem;
        }

        .ls-module-info {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 0.375rem;
        }

        .ls-lessons {
            flex: 1;
            overflow-y: auto;
            padding: 0.5rem 0;
        }

        .ls-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.25rem;
            transition: all 0.3s ease;
            color: inherit;
            border-left: 3px solid transparent;
            text-decoration: none;
        }

        .ls-item:hover { background: rgba(255,255,255,0.03); }

        .ls-item.active {
            background: rgba(59,130,246,0.08);
            border-left-color: var(--primary);
        }

        .ls-dot {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            flex-shrink: 0;
            background: rgba(255,255,255,0.05);
            color: var(--text-muted);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .ls-item.active .ls-dot {
            background: var(--primary);
            color: white;
            box-shadow: 0 0 10px var(--glow-primary);
        }

        .ls-item-info {
            flex: 1;
            min-width: 0;
        }

        .ls-item-title {
            font-size: 0.825rem;
            font-weight: 500;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ls-item.active .ls-item-title {
            color: var(--primary);
            font-weight: 600;
        }

        .ls-item-meta {
            font-size: 0.65rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.125rem;
        }

        /* ── Основная область ── */
        .lesson-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        .lesson-header-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1.5rem;
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .lhb-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .lhb-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .lhb-nav:hover { border-color: var(--primary); color: var(--primary); }
        .lhb-nav.disabled { opacity: 0.3; pointer-events: none; }

        .lhb-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .lhb-num {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-weight: 700;
            font-size: 0.75rem;
            padding: 0.3rem 0.625rem;
            border-radius: 8px;
        }

        .lhb-title {
            font-weight: 600;
            font-size: 1rem;
        }

        .lhb-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .lhb-type {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.8rem;
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
            font-weight: 500;
        }

        .lhb-type.practice { background: rgba(34,197,94,0.1);  color: var(--success); }
        .lhb-type.theory   { background: rgba(59,130,246,0.1); color: var(--primary); }
        .lhb-type.parent   { background: rgba(168,85,247,0.1); color: #c084fc; }

        /* ── Скролл-область контента ── */
        .lesson-content {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
        }

        /* ── HTML контент из TinyMCE ── */
        .lesson-body {
            max-width: 820px;
        }

        .lesson-body h1,
        .lesson-body h2 {
            font-size: 1.45rem;
            font-weight: 800;
            margin-top: 2rem;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
            color: var(--text-primary);
        }

        .lesson-body h2:first-child {
            margin-top: 0;
        }

        .lesson-body h3 {
            font-size: 1.08rem;
            font-weight: 700;
            margin: 1.75rem 0 0.65rem;
            color: var(--text-primary);
        }

        .lesson-body p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.85;
            margin-bottom: 1rem;
        }

        .lesson-body ul,
        .lesson-body ol {
            padding-left: 1.35rem;
            margin-bottom: 1rem;
        }

        .lesson-body li {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.8;
            margin-bottom: 0.35rem;
        }

        /* Инлайн код */
        .lesson-body code:not(pre code) {
            background: rgba(59,130,246,0.12);
            color: #60a5fa;
            padding: 0.18rem 0.45rem;
            border-radius: 6px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.86em;
        }

        /* Блоки кода — Prism.js стилизация */
        .lesson-body pre {
            border-radius: 12px !important;
            margin: 1.25rem 0 !important;
            overflow-x: auto;
            border: 1px solid rgba(255,255,255,0.06) !important;
        }

        .lesson-body pre code {
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 0.85rem !important;
            line-height: 1.75 !important;
        }

        /* Таблицы */
        .lesson-body table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.25rem 0;
            font-size: 0.9rem;
        }

        .lesson-body th {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border-color);
            padding: 0.6rem 1rem;
            text-align: left;
            font-weight: 700;
            color: var(--text-primary);
        }

        .lesson-body td {
            border: 1px solid var(--border-color);
            padding: 0.55rem 1rem;
            color: var(--text-secondary);
        }

        .lesson-body tr:hover td {
            background: rgba(255,255,255,0.02);
        }

        /* Пустой контент */
        .lesson-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            text-align: center;
            color: var(--text-muted);
            gap: 1rem;
        }

        .lesson-empty i {
            font-size: 3rem;
            opacity: 0.4;
        }

        /* ── Навигация внизу ── */
        .lesson-footer-nav {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .lesson-footer-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: var(--text-primary);
            padding: 0.75rem 1rem;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            background: rgba(255,255,255,0.03);
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.25s ease;
            max-width: 260px;
        }

        .lesson-footer-link span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .lesson-footer-link:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(59,130,246,0.06);
        }

        @media (max-width: 1024px) {
            .lesson-sidebar { display: none; }
        }

        @media (max-width: 640px) {
            .lesson-content { padding: 1.25rem; }
            .lhb-title { display: none; }
        }
    </style>
@endsection

@section('content')
    <div class="lesson-page">

        {{-- ── Сайдбар со списком уроков ── --}}
        <aside class="lesson-sidebar">
            <div class="ls-header">
                <a href="{{ route('public.courses.index') }}" class="ls-back">
                    <i class="bi bi-arrow-left"></i> Назад к курсу
                </a>

                <div class="ls-module-title">
                    Модуль {{ $module->order_index }} · {{ $module->title }}
                </div>

                <div class="ls-module-info">
                    Урок {{ $lesson->lesson_order }} из {{ $moduleLessons->count() }}
                </div>
            </div>

            <div class="ls-lessons">
                @foreach($moduleLessons as $moduleLesson)
                    <a
                        href="{{ route('public.courses.show', $moduleLesson) }}"
                        class="ls-item {{ $moduleLesson->id === $lesson->id ? 'active' : '' }}"
                    >
                        <div class="ls-dot">{{ $moduleLesson->lesson_order }}</div>
                        <div class="ls-item-info">
                            <div class="ls-item-title">{{ $moduleLesson->title }}</div>
                            <div class="ls-item-meta">
                                @if($moduleLesson->lesson_type === 'practice')
                                    <i class="bi bi-code-slash"></i> Практика
                                @elseif($moduleLesson->lesson_type === 'parent')
                                    <i class="bi bi-folder"></i> Раздел
                                @else
                                    <i class="bi bi-book"></i> Теория
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </aside>

        {{-- ── Основная область ── --}}
        <div class="lesson-main">

            {{-- Верхняя панель навигации --}}
            <div class="lesson-header-bar">
                <div class="lhb-left">
                    @if($previousLesson)
                        <a href="{{ route('public.courses.show', $previousLesson) }}" class="lhb-nav" title="{{ $previousLesson->title }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    @else
                        <span class="lhb-nav disabled">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                    @endif

                    <div class="lhb-info">
                        <span class="lhb-num">#{{ $lesson->lesson_order }}</span>
                        <span class="lhb-title">{{ $lesson->title }}</span>
                    </div>

                    @if($nextLesson)
                        <a href="{{ route('public.courses.show', $nextLesson) }}" class="lhb-nav" title="{{ $nextLesson->title }}">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    @else
                        <span class="lhb-nav disabled">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    @endif
                </div>

                <div class="lhb-right">
                    <span class="lhb-type {{ $lesson->lesson_type }}">
                        @if($lesson->lesson_type === 'practice')
                            <i class="bi bi-code-slash"></i> Практика
                        @elseif($lesson->lesson_type === 'parent')
                            <i class="bi bi-folder"></i> Раздел
                        @else
                            <i class="bi bi-book"></i> Теория
                        @endif
                    </span>
                </div>
            </div>

            {{-- Контент урока --}}
            <div class="lesson-content">
                @if($lesson->content)
                    {{--
                        Выводим HTML из TinyMCE напрямую.
                        Prism.js автоматически подсветит все
                        <pre><code class="language-sql">...</code></pre>
                    --}}
                    <div class="lesson-body">
                        {!! $lesson->content !!}
                    </div>
                @else
                    <div class="lesson-empty">
                        <i class="bi bi-file-earmark-x"></i>
                        <p>Содержимое этого урока пока не добавлено.</p>
                    </div>
                @endif

                {{-- Нижняя навигация между уроками --}}
                <div class="lesson-footer-nav">
                    @if($previousLesson)
                        <a href="{{ route('public.courses.show', $previousLesson) }}" class="lesson-footer-link">
                            <i class="bi bi-arrow-left" style="flex-shrink:0;"></i>
                            <span>{{ $previousLesson->title }}</span>
                        </a>
                    @else
                        <span></span>
                    @endif

                    @if($nextLesson)
                        <a href="{{ route('public.courses.show', $nextLesson) }}" class="lesson-footer-link" style="margin-left:auto;">
                            <span>{{ $nextLesson->title }}</span>
                            <i class="bi bi-arrow-right" style="flex-shrink:0;"></i>
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    {{-- Prism.js — подсветка синтаксиса --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-sql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-json.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-bash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Запускаем подсветку кода
            Prism.highlightAll();
        });
    </script>
@endsection
