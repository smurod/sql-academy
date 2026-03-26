@extends('public.layouts.app')

@section('title', 'Урок: GROUP BY и группировка — SQL Academy')

@section('styles')
    <style>
        .lesson-page {
            display: flex;
            height: calc(100vh - 72px);
            overflow: hidden;
        }

        /* ── LESSON SIDEBAR NAV ── */
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

        .ls-module-progress {
            height: 4px;
            background: rgba(255,255,255,0.06);
            border-radius: 2px;
            overflow: hidden;
        }

        .ls-module-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 2px;
        }

        .ls-module-info {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 0.375rem;
        }

        /* ── LESSON LIST ── */
        .ls-lessons {
            flex: 1;
            overflow-y: auto;
            padding: 0.5rem 0;
        }

        .ls-lessons::-webkit-scrollbar { width: 4px; }
        .ls-lessons::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }

        .ls-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.25rem;
            transition: all 0.3s ease;
            color: inherit;
            border-left: 3px solid transparent;
        }

        .ls-item:hover { background: rgba(255,255,255,0.03); }

        .ls-item.active {
            background: rgba(59,130,246,0.08);
            border-left-color: var(--primary);
        }

        .ls-item.completed-item { opacity: 0.7; }
        .ls-item.locked-item { opacity: 0.4; }

        .ls-dot {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            flex-shrink: 0;
        }

        .ls-dot.completed { background: var(--success); color: white; }
        .ls-dot.current { background: var(--primary); color: white; box-shadow: 0 0 10px var(--glow-primary); }
        .ls-dot.locked { background: rgba(255,255,255,0.05); color: var(--text-muted); border: 1px solid rgba(255,255,255,0.08); }

        .ls-item-info { flex: 1; min-width: 0; }

        .ls-item-title {
            font-size: 0.825rem;
            font-weight: 500;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ls-item.active .ls-item-title { color: var(--primary); font-weight: 600; }
        .ls-item.locked-item .ls-item-title { color: var(--text-muted); }

        .ls-item-meta {
            font-size: 0.65rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.125rem;
        }

        /* ── MAIN CONTENT ── */
        .lesson-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        /* ── LESSON HEADER BAR ── */
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
        }

        .lhb-nav:hover { border-color: var(--primary); color: var(--primary); }
        .lhb-nav.disabled { opacity: 0.3; pointer-events: none; }

        .lhb-info { display: flex; align-items: center; gap: 0.75rem; }

        .lhb-num {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-weight: 700;
            font-size: 0.75rem;
            padding: 0.3rem 0.625rem;
            border-radius: 8px;
        }

        .lhb-title { font-weight: 600; font-size: 1rem; }

        .lhb-right { display: flex; align-items: center; gap: 0.75rem; }

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

        .lhb-xp {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.8rem;
            color: var(--warning);
            font-weight: 600;
        }

        /* ── CONTENT SPLIT ── */
        .lesson-split {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        /* ── THEORY PANE ── */
        .lesson-theory {
            width: 50%;
            min-width: 300px;
            overflow-y: auto;
            padding: 2rem;
            border-right: 1px solid var(--border-color);
        }

        .lesson-theory::-webkit-scrollbar { width: 4px; }
        .lesson-theory::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }

        .lesson-theory h2 {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 1.25rem;
            letter-spacing: -0.02em;
        }

        .lesson-theory p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .lesson-theory code {
            background: rgba(255,255,255,0.08);
            padding: 0.15rem 0.5rem;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            color: var(--accent);
        }

        .lesson-theory h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 2rem 0 0.75rem;
            color: var(--text-primary);
        }

        .theory-code-block {
            background: var(--bg-elevated);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            margin: 1.25rem 0;
        }

        .theory-code-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
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
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            line-height: 1.8;
            overflow-x: auto;
        }

        .theory-note {
            background: rgba(59,130,246,0.08);
            border: 1px solid rgba(59,130,246,0.2);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin: 1.25rem 0;
        }

        .theory-note h4 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .theory-note p {
            font-size: 0.875rem;
            margin-bottom: 0;
        }

        .theory-result-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            margin: 1rem 0;
        }

        .theory-result-table th {
            text-align: left;
            padding: 0.5rem 1rem;
            background: rgba(59,130,246,0.08);
            color: var(--primary);
            font-weight: 600;
            border-bottom: 1px solid var(--border-color);
        }

        .theory-result-table td {
            padding: 0.5rem 1rem;
            color: var(--text-secondary);
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }

        /* ── PRACTICE PANE ── */
        .lesson-practice {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        .lp-editor-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 1rem;
            background: rgba(0,0,0,0.3);
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .lp-editor-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .lp-editor-label i { color: var(--success); }

        .lp-editor {
            flex: 1;
            min-height: 150px;
        }

        .lp-editor textarea {
            width: 100%;
            height: 100%;
            background: var(--bg-elevated);
            color: var(--text-primary);
            border: none;
            padding: 1rem 1.25rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            line-height: 1.8;
            resize: none;
            outline: none;
            tab-size: 2;
        }

        .lp-editor textarea::placeholder { color: var(--text-muted); }

        .lp-run-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.625rem 1rem;
            background: rgba(0,0,0,0.2);
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .lp-run-bar .shortcuts {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .lp-run-bar .shortcuts kbd {
            background: rgba(255,255,255,0.08);
            padding: 0.1rem 0.4rem;
            border-radius: 3px;
            border: 1px solid var(--border-color);
            font-size: 0.68rem;
            color: var(--text-secondary);
        }

        .lp-btns { display: flex; gap: 0.5rem; }

        .lp-run-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: var(--success);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .lp-run-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(34,197,94,0.4); }

        .lp-check-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .lp-check-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px var(--glow-primary); }

        .lp-results {
            height: 200px;
            min-height: 80px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: var(--bg-elevated);
        }

        .lp-results-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 1rem;
            border-bottom: 1px solid var(--border-color);
            background: rgba(0,0,0,0.2);
            flex-shrink: 0;
        }

        .lp-results-body {
            flex: 1;
            overflow: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lp-empty {
            text-align: center;
            color: var(--text-muted);
        }

        .lp-empty i { font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 0.5rem; }

        /* ── NEXT LESSON BAR ── */
        .next-lesson-bar {
            display: none;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1.5rem;
            background: rgba(34,197,94,0.1);
            border-top: 1px solid rgba(34,197,94,0.2);
            flex-shrink: 0;
        }

        .next-lesson-bar.show { display: flex; }

        .nlb-msg {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            color: var(--success);
        }

        .nlb-msg i { font-size: 1.25rem; }

        .nlb-next {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: var(--success);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .nlb-next:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(34,197,94,0.4); }

        /* ── RESIZER ── */
        .lp-resizer-h {
            width: 5px;
            cursor: col-resize;
            background: transparent;
            transition: background 0.3s ease;
            flex-shrink: 0;
        }

        .lp-resizer-h:hover, .lp-resizer-h.active { background: var(--primary); }

        @media (max-width: 1024px) {
            .lesson-sidebar { display: none; }
            .lesson-split { flex-direction: column; }
            .lesson-theory {
                width: 100%;
                min-width: 0;
                max-height: 40vh;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
            }
            .lp-resizer-h { display: none; }
        }
    </style>
@endsection

@section('content')
    <div class="lesson-page">

        {{-- SIDEBAR: Lesson navigation --}}
        <aside class="lesson-sidebar">
            <div class="ls-header">
                <a href="{{ url('/course') }}" class="ls-back"><i class="bi bi-arrow-left"></i> Назад к курсу</a>
                <div class="ls-module-title">Модуль 3 · Агрегатные функции</div>
                <div class="ls-module-progress"><div class="ls-module-progress-fill" style="width:40%;"></div></div>
                <div class="ls-module-info">2 из 5 уроков пройдено</div>
            </div>
            <div class="ls-lessons">
                <a href="{{ url('/course/12') }}" class="ls-item completed-item">
                    <div class="ls-dot completed"><i class="bi bi-check-lg"></i></div>
                    <div class="ls-item-info">
                        <div class="ls-item-title">Функция COUNT</div>
                        <div class="ls-item-meta"><i class="bi bi-code-slash"></i> Практика <span>· 20 мин</span></div>
                    </div>
                </a>
                <a href="{{ url('/course/13') }}" class="ls-item completed-item">
                    <div class="ls-dot completed"><i class="bi bi-check-lg"></i></div>
                    <div class="ls-item-info">
                        <div class="ls-item-title">Функции SUM и AVG</div>
                        <div class="ls-item-meta"><i class="bi bi-code-slash"></i> Практика <span>· 25 мин</span></div>
                    </div>
                </a>
                <a href="{{ url('/course/14') }}" class="ls-item active">
                    <div class="ls-dot current"><i class="bi bi-play-fill"></i></div>
                    <div class="ls-item-info">
                        <div class="ls-item-title">GROUP BY и группировка</div>
                        <div class="ls-item-meta"><i class="bi bi-code-slash"></i> Практика <span>· 30 мин</span></div>
                    </div>
                </a>
                <a href="#" class="ls-item locked-item">
                    <div class="ls-dot locked"><i class="bi bi-lock-fill"></i></div>
                    <div class="ls-item-info">
                        <div class="ls-item-title">HAVING — фильтрация групп</div>
                        <div class="ls-item-meta"><i class="bi bi-code-slash"></i> Практика <span>· 20 мин</span></div>
                    </div>
                </a>
                <a href="#" class="ls-item locked-item">
                    <div class="ls-dot locked"><i class="bi bi-lock-fill"></i></div>
                    <div class="ls-item-info">
                        <div class="ls-item-title">Тест: Агрегатные функции</div>
                        <div class="ls-item-meta"><i class="bi bi-patch-question"></i> Тест <span>· 15 мин</span></div>
                    </div>
                </a>
            </div>
        </aside>

        {{-- MAIN --}}
        <div class="lesson-main">

            {{-- Header --}}
            <div class="lesson-header-bar">
                <div class="lhb-left">
                    <a href="{{ url('/course/13') }}" class="lhb-nav"><i class="bi bi-chevron-left"></i></a>
                    <div class="lhb-info">
                        <span class="lhb-num">#14</span>
                        <span class="lhb-title">GROUP BY и группировка</span>
                    </div>
                    <a href="#" class="lhb-nav disabled"><i class="bi bi-chevron-right"></i></a>
                </div>
                <div class="lhb-right">
                    <span class="lhb-type practice"><i class="bi bi-code-slash"></i> Практика</span>
                    <span class="lhb-xp"><i class="bi bi-star-fill"></i> 30 XP</span>
                </div>
            </div>

            {{-- Split: Theory + Practice --}}
            <div class="lesson-split">

                {{-- Theory --}}
                <div class="lesson-theory" id="theoryPane">
                    <h2>{{ $lesson->title }}</h2>

                    <p>
                        Оператор <code>GROUP BY</code> используется для группировки строк, имеющих одинаковые значения, в итоговые строки. Часто используется совместно с агрегатными функциями (<code>COUNT</code>, <code>SUM</code>, <code>AVG</code> и т.д.).
                    </p>

                    <h3>Синтаксис</h3>

                    <div class="theory-code-block">
                        <div class="theory-code-header"><span>SQL</span></div>
                        <div class="theory-code-body">
                            <span class="kw">SELECT</span> <span class="col">column1</span><span class="op">,</span> <span class="fn">COUNT</span><span class="op">(*)</span><br>
                            <span class="kw">FROM</span> <span class="tbl">table_name</span><br>
                            <span class="kw">GROUP BY</span> <span class="col">column1</span><span class="op">;</span>
                        </div>
                    </div>

                    <h3>Пример</h3>

                    <p>Подсчитаем количество рейсов из каждого города:</p>

                    <div class="theory-code-block">
                        <div class="theory-code-header"><span>SQL</span></div>
                        <div class="theory-code-body">
                            <span class="kw">SELECT</span> <span class="col">town_from</span><span class="op">,</span> <span class="fn">COUNT</span><span class="op">(*)</span> <span class="kw">AS</span> <span class="alias">cnt</span><br>
                            <span class="kw">FROM</span> <span class="tbl">Trip</span><br>
                            <span class="kw">GROUP BY</span> <span class="col">town_from</span><span class="op">;</span>
                        </div>
                    </div>

                    <p>Результат:</p>

                    <table class="theory-result-table">
                        <thead><tr><th>town_from</th><th>cnt</th></tr></thead>
                        <tbody>
                        <tr><td>Moscow</td><td>3</td></tr>
                        <tr><td>Paris</td><td>2</td></tr>
                        <tr><td>Rostov</td><td>1</td></tr>
                        </tbody>
                    </table>

                    <div class="theory-note">
                        <h4><i class="bi bi-info-circle-fill"></i> Важно</h4>
                        <p>Все столбцы в <code>SELECT</code>, которые не являются агрегатными функциями, должны быть указаны в <code>GROUP BY</code>.</p>
                    </div>

                    <h3>📝 Ваше задание</h3>

                    <p>
                        Подсчитайте количество пассажиров (<code>COUNT</code>) для каждого рейса (<code>trip</code>) из таблицы <code>Pass_in_trip</code>. Выведите номер рейса и количество пассажиров, назвав столбец <code>count</code>.
                    </p>

                    <div class="theory-code-block">
                        <div class="theory-code-header"><span>Ожидаемый результат</span></div>
                        <div class="theory-code-body">
                            <table class="theory-result-table" style="margin:0;">
                                <thead><tr><th>trip</th><th>count</th></tr></thead>
                                <tbody>
                                <tr><td>1100</td><td>4</td></tr>
                                <tr><td>1123</td><td>2</td></tr>
                                <tr><td>1187</td><td>3</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Resizer --}}
                <div class="lp-resizer-h" id="lpResizerH"></div>

                {{-- Practice --}}
                <div class="lesson-practice">
                    <div class="lp-editor-header">
                        <span class="lp-editor-label"><i class="bi bi-code-slash"></i> Ваше решение</span>
                        <span style="font-size:0.75rem;color:var(--text-muted);"><i class="bi bi-database"></i> Схема: Aero</span>
                    </div>
                    <div class="lp-editor">
                        <textarea id="lessonEditor" placeholder="-- Напишите SQL-запрос для решения задания...&#10;SELECT "></textarea>
                    </div>
                    <div class="lp-run-bar">
                        <span class="shortcuts"><kbd>Ctrl</kbd>+<kbd>Enter</kbd> — выполнить</span>
                        <div class="lp-btns">
                            <button class="lp-run-btn" id="lpRunBtn"><i class="bi bi-play-fill"></i> Выполнить</button>
                            <button class="lp-check-btn" id="lpCheckBtn"><i class="bi bi-check2-circle"></i> Проверить</button>
                        </div>
                    </div>

                    <div class="lp-results">
                        <div class="lp-results-header">
                            <span style="font-size:0.8rem;font-weight:500;">Результат</span>
                            <span style="font-size:0.72rem;color:var(--text-muted);" id="lpResultInfo"></span>
                        </div>
                        <div class="lp-results-body" id="lpResultsBody">
                            <div class="lp-empty" id="lpEmpty">
                                <i class="bi bi-terminal"></i>
                                <span>Выполните запрос для просмотра результата</span>
                            </div>
                        </div>
                    </div>

                    {{-- Next lesson bar --}}
                    <div class="next-lesson-bar" id="nextLessonBar">
                        <div class="nlb-msg"><i class="bi bi-check-circle-fill"></i> Урок пройден! +30 XP 🎉</div>
                        <a href="{{ url('/course/15') }}" class="nlb-next">Следующий урок <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Tab in textarea
        document.getElementById('lessonEditor').addEventListener('keydown', function(e) {
            if (e.key === 'Tab') { e.preventDefault(); var s=this.selectionStart; this.value=this.value.substring(0,s)+'  '+this.value.substring(this.selectionEnd); this.selectionStart=this.selectionEnd=s+2; }
            if (e.ctrlKey && e.key === 'Enter') { e.preventDefault(); document.getElementById('lpRunBtn').click(); }
        });

        // Run
        document.getElementById('lpRunBtn').addEventListener('click', function() {
            var q = document.getElementById('lessonEditor').value.trim();
            if (!q) return;
            document.getElementById('lpEmpty').style.display = 'none';
            document.getElementById('lpResultInfo').textContent = '3 строки • 0.021с';
            document.getElementById('lpResultsBody').innerHTML = '<table class="theory-result-table" style="width:100%;margin:0;"><thead><tr><th>trip</th><th>count</th></tr></thead><tbody><tr><td>1100</td><td>4</td></tr><tr><td>1123</td><td>2</td></tr><tr><td>1187</td><td>3</td></tr></tbody></table>';
        });

        // Check
        document.getElementById('lpCheckBtn').addEventListener('click', function() {
            var q = document.getElementById('lessonEditor').value.trim().toLowerCase();
            if (!q) return;
            if (q.indexOf('group by') !== -1 && q.indexOf('count') !== -1 && q.indexOf('pass_in_trip') !== -1) {
                document.getElementById('nextLessonBar').classList.add('show');
                document.getElementById('lpResultInfo').textContent = '✓ Верно!';
            } else {
                document.getElementById('lpResultInfo').textContent = '✗ Неверно — проверьте запрос';
            }
        });

        // Resizer
        (function(){var r=document.getElementById('lpResizerH'),t=document.getElementById('theoryPane'),d=false;r.addEventListener('mousedown',function(e){d=true;r.classList.add('active');document.body.style.cursor='col-resize';document.body.style.userSelect='none';e.preventDefault();});document.addEventListener('mousemove',function(e){if(!d)return;var cr=t.parentElement.getBoundingClientRect();var nw=e.clientX-cr.left;nw=Math.max(250,Math.min(nw,cr.width-350));t.style.width=nw+'px';t.style.minWidth=nw+'px';});document.addEventListener('mouseup',function(){if(d){d=false;r.classList.remove('active');document.body.style.cursor='';document.body.style.userSelect='';}});})();
    </script>
@endsection
