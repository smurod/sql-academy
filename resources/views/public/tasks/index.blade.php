@extends('public.layouts.app')

@section('title', 'SQL Тренажёр — Список задач')

@section('styles')
    <style>
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
                        <span>24 из 80 задач решено</span>
                    </div>
                </div>
                <div class="tasks-progress-track">
                    <div class="tasks-progress-fill" style="width: 30%;"></div>
                </div>
                <div class="tasks-progress-percent">30%</div>
            </div>

            {{-- Filters --}}
            <div class="tasks-filters">
                <div class="tasks-search">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Поиск задачи по названию или номеру..." />
                </div>
                <button class="filter-btn active">
                    <i class="bi bi-grid-3x3"></i> Все
                </button>
                <button class="filter-btn">
                    <i class="bi bi-check-circle"></i> Решённые
                </button>
                <button class="filter-btn">
                    <i class="bi bi-circle"></i> Нерешённые
                </button>
            </div>

            {{-- Category Tabs --}}
            <div class="category-tabs">
                <button class="category-tab active">
                    Все задачи <span class="count">80</span>
                </button>
                <button class="category-tab">
                    SELECT <span class="count">25</span>
                </button>
                <button class="category-tab">
                    JOIN <span class="count">18</span>
                </button>
                <button class="category-tab">
                    Агрегатные функции <span class="count">12</span>
                </button>
                <button class="category-tab">
                    Подзапросы <span class="count">10</span>
                </button>
                <button class="category-tab">
                    INSERT / UPDATE / DELETE <span class="count">8</span>
                </button>
                <button class="category-tab">
                    Оконные функции <span class="count">7</span>
                </button>
            </div>

            {{-- Task List --}}
            <div class="tasks-list">

                {{-- Solved Task --}}
                <a href="{{ url('/tasks/1') }}" class="task-card solved">
                    <div class="task-number solved">1</div>
                    <div class="task-info">
                        <div class="task-info-top">
                            <span class="task-title">Выбрать все данные из таблицы</span>
                            <div class="task-tags">
                                <span class="task-tag select">SELECT</span>
                            </div>
                        </div>
                        <div class="task-desc">Получите все строки и столбцы из таблицы Passenger</div>
                    </div>
                    <div class="task-meta">
                        <div class="task-difficulty easy">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Легко
                        </div>
                        <div class="task-stat">
                            <i class="bi bi-people"></i> 12,450
                        </div>
                        <div class="task-status solved">
                            <i class="bi bi-check-lg"></i>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right task-arrow"></i>
                </a>

                {{-- Solved Task --}}
                <a href="{{ url('/tasks/2') }}" class="task-card solved">
                    <div class="task-number solved">2</div>
                    <div class="task-info">
                        <div class="task-info-top">
                            <span class="task-title">Выбрать определённые столбцы</span>
                            <div class="task-tags">
                                <span class="task-tag select">SELECT</span>
                            </div>
                        </div>
                        <div class="task-desc">Выведите имя и возраст всех пассажиров</div>
                    </div>
                    <div class="task-meta">
                        <div class="task-difficulty easy">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Легко
                        </div>
                        <div class="task-stat">
                            <i class="bi bi-people"></i> 11,230
                        </div>
                        <div class="task-status solved">
                            <i class="bi bi-check-lg"></i>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right task-arrow"></i>
                </a>

                {{-- Solved Task --}}
                <a href="{{ url('/tasks/3') }}" class="task-card solved">
                    <div class="task-number solved">3</div>
                    <div class="task-info">
                        <div class="task-info-top">
                            <span class="task-title">Фильтрация с WHERE</span>
                            <div class="task-tags">
                                <span class="task-tag select">SELECT</span>
                            </div>
                        </div>
                        <div class="task-desc">Выведите рейсы, вылетающие из Москвы</div>
                    </div>
                    <div class="task-meta">
                        <div class="task-difficulty easy">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Легко
                        </div>
                        <div class="task-stat">
                            <i class="bi bi-people"></i> 10,890
                        </div>
                        <div class="task-status solved">
                            <i class="bi bi-check-lg"></i>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right task-arrow"></i>
                </a>

                {{-- Unsolved / Current --}}
                <a href="{{ url('/tasks/4') }}" class="task-card unsolved">
                    <div class="task-number unsolved">4</div>
                    <div class="task-info">
                        <div class="task-info-top">
                            <span class="task-title">Сортировка результатов</span>
                            <div class="task-tags">
                                <span class="task-tag select">SELECT</span>
                            </div>
                        </div>
                        <div class="task-desc">Выведите пассажиров, отсортированных по имени в алфавитном порядке</div>
                    </div>
                    <div class="task-meta">
                        <div class="task-difficulty easy">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Легко
                        </div>
                        <div class="task-stat">
                            <i class="bi bi-people"></i> 9,456
                        </div>
                        <div class="task-status unsolved">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right task-arrow"></i>
                </a>

                <a href="{{ url('/tasks/5') }}" class="task-card unsolved">
                    <div class="task-number unsolved">5</div>
                    <div class="task-info">
                        <div class="task-info-top">
                            <span class="task-title">Использование DISTINCT</span>
                            <div class="task-tags">
                                <span class="task-tag select">SELECT</span>
                            </div>
                        </div>
                        <div class="task-desc">Получите уникальные города отправления рейсов</div>
                    </div>
                    <div class="task-meta">
                        <div class="task-difficulty easy">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Легко
                        </div>
                        <div class="task-stat">
                            <i class="bi bi-people"></i> 8,234
                        </div>
                        <div class="task-status unsolved">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right task-arrow"></i>
                </a>

                <a href="{{ url('/tasks/6') }}" class="task-card unsolved">
                    <div class="task-number unsolved">6</div>
                    <div class="task-info">
                        <div class="task-info-top">
                            <span class="task-title">Агрегатная функция COUNT</span>
                            <div class="task-tags">
                                <span class="task-tag aggregate">AGGREGATE</span>
                            </div>
                        </div>
                        <div class="task-desc">Подсчитайте общее количество пассажиров</div>
                    </div>
                    <div class="task-meta">
                        <div class="task-difficulty medium">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Средне
                        </div>
                        <div class="task-stat">
                            <i class="bi bi-people"></i> 7,123
                        </div>
                        <div class="task-status unsolved">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right task-arrow"></i>
                </a>

                <a href="{{ url('/tasks/7') }}" class="task-card unsolved">
                    <div class="task-number unsolved">7</div>
                    <div class="task-info">
                        <div class="task-info-top">
                            <span class="task-title">Группировка с GROUP BY</span>
                            <div class="task-tags">
                                <span class="task-tag aggregate">AGGREGATE</span>
                            </div>
                        </div>
                        <div class="task-desc">Подсчитайте количество рейсов из каждого города</div>
                    </div>
                    <div class="task-meta">
                        <div class="task-difficulty medium">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Средне
                        </div>
                        <div class="task-stat">
                            <i class="bi bi-people"></i> 6,780
                        </div>
                        <div class="task-status unsolved">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right task-arrow"></i>
                </a>

                <a href="{{ url('/tasks/8') }}" class="task-card unsolved">
                    <div class="task-number unsolved">8</div>
                    <div class="task-info">
                        <div class="task-info-top">
                            <span class="task-title">Соединение двух таблиц</span>
                            <div class="task-tags">
                                <span class="task-tag join">JOIN</span>
                            </div>
                        </div>
                        <div class="task-desc">Выведите имена пассажиров вместе с номерами их рейсов</div>
                    </div>
                    <div class="task-meta">
                        <div class="task-difficulty medium">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Средне
                        </div>
                        <div class="task-stat">
                            <i class="bi bi-people"></i> 5,890
                        </div>
                        <div class="task-status unsolved">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right task-arrow"></i>
                </a>

                <a href="{{ url('/tasks/9') }}" class="task-card unsolved">
                    <div class="task-number unsolved">9</div>
                    <div class="task-info">
                        <div class="task-info-top">
                            <span class="task-title">Сложный JOIN с фильтрацией</span>
                            <div class="task-tags">
                                <span class="task-tag join">JOIN</span>
                                <span class="task-tag aggregate">AGGREGATE</span>
                            </div>
                        </div>
                        <div class="task-desc">Найдите пассажиров, летавших более 2 раз</div>
                    </div>
                    <div class="task-meta">
                        <div class="task-difficulty hard">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Сложно
                        </div>
                        <div class="task-stat">
                            <i class="bi bi-people"></i> 3,456
                        </div>
                        <div class="task-status unsolved">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right task-arrow"></i>
                </a>

                <a href="{{ url('/tasks/10') }}" class="task-card unsolved">
                    <div class="task-number unsolved">10</div>
                    <div class="task-info">
                        <div class="task-info-top">
                            <span class="task-title">Подзапрос в WHERE</span>
                            <div class="task-tags">
                                <span class="task-tag subquery">SUBQUERY</span>
                            </div>
                        </div>
                        <div class="task-desc">Найдите рейсы, на которых летел самый старший пассажир</div>
                    </div>
                    <div class="task-meta">
                        <div class="task-difficulty hard">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Сложно
                        </div>
                        <div class="task-stat">
                            <i class="bi bi-people"></i> 2,345
                        </div>
                        <div class="task-status unsolved">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right task-arrow"></i>
                </a>

            </div>

            {{-- Pagination --}}
            <div class="tasks-pagination">
                <button class="page-btn disabled"><i class="bi bi-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">...</button>
                <button class="page-btn">8</button>
                <button class="page-btn"><i class="bi bi-chevron-right"></i></button>
            </div>

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
