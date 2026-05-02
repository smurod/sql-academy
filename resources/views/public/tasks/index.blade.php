@extends('public.layouts.app')

@section('title', 'SQL Тренажёр — Список задач')

@section('styles')
    <style>

        /* Поиск */
        .tasks-search {
            position: relative;
            flex: 1;
            min-width: 250px;
        }

        .tasks-search i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .tasks-search input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .tasks-search input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(99, 102, 241, 0.05);
        }

        /* Фильтр-кнопки */
        .filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .filter-btn:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .filter-btn.active {
            background: rgba(99, 102, 241, 0.15);
            color: var(--primary);
            border-color: var(--primary);
        }

        .filter-btn .count {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.1rem 0.5rem;
            border-radius: 8px;
            font-size: 0.75rem;
        }

        .filter-btn.active .count {
            background: rgba(99, 102, 241, 0.2);
        }

        /* Категории */
        .category-tabs {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .category-tab {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .category-tab:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--text-primary);
        }

        .category-tab.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .category-tab .count {
            background: rgba(255, 255, 255, 0.15);
            padding: 0.1rem 0.5rem;
            border-radius: 8px;
            font-size: 0.75rem;
        }

        .category-tab.active .count {
            background: rgba(255, 255, 255, 0.25);
        }

        .tasks-pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .page-btn:hover:not(.disabled):not(.active) {
            background: rgba(99, 102, 241, 0.2);
            color: var(--primary);
            border-color: var(--primary);
        }

        .page-btn.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            cursor: default;
        }

        .page-btn.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* ── TASKS PAGE ── */
        .tasks-page {
            padding: 2rem 0 4rem;
        }

        .tasks-page .section-inner {
            max-width: 1400px;
        }

        /* ── PAGE HEADER ── */
        .tasks-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .tasks-page-header-left h1 {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .tasks-page-header-left p {
            color: var(--text-secondary);
            margin-top: 0.5rem;
            font-size: 1rem;
        }

        /* ── PROGRESS BAR ── */
        .tasks-progress-bar {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.25rem 1.5rem;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .tasks-progress-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .tasks-progress-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--text-primary);
            flex-shrink: 0;
        }

        .tasks-progress-text strong {
            display: block;
            font-size: 1rem;
        }

        .tasks-progress-text span {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .tasks-progress-track {
            flex: 1;
            min-width: 200px;
            height: 10px;
            background: rgba(255,255,255,0.08);
            border-radius: 5px;
            overflow: hidden;
        }

        .tasks-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--success));
            border-radius: 5px;
            transition: width 0.6s ease;
        }

        .tasks-progress-percent {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--success);
            flex-shrink: 0;
        }

        /* ── FILTERS ── */
        .tasks-filters {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .tasks-search {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .tasks-search i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem;
        }

        .tasks-search input {
            width: 100%;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            color: var(--text-primary);
            font-size: 0.9rem;
            font-family: inherit;
            outline: none;
            transition: all 0.3s ease;
        }

        .tasks-search input::placeholder {
            color: var(--text-muted);
        }

        .tasks-search input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
        }

        .filter-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-family: inherit;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .filter-btn:hover {
            border-color: var(--primary);
            color: var(--text-primary);
        }

        .filter-btn.active {
            background: rgba(59,130,246,0.15);
            border-color: var(--primary);
            color: var(--primary);
        }

        /* ── CATEGORY TABS ── */
        .category-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
            scrollbar-width: none;
        }

        .category-tabs::-webkit-scrollbar {
            display: none;
        }

        .category-tab {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            font-family: inherit;
            transition: all 0.3s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .category-tab:hover {
            border-color: var(--primary);
            color: var(--text-primary);
            background: rgba(59,130,246,0.08);
        }

        .category-tab.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--text-primary);
            box-shadow: 0 4px 15px var(--glow-primary);
        }

        .category-tab .count {
            background: rgba(255,255,255,0.15);
            padding: 0.125rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .category-tab.active .count {
            background: rgba(255,255,255,0.25);
        }

        /* ── TASK LIST ── */
        .tasks-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .task-card {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            padding: 1.25rem 1.5rem;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .task-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            border-radius: 4px 0 0 4px;
            transition: all 0.3s ease;
        }

        .task-card.solved::before {
            background: var(--success);
        }

        .task-card.unsolved::before {
            background: transparent;
        }

        .task-card:hover {
            border-color: rgba(59,130,246,0.3);
            transform: translateX(4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        .task-card:hover::before {
            width: 5px;
        }

        .task-number {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .task-number.solved {
            background: rgba(34,197,94,0.15);
            color: var(--success);
        }

        .task-number.unsolved {
            background: rgba(255,255,255,0.05);
            color: var(--text-muted);
        }

        .task-card:hover .task-number {
            transform: scale(1.05);
        }

        .task-info {
            flex: 1;
            min-width: 0;
        }

        .task-info-top {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .task-title {
            font-weight: 600;
            font-size: 1rem;
            color: var(--text-primary);
            transition: color 0.3s ease;
        }

        .task-card:hover .task-title {
            color: var(--primary);
        }

        .task-tags {
            display: flex;
            gap: 0.375rem;
            flex-wrap: wrap;
        }

        .task-tag {
            padding: 0.2rem 0.625rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .task-tag.select { background: rgba(59,130,246,0.15); color: #60a5fa; }
        .task-tag.join { background: rgba(147,51,234,0.15); color: #c084fc; }
        .task-tag.aggregate { background: rgba(245,158,11,0.15); color: #fbbf24; }
        .task-tag.subquery { background: rgba(236,72,153,0.15); color: #f472b6; }
        .task-tag.insert { background: rgba(34,197,94,0.15); color: #4ade80; }
        .task-tag.update { background: rgba(6,182,212,0.15); color: #22d3ee; }
        .task-tag.delete { background: rgba(239,68,68,0.15); color: #f87171; }
        .task-tag.window { background: rgba(168,85,247,0.15); color: #c084fc; }

        .task-desc {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-top: 0.375rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .task-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-shrink: 0;
        }

        .task-difficulty {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
        }

        .task-difficulty.easy {
            background: rgba(34,197,94,0.1);
            color: var(--success);
        }

        .task-difficulty.medium {
            background: rgba(245,158,11,0.1);
            color: var(--warning);
        }

        .task-difficulty.hard {
            background: rgba(239,68,68,0.1);
            color: var(--danger);
        }

        .task-stat {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        .task-status {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1rem;
        }

        .task-status.solved {
            background: rgba(34,197,94,0.15);
            color: var(--success);
        }

        .task-status.unsolved {
            background: rgba(255,255,255,0.05);
            color: var(--text-muted);
        }

        .task-arrow {
            color: var(--text-muted);
            font-size: 1rem;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .task-card:hover .task-arrow {
            color: var(--primary);
            transform: translateX(4px);
        }

        /* ── PAGINATION ── */
        .tasks-pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2.5rem;
        }

        .page-btn {
            min-width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: var(--bg-card);
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 500;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .page-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .page-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--text-primary);
            box-shadow: 0 4px 15px var(--glow-primary);
        }

        .page-btn.disabled {
            opacity: 0.3;
            pointer-events: none;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .task-meta {
                flex-direction: column;
                align-items: flex-end;
                gap: 0.5rem;
            }

            .task-card {
                flex-wrap: wrap;
            }

            .task-stat {
                display: none;
            }

            .tasks-page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endsection

@section('content')
    <div class="tasks-page">
        <div class="section-inner">

            {{-- Page Header --}}
            <div class="tasks-page-header">
                <div class="tasks-page-header-left">
                    <h1>SQL <span class="gradient-text">Тренажёр</span></h1>
                    <p>Практикуйтесь на реальных задачах и прокачайте навыки SQL</p>
                </div>
            </div>

            {{-- Progress --}}
            <div class="tasks-progress-bar">
                <div class="tasks-progress-info">
                    <div class="tasks-progress-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <div class="tasks-progress-text">
                        <strong>Ваш прогресс</strong>
                        <span>{{ $solvedTasksCount }} из {{ $totalTasks }} задач решено</span>
                    </div>
                </div>
                <div class="tasks-progress-track">
                    <div class="tasks-progress-fill" style="width: {{ $progressPercent }}%;"></div>
                </div>
                <div class="tasks-progress-percent">{{ $progressPercent }}%</div>
            </div>

            {{-- Filters --}}
            <div class="tasks-filters">
                <form method="GET" action="{{ route('public.tasks.index') }}" class="tasks-search">
                    {{-- Сохраняем текущие фильтры --}}
                    @if($category !== 'all')
                        <input type="hidden" name="category" value="{{ $category }}">
                    @endif
                    @if($status !== 'all')
                        <input type="hidden" name="status" value="{{ $status }}">
                    @endif

                    <i class="bi bi-search"></i>
                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           placeholder="Поиск задачи по названию или номеру..."
                           autocomplete="off" />
                </form>

                @php
                    $statusButtons = [
                        'all'      => ['icon' => 'bi-grid-3x3',      'label' => 'Все'],
                        'solved'   => ['icon' => 'bi-check-circle',   'label' => 'Решённые'],
                        'unsolved' => ['icon' => 'bi-circle',         'label' => 'Нерешённые'],
                    ];
                @endphp

                @foreach($statusButtons as $key => $btn)
                    <a href="{{ route('public.tasks.index', array_merge(
                request()->query(),
                ['status' => $key, 'page' => 1]
                )) }}"
                       class="filter-btn {{ $status === $key ? 'active' : '' }}">
                        <i class="bi {{ $btn['icon'] }}"></i> {{ $btn['label'] }}
                        <span class="count">{{ $statusCounts[$key] }}</span>
                    </a>
                @endforeach
            </div>

            {{-- Category Tabs --}}
            <div class="category-tabs">
                @php
                    $categories = [
                        'all'       => 'Все задачи',
                        'select'    => 'SELECT',
                        'join'      => 'JOIN',
                        'aggregate' => 'Агрегатные функции',
                        'subquery'  => 'Подзапросы',
                        'dml'       => 'INSERT / UPDATE / DELETE',
                        'window'    => 'Оконные функции',
                    ];
                @endphp

                @foreach($categories as $key => $label)
                    <a href="{{ route('public.tasks.index', array_merge(
                request()->query(),
                ['category' => $key, 'page' => 1]
            )) }}"
                       class="category-tab {{ $category === $key ? 'active' : '' }}">
                        {{ $label }}
                        <span class="count">{{ $categoryCounts[$key] }}</span>
                    </a>
                @endforeach
            </div>

            {{-- Task List --}}
            <div class="tasks-list">

                @foreach($tasks as $task)
                    @php
                        $isSolved = in_array($task->id, $solvedTaskIds);
                    @endphp
                    <a href="{{ route('public.tasks.show', $task) }}"
                       class="task-card {{ $isSolved ? 'solved' : 'unsolved' }}">
                        <div class="task-number {{ $isSolved ? 'solved' : 'unsolved' }}">
                            {{ $task->task_number }}
                        </div>
                        <div class="task-info">
                            <div class="task-info-top">
                                <span class="task-title">{{ $task->title }}</span>
                                <div class="task-tags">
                                    <span class="task-tag select">{{ $task->sql_type }}</span>
                                </div>
                            </div>
                            <div class="task-desc">{{ $task->description }}</div>
                        </div>
                        <div class="task-meta">
                                @php
                                    $p = $task->difficulty_percent;
                                    $diffClass = $p <= 30 ? 'easy' : ($p <= 60 ? 'medium' : 'hard');
                                    $diffLabel = $p <= 30 ? 'Легко' : ($p <= 60 ? 'Средне' : 'Сложно');
                                @endphp

                                <div class="task-difficulty {{ $diffClass }}">
                                    <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i>
                                    {{ $diffLabel }}
                                </div>
                            <div class="task-stat">
                                <i class="bi bi-people"></i> {{ number_format($task->solved_by_count ?? 0) }}
                            </div>
                            <div class="task-status {{ $isSolved ? 'solved' : 'unsolved' }}">
                                @if($isSolved)
                                    <i class="bi bi-check-lg"></i>
                                @else
                                    <i class="bi bi-circle"></i>
                                @endif
                            </div>
                        </div>
                        <i class="bi bi-chevron-right task-arrow"></i>
                    </a>

                @endforeach

            </div>

            {{-- Pagination --}}
            {{ $tasks->links('vendor.pagination.tasks') }}

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Category tab switching
        document.querySelectorAll('.category-tab').forEach(function(tab) {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.category-tab').forEach(function(t) { t.classList.remove('active'); });
                this.classList.add('active');
            });
        });

        // Filter button switching
        document.querySelectorAll('.filter-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(function(b) { b.classList.remove('active'); });
                this.classList.add('active');
            });
        });
    </script>
@endsection
