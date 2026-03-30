@extends('public.layouts.app')

@section('title', 'Урок: ' . $lesson->title)

@section('styles')
    <style>
        .lesson-page {
            display: flex;
            height: calc(100vh - 72px);
            overflow: hidden;
        }

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

        .lhb-type.practice { background: rgba(34,197,94,0.1); color: var(--success); }
        .lhb-type.theory { background: rgba(59,130,246,0.1); color: var(--primary); }

        .lesson-content {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
        }

        .lesson-content h1,
        .lesson-content h2 {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 1.25rem;
            letter-spacing: -0.02em;
        }

        .lesson-content h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 2rem 0 0.75rem;
            color: var(--text-primary);
        }

        .lesson-content p,
        .lesson-content li {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .lesson-content ul {
            padding-left: 1.25rem;
            margin-bottom: 1rem;
        }

        .theory-code-block {
            background: var(--bg-elevated);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            margin: 1.25rem 0;
        }

        .theory-code-header {
            padding: 0.5rem 1rem;
            background: rgba(0,0,0,0.3);
            border-bottom: 1px solid var(--border-color);
        }

        .theory-code-header span {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-family: 'JetBrains Mono', monospace;
        }

        .theory-code-body {
            padding: 1rem 1.25rem;
            overflow-x: auto;
        }

        .theory-code-body pre {
            margin: 0;
            color: var(--text-primary);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            line-height: 1.8;
        }

        .lesson-footer-nav {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 2rem;
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
        }

        .lesson-footer-link:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        @media (max-width: 1024px) {
            .lesson-sidebar { display: none; }
        }
    </style>
@endsection

@section('content')
    <div class="lesson-page">
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
                    <a href="{{ route('public.courses.show', $moduleLesson) }}"
                       class="ls-item {{ $moduleLesson->id === $lesson->id ? 'active' : '' }}">
                        <div class="ls-dot">
                            {{ $moduleLesson->lesson_order }}
                        </div>
                        <div class="ls-item-info">
                            <div class="ls-item-title">{{ $moduleLesson->title }}</div>
                            <div class="ls-item-meta">
                                {{ $moduleLesson->lesson_type === 'practice' ? 'Практика' : 'Теория' }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </aside>

        <div class="lesson-main">
            <div class="lesson-header-bar">
                <div class="lhb-left">
                    @if($previousLesson)
                        <a href="{{ route('public.courses.show', $previousLesson) }}" class="lhb-nav">
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
                        <a href="{{ route('public.courses.show', $nextLesson) }}" class="lhb-nav">
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
                        {{ $lesson->lesson_type === 'practice' ? 'Практика' : 'Теория' }}
                    </span>
                </div>
            </div>

            <div class="lesson-content">
                @if(!empty($lesson->lecture))
                    @foreach($lesson->lecture as $block)
                        @if($block['type'] === 'heading')
                            <h2>{{ $block['text'] }}</h2>
                        @elseif($block['type'] === 'paragraph')
                            <p>{{ $block['text'] }}</p>
                        @elseif($block['type'] === 'list')
                            <ul>
                                @foreach($block['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @elseif($block['type'] === 'code')
                            <div class="theory-code-block">
                                <div class="theory-code-header">
                                    <span>{{ strtoupper($block['language'] ?? 'CODE') }}</span>
                                </div>
                                <div class="theory-code-body">
                                    <pre><code>{{ $block['content'] }}</code></pre>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <h2>{{ $lesson->title }}</h2>
                    <p>Для этого урока пока нет содержимого.</p>
                @endif

                <div class="lesson-footer-nav">
                    @if($previousLesson)
                        <a href="{{ route('public.courses.show', $previousLesson) }}" class="lesson-footer-link">
                            <i class="bi bi-arrow-left"></i>
                            <span>{{ $previousLesson->title }}</span>
                        </a>
                    @else
                        <span></span>
                    @endif

                    @if($nextLesson)
                        <a href="{{ route('public.courses.show', $nextLesson) }}" class="lesson-footer-link">
                            <span>{{ $nextLesson->title }}</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
