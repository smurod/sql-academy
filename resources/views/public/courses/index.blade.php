@extends('public.layouts.app')

@section('title', 'Курс SQL — Программа обучения')

@section('styles')
    <style>
        .course-page {
            padding: 2rem 0 6rem;
            min-height: calc(100vh - 72px);
        }

        /* ── COURSE HERO ── */
        .course-hero {
            position: relative;
            padding: 2.5rem 0 3rem;
            margin-bottom: 2.5rem;
        }

        .course-hero-inner {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 3rem;
            align-items: start;
        }

        .course-hero-content h1 {
            font-size: 2.25rem;
            font-weight: 900;
            letter-spacing: -0.03em;
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }

        .course-hero-content > p {
            color: var(--text-secondary);
            font-size: 1.05rem;
            line-height: 1.7;
            max-width: 600px;
            margin-bottom: 1.5rem;
        }

        .course-meta-row {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .course-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .course-meta-item i {
            color: var(--primary);
            font-size: 1rem;
        }

        .course-hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-continue {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 2rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--text-primary);
            border: none;
            border-radius: 14px;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px var(--glow-primary);
        }

        .btn-continue::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-continue:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px var(--glow-primary);
        }

        .btn-continue:hover::before { left: 100%; }

        .btn-reset-progress {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.5rem;
            background: rgba(255,255,255,0.05);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            font-size: 0.9rem;
            font-weight: 500;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .btn-reset-progress:hover {
            border-color: var(--danger);
            color: var(--danger);
        }

        /* ── PROGRESS CARD (RIGHT) ── */
        .progress-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 1.75rem;
            position: sticky;
            top: 90px;
        }

        .progress-card-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .progress-card-title i { color: var(--primary); }

        /* Ring */
        .pc-ring-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .pc-ring {
            position: relative;
            width: 130px;
            height: 130px;
        }

        .pc-ring svg {
            transform: rotate(-90deg);
        }

        .pc-ring-bg {
            fill: none;
            stroke: rgba(255,255,255,0.06);
            stroke-width: 8;
        }

        .pc-ring-fill {
            fill: none;
            stroke: url(#pcGrad);
            stroke-width: 8;
            stroke-linecap: round;
            transition: stroke-dashoffset 1.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .pc-ring-center {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .pc-ring-val {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pc-ring-label {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 0.125rem;
        }

        /* Stats */
        .pc-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.625rem;
            margin-bottom: 1.25rem;
        }

        .pc-stat {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            padding: 0.75rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .pc-stat:hover {
            border-color: rgba(59,130,246,0.2);
            background: rgba(59,130,246,0.05);
        }

        .pc-stat-val {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .pc-stat-label {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        /* Streak */
        .pc-streak {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem;
            background: linear-gradient(135deg, rgba(245,158,11,0.08), rgba(239,68,68,0.05));
            border: 1px solid rgba(245,158,11,0.15);
            border-radius: 12px;
            margin-bottom: 1.25rem;
        }

        .pc-streak-fire {
            font-size: 1.5rem;
            animation: fire-bounce 1s ease-in-out infinite alternate;
        }

        @keyframes fire-bounce {
            from { transform: scale(1) rotate(-5deg); }
            to { transform: scale(1.15) rotate(5deg); }
        }

        .pc-streak-info strong {
            display: block;
            font-size: 0.95rem;
            color: var(--warning);
        }

        .pc-streak-info span {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .pc-continue-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--text-primary);
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .pc-continue-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px var(--glow-primary);
        }

        @media (max-width: 1024px) {
            .course-hero-inner {
                grid-template-columns: 1fr;
            }
            .progress-card {
                position: static;
                max-width: 400px;
            }
        }

        /* ══════════════════════════════
           TREE VIEW — MODULES & LESSONS
           ══════════════════════════════ */

        .course-tree {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        /* ── MODULE BLOCK ── */
        .module-block {
            position: relative;
        }

        /* ── MODULE HEADER ── */
        .module-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            margin-bottom: 0;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            width: 100%;
            text-align: left;
            color: inherit;
            font-family: inherit;
        }

        .module-header:hover {
            border-color: rgba(59,130,246,0.3);
            background: rgba(17,17,39,0.95);
        }

        .module-block.open .module-header {
            border-radius: 16px 16px 0 0;
            border-bottom-color: transparent;
        }

        /* Module circle */
        .mh-circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
            position: relative;
        }

        .mh-circle.completed {
            background: var(--success);
            color: white;
            box-shadow: 0 4px 15px rgba(34,197,94,0.3);
        }

        .mh-circle.in-progress {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 15px var(--glow-primary);
            animation: glow-soft 3s ease-in-out infinite;
        }

        @keyframes glow-soft {
            0%, 100% { box-shadow: 0 4px 15px var(--glow-primary); }
            50% { box-shadow: 0 8px 30px var(--glow-primary); }
        }

        .mh-circle.locked {
            background: rgba(255,255,255,0.05);
            color: var(--text-muted);
            border: 2px dashed rgba(255,255,255,0.1);
        }

        .module-header:hover .mh-circle { transform: scale(1.08); }

        /* Module info */
        .mh-info { flex: 1; min-width: 0; }

        .mh-info-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.25rem;
        }

        .mh-title {
            font-size: 1.05rem;
            font-weight: 700;
        }

        .mh-badge {
            padding: 0.2rem 0.625rem;
            border-radius: 6px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .mh-badge.completed { background: rgba(34,197,94,0.15); color: var(--success); }
        .mh-badge.in-progress { background: rgba(59,130,246,0.15); color: var(--primary); }
        .mh-badge.locked { background: rgba(255,255,255,0.06); color: var(--text-muted); }

        .mh-desc {
            color: var(--text-muted);
            font-size: 0.825rem;
            margin-bottom: 0.5rem;
        }

        .mh-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mh-meta-item {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .mh-meta-item i { font-size: 0.8rem; }
        .mh-meta-item i.text-primary { color: var(--primary); }
        .mh-meta-item i.text-success { color: var(--success); }
        .mh-meta-item i.text-warning { color: var(--warning); }

        /* Progress mini bar */
        .mh-progress {
            width: 140px;
            flex-shrink: 0;
        }

        .mh-progress-head {
            display: flex;
            justify-content: space-between;
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
        }

        .mh-progress-track {
            height: 5px;
            background: rgba(255,255,255,0.06);
            border-radius: 3px;
            overflow: hidden;
        }

        .mh-progress-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .mh-progress-fill.completed { background: var(--success); }
        .mh-progress-fill.in-progress { background: linear-gradient(90deg, var(--primary), var(--accent)); }
        .mh-progress-fill.locked { background: rgba(255,255,255,0.1); }

        /* Chevron */
        .mh-chevron {
            color: var(--text-muted);
            font-size: 1rem;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }

        .module-block.open .mh-chevron { transform: rotate(180deg); }

        /* ══════════════════════════════
           LESSON TREE (inside module)
           ══════════════════════════════ */

        .lessons-tree {
            display: none;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-top: none;
            border-radius: 0 0 16px 16px;
            padding: 0.5rem 0 1rem;
            margin-bottom: 1.5rem;
        }

        .module-block.open .lessons-tree { display: block; }

        /* Lesson connector line */
        .lesson-row {
            position: relative;
            display: flex;
            align-items: center;
            padding: 0;
        }

        /* Vertical connector */
        .lesson-connector {
            width: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-shrink: 0;
            position: relative;
            align-self: stretch;
        }

        .lesson-connector .line-top,
        .lesson-connector .line-bottom {
            width: 2px;
            flex: 1;
            transition: background 0.3s ease;
        }

        .lesson-connector .line-top.completed,
        .lesson-connector .line-bottom.completed {
            background: var(--success);
        }

        .lesson-connector .line-top.in-progress,
        .lesson-connector .line-bottom.in-progress {
            background: linear-gradient(to bottom, var(--success), var(--primary));
        }

        .lesson-connector .line-top.pending,
        .lesson-connector .line-bottom.pending {
            background: rgba(255,255,255,0.08);
        }

        .lesson-connector .line-top.hidden,
        .lesson-connector .line-bottom.hidden {
            background: transparent;
        }

        /* Lesson node dot */
        .lesson-node {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 0.75rem;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .lesson-node.completed {
            background: var(--success);
            color: white;
            box-shadow: 0 2px 8px rgba(34,197,94,0.3);
        }

        .lesson-node.current {
            background: var(--primary);
            color: white;
            box-shadow: 0 0 0 4px rgba(59,130,246,0.2), 0 2px 10px var(--glow-primary);
            animation: node-pulse 2s ease-in-out infinite;
        }

        @keyframes node-pulse {
            0%, 100% { box-shadow: 0 0 0 4px rgba(59,130,246,0.2), 0 2px 10px var(--glow-primary); }
            50% { box-shadow: 0 0 0 8px rgba(59,130,246,0.1), 0 4px 20px var(--glow-primary); }
        }

        .lesson-node.locked {
            background: rgba(255,255,255,0.05);
            color: var(--text-muted);
            border: 2px solid rgba(255,255,255,0.08);
        }

        /* Lesson content card */
        .lesson-card {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1.25rem;
            margin: 0.25rem 1.25rem 0.25rem 0;
            border-radius: 12px;
            transition: all 0.3s ease;
            color: inherit;
            border: 1px solid transparent;
        }

        .lesson-card:hover {
            background: rgba(255,255,255,0.03);
            border-color: var(--border-color);
        }

        .lesson-card.current {
            background: rgba(59,130,246,0.08);
            border-color: rgba(59,130,246,0.2);
        }

        .lesson-card.current:hover {
            background: rgba(59,130,246,0.12);
            border-color: rgba(59,130,246,0.3);
        }

        .lesson-card.locked-card {
            opacity: 0.5;
        }

        .lesson-card.locked-card:hover {
            opacity: 0.7;
        }

        /* Lesson type icon */
        .lc-type-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .lc-type-icon.theory {
            background: rgba(59,130,246,0.12);
            color: var(--primary);
        }

        .lc-type-icon.practice {
            background: rgba(34,197,94,0.12);
            color: var(--success);
        }

        .lc-type-icon.test {
            background: rgba(147,51,234,0.12);
            color: var(--secondary);
        }

        .lc-type-icon.video {
            background: rgba(239,68,68,0.12);
            color: var(--danger);
        }

        .lesson-card:hover .lc-type-icon {
            transform: scale(1.08);
        }

        /* Lesson info */
        .lc-info { flex: 1; min-width: 0; }

        .lc-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.2rem;
            transition: color 0.3s ease;
        }

        .lesson-card:hover .lc-title { color: var(--primary); }
        .lesson-card.locked-card .lc-title { color: var(--text-muted); }

        .lc-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .lc-meta-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        /* Right side */
        .lc-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .lc-xp {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.75rem;
            color: var(--warning);
            font-weight: 600;
            background: rgba(245,158,11,0.1);
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
        }

        .lc-duration {
            font-size: 0.75rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .lc-arrow {
            color: var(--text-muted);
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .lesson-card:hover .lc-arrow {
            color: var(--primary);
            transform: translateX(3px);
        }

        /* ── Module spacing connector ── */
        .module-connector {
            display: flex;
            justify-content: center;
            padding: 0;
            height: 1.5rem;
        }

        .module-connector-line {
            width: 2px;
            height: 100%;
        }

        .module-connector-line.completed { background: var(--success); }
        .module-connector-line.pending { background: rgba(255,255,255,0.08); }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .mh-progress { display: none; }
            .mh-meta { flex-wrap: wrap; }
            .lesson-connector { width: 45px; }
            .lesson-card { margin-right: 0.75rem; padding: 0.75rem; }
            .lc-xp { display: none; }
            .lc-right { gap: 0.5rem; }
        }

        @media (max-width: 480px) {
            .module-header { padding: 1rem; gap: 0.75rem; }
            .mh-circle { width: 42px; height: 42px; font-size: 0.85rem; }
            .mh-title { font-size: 0.95rem; }
            .lesson-connector { width: 35px; }
            .lesson-node { width: 26px; height: 26px; font-size: 0.65rem; }
            .lc-type-icon { width: 32px; height: 32px; font-size: 0.8rem; }
        }
    </style>
@endsection

@section('content')
    <div class="course-page">
        <div class="section-inner">

            {{-- ═══ COURSE HERO ═══ --}}
            <div class="course-hero">
                <div class="course-hero-inner">
                    <div class="course-hero-content">
                        <div class="section-tag"><i class="bi bi-mortarboard-fill"></i> Интерактивный курс</div>
                        <h1>Полный курс по <span class="gradient-text">SQL</span></h1>
                        <p>От простых SELECT-запросов до оконных функций и CTE. Каждый урок — теория, живые примеры и практическое задание.</p>

                        <div class="course-meta-row">
                            <div class="course-meta-item"><i class="bi bi-collection"></i> 6 модулей</div>
                            <div class="course-meta-item"><i class="bi bi-journal-text"></i> 33 урока</div>
                            <div class="course-meta-item"><i class="bi bi-clock"></i> ~15 часов</div>
                            <div class="course-meta-item"><i class="bi bi-award"></i> Сертификат</div>
                            <div class="course-meta-item"><i class="bi bi-infinity"></i> Бессрочный доступ</div>
                        </div>

                        <div class="course-hero-actions">
                            <a href="{{ url('/course/14') }}" class="btn-continue">
                                <i class="bi bi-play-fill"></i> Продолжить обучение
                            </a>
                            <button class="btn-reset-progress">
                                <i class="bi bi-arrow-counterclockwise"></i> Сбросить прогресс
                            </button>
                        </div>
                    </div>

                    {{-- Progress card --}}
                    <div class="progress-card">
                        <div class="progress-card-title"><i class="bi bi-bar-chart-fill"></i> Ваш прогресс</div>

                        <div class="pc-ring-wrap">
                            <div class="pc-ring">
                                <svg width="130" height="130" viewBox="0 0 130 130">
                                    <defs>
                                        <linearGradient id="pcGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:var(--primary)" />
                                            <stop offset="100%" style="stop-color:var(--accent)" />
                                        </linearGradient>
                                    </defs>
                                    <circle class="pc-ring-bg" cx="65" cy="65" r="58" />
                                    <circle class="pc-ring-fill" cx="65" cy="65" r="58"
                                            stroke-dasharray="364.42"
                                            stroke-dashoffset="218.65" />
                                </svg>
                                <div class="pc-ring-center">
                                    <div class="pc-ring-val">40%</div>
                                    <div class="pc-ring-label">завершено</div>
                                </div>
                            </div>
                        </div>

                        <div class="pc-stats">
                            <div class="pc-stat">
                                <div class="pc-stat-val" style="color: var(--success);">13</div>
                                <div class="pc-stat-label">Пройдено</div>
                            </div>
                            <div class="pc-stat">
                                <div class="pc-stat-val">20</div>
                                <div class="pc-stat-label">Осталось</div>
                            </div>
                            <div class="pc-stat">
                                <div class="pc-stat-val" style="color: var(--warning);">650</div>
                                <div class="pc-stat-label">XP</div>
                            </div>
                            <div class="pc-stat">
                                <div class="pc-stat-val">⏱ 6ч</div>
                                <div class="pc-stat-label">Потрачено</div>
                            </div>
                        </div>

                        <div class="pc-streak">
                            <div class="pc-streak-fire">🔥</div>
                            <div class="pc-streak-info">
                                <strong>7 дней подряд!</strong>
                                <span>Не прерывайте серию</span>
                            </div>
                        </div>

                        <a href="{{ url('/course/14') }}" class="pc-continue-btn">
                            <i class="bi bi-play-fill"></i> Продолжить
                        </a>
                    </div>
                </div>
            </div>

            {{-- ═══ COURSE TREE ═══ --}}
            <div class="course-tree">

                {{-- ══ MODULE 1: Основы SQL (COMPLETED) ══ --}}
                <div class="module-block open" data-module="1">
                    <button class="module-header">
                        <div class="mh-circle completed"><i class="bi bi-check-lg" style="font-size:1.2rem;"></i></div>
                        <div class="mh-info">
                            <div class="mh-info-row">
                                <span class="mh-title">Модуль 1 · Основы SQL</span>
                                <span class="mh-badge completed">Пройден</span>
                            </div>
                            <div class="mh-desc">SELECT, WHERE, ORDER BY, LIMIT — фундамент работы с данными</div>
                            <div class="mh-meta">
                                <span class="mh-meta-item"><i class="bi bi-journal-text text-primary"></i> 6 уроков</span>
                                <span class="mh-meta-item"><i class="bi bi-clock text-primary"></i> 2.5 часа</span>
                                <span class="mh-meta-item"><i class="bi bi-trophy-fill text-warning"></i> 150 XP</span>
                            </div>
                        </div>
                        <div class="mh-progress">
                            <div class="mh-progress-head"><span>6/6</span><span>100%</span></div>
                            <div class="mh-progress-track"><div class="mh-progress-fill completed" style="width:100%;"></div></div>
                        </div>
                        <i class="bi bi-chevron-down mh-chevron"></i>
                    </button>

                    <div class="lessons-tree">
                        {{-- Lesson 1 --}}
                        <div class="lesson-row">
                            <div class="lesson-connector">
                                <div class="line-top hidden"></div>
                                <div class="lesson-node completed"><i class="bi bi-check-lg"></i></div>
                                <div class="line-bottom completed"></div>
                            </div>
                            <a href="{{ url('/course/1') }}" class="lesson-card">
                                <div class="lc-type-icon theory"><i class="bi bi-book"></i></div>
                                <div class="lc-info">
                                    <div class="lc-title">Введение в базы данных</div>
                                    <div class="lc-meta">
                                        <span class="lc-meta-item"><i class="bi bi-book"></i> Теория</span>
                                        <span class="lc-meta-item"><i class="bi bi-check-circle-fill" style="color:var(--success);"></i> Пройден</span>
                                    </div>
                                </div>
                                <div class="lc-right">
                                    <span class="lc-xp"><i class="bi bi-star-fill"></i> 25</span>
                                    <span class="lc-duration"><i class="bi bi-clock"></i> 10 мин</span>
                                    <i class="bi bi-chevron-right lc-arrow"></i>
                                </div>
                            </a>
                        </div>

                        {{-- Lesson 2 --}}
                        <div class="lesson-row">
                            <div class="lesson-connector">
                                <div class="line-top completed"></div>
                                <div class="lesson-node completed"><i class="bi bi-check-lg"></i></div>
                                <div class="line-bottom completed"></div>
                            </div>
                            <a href="{{ url('/course/2') }}" class="lesson-card">
                                <div class="lc-type-icon practice"><i class="bi bi-code-slash"></i></div>
                                <div class="lc-info">
                                    <div class="lc-title">Первый запрос SELECT</div>
                                    <div class="lc-meta">
                                        <span class="lc-meta-item"><i class="bi bi-code-slash"></i> Практика</span>
                                        <span class="lc-meta-item"><i class="bi bi-check-circle-fill" style="color:var(--success);"></i> Пройден</span>
                                    </div>
                                </div>
                                <div class="lc-right">
                                    <span class="lc-xp"><i class="bi bi-star-fill"></i> 25</span>
                                    <span class="lc-duration"><i class="bi bi-clock"></i> 15 мин</span>
                                    <i class="bi bi-chevron-right lc-arrow"></i>
                                </div>
                            </a>
                        </div>

                        {{-- Lesson 3 --}}
                        <div class="lesson-row">
                            <div class="lesson-connector">
                                <div class="line-top completed"></div>
                                <div class="lesson-node completed"><i class="bi bi-check-lg"></i></div>
                                <div class="line-bottom completed"></div>
                            </div>
                            <a href="{{ url('/course/3') }}" class="lesson-card">
                                <div class="lc-type-icon practice"><i class="bi bi-code-slash"></i></div>
                                <div class="lc-info">
                                    <div class="lc-title">Выбор определённых столбцов</div>
                                    <div class="lc-meta">
                                        <span class="lc-meta-item"><i class="bi bi-code-slash"></i> Практика</span>
                                        <span class="lc-meta-item"><i class="bi bi-check-circle-fill" style="color:var(--success);"></i> Пройден</span>
                                    </div>
                                </div>
                                <div class="lc-right">
                                    <span class="lc-xp"><i class="bi bi-star-fill"></i> 25</span>
                                    <span class="lc-duration"><i class="bi bi-clock"></i> 15 мин</span>
                                    <i class="bi bi-chevron-right lc-arrow"></i>
                                </div>
                            </a>
                        </div>

                        {{-- Lesson 4 --}}
                        <div class="lesson-row">
                            <div class="lesson-connector">
                                <div class="line-top completed"></div>
                                <div class="lesson-node completed"><i class="bi bi-check-lg"></i></div>
                                <div class="line-bottom completed"></div>
                            </div>
                            <a href="{{ url('/course/4') }}" class="lesson-card">
                                <div class="lc-type-icon practice"><i class="bi bi-code-slash"></i></div>
                                <div class="lc-info">
                                    <div class="lc-title">Фильтрация с WHERE</div>
                                    <div class="lc-meta">
                                        <span class="lc-meta-item"><i class="bi bi-code-slash"></i> Практика</span>
                                        <span class="lc-meta-item"><i class="bi bi-check-circle-fill" style="color:var(--success);"></i> Пройден</span>
                                    </div>
                                </div>
                                <div class="lc-right">
                                    <span class="lc-xp"><i class="bi bi-star-fill"></i> 25</span>
                                    <span class="lc-duration"><i class="bi bi-clock"></i> 20 мин</span>
                                    <i class="bi bi-chevron-right lc-arrow"></i>
                                </div>
                            </a>
                        </div>

                        {{-- Lesson 5 --}}
                        <div class="lesson-row">
                            <div class="lesson-connector">
                                <div class="line-top completed"></div>
                                <div class="lesson-node completed"><i class="bi bi-check-lg"></i></div>
                                <div class="line-bottom completed"></div>
                            </div>
                            <a href="{{ url('/course/5') }}" class="lesson-card">
                                <div class="lc-type-icon theory"><i class="bi bi-book"></i></div>
                                <div class="lc-info">
                                    <div class="lc-title">Сортировка ORDER BY</div>
                                    <div class="lc-meta">
                                        <span class="lc-meta-item"><i class="bi bi-book"></i> Теория + Практика</span>
                                        <span class="lc-meta-item"><i class="bi bi-check-circle-fill" style="color:var(--success);"></i> Пройден</span>
                                    </div>
                                </div>
                                <div class="lc-right">
                                    <span class="lc-xp"><i class="bi bi-star-fill"></i> 25</span>
                                    <span class="lc-duration"><i class="bi bi-clock"></i> 15 мин</span>
                                    <i class="bi bi-chevron-right lc-arrow"></i>
                                </div>
                            </a>
                        </div>

                        {{-- Lesson 6 (Test) --}}
                        <div class="lesson-row">
                            <div class="lesson-connector">
                                <div class="line-top completed"></div>
                                <div class="lesson-node completed"><i class="bi bi-check-lg"></i></div>
                                <div class="line-bottom hidden"></div>
                            </div>
                            <a href="{{ url('/course/6') }}" class="lesson-card">
                                <div class="lc-type-icon test"><i class="bi bi-patch-question"></i></div>
                                <div class="lc-info">
                                    <div class="lc-title">Тест: Основы SQL</div>
                                    <div class="lc-meta">
                                        <span class="lc-meta-item"><i class="bi bi-patch-question"></i> Тест</span>
                                        <span class="lc-meta-item"><i class="bi bi-check-circle-fill" style="color:var(--success);"></i> 6/6 верно</span>
                                    </div>
                                </div>
                                <div class="lc-right">
                                    <span class="lc-xp"><i class="bi bi-star-fill"></i> 25</span>
                                    <span class="lc-duration"><i class="bi bi-clock"></i> 10 мин</span>
                                    <i class="bi bi-chevron-right lc-arrow"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Connector --}}
                <div class="module-connector"><div class="module-connector-line completed"></div></div>

                {{-- ══ MODULE 2: Фильтрация данных (COMPLETED) ══ --}}
                <div class="module-block" data-module="2">
                    <button class="module-header">
                        <div class="mh-circle completed"><i class="bi bi-check-lg" style="font-size:1.2rem;"></i></div>
                        <div class="mh-info">
                            <div class="mh-info-row">
                                <span class="mh-title">Модуль 2 · Фильтрация данных</span>
                                <span class="mh-badge completed">Пройден</span>
                            </div>
                            <div class="mh-desc">LIKE, IN, BETWEEN, IS NULL — продвинутые условия выборки</div>
                            <div class="mh-meta">
                                <span class="mh-meta-item"><i class="bi bi-journal-text text-primary"></i> 5 уроков</span>
                                <span class="mh-meta-item"><i class="bi bi-clock text-primary"></i> 2 часа</span>
                                <span class="mh-meta-item"><i class="bi bi-trophy-fill text-warning"></i> 125 XP</span>
                            </div>
                        </div>
                        <div class="mh-progress">
                            <div class="mh-progress-head"><span>5/5</span><span>100%</span></div>
                            <div class="mh-progress-track"><div class="mh-progress-fill completed" style="width:100%;"></div></div>
                        </div>
                        <i class="bi bi-chevron-down mh-chevron"></i>
                    </button>

                    <div class="lessons-tree">
                        @php
                            $mod2 = [
                                ['id' => 7, 'title' => 'Оператор LIKE и шаблоны', 'type' => 'practice', 'icon' => 'bi-code-slash', 'xp' => 25, 'time' => '20 мин'],
                                ['id' => 8, 'title' => 'Операторы IN и NOT IN', 'type' => 'practice', 'icon' => 'bi-code-slash', 'xp' => 25, 'time' => '15 мин'],
                                ['id' => 9, 'title' => 'Диапазон BETWEEN', 'type' => 'practice', 'icon' => 'bi-code-slash', 'xp' => 25, 'time' => '15 мин'],
                                ['id' => 10, 'title' => 'Работа с NULL значениями', 'type' => 'theory', 'icon' => 'bi-book', 'xp' => 25, 'time' => '20 мин'],
                                ['id' => 11, 'title' => 'Тест: Фильтрация данных', 'type' => 'test', 'icon' => 'bi-patch-question', 'xp' => 25, 'time' => '15 мин'],
                            ];
                        @endphp
                        @foreach($mod2 as $i => $lesson)
                            <div class="lesson-row">
                                <div class="lesson-connector">
                                    <div class="line-top {{ $i === 0 ? 'hidden' : 'completed' }}"></div>
                                    <div class="lesson-node completed"><i class="bi bi-check-lg"></i></div>
                                    <div class="line-bottom {{ $i === count($mod2) - 1 ? 'hidden' : 'completed' }}"></div>
                                </div>
                                <a href="{{ url('/course/' . $lesson['id']) }}" class="lesson-card">
                                    <div class="lc-type-icon {{ $lesson['type'] }}"><i class="bi {{ $lesson['icon'] }}"></i></div>
                                    <div class="lc-info">
                                        <div class="lc-title">{{ $lesson['title'] }}</div>
                                        <div class="lc-meta">
                                            <span class="lc-meta-item"><i class="bi {{ $lesson['icon'] }}"></i> {{ ucfirst($lesson['type'] === 'practice' ? 'Практика' : ($lesson['type'] === 'test' ? 'Тест' : 'Теория')) }}</span>
                                            <span class="lc-meta-item"><i class="bi bi-check-circle-fill" style="color:var(--success);"></i> Пройден</span>
                                        </div>
                                    </div>
                                    <div class="lc-right">
                                        <span class="lc-xp"><i class="bi bi-star-fill"></i> {{ $lesson['xp'] }}</span>
                                        <span class="lc-duration"><i class="bi bi-clock"></i> {{ $lesson['time'] }}</span>
                                        <i class="bi bi-chevron-right lc-arrow"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Connector --}}
                <div class="module-connector"><div class="module-connector-line completed"></div></div>

                {{-- ══ MODULE 3: Агрегатные функции (IN PROGRESS) ══ --}}
                <div class="module-block open" data-module="3">
                    <button class="module-header">
                        <div class="mh-circle in-progress">03</div>
                        <div class="mh-info">
                            <div class="mh-info-row">
                                <span class="mh-title">Модуль 3 · Агрегатные функции</span>
                                <span class="mh-badge in-progress">В процессе</span>
                            </div>
                            <div class="mh-desc">COUNT, SUM, AVG, MIN, MAX, GROUP BY, HAVING</div>
                            <div class="mh-meta">
                                <span class="mh-meta-item"><i class="bi bi-journal-text text-primary"></i> 5 уроков</span>
                                <span class="mh-meta-item"><i class="bi bi-clock text-primary"></i> 2.5 часа</span>
                                <span class="mh-meta-item"><i class="bi bi-trophy-fill text-warning"></i> 150 XP</span>
                            </div>
                        </div>
                        <div class="mh-progress">
                            <div class="mh-progress-head"><span>2/5</span><span>40%</span></div>
                            <div class="mh-progress-track"><div class="mh-progress-fill in-progress" style="width:40%;"></div></div>
                        </div>
                        <i class="bi bi-chevron-down mh-chevron"></i>
                    </button>

                    <div class="lessons-tree">
                        {{-- Completed --}}
                        <div class="lesson-row">
                            <div class="lesson-connector">
                                <div class="line-top hidden"></div>
                                <div class="lesson-node completed"><i class="bi bi-check-lg"></i></div>
                                <div class="line-bottom completed"></div>
                            </div>
                            <a href="{{ url('/course/12') }}" class="lesson-card">
                                <div class="lc-type-icon practice"><i class="bi bi-code-slash"></i></div>
                                <div class="lc-info">
                                    <div class="lc-title">Функция COUNT</div>
                                    <div class="lc-meta">
                                        <span class="lc-meta-item"><i class="bi bi-code-slash"></i> Практика</span>
                                        <span class="lc-meta-item"><i class="bi bi-check-circle-fill" style="color:var(--success);"></i> Пройден</span>
                                    </div>
                                </div>
                                <div class="lc-right">
                                    <span class="lc-xp"><i class="bi bi-star-fill"></i> 30</span>
                                    <span class="lc-duration"><i class="bi bi-clock"></i> 20 мин</span>
                                    <i class="bi bi-chevron-right lc-arrow"></i>
                                </div>
                            </a>
                        </div>

                        {{-- Completed --}}
                        <div class="lesson-row">
                            <div class="lesson-connector">
                                <div class="line-top completed"></div>
                                <div class="lesson-node completed"><i class="bi bi-check-lg"></i></div>
                                <div class="line-bottom in-progress"></div>
                            </div>
                            <a href="{{ url('/course/13') }}" class="lesson-card">
                                <div class="lc-type-icon practice"><i class="bi bi-code-slash"></i></div>
                                <div class="lc-info">
                                    <div class="lc-title">Функции SUM и AVG</div>
                                    <div class="lc-meta">
                                        <span class="lc-meta-item"><i class="bi bi-code-slash"></i> Практика</span>
                                        <span class="lc-meta-item"><i class="bi bi-check-circle-fill" style="color:var(--success);"></i> Пройден</span>
                                    </div>
                                </div>
                                <div class="lc-right">
                                    <span class="lc-xp"><i class="bi bi-star-fill"></i> 30</span>
                                    <span class="lc-duration"><i class="bi bi-clock"></i> 25 мин</span>
                                    <i class="bi bi-chevron-right lc-arrow"></i>
                                </div>
                            </a>
                        </div>

                        {{-- CURRENT --}}
                        <div class="lesson-row">
                            <div class="lesson-connector">
                                <div class="line-top in-progress"></div>
                                <div class="lesson-node current"><i class="bi bi-play-fill"></i></div>
                                <div class="line-bottom pending"></div>
                            </div>
                            <a href="{{ url('/course/14') }}" class="lesson-card current">
                                <div class="lc-type-icon practice"><i class="bi bi-code-slash"></i></div>
                                <div class="lc-info">
                                    <div class="lc-title">GROUP BY и группировка</div>
                                    <div class="lc-meta">
                                        <span class="lc-meta-item"><i class="bi bi-code-slash"></i> Практика</span>
                                        <span class="lc-meta-item"><i class="bi bi-arrow-right-circle" style="color:var(--primary);"></i> Текущий урок</span>
                                    </div>
                                </div>
                                <div class="lc-right">
                                    <span class="lc-xp"><i class="bi bi-star-fill"></i> 30</span>
                                    <span class="lc-duration"><i class="bi bi-clock"></i> 30 мин</span>
                                    <i class="bi bi-chevron-right lc-arrow"></i>
                                </div>
                            </a>
                        </div>

                        {{-- Locked --}}
                        <div class="lesson-row">
                            <div class="lesson-connector">
                                <div class="line-top pending"></div>
                                <div class="lesson-node locked"><i class="bi bi-lock-fill"></i></div>
                                <div class="line-bottom pending"></div>
                            </div>
                            <a href="#" class="lesson-card locked-card">
                                <div class="lc-type-icon practice"><i class="bi bi-code-slash"></i></div>
                                <div class="lc-info">
                                    <div class="lc-title">HAVING — фильтрация групп</div>
                                    <div class="lc-meta">
                                        <span class="lc-meta-item"><i class="bi bi-code-slash"></i> Практика</span>
                                        <span class="lc-meta-item"><i class="bi bi-lock"></i> Заблокирован</span>
                                    </div>
                                </div>
                                <div class="lc-right">
                                    <span class="lc-xp"><i class="bi bi-star-fill"></i> 30</span>
                                    <span class="lc-duration"><i class="bi bi-clock"></i> 20 мин</span>
                                    <i class="bi bi-chevron-right lc-arrow"></i>
                                </div>
                            </a>
                        </div>

                        {{-- Locked test --}}
                        <div class="lesson-row">
                            <div class="lesson-connector">
                                <div class="line-top pending"></div>
                                <div class="lesson-node locked"><i class="bi bi-lock-fill"></i></div>
                                <div class="line-bottom hidden"></div>
                            </div>
                            <a href="#" class="lesson-card locked-card">
                                <div class="lc-type-icon test"><i class="bi bi-patch-question"></i></div>
                                <div class="lc-info">
                                    <div class="lc-title">Тест: Агрегатные функции</div>
                                    <div class="lc-meta">
                                        <span class="lc-meta-item"><i class="bi bi-patch-question"></i> Тест</span>
                                        <span class="lc-meta-item"><i class="bi bi-lock"></i> Заблокирован</span>
                                    </div>
                                </div>
                                <div class="lc-right">
                                    <span class="lc-xp"><i class="bi bi-star-fill"></i> 30</span>
                                    <span class="lc-duration"><i class="bi bi-clock"></i> 15 мин</span>
                                    <i class="bi bi-chevron-right lc-arrow"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Connector --}}
                <div class="module-connector"><div class="module-connector-line pending"></div></div>

                {{-- ══ MODULE 4: Соединение таблиц (LOCKED) ══ --}}
                <div class="module-block" data-module="4">
                    <button class="module-header">
                        <div class="mh-circle locked"><i class="bi bi-lock-fill" style="font-size:0.9rem;"></i></div>
                        <div class="mh-info">
                            <div class="mh-info-row">
                                <span class="mh-title">Модуль 4 · Соединение таблиц</span>
                                <span class="mh-badge locked">Заблокирован</span>
                            </div>
                            <div class="mh-desc">JOIN, LEFT JOIN, RIGHT JOIN, CROSS JOIN, FULL JOIN</div>
                            <div class="mh-meta">
                                <span class="mh-meta-item"><i class="bi bi-journal-text text-primary"></i> 7 уроков</span>
                                <span class="mh-meta-item"><i class="bi bi-clock text-primary"></i> 3.5 часа</span>
                                <span class="mh-meta-item"><i class="bi bi-trophy-fill text-warning"></i> 200 XP</span>
                            </div>
                        </div>
                        <div class="mh-progress">
                            <div class="mh-progress-head"><span>0/7</span><span>0%</span></div>
                            <div class="mh-progress-track"><div class="mh-progress-fill locked" style="width:0%;"></div></div>
                        </div>
                        <i class="bi bi-chevron-down mh-chevron"></i>
                    </button>

                    <div class="lessons-tree">
                        @php
                            $mod4 = [
                                ['title' => 'Введение в JOIN', 'type' => 'theory', 'icon' => 'bi-book', 'time' => '15 мин'],
                                ['title' => 'INNER JOIN', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '25 мин'],
                                ['title' => 'LEFT и RIGHT JOIN', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '30 мин'],
                                ['title' => 'CROSS JOIN', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '20 мин'],
                                ['title' => 'FULL OUTER JOIN', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '20 мин'],
                                ['title' => 'Множественные JOIN', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '30 мин'],
                                ['title' => 'Тест: Соединения таблиц', 'type' => 'test', 'icon' => 'bi-patch-question', 'time' => '15 мин'],
                            ];
                        @endphp
                        @foreach($mod4 as $i => $lesson)
                            <div class="lesson-row">
                                <div class="lesson-connector">
                                    <div class="line-top {{ $i === 0 ? 'hidden' : 'pending' }}"></div>
                                    <div class="lesson-node locked"><i class="bi bi-lock-fill"></i></div>
                                    <div class="line-bottom {{ $i === count($mod4) - 1 ? 'hidden' : 'pending' }}"></div>
                                </div>
                                <a href="#" class="lesson-card locked-card">
                                    <div class="lc-type-icon {{ $lesson['type'] }}"><i class="bi {{ $lesson['icon'] }}"></i></div>
                                    <div class="lc-info">
                                        <div class="lc-title">{{ $lesson['title'] }}</div>
                                        <div class="lc-meta">
                                            <span class="lc-meta-item"><i class="bi {{ $lesson['icon'] }}"></i> {{ $lesson['type'] === 'practice' ? 'Практика' : ($lesson['type'] === 'test' ? 'Тест' : 'Теория') }}</span>
                                            <span class="lc-meta-item"><i class="bi bi-lock"></i> Заблокирован</span>
                                        </div>
                                    </div>
                                    <div class="lc-right">
                                        <span class="lc-xp"><i class="bi bi-star-fill"></i> 30</span>
                                        <span class="lc-duration"><i class="bi bi-clock"></i> {{ $lesson['time'] }}</span>
                                        <i class="bi bi-chevron-right lc-arrow"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Connector --}}
                <div class="module-connector"><div class="module-connector-line pending"></div></div>

                {{-- ══ MODULE 5: Подзапросы (LOCKED) ══ --}}
                <div class="module-block" data-module="5">
                    <button class="module-header">
                        <div class="mh-circle locked"><i class="bi bi-lock-fill" style="font-size:0.9rem;"></i></div>
                        <div class="mh-info">
                            <div class="mh-info-row">
                                <span class="mh-title">Модуль 5 · Подзапросы</span>
                                <span class="mh-badge locked">Заблокирован</span>
                            </div>
                            <div class="mh-desc">Вложенные запросы, EXISTS, ANY, ALL, коррелированные подзапросы</div>
                            <div class="mh-meta">
                                <span class="mh-meta-item"><i class="bi bi-journal-text text-primary"></i> 5 уроков</span>
                                <span class="mh-meta-item"><i class="bi bi-clock text-primary"></i> 2.5 часа</span>
                                <span class="mh-meta-item"><i class="bi bi-trophy-fill text-warning"></i> 150 XP</span>
                            </div>
                        </div>
                        <div class="mh-progress">
                            <div class="mh-progress-head"><span>0/5</span><span>0%</span></div>
                            <div class="mh-progress-track"><div class="mh-progress-fill locked" style="width:0%;"></div></div>
                        </div>
                        <i class="bi bi-chevron-down mh-chevron"></i>
                    </button>

                    <div class="lessons-tree">
                        @php
                            $mod5 = [
                                ['title' => 'Простые подзапросы', 'type' => 'theory', 'icon' => 'bi-book', 'time' => '20 мин'],
                                ['title' => 'Подзапрос в WHERE', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '25 мин'],
                                ['title' => 'EXISTS и NOT EXISTS', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '25 мин'],
                                ['title' => 'Коррелированные подзапросы', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '30 мин'],
                                ['title' => 'Тест: Подзапросы', 'type' => 'test', 'icon' => 'bi-patch-question', 'time' => '15 мин'],
                            ];
                        @endphp
                        @foreach($mod5 as $i => $lesson)
                            <div class="lesson-row">
                                <div class="lesson-connector">
                                    <div class="line-top {{ $i === 0 ? 'hidden' : 'pending' }}"></div>
                                    <div class="lesson-node locked"><i class="bi bi-lock-fill"></i></div>
                                    <div class="line-bottom {{ $i === count($mod5) - 1 ? 'hidden' : 'pending' }}"></div>
                                </div>
                                <a href="#" class="lesson-card locked-card">
                                    <div class="lc-type-icon {{ $lesson['type'] }}"><i class="bi {{ $lesson['icon'] }}"></i></div>
                                    <div class="lc-info">
                                        <div class="lc-title">{{ $lesson['title'] }}</div>
                                        <div class="lc-meta">
                                            <span class="lc-meta-item"><i class="bi {{ $lesson['icon'] }}"></i> {{ $lesson['type'] === 'practice' ? 'Практика' : ($lesson['type'] === 'test' ? 'Тест' : 'Теория') }}</span>
                                            <span class="lc-meta-item"><i class="bi bi-lock"></i> Заблокирован</span>
                                        </div>
                                    </div>
                                    <div class="lc-right">
                                        <span class="lc-xp"><i class="bi bi-star-fill"></i> 30</span>
                                        <span class="lc-duration"><i class="bi bi-clock"></i> {{ $lesson['time'] }}</span>
                                        <i class="bi bi-chevron-right lc-arrow"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Connector --}}
                <div class="module-connector"><div class="module-connector-line pending"></div></div>

                {{-- ══ MODULE 6: Продвинутый SQL (LOCKED) ══ --}}
                <div class="module-block" data-module="6">
                    <button class="module-header">
                        <div class="mh-circle locked"><i class="bi bi-lock-fill" style="font-size:0.9rem;"></i></div>
                        <div class="mh-info">
                            <div class="mh-info-row">
                                <span class="mh-title">Модуль 6 · Продвинутый SQL</span>
                                <span class="mh-badge locked">Заблокирован</span>
                            </div>
                            <div class="mh-desc">Оконные функции, CTE, CASE, UNION, рекурсивные запросы</div>
                            <div class="mh-meta">
                                <span class="mh-meta-item"><i class="bi bi-journal-text text-primary"></i> 6 уроков</span>
                                <span class="mh-meta-item"><i class="bi bi-clock text-primary"></i> 3 часа</span>
                                <span class="mh-meta-item"><i class="bi bi-trophy-fill text-warning"></i> 200 XP</span>
                            </div>
                        </div>
                        <div class="mh-progress">
                            <div class="mh-progress-head"><span>0/6</span><span>0%</span></div>
                            <div class="mh-progress-track"><div class="mh-progress-fill locked" style="width:0%;"></div></div>
                        </div>
                        <i class="bi bi-chevron-down mh-chevron"></i>
                    </button>

                    <div class="lessons-tree">
                        @php
                            $mod6 = [
                                ['title' => 'Оператор CASE', 'type' => 'theory', 'icon' => 'bi-book', 'time' => '20 мин'],
                                ['title' => 'UNION и UNION ALL', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '20 мин'],
                                ['title' => 'Common Table Expressions (CTE)', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '30 мин'],
                                ['title' => 'Оконные функции: ROW_NUMBER, RANK', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '35 мин'],
                                ['title' => 'Оконные функции: LAG, LEAD, SUM', 'type' => 'practice', 'icon' => 'bi-code-slash', 'time' => '30 мин'],
                                ['title' => 'Финальный тест', 'type' => 'test', 'icon' => 'bi-patch-question', 'time' => '20 мин'],
                            ];
                        @endphp
                        @foreach($mod6 as $i => $lesson)
                            <div class="lesson-row">
                                <div class="lesson-connector">
                                    <div class="line-top {{ $i === 0 ? 'hidden' : 'pending' }}"></div>
                                    <div class="lesson-node locked"><i class="bi bi-lock-fill"></i></div>
                                    <div class="line-bottom {{ $i === count($mod6) - 1 ? 'hidden' : 'pending' }}"></div>
                                </div>
                                <a href="#" class="lesson-card locked-card">
                                    <div class="lc-type-icon {{ $lesson['type'] }}"><i class="bi {{ $lesson['icon'] }}"></i></div>
                                    <div class="lc-info">
                                        <div class="lc-title">{{ $lesson['title'] }}</div>
                                        <div class="lc-meta">
                                            <span class="lc-meta-item"><i class="bi {{ $lesson['icon'] }}"></i> {{ $lesson['type'] === 'practice' ? 'Практика' : ($lesson['type'] === 'test' ? 'Тест' : 'Теория') }}</span>
                                            <span class="lc-meta-item"><i class="bi bi-lock"></i> Заблокирован</span>
                                        </div>
                                    </div>
                                    <div class="lc-right">
                                        <span class="lc-xp"><i class="bi bi-star-fill"></i> 35</span>
                                        <span class="lc-duration"><i class="bi bi-clock"></i> {{ $lesson['time'] }}</span>
                                        <i class="bi bi-chevron-right lc-arrow"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>{{-- /course-tree --}}

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Toggle module blocks
        document.querySelectorAll('.module-header').forEach(function(header) {
            header.addEventListener('click', function() {
                var block = this.closest('.module-block');
                block.classList.toggle('open');
            });
        });

        // Scroll to current lesson on load
        document.addEventListener('DOMContentLoaded', function() {
            var currentLesson = document.querySelector('.lesson-card.current');
            if (currentLesson) {
                setTimeout(function() {
                    currentLesson.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 500);
            }
        });

        // Animate progress ring on scroll
        var ringObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var fill = entry.target.querySelector('.pc-ring-fill');
                    if (fill) {
                        // 40% progress: dashoffset = 364.42 * (1 - 0.40) = 218.65
                        fill.style.strokeDashoffset = '218.65';
                    }
                }
            });
        }, { threshold: 0.5 });

        var ringWrap = document.querySelector('.pc-ring-wrap');
        if (ringWrap) ringObserver.observe(ringWrap);
    </script>
@endsection
