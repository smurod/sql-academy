@extends('public.layouts.app')

@section('title', 'Курс SQL — Программа обучения')
@section('styles')
    <style>
        .course-page {
            position: relative;
            min-height: calc(100vh - 72px);
            padding: 4.5rem 0 7rem;
            overflow: hidden;
            background:
                radial-gradient(circle at 20% 100%, rgba(34, 197, 94, 0.04), transparent 28%),
                radial-gradient(circle at 80% 0%, rgba(59, 130, 246, 0.03), transparent 24%);
        }

        .course-page::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255,255,255,0.08) 0.8px, transparent 0.8px);
            background-size: 32px 32px;
            opacity: 0.28;
            pointer-events: none;
            z-index: 0;
        }

        .course-wrap {
            position: relative;
            z-index: 1;
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 1.25rem;
        }

        .course-intro {
            max-width: 860px;
            margin: 0 auto 2.75rem;
        }

        .course-intro h1 {
            margin: 0 0 1.25rem;
            font-size: clamp(2.6rem, 5vw, 4.1rem);
            line-height: 1.1;
            letter-spacing: -0.04em;
            font-weight: 800;
            color: #f3f4f6;
        }

        .course-intro p {
            margin: 0;
            max-width: 920px;
            font-size: 1.1rem;
            line-height: 1.85;
            color: rgba(255,255,255,0.82);
        }

        .course-modules {
            max-width: 860px;
            margin: 0 auto;
            border-radius: 26px;
            overflow: hidden;
            position: relative;
            z-index: 1;
            background: rgba(14, 18, 34, 0.82);
            border: 1px solid rgba(110, 130, 255, 0.07);
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.22),
                inset 0 1px 0 rgba(255,255,255,0.02);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .course-modules::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 26px;
            pointer-events: none;
            background: linear-gradient(
                180deg,
                rgba(255,255,255,0.015) 0%,
                rgba(255,255,255,0.005) 100%
            );
        }

        .module-container {
            display: grid;
            grid-template-columns: 430px 1fr;
            gap: 3.5rem;
            padding: 1.25rem 3.25rem 1.75rem 3.25rem;
            position: relative;
        }

        .module-side {
            padding-top: 0.15rem;
        }

        .module-number {
            font-size: 0.95rem;
            line-height: 1.4;
            color: rgba(255,255,255,0.42);
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .module-name {
            font-size: 1rem;
            line-height: 1.35;
            color: #f5f7fb;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .module-desc {
            font-size: 0.88rem;
            line-height: 1.9;
            color: rgba(255,255,255,0.78);
            max-width: 360px;
        }

        .lessons-side { min-width: 0; }
        .lessons-inner { width: 100%; padding-top: 0.05rem; }

        .lesson-row {
            display: flex;
            align-items: stretch;
            min-height: 54px;
            cursor: pointer;
        }

        .lesson-connector {
            width: 44px;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-shrink: 0;
            transform: translateX(-2px);
        }

        .lesson-connector .line {
            width: 2px;
            flex: 1;
            background: rgba(255,255,255,0.12);
            transition: background 0.25s ease;
        }

        .lesson-connector .line.hidden {
            background: transparent;
        }

        /* ── БАЗОВАЯ ТОЧКА ── */
        .lesson-connector .dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: rgba(255,255,255,0.14);
            flex-shrink: 0;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* ── COMPLETED ── */
        .lesson-connector .dot.completed {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow:
                0 0 0 3px rgba(59, 130, 246, 0.15),
                0 4px 14px var(--glow-primary);
        }

        /* ── SVG галочка строго по центру ── */
        .lesson-connector .dot.completed svg {
            width: 10px;
            height: 10px;
            display: block;
            flex-shrink: 0;
            stroke: #ffffff;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
        }

        /* ── HOVER: обычная точка ── */
        .lesson-row:hover .lesson-connector .dot:not(.completed) {
            background: rgba(255,255,255,0.26);
            transform: scale(1.18);
        }

        /* ── HOVER: completed точка ── */
        .lesson-row:hover .lesson-connector .dot.completed {
            transform: scale(1.2) rotate(-8deg);
            box-shadow:
                0 0 0 4px rgba(59, 130, 246, 0.2),
                0 6px 20px var(--glow-primary);
        }

        /* ── HOVER: линии ── */
        .lesson-row:hover .lesson-connector .line:not(.hidden) {
            background: rgba(255,255,255,0.22);
        }

        /* ── LESSON LINK ── */
        .lesson-link {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 0 0 0 0.4rem;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 0.98rem;
            line-height: 1.45;
            transition: color 0.22s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            min-width: 0;
        }

        .lesson-link span {
            display: inline-block;
            max-width: 100%;
        }

        /* ── HOVER: текст белый + сдвиг ── */
        .lesson-row:hover .lesson-link {
            color: #ffffff;
            transform: translateX(5px);
        }

        .lesson-link.is-test {
            color: rgba(255,255,255,0.65);
        }

        .lesson-row.branch-start .lesson-connector .line.bottom-rounded {
            border-bottom-left-radius: 16px;
        }

        .lesson-row.branch-mid .lesson-connector .line.top-rounded {
            border-top-left-radius: 16px;
        }

        .lesson-row.branch-mid .lesson-connector .line.bottom-rounded {
            border-bottom-left-radius: 16px;
        }

        .lesson-row.branch-end .lesson-connector .line.top-rounded {
            border-top-left-radius: 16px;
        }

        .module-container:hover .module-name {
            color: #ffffff;
        }

        .module-container:hover .lesson-connector .line:not(.hidden) {
            background: rgba(255,255,255,0.16);
        }

        @media (max-width: 980px) {
            .course-modules,
            .course-intro {
                max-width: 100%;
            }

            .module-container {
                grid-template-columns: 1fr;
                gap: 1.2rem;
                padding: 1.25rem 1.5rem 1.5rem;
            }

            .module-desc {
                max-width: none;
            }

            .lessons-inner {
                width: 100%;
            }
        }

        @media (max-width: 640px) {
            .course-page {
                padding: 3rem 0 5rem;
            }

            .course-intro h1 {
                font-size: 2.2rem;
            }

            .course-intro p {
                font-size: 1rem;
                line-height: 1.75;
            }

            .course-modules {
                border-radius: 18px;
            }

            .course-modules::before {
                border-radius: 18px;
            }

            .module-container {
                padding: 1rem 1rem 1.2rem;
            }

            .lesson-row {
                min-height: 50px;
            }

            .lesson-link {
                font-size: 0.93rem;
            }

            .lesson-connector {
                width: 34px;
            }

            .lesson-connector .dot {
                width: 15px;
                height: 15px;
            }

            .lesson-connector .dot.completed svg {
                width: 8px;
                height: 8px;
            }

            .lesson-connector .line {
                width: 2px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="course-page">
        <div class="course-wrap">
            <div class="course-intro">
                <h1>Интерактивный курс по SQL</h1>
                <p>
                    Всесторонний курс по MySQL, спроектированный так, чтобы навсегда изменить твоё
                    отношение к SQL. Мы вместе пройдём путь, чтобы понять как этот язык работает, и получим все
                    необходимые навыки для эффективного применения его на работе.
                </p>
            </div>

            <div class="course-modules">
                @foreach($modules as $module)
                    <div class="module-container">
                        <div class="module-side">
                            <div class="module-number">Модуль {{ $module['order_index'] }}</div>
                            <div class="module-name">{{ $module['title'] }}</div>
                            <div class="module-desc">{{ $module['description'] }}</div>
                        </div>

                        <div class="lessons-side">
                            <div class="lessons-inner">
                                @foreach($module['lessons'] as $lesson)
                                    @php
                                        $lessonCompleted = auth()->check() && isset($completedLessons) && in_array($lesson->id, $completedLessons);
                                    @endphp

                                    <div class="lesson-row">
                                        <div class="lesson-connector">
                                            <div class="line {{ $loop->first ? 'hidden' : '' }}"></div>

                                            <div class="dot {{ $lessonCompleted ? 'completed' : '' }}">
                                                @if($lessonCompleted)
                                                @endif
                                            </div>

                                            <div class="line {{ $loop->last ? 'hidden' : '' }}"></div>
                                        </div>

                                        <a href="{{ route('public.courses.show', $lesson) }}"
                                           class="lesson-link {{ $lesson['is_test'] ? 'is-test' : '' }}">
                                            <span>{{ $lesson['title'] }}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
