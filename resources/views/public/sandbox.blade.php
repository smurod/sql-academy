@extends('public.layouts.app')

@section('title', 'SQL Песочница — Свободный редактор')

@section('styles')
    <style>
        .sandbox-page {
            display: flex;
            height: calc(100vh - 72px);
            overflow: hidden;
        }

        /* ── LEFT SIDEBAR: Schema ── */
        .sandbox-sidebar {
            width: 280px;
            min-width: 280px;
            background: var(--bg-card);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .sandbox-sidebar-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
        }

        .sandbox-sidebar-header h3 {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .sandbox-sidebar-header h3 i { color: var(--primary); }

        .schema-select {
            width: 100%;
            background: var(--bg-elevated);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 0.625rem 0.75rem;
            color: var(--text-primary);
            font-size: 0.85rem;
            font-family: inherit;
            outline: none;
            cursor: pointer;
            transition: border-color 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%239ca3af' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            padding-right: 2rem;
        }

        .schema-select:focus { border-color: var(--primary); }

        .schema-select option {
            background: var(--bg-elevated);
            color: var(--text-primary);
        }

        .sandbox-tables {
            flex: 1;
            overflow-y: auto;
            padding: 0.75rem;
        }

        .sandbox-tables::-webkit-scrollbar { width: 4px; }
        .sandbox-tables::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }

        .sb-table {
            margin-bottom: 0.5rem;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
            transition: border-color 0.3s ease;
        }

        .sb-table:hover { border-color: rgba(59,130,246,0.3); }

        .sb-table-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 0.75rem;
            background: rgba(255,255,255,0.03);
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: left;
            color: var(--text-primary);
            font-family: inherit;
            transition: background 0.2s ease;
        }

        .sb-table-header:hover { background: rgba(59,130,246,0.08); }
        .sb-table-header i.ti { color: var(--primary); font-size: 0.9rem; }
        .sb-table-header .tn { font-size: 0.85rem; font-weight: 600; font-family: 'JetBrains Mono', monospace; flex: 1; }
        .sb-table-header .chev { color: var(--text-muted); font-size: 0.75rem; transition: transform 0.3s ease; }
        .sb-table.open .sb-table-header .chev { transform: rotate(180deg); }

        .sb-fields { display: none; padding: 0.25rem 0; border-top: 1px solid var(--border-color); }
        .sb-table.open .sb-fields { display: block; }

        .sb-field {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.375rem 0.75rem 0.375rem 1.5rem;
            font-size: 0.8rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .sb-field:hover { background: rgba(255,255,255,0.03); }
        .sb-fi { font-size: 0.7rem; width: 14px; text-align: center; }
        .sb-fi.pk { color: #fbbf24; }
        .sb-fi.fk { color: var(--primary); }
        .sb-fi.cl { color: var(--text-muted); }
        .sb-fn { color: var(--text-primary); flex: 1; }
        .sb-ft { color: var(--text-muted); font-size: 0.7rem; }

        /* ── MAIN AREA ── */
        .sandbox-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        /* ── TOOLBAR ── */
        .sandbox-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 1rem;
            background: rgba(0,0,0,0.3);
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .sandbox-toolbar-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .stl-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stl-label i { color: var(--accent); }

        .stl-tabs {
            display: flex;
            gap: 0.25rem;
        }

        .stl-tab {
            padding: 0.375rem 0.875rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-family: 'JetBrains Mono', monospace;
            background: none;
            border: none;
            color: var(--text-muted);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .stl-tab:hover { background: rgba(255,255,255,0.05); color: var(--text-secondary); }
        .stl-tab.active { background: rgba(255,255,255,0.1); color: var(--text-primary); }

        .stl-tab .close-tab {
            font-size: 0.65rem;
            opacity: 0;
            transition: opacity 0.2s ease;
            border: none;
            background: none;
            color: inherit;
            padding: 0;
        }

        .stl-tab:hover .close-tab { opacity: 0.6; }
        .stl-tab .close-tab:hover { opacity: 1; }

        .stl-new {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: none;
            border: 1px dashed var(--border-color);
            color: var(--text-muted);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .stl-new:hover { border-color: var(--primary); color: var(--primary); }

        .sandbox-toolbar-right {
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .st-action {
            padding: 0.375rem 0.5rem;
            border-radius: 6px;
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .st-action:hover { background: rgba(255,255,255,0.08); color: var(--text-primary); }

        /* ── EDITOR ── */
        .sandbox-editor {
            flex: 1;
            min-height: 200px;
            position: relative;
        }

        .sandbox-editor textarea {
            width: 100%;
            height: 100%;
            background: var(--bg-elevated);
            color: var(--text-primary);
            border: none;
            padding: 1.25rem 1.5rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            line-height: 1.8;
            resize: none;
            outline: none;
            tab-size: 2;
        }

        .sandbox-editor textarea::placeholder { color: var(--text-muted); }

        /* ── RUN BAR ── */
        .sandbox-run-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.625rem 1rem;
            background: rgba(0,0,0,0.2);
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .srb-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .srb-left kbd {
            background: rgba(255,255,255,0.08);
            padding: 0.125rem 0.5rem;
            border-radius: 4px;
            border: 1px solid var(--border-color);
            font-size: 0.7rem;
            color: var(--text-secondary);
        }

        .srb-right { display: flex; gap: 0.5rem; }

        .sb-run-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.5rem;
            background: var(--success);
            color: var(--text-primary);
            border: none;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .sb-run-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(34,197,94,0.4); }

        .sb-clear-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-muted);
            transition: all 0.3s ease;
        }

        .sb-clear-btn:hover { border-color: var(--danger); color: var(--danger); }

        /* ── RESULTS ── */
        .sandbox-results {
            height: 300px;
            min-height: 80px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: var(--bg-elevated);
        }

        .sandbox-results-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 1rem;
            border-bottom: 1px solid var(--border-color);
            background: rgba(0,0,0,0.2);
            flex-shrink: 0;
        }

        .sr-tabs { display: flex; gap: 0.25rem; }

        .sr-tab {
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 500;
            background: none;
            border: none;
            color: var(--text-muted);
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .sr-tab:hover { color: var(--text-secondary); }
        .sr-tab.active { background: rgba(255,255,255,0.08); color: var(--text-primary); }

        .sr-info { font-size: 0.75rem; color: var(--text-muted); }

        .sandbox-results-body {
            flex: 1;
            overflow: auto;
        }

        .sandbox-results-body::-webkit-scrollbar { width: 4px; height: 4px; }
        .sandbox-results-body::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }

        .sb-result-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: var(--text-muted);
            gap: 0.75rem;
        }

        .sb-result-empty i { font-size: 2.5rem; opacity: 0.3; }
        .sb-result-empty span { font-size: 0.9rem; }

        .sb-result-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
        }

        .sb-result-table th {
            text-align: left;
            padding: 0.5rem 1rem;
            background: rgba(59,130,246,0.08);
            color: var(--primary);
            font-weight: 600;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .sb-result-table td {
            padding: 0.5rem 1rem;
            color: var(--text-secondary);
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }

        .sb-result-table tr:hover td { background: rgba(255,255,255,0.02); }

        /* ── RESIZER ── */
        .sb-resizer-v {
            height: 5px;
            cursor: row-resize;
            background: transparent;
            transition: background 0.3s ease;
            flex-shrink: 0;
        }

        .sb-resizer-v:hover, .sb-resizer-v.active { background: var(--primary); }

        @media (max-width: 1024px) {
            .sandbox-sidebar { display: none; }
        }
    </style>
@endsection

@section('content')
    <div class="sandbox-page">

        {{-- Sidebar --}}
        <aside class="sandbox-sidebar">
            <div class="sandbox-sidebar-header">
                <h3><i class="bi bi-database"></i> Схема базы данных</h3>
                <select class="schema-select" id="schemaSelect">
                    <option value="aero">✈️ Аэропорт (Aero)</option>
                    <option value="computers">💻 Компьютеры (Computer)</option>
                    <option value="ships">🚢 Корабли (Ships)</option>
                    <option value="university">🎓 Университет (University)</option>
                    <option value="custom">📝 Своя схема</option>
                </select>
            </div>
            <div class="sandbox-tables">
                <div class="sb-table open">
                    <button class="sb-table-header">
                        <i class="bi bi-table ti"></i>
                        <span class="tn">Passenger</span>
                        <i class="bi bi-chevron-down chev"></i>
                    </button>
                    <div class="sb-fields">
                        <div class="sb-field"><span class="sb-fi pk"><i class="bi bi-key-fill"></i></span><span class="sb-fn">id</span><span class="sb-ft">INT</span></div>
                        <div class="sb-field"><span class="sb-fi cl"><i class="bi bi-dash"></i></span><span class="sb-fn">name</span><span class="sb-ft">VARCHAR</span></div>
                        <div class="sb-field"><span class="sb-fi cl"><i class="bi bi-dash"></i></span><span class="sb-fn">age</span><span class="sb-ft">INT</span></div>
                    </div>
                </div>
                <div class="sb-table open">
                    <button class="sb-table-header">
                        <i class="bi bi-table ti"></i>
                        <span class="tn">Trip</span>
                        <i class="bi bi-chevron-down chev"></i>
                    </button>
                    <div class="sb-fields">
                        <div class="sb-field"><span class="sb-fi pk"><i class="bi bi-key-fill"></i></span><span class="sb-fn">id</span><span class="sb-ft">INT</span></div>
                        <div class="sb-field"><span class="sb-fi cl"><i class="bi bi-dash"></i></span><span class="sb-fn">company</span><span class="sb-ft">VARCHAR</span></div>
                        <div class="sb-field"><span class="sb-fi cl"><i class="bi bi-dash"></i></span><span class="sb-fn">town_from</span><span class="sb-ft">VARCHAR</span></div>
                        <div class="sb-field"><span class="sb-fi cl"><i class="bi bi-dash"></i></span><span class="sb-fn">town_to</span><span class="sb-ft">VARCHAR</span></div>
                        <div class="sb-field"><span class="sb-fi cl"><i class="bi bi-dash"></i></span><span class="sb-fn">time_out</span><span class="sb-ft">DATETIME</span></div>
                        <div class="sb-field"><span class="sb-fi cl"><i class="bi bi-dash"></i></span><span class="sb-fn">time_in</span><span class="sb-ft">DATETIME</span></div>
                    </div>
                </div>
                <div class="sb-table">
                    <button class="sb-table-header">
                        <i class="bi bi-table ti"></i>
                        <span class="tn">Pass_in_trip</span>
                        <i class="bi bi-chevron-down chev"></i>
                    </button>
                    <div class="sb-fields">
                        <div class="sb-field"><span class="sb-fi fk"><i class="bi bi-link-45deg"></i></span><span class="sb-fn">trip</span><span class="sb-ft">INT</span></div>
                        <div class="sb-field"><span class="sb-fi fk"><i class="bi bi-link-45deg"></i></span><span class="sb-fn">passenger</span><span class="sb-ft">INT</span></div>
                        <div class="sb-field"><span class="sb-fi cl"><i class="bi bi-dash"></i></span><span class="sb-fn">place</span><span class="sb-ft">VARCHAR</span></div>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Main --}}
        <div class="sandbox-main">

            {{-- Toolbar --}}
            <div class="sandbox-toolbar">
                <div class="sandbox-toolbar-left">
                    <span class="stl-label"><i class="bi bi-terminal"></i> Песочница</span>
                    <div class="stl-tabs">
                        <button class="stl-tab active">query_1.sql <span class="close-tab">×</span></button>
                        <button class="stl-tab">query_2.sql <span class="close-tab">×</span></button>
                    </div>
                    <button class="stl-new"><i class="bi bi-plus"></i></button>
                </div>
                <div class="sandbox-toolbar-right">
                    <button class="st-action" title="Форматировать"><i class="bi bi-text-indent-left"></i></button>
                    <button class="st-action" title="Копировать"><i class="bi bi-clipboard"></i></button>
                    <button class="st-action" title="Скачать"><i class="bi bi-download"></i></button>
                    <button class="st-action" title="Настройки"><i class="bi bi-gear"></i></button>
                </div>
            </div>

            {{-- Editor --}}
            <div class="sandbox-editor">
                <textarea id="sandboxEditor" placeholder="-- Напишите любой SQL-запрос...&#10;-- Выберите схему БД в боковой панели&#10;&#10;SELECT * FROM Passenger&#10;WHERE age > 25&#10;ORDER BY name;"></textarea>
            </div>

            {{-- Run Bar --}}
            <div class="sandbox-run-bar">
                <div class="srb-left">
                    <span><kbd>Ctrl</kbd> + <kbd>Enter</kbd> — выполнить</span>
                    <span><kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>F</kbd> — форматировать</span>
                </div>
                <div class="srb-right">
                    <button class="sb-clear-btn" title="Очистить"><i class="bi bi-trash3"></i></button>
                    <button class="sb-run-btn" id="sbRunBtn"><i class="bi bi-play-fill"></i> Выполнить</button>
                </div>
            </div>

            {{-- Resizer --}}
            <div class="sb-resizer-v" id="sbResizerV"></div>

            {{-- Results --}}
            <div class="sandbox-results" id="sbResults">
                <div class="sandbox-results-header">
                    <div class="sr-tabs">
                        <button class="sr-tab active">Результат</button>
                        <button class="sr-tab">История</button>
                        <button class="sr-tab">Сообщения</button>
                    </div>
                    <span class="sr-info" id="sbResultsInfo"></span>
                </div>
                <div class="sandbox-results-body" id="sbResultsBody">
                    <div class="sb-result-empty" id="sbEmpty">
                        <i class="bi bi-terminal"></i>
                        <span>Выполните запрос, чтобы увидеть результат</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Toggle tables
        document.querySelectorAll('.sb-table-header').forEach(function(h) {
            h.addEventListener('click', function() { this.closest('.sb-table').classList.toggle('open'); });
        });

        // Tab switching
        document.querySelectorAll('.stl-tab').forEach(function(tab) {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.stl-tab').forEach(function(t) { t.classList.remove('active'); });
                this.classList.add('active');
            });
        });

        // Results tabs
        document.querySelectorAll('.sr-tab').forEach(function(tab) {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.sr-tab').forEach(function(t) { t.classList.remove('active'); });
                this.classList.add('active');
            });
        });

        // Run button
        document.getElementById('sbRunBtn').addEventListener('click', function() {
            var q = document.getElementById('sandboxEditor').value.trim();
            if (!q) return;
            document.getElementById('sbEmpty').style.display = 'none';
            document.getElementById('sbResultsInfo').textContent = '5 строк • 0.028с';
            var tableHTML = '<table class="sb-result-table"><thead><tr><th>id</th><th>name</th><th>age</th></tr></thead><tbody>';
            var data = [['1','Bruce Willis','65'],['2','George Clooney','59'],['3','Kevin Costner','66'],['4','Nikole Kidman','53'],['5','Steve Martin','75']];
            data.forEach(function(r) { tableHTML += '<tr><td>'+r[0]+'</td><td>'+r[1]+'</td><td>'+r[2]+'</td></tr>'; });
            tableHTML += '</tbody></table>';
            document.getElementById('sbResultsBody').innerHTML = tableHTML;
        });

        // Tab support in textarea
        document.getElementById('sandboxEditor').addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                var s = this.selectionStart, en = this.selectionEnd;
                this.value = this.value.substring(0, s) + '  ' + this.value.substring(en);
                this.selectionStart = this.selectionEnd = s + 2;
            }
            if (e.ctrlKey && e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('sbRunBtn').click();
            }
        });

        // Vertical resizer
        (function() {
            var r = document.getElementById('sbResizerV');
            var res = document.getElementById('sbResults');
            var dragging = false;
            r.addEventListener('mousedown', function(e) { dragging = true; r.classList.add('active'); document.body.style.cursor = 'row-resize'; document.body.style.userSelect = 'none'; e.preventDefault(); });
            document.addEventListener('mousemove', function(e) {
                if (!dragging) return;
                var cr = res.parentElement.getBoundingClientRect();
                var nh = cr.bottom - e.clientY;
                nh = Math.max(80, Math.min(nh, cr.height - 200));
                res.style.height = nh + 'px';
            });
            document.addEventListener('mouseup', function() { if (dragging) { dragging = false; r.classList.remove('active'); document.body.style.cursor = ''; document.body.style.userSelect = ''; } });
        })();
    </script>
@endsection
