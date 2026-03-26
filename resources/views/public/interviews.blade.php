@extends('public.layouts.app')

@section('title', 'Задачи с собеседований — SQL Academy')

@section('styles')
    <style>
        .interviews-page { padding: 2rem 0 6rem; }

        /* ── Hero ── */
        .interviews-hero {
            text-align: center;
            padding: 2rem 0 3rem;
            margin-bottom: 2rem;
        }

        .interviews-hero h1 {
            font-size: 2.5rem;
            font-weight: 900;
            letter-spacing: -0.03em;
            margin-bottom: 1rem;
        }

        .interviews-hero p {
            color: var(--text-secondary);
            font-size: 1.125rem;
            max-width: 650px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* ── Company Filters ── */
        .company-filters {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 2.5rem;
        }

        .company-chip {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            font-family: inherit;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .company-chip:hover {
            border-color: var(--primary);
            color: var(--text-primary);
        }

        .company-chip.active {
            background: rgba(59,130,246,0.15);
            border-color: var(--primary);
            color: var(--primary);
        }

        .company-chip .logo {
            width: 20px;
            height: 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        /* ── Difficulty tabs ── */
        .diff-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            justify-content: center;
        }

        .diff-tab {
            padding: 0.5rem 1.5rem;
            border-radius: 10px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .diff-tab:hover { border-color: var(--primary); color: var(--text-primary); }
        .diff-tab.active { background: var(--primary); border-color: var(--primary); color: var(--text-primary); box-shadow: 0 4px 15px var(--glow-primary); }

        /* ── Cards grid ── */
        .interview-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 1.5rem;
        }

        .interview-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .interview-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            border-radius: 4px 0 0 4px;
        }

        .interview-card.easy::before { background: var(--success); }
        .interview-card.medium::before { background: var(--warning); }
        .interview-card.hard::before { background: var(--danger); }

        .interview-card:hover {
            border-color: rgba(59,130,246,0.3);
            transform: translateY(-6px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .ic-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .ic-company {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .ic-company .clogo {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .ic-diff {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.3rem 0.75rem;
            border-radius: 8px;
        }

        .ic-diff.easy { background: rgba(34,197,94,0.1); color: var(--success); }
        .ic-diff.medium { background: rgba(245,158,11,0.1); color: var(--warning); }
        .ic-diff.hard { background: rgba(239,68,68,0.1); color: var(--danger); }

        .ic-title {
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1.4;
        }

        .ic-desc {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.6;
            flex: 1;
        }

        .ic-tags {
            display: flex;
            gap: 0.375rem;
            flex-wrap: wrap;
        }

        .ic-tag {
            padding: 0.2rem 0.625rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            background: rgba(255,255,255,0.06);
            color: var(--text-secondary);
        }

        .ic-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .ic-stats {
            display: flex;
            gap: 1rem;
        }

        .ic-stat {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .ic-solve-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--text-primary);
            border: none;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .ic-solve-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px var(--glow-primary);
        }

        @media (max-width: 640px) {
            .interview-cards { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    <div class="interviews-page">
        <div class="section-inner">

            {{-- Hero --}}
            <div class="interviews-hero">
                <div class="section-tag"><i class="bi bi-briefcase-fill"></i> Собеседования</div>
                <h1>SQL задачи с <span class="gradient-text">собеседований</span></h1>
                <p>Реальные задачи, которые задают на собеседованиях в ведущих IT-компаниях. Подготовьтесь к интервью на практике.</p>
            </div>

            {{-- Company chips --}}
            <div class="company-filters">
                <button class="company-chip active">Все компании</button>
                <button class="company-chip"><span class="logo" style="background:#4285F4;">G</span> Google</button>
                <button class="company-chip"><span class="logo" style="background:#FF9900;">A</span> Amazon</button>
                <button class="company-chip"><span class="logo" style="background:#0078D4;">M</span> Microsoft</button>
                <button class="company-chip"><span class="logo" style="background:#E50914;">N</span> Netflix</button>
                <button class="company-chip"><span class="logo" style="background:#1DB954;">S</span> Spotify</button>
                <button class="company-chip"><span class="logo" style="background:#FF5A5F;">A</span> Airbnb</button>
                <button class="company-chip"><span class="logo" style="background:#0A66C2;">L</span> LinkedIn</button>
                <button class="company-chip"><span class="logo" style="background:#E4405F;">Y</span> Яндекс</button>
            </div>

            {{-- Difficulty --}}
            <div class="diff-tabs">
                <button class="diff-tab active">Все</button>
                <button class="diff-tab">Легко</button>
                <button class="diff-tab">Средне</button>
                <button class="diff-tab">Сложно</button>
            </div>

            {{-- Cards --}}
            <div class="interview-cards">

                <div class="interview-card easy">
                    <div class="ic-top">
                        <div class="ic-company"><div class="clogo" style="background:#4285F4;">G</div> Google</div>
                        <div class="ic-diff easy"><i class="bi bi-circle-fill" style="font-size:0.4rem;"></i> Легко</div>
                    </div>
                    <div class="ic-title">Найти дубликаты email</div>
                    <div class="ic-desc">Напишите запрос, который найдёт все дубликаты адресов электронной почты в таблице пользователей.</div>
                    <div class="ic-tags">
                        <span class="ic-tag">GROUP BY</span>
                        <span class="ic-tag">HAVING</span>
                        <span class="ic-tag">COUNT</span>
                    </div>
                    <div class="ic-bottom">
                        <div class="ic-stats">
                            <div class="ic-stat"><i class="bi bi-people"></i> 8,540</div>
                            <div class="ic-stat"><i class="bi bi-check-circle"></i> 72%</div>
                        </div>
                        <a href="{{ url('/tasks/1') }}" class="ic-solve-btn"><i class="bi bi-play-fill"></i> Решить</a>
                    </div>
                </div>

                <div class="interview-card medium">
                    <div class="ic-top">
                        <div class="ic-company"><div class="clogo" style="background:#FF9900;">A</div> Amazon</div>
                        <div class="ic-diff medium"><i class="bi bi-circle-fill" style="font-size:0.4rem;"></i> Средне</div>
                    </div>
                    <div class="ic-title">Второй по величине оклад</div>
                    <div class="ic-desc">Найдите второй по величине оклад в таблице сотрудников. Если такового нет, верните NULL.</div>
                    <div class="ic-tags">
                        <span class="ic-tag">SUBQUERY</span>
                        <span class="ic-tag">LIMIT</span>
                        <span class="ic-tag">DISTINCT</span>
                    </div>
                    <div class="ic-bottom">
                        <div class="ic-stats">
                            <div class="ic-stat"><i class="bi bi-people"></i> 6,230</div>
                            <div class="ic-stat"><i class="bi bi-check-circle"></i> 58%</div>
                        </div>
                        <a href="{{ url('/tasks/2') }}" class="ic-solve-btn"><i class="bi bi-play-fill"></i> Решить</a>
                    </div>
                </div>

                <div class="interview-card hard">
                    <div class="ic-top">
                        <div class="ic-company"><div class="clogo" style="background:#0078D4;">M</div> Microsoft</div>
                        <div class="ic-diff hard"><i class="bi bi-circle-fill" style="font-size:0.4rem;"></i> Сложно</div>
                    </div>
                    <div class="ic-title">Медиана зарплат по отделам</div>
                    <div class="ic-desc">Рассчитайте медиану зарплат для каждого отдела компании, используя оконные функции.</div>
                    <div class="ic-tags">
                        <span class="ic-tag">WINDOW</span>
                        <span class="ic-tag">ROW_NUMBER</span>
                        <span class="ic-tag">CTE</span>
                    </div>
                    <div class="ic-bottom">
                        <div class="ic-stats">
                            <div class="ic-stat"><i class="bi bi-people"></i> 2,890</div>
                            <div class="ic-stat"><i class="bi bi-check-circle"></i> 31%</div>
                        </div>
                        <a href="{{ url('/tasks/3') }}" class="ic-solve-btn"><i class="bi bi-play-fill"></i> Решить</a>
                    </div>
                </div>

                <div class="interview-card medium">
                    <div class="ic-top">
                        <div class="ic-company"><div class="clogo" style="background:#E50914;">N</div> Netflix</div>
                        <div class="ic-diff medium"><i class="bi bi-circle-fill" style="font-size:0.4rem;"></i> Средне</div>
                    </div>
                    <div class="ic-title">Самые популярные жанры</div>
                    <div class="ic-desc">Найдите топ-5 жанров по количеству просмотров за последний месяц с учётом уникальных пользователей.</div>
                    <div class="ic-tags">
                        <span class="ic-tag">JOIN</span>
                        <span class="ic-tag">GROUP BY</span>
                        <span class="ic-tag">ORDER BY</span>
                    </div>
                    <div class="ic-bottom">
                        <div class="ic-stats">
                            <div class="ic-stat"><i class="bi bi-people"></i> 4,120</div>
                            <div class="ic-stat"><i class="bi bi-check-circle"></i> 64%</div>
                        </div>
                        <a href="{{ url('/tasks/4') }}" class="ic-solve-btn"><i class="bi bi-play-fill"></i> Решить</a>
                    </div>
                </div>

                <div class="interview-card hard">
                    <div class="ic-top">
                        <div class="ic-company"><div class="clogo" style="background:#E4405F;">Y</div> Яндекс</div>
                        <div class="ic-diff hard"><i class="bi bi-circle-fill" style="font-size:0.4rem;"></i> Сложно</div>
                    </div>
                    <div class="ic-title">Непрерывные дни активности</div>
                    <div class="ic-desc">Найдите пользователей, которые были активны не менее 3 дней подряд. Выведите их ID и максимальную серию.</div>
                    <div class="ic-tags">
                        <span class="ic-tag">WINDOW</span>
                        <span class="ic-tag">LAG</span>
                        <span class="ic-tag">CTE</span>
                        <span class="ic-tag">DATE</span>
                    </div>
                    <div class="ic-bottom">
                        <div class="ic-stats">
                            <div class="ic-stat"><i class="bi bi-people"></i> 1,780</div>
                            <div class="ic-stat"><i class="bi bi-check-circle"></i> 24%</div>
                        </div>
                        <a href="{{ url('/tasks/5') }}" class="ic-solve-btn"><i class="bi bi-play-fill"></i> Решить</a>
                    </div>
                </div>

                <div class="interview-card easy">
                    <div class="ic-top">
                        <div class="ic-company"><div class="clogo" style="background:#1DB954;">S</div> Spotify</div>
                        <div class="ic-diff easy"><i class="bi bi-circle-fill" style="font-size:0.4rem;"></i> Легко</div>
                    </div>
                    <div class="ic-title">Топ исполнители</div>
                    <div class="ic-desc">Найдите 10 исполнителей с наибольшим количеством прослушиваний за всё время.</div>
                    <div class="ic-tags">
                        <span class="ic-tag">JOIN</span>
                        <span class="ic-tag">SUM</span>
                        <span class="ic-tag">LIMIT</span>
                    </div>
                    <div class="ic-bottom">
                        <div class="ic-stats">
                            <div class="ic-stat"><i class="bi bi-people"></i> 5,670</div>
                            <div class="ic-stat"><i class="bi bi-check-circle"></i> 78%</div>
                        </div>
                        <a href="{{ url('/tasks/6') }}" class="ic-solve-btn"><i class="bi bi-play-fill"></i> Решить</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Company chips
        document.querySelectorAll('.company-chip').forEach(function(c) {
            c.addEventListener('click', function() {
                document.querySelectorAll('.company-chip').forEach(function(ch) { ch.classList.remove('active'); });
                this.classList.add('active');
            });
        });

        // Difficulty tabs
        document.querySelectorAll('.diff-tab').forEach(function(t) {
            t.addEventListener('click', function() {
                document.querySelectorAll('.diff-tab').forEach(function(tb) { tb.classList.remove('active'); });
                this.classList.add('active');
            });
        });
    </script>
@endsection
