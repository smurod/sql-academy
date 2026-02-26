@extends('public.layouts.app')

@section('title', 'Задача #4 — SQL Тренажёр')

@section('styles')
    <style>
        /* ── TASK PAGE — FULL HEIGHT LAYOUT ── */
        .task-page {
            display: flex;
            height: calc(100vh - 72px);
            overflow: hidden;
        }

        /* ── LEFT: DB SCHEMA SIDEBAR ── */
        .schema-sidebar {
            width: 280px;
            min-width: 280px;
            background: var(--bg-card);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .schema-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .schema-header h3 {
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .schema-header h3 i {
            color: var(--primary);
        }

        .schema-toggle {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1rem;
            transition: all 0.3s ease;
            padding: 0.25rem;
        }

        .schema-toggle:hover {
            color: var(--text-primary);
        }

        .schema-body {
            flex: 1;
            overflow-y: auto;
            padding: 0.75rem;
        }

        .schema-body::-webkit-scrollbar {
            width: 4px;
        }

        .schema-body::-webkit-scrollbar-track {
            background: transparent;
        }

        .schema-body::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 2px;
        }

        .db-table {
            margin-bottom: 0.5rem;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .db-table:hover {
            border-color: rgba(59,130,246,0.3);
        }

        .db-table-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 0.75rem;
            background: rgba(255,255,255,0.03);
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            width: 100%;
            text-align: left;
            color: var(--text-primary);
            font-family: inherit;
        }

        .db-table-header:hover {
            background: rgba(59,130,246,0.08);
        }

        .db-table-header i.table-icon {
            color: var(--primary);
            font-size: 0.9rem;
        }

        .db-table-header .table-name {
            font-size: 0.85rem;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            flex: 1;
        }

        .db-table-header .chevron {
            color: var(--text-muted);
            font-size: 0.75rem;
            transition: transform 0.3s ease;
        }

        .db-table.open .db-table-header .chevron {
            transform: rotate(180deg);
        }

        .db-table-fields {
            display: none;
            padding: 0.25rem 0;
            border-top: 1px solid var(--border-color);
        }

        .db-table.open .db-table-fields {
            display: block;
        }

        .db-field {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.375rem 0.75rem 0.375rem 1.5rem;
            font-size: 0.8rem;
            font-family: 'JetBrains Mono', monospace;
            transition: background 0.2s ease;
        }

        .db-field:hover {
            background: rgba(255,255,255,0.03);
        }

        .db-field-icon {
            font-size: 0.7rem;
            width: 14px;
            text-align: center;
        }

        .db-field-icon.pk { color: #fbbf24; }
        .db-field-icon.fk { color: var(--primary); }
        .db-field-icon.col { color: var(--text-muted); }

        .db-field-name {
            color: var(--text-primary);
            flex: 1;
        }

        .db-field-type {
            color: var(--text-muted);
            font-size: 0.7rem;
        }

        /* ── CENTER AREA ── */
        .task-center {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        /* ── TASK HEADER BAR ── */
        .task-header-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1.5rem;
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .task-header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .task-nav-btn {
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

        .task-nav-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(59,130,246,0.1);
        }

        .task-header-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .task-header-num {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--text-primary);
            font-weight: 700;
            font-size: 0.8rem;
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
        }

        .task-header-name {
            font-weight: 600;
            font-size: 1rem;
        }

        .task-header-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .task-difficulty-badge {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
        }

        .task-difficulty-badge.easy { background: rgba(34,197,94,0.1); color: var(--success); }
        .task-difficulty-badge.medium { background: rgba(245,158,11,0.1); color: var(--warning); }
        .task-difficulty-badge.hard { background: rgba(239,68,68,0.1); color: var(--danger); }

        .task-hint-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .task-hint-btn:hover {
            border-color: var(--warning);
            color: var(--warning);
        }

        /* ── SPLIT: DESCRIPTION + EDITOR ── */
        .task-split {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        /* ── TASK DESCRIPTION PANE ── */
        .task-description-pane {
            width: 40%;
            min-width: 300px;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .task-desc-tabs {
            display: flex;
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .task-desc-tab {
            flex: 1;
            padding: 0.75rem 1rem;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 500;
            font-family: inherit;
            color: var(--text-muted);
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .task-desc-tab:hover {
            color: var(--text-secondary);
            background: rgba(255,255,255,0.02);
        }

        .task-desc-tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
            background: rgba(59,130,246,0.05);
        }

        .task-desc-content {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }

        .task-desc-content::-webkit-scrollbar {
            width: 4px;
        }

        .task-desc-content::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 2px;
        }

        .task-desc-content h2 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .task-desc-content p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .task-desc-content .example-box {
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1rem;
        }

        .task-desc-content .example-box h4 {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.75rem;
        }

        .task-desc-content .example-box table {
            width: 100%;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            border-collapse: collapse;
        }

        .task-desc-content .example-box table th {
            text-align: left;
            padding: 0.5rem 0.75rem;
            color: var(--primary);
            font-weight: 600;
            border-bottom: 1px solid var(--border-color);
            background: rgba(59,130,246,0.05);
        }

        .task-desc-content .example-box table td {
            padding: 0.5rem 0.75rem;
            color: var(--text-secondary);
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }

        .task-desc-content .hint-block {
            background: rgba(245,158,11,0.08);
            border: 1px solid rgba(245,158,11,0.2);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-top: 1rem;
        }

        .task-desc-content .hint-block h4 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--warning);
            margin-bottom: 0.5rem;
        }

        .task-desc-content .hint-block p {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: 0;
        }

        /* ── EDITOR + RESULTS PANE ── */
        .task-editor-pane {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        /* ── SQL EDITOR ── */
        .sql-editor-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }

        .sql-editor-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 1rem;
            background: rgba(0,0,0,0.3);
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .sql-editor-header-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sql-editor-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sql-editor-label i { color: var(--primary); }

        .sql-editor-db {
            font-size: 0.75rem;
            color: var(--text-muted);
            background: rgba(255,255,255,0.05);
            padding: 0.25rem 0.625rem;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .sql-editor-actions {
            display: flex;
            gap: 0.375rem;
        }

        .sql-editor-action {
            padding: 0.375rem 0.5rem;
            border-radius: 6px;
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .sql-editor-action:hover {
            background: rgba(255,255,255,0.08);
            color: var(--text-primary);
        }

        .sql-editor-area {
            flex: 1;
            position: relative;
            min-height: 150px;
        }

        .sql-editor-area textarea {
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

        .sql-editor-area textarea::placeholder {
            color: var(--text-muted);
        }

        /* ── RUN BAR ── */
        .sql-run-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            background: rgba(0,0,0,0.2);
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .sql-run-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sql-run-left .shortcut {
            font-size: 0.75rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .shortcut kbd {
            background: rgba(255,255,255,0.08);
            padding: 0.125rem 0.5rem;
            border-radius: 4px;
            font-size: 0.7rem;
            font-family: inherit;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
        }

        .sql-run-btns {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-run {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: var(--success);
            color: var(--text-primary);
            border: none;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .btn-run:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(34,197,94,0.4);
        }

        .btn-check {
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

        .btn-check:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px var(--glow-primary);
        }

        .btn-reset {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-muted);
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-reset:hover {
            border-color: var(--danger);
            color: var(--danger);
        }

        /* ── RESULTS AREA ── */
        .sql-results {
            height: 250px;
            min-height: 100px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: var(--bg-elevated);
        }

        .sql-results-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.625rem 1rem;
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
            background: rgba(0,0,0,0.2);
        }

        .results-tabs {
            display: flex;
            gap: 0.25rem;
        }

        .results-tab {
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 500;
            font-family: inherit;
            background: none;
            border: none;
            color: var(--text-muted);
            transition: all 0.3s ease;
        }

        .results-tab:hover { color: var(--text-secondary); }
        .results-tab.active { background: rgba(255,255,255,0.08); color: var(--text-primary); }

        .results-info {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .sql-results-body {
            flex: 1;
            overflow: auto;
            padding: 0;
        }

        .sql-results-body::-webkit-scrollbar { width: 4px; height: 4px; }
        .sql-results-body::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }

        /* ── Result States ── */
        .result-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: var(--text-muted);
            gap: 0.75rem;
        }

        .result-empty i {
            font-size: 2.5rem;
            opacity: 0.3;
        }

        .result-empty span {
            font-size: 0.9rem;
        }

        .result-success-msg {
            display: none;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.2);
            border-radius: 12px;
            margin: 1rem;
        }

        .result-success-msg.show {
            display: flex;
        }

        .result-success-msg i {
            font-size: 1.5rem;
            color: var(--success);
        }

        .result-success-msg .msg-content h4 {
            color: var(--success);
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .result-success-msg .msg-content p {
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        .result-error-msg {
            display: none;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 12px;
            margin: 1rem;
        }

        .result-error-msg.show {
            display: flex;
        }

        .result-error-msg i {
            font-size: 1.5rem;
            color: var(--danger);
            flex-shrink: 0;
            margin-top: 0.125rem;
        }

        .result-error-msg .msg-content h4 {
            color: var(--danger);
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .result-error-msg .msg-content p {
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-family: 'JetBrains Mono', monospace;
        }

        /* ── Results Table ── */
        .results-table-wrap {
            overflow: auto;
            height: 100%;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
        }

        .results-table th {
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

        .results-table td {
            padding: 0.5rem 1rem;
            color: var(--text-secondary);
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }

        .results-table tr:hover td {
            background: rgba(255,255,255,0.02);
        }

        /* ── RESIZER ── */
        .resizer-h {
            width: 5px;
            cursor: col-resize;
            background: transparent;
            transition: background 0.3s ease;
            flex-shrink: 0;
            position: relative;
        }

        .resizer-h:hover,
        .resizer-h.active {
            background: var(--primary);
        }

        .resizer-h::after {
            content: '';
            position: absolute;
            left: -5px;
            right: -5px;
            top: 0;
            bottom: 0;
        }

        .resizer-v {
            height: 5px;
            cursor: row-resize;
            background: transparent;
            transition: background 0.3s ease;
            flex-shrink: 0;
            position: relative;
        }

        .resizer-v:hover,
        .resizer-v.active {
            background: var(--primary);
        }

        .resizer-v::after {
            content: '';
            position: absolute;
            top: -5px;
            bottom: -5px;
            left: 0;
            right: 0;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .schema-sidebar {
                display: none;
            }

            .task-split {
                flex-direction: column;
            }

            .task-description-pane {
                width: 100%;
                min-width: 0;
                height: 40%;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
            }

            .resizer-h {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .task-header-right {
                display: none;
            }

            .sql-run-left .shortcut {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="task-page">

        {{-- LEFT: Database Schema Sidebar --}}
        <aside class="schema-sidebar">
            <div class="schema-header">
                <h3><i class="bi bi-database"></i> Схема БД</h3>
                <button class="schema-toggle"><i class="bi bi-arrows-angle-contract"></i></button>
            </div>
            <div class="schema-body">

                {{-- Table: Passenger --}}
                <div class="db-table open">
                    <button class="db-table-header">
                        <i class="bi bi-table table-icon"></i>
                        <span class="table-name">Passenger</span>
                        <i class="bi bi-chevron-down chevron"></i>
                    </button>
                    <div class="db-table-fields">
                        <div class="db-field">
                            <span class="db-field-icon pk"><i class="bi bi-key-fill"></i></span>
                            <span class="db-field-name">id</span>
                            <span class="db-field-type">INT</span>
                        </div>
                        <div class="db-field">
                            <span class="db-field-icon col"><i class="bi bi-dash"></i></span>
                            <span class="db-field-name">name</span>
                            <span class="db-field-type">VARCHAR</span>
                        </div>
                        <div class="db-field">
                            <span class="db-field-icon col"><i class="bi bi-dash"></i></span>
                            <span class="db-field-name">age</span>
                            <span class="db-field-type">INT</span>
                        </div>
                    </div>
                </div>

                {{-- Table: Trip --}}
                <div class="db-table open">
                    <button class="db-table-header">
                        <i class="bi bi-table table-icon"></i>
                        <span class="table-name">Trip</span>
                        <i class="bi bi-chevron-down chevron"></i>
                    </button>
                    <div class="db-table-fields">
                        <div class="db-field">
                            <span class="db-field-icon pk"><i class="bi bi-key-fill"></i></span>
                            <span class="db-field-name">id</span>
                            <span class="db-field-type">INT</span>
                        </div>
                        <div class="db-field">
                            <span class="db-field-icon col"><i class="bi bi-dash"></i></span>
                            <span class="db-field-name">company</span>
                            <span class="db-field-type">VARCHAR</span>
                        </div>
                        <div class="db-field">
                            <span class="db-field-icon col"><i class="bi bi-dash"></i></span>
                            <span class="db-field-name">town_from</span>
                            <span class="db-field-type">VARCHAR</span>
                        </div>
                        <div class="db-field">
                            <span class="db-field-icon col"><i class="bi bi-dash"></i></span>
                            <span class="db-field-name">town_to</span>
                            <span class="db-field-type">VARCHAR</span>
                        </div>
                        <div class="db-field">
                            <span class="db-field-icon col"><i class="bi bi-dash"></i></span>
                            <span class="db-field-name">time_out</span>
                            <span class="db-field-type">DATETIME</span>
                        </div>
                        <div class="db-field">
                            <span class="db-field-icon col"><i class="bi bi-dash"></i></span>
                            <span class="db-field-name">time_in</span>
                            <span class="db-field-type">DATETIME</span>
                        </div>
                    </div>
                </div>

                {{-- Table: Pass_in_trip --}}
                <div class="db-table">
                    <button class="db-table-header">
                        <i class="bi bi-table table-icon"></i>
                        <span class="table-name">Pass_in_trip</span>
                        <i class="bi bi-chevron-down chevron"></i>
                    </button>
                    <div class="db-table-fields">
                        <div class="db-field">
                            <span class="db-field-icon fk"><i class="bi bi-link-45deg"></i></span>
                            <span class="db-field-name">trip</span>
                            <span class="db-field-type">INT</span>
                        </div>
                        <div class="db-field">
                            <span class="db-field-icon fk"><i class="bi bi-link-45deg"></i></span>
                            <span class="db-field-name">passenger</span>
                            <span class="db-field-type">INT</span>
                        </div>
                        <div class="db-field">
                            <span class="db-field-icon col"><i class="bi bi-dash"></i></span>
                            <span class="db-field-name">place</span>
                            <span class="db-field-type">VARCHAR</span>
                        </div>
                    </div>
                </div>

            </div>
        </aside>

        {{-- CENTER --}}
        <div class="task-center">

            {{-- Task Header Bar --}}
            <div class="task-header-bar">
                <div class="task-header-left">
                    <a href="{{ url('/tasks') }}" class="task-nav-btn" title="К списку задач">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <a href="{{ url('/tasks/3') }}" class="task-nav-btn" title="Предыдущая задача">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    <div class="task-header-title">
                        <span class="task-header-num">#4</span>
                        <span class="task-header-name">Сортировка результатов</span>
                    </div>
                    <a href="{{ url('/tasks/5') }}" class="task-nav-btn" title="Следующая задача">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
                <div class="task-header-right">
                <span class="task-difficulty-badge easy">
                    <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Легко
                </span>
                    <button class="task-hint-btn">
                        <i class="bi bi-lightbulb"></i> Подсказка
                    </button>
                </div>
            </div>

            {{-- Split: Description + Editor --}}
            <div class="task-split">

                {{-- Description Pane --}}
                <div class="task-description-pane" id="descPane">
                    <div class="task-desc-tabs">
                        <button class="task-desc-tab active" data-tab="description">
                            <i class="bi bi-file-text"></i> Условие
                        </button>
                        <button class="task-desc-tab" data-tab="solution">
                            <i class="bi bi-chat-dots"></i> Обсуждение
                        </button>
                    </div>
                    <div class="task-desc-content">
                        <h2>Сортировка результатов</h2>

                        <p>
                            Выведите имена пассажиров (<code style="background:rgba(255,255,255,0.08);padding:0.125rem 0.5rem;border-radius:4px;font-family:'JetBrains Mono',monospace;font-size:0.85rem;color:var(--accent);">name</code>),
                            отсортированных по имени в алфавитном порядке.
                        </p>

                        <p>
                            Используйте оператор <code style="background:rgba(255,255,255,0.08);padding:0.125rem 0.5rem;border-radius:4px;font-family:'JetBrains Mono',monospace;font-size:0.85rem;color:#c792ea;">ORDER BY</code>
                            для сортировки результатов запроса.
                        </p>

                        <div class="example-box">
                            <h4>Ожидаемый результат</h4>
                            <table>
                                <thead>
                                <tr><th>name</th></tr>
                                </thead>
                                <tbody>
                                <tr><td>Bruce Willis</td></tr>
                                <tr><td>George Clooney</td></tr>
                                <tr><td>Kevin Costner</td></tr>
                                <tr><td>Nikole Kidman</td></tr>
                                <tr><td>Steve Martin</td></tr>
                                <tr><td style="color:var(--text-muted);font-style:italic;">...</td></tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="hint-block" id="hintBlock" style="display: none;">
                            <h4><i class="bi bi-lightbulb-fill"></i> Подсказка</h4>
                            <p>Используйте <code style="color:var(--accent);">SELECT name FROM Passenger ORDER BY name;</code> — по умолчанию сортировка идёт по возрастанию (ASC).</p>
                        </div>
                    </div>
                </div>

                {{-- Resizer --}}
                <div class="resizer-h" id="resizerH"></div>

                {{-- Editor Pane --}}
                <div class="task-editor-pane">

                    {{-- SQL Editor --}}
                    <div class="sql-editor-wrapper">
                        <div class="sql-editor-header">
                            <div class="sql-editor-header-left">
                                <span class="sql-editor-label"><i class="bi bi-code-slash"></i> SQL Редактор</span>
                                <span class="sql-editor-db"><i class="bi bi-database"></i> Aero</span>
                            </div>
                            <div class="sql-editor-actions">
                                <button class="sql-editor-action" title="Форматировать"><i class="bi bi-text-indent-left"></i></button>
                                <button class="sql-editor-action" title="Копировать"><i class="bi bi-clipboard"></i></button>
                                <button class="sql-editor-action" title="Полный экран"><i class="bi bi-arrows-fullscreen"></i></button>
                            </div>
                        </div>
                        <div class="sql-editor-area">
                            <textarea id="sqlEditor" placeholder="-- Напишите SQL-запрос здесь...&#10;SELECT "></textarea>
                        </div>
                    </div>

                    {{-- Run Bar --}}
                    <div class="sql-run-bar">
                        <div class="sql-run-left">
                            <span class="shortcut"><kbd>Ctrl</kbd> + <kbd>Enter</kbd> — выполнить</span>
                        </div>
                        <div class="sql-run-btns">
                            <button class="btn-reset" title="Сбросить" id="btnReset"><i class="bi bi-arrow-counterclockwise"></i></button>
                            <button class="btn-run" id="btnRun"><i class="bi bi-play-fill"></i> Выполнить</button>
                            <button class="btn-check" id="btnCheck"><i class="bi bi-check2-circle"></i> Проверить</button>
                        </div>
                    </div>

                    {{-- Resizer vertical --}}
                    <div class="resizer-v" id="resizerV"></div>

                    {{-- Results --}}
                    <div class="sql-results" id="sqlResults">
                        <div class="sql-results-header">
                            <div class="results-tabs">
                                <button class="results-tab active">Результат</button>
                                <button class="results-tab">Ожидаемый</button>
                            </div>
                            <span class="results-info" id="resultsInfo"></span>
                        </div>
                        <div class="sql-results-body" id="resultsBody">

                            {{-- Empty state (default) --}}
                            <div class="result-empty" id="resultEmpty">
                                <i class="bi bi-terminal"></i>
                                <span>Выполните запрос, чтобы увидеть результат</span>
                            </div>

                            {{-- Success message (hidden) --}}
                            <div class="result-success-msg" id="resultSuccess">
                                <i class="bi bi-check-circle-fill"></i>
                                <div class="msg-content">
                                    <h4>Верное решение! 🎉</h4>
                                    <p>Ваш запрос вернул правильный результат. Переходите к следующей задаче!</p>
                                </div>
                            </div>

                            {{-- Error message (hidden) --}}
                            <div class="result-error-msg" id="resultError">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <div class="msg-content">
                                    <h4>Ошибка в запросе</h4>
                                    <p id="errorText">ERROR: column "names" does not exist. Did you mean "name"?</p>
                                </div>
                            </div>

                            {{-- Results table (hidden) --}}
                            <div class="results-table-wrap" id="resultTable" style="display:none;">
                                <table class="results-table">
                                    <thead>
                                    <tr>
                                        <th>name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr><td>Bruce Willis</td></tr>
                                    <tr><td>George Clooney</td></tr>
                                    <tr><td>Kevin Costner</td></tr>
                                    <tr><td>Nikole Kidman</td></tr>
                                    <tr><td>Steve Martin</td></tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // ── Toggle DB tables ──
        document.querySelectorAll('.db-table-header').forEach(function(header) {
            header.addEventListener('click', function() {
                this.closest('.db-table').classList.toggle('open');
            });
        });

        // ── Hint button ──
        document.querySelector('.task-hint-btn').addEventListener('click', function() {
            var hint = document.getElementById('hintBlock');
            hint.style.display = hint.style.display === 'none' ? 'block' : 'none';
        });

        // ── Description tabs ──
        document.querySelectorAll('.task-desc-tab').forEach(function(tab) {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.task-desc-tab').forEach(function(t) { t.classList.remove('active'); });
                this.classList.add('active');
            });
        });

        // ── Results tabs ──
        document.querySelectorAll('.results-tab').forEach(function(tab) {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.results-tab').forEach(function(t) { t.classList.remove('active'); });
                this.classList.add('active');
            });
        });

        // ── Run button: simulate ──
        document.getElementById('btnRun').addEventListener('click', function() {
            simulateRun();
        });

        // ── Check button: simulate ──
        document.getElementById('btnCheck').addEventListener('click', function() {
            simulateCheck();
        });

        // ── Reset button ──
        document.getElementById('btnReset').addEventListener('click', function() {
            document.getElementById('sqlEditor').value = '';
            resetResults();
        });

        // ── Ctrl+Enter shortcut ──
        document.getElementById('sqlEditor').addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'Enter') {
                e.preventDefault();
                simulateRun();
            }
            // Tab support
            if (e.key === 'Tab') {
                e.preventDefault();
                var start = this.selectionStart;
                var end = this.selectionEnd;
                this.value = this.value.substring(0, start) + '  ' + this.value.substring(end);
                this.selectionStart = this.selectionEnd = start + 2;
            }
        });

        function resetResults() {
            document.getElementById('resultEmpty').style.display = 'flex';
            document.getElementById('resultSuccess').classList.remove('show');
            document.getElementById('resultError').classList.remove('show');
            document.getElementById('resultTable').style.display = 'none';
            document.getElementById('resultsInfo').textContent = '';
        }

        function simulateRun() {
            var query = document.getElementById('sqlEditor').value.trim().toLowerCase();
            resetResults();

            if (!query) return;

            document.getElementById('resultEmpty').style.display = 'none';

            if (query.indexOf('select') === -1) {
                document.getElementById('resultError').classList.add('show');
                document.getElementById('errorText').textContent = 'ERROR: syntax error at or near "' + query.split(' ')[0] + '"';
                document.getElementById('resultsInfo').textContent = 'Ошибка';
            } else {
                document.getElementById('resultTable').style.display = 'block';
                document.getElementById('resultsInfo').textContent = '5 строк • 0.034с';
            }
        }

        function simulateCheck() {
            var query = document.getElementById('sqlEditor').value.trim().toLowerCase();
            resetResults();

            if (!query) return;

            document.getElementById('resultEmpty').style.display = 'none';

            // Simple check simulation
            if (query.indexOf('select') !== -1 && query.indexOf('name') !== -1 &&
                query.indexOf('passenger') !== -1 && query.indexOf('order by') !== -1) {
                document.getElementById('resultSuccess').classList.add('show');
                document.getElementById('resultTable').style.display = 'block';
                document.getElementById('resultsInfo').textContent = '✓ Верно • 5 строк • 0.034с';
            } else {
                document.getElementById('resultError').classList.add('show');
                document.getElementById('errorText').textContent = 'Результат вашего запроса не совпадает с ожидаемым. Проверьте сортировку.';
                document.getElementById('resultsInfo').textContent = '✗ Неверно';
            }
        }

        // ── Horizontal Resizer (Description ↔ Editor) ──
        (function() {
            var resizer = document.getElementById('resizerH');
            var leftPane = document.getElementById('descPane');
            var isResizing = false;

            resizer.addEventListener('mousedown', function(e) {
                isResizing = true;
                resizer.classList.add('active');
                document.body.style.cursor = 'col-resize';
                document.body.style.userSelect = 'none';
                e.preventDefault();
            });

            document.addEventListener('mousemove', function(e) {
                if (!isResizing) return;
                var containerRect = leftPane.parentElement.getBoundingClientRect();
                var newWidth = e.clientX - containerRect.left;
                var minWidth = 250;
                var maxWidth = containerRect.width - 350;
                newWidth = Math.max(minWidth, Math.min(newWidth, maxWidth));
                leftPane.style.width = newWidth + 'px';
                leftPane.style.minWidth = newWidth + 'px';
            });

            document.addEventListener('mouseup', function() {
                if (isResizing) {
                    isResizing = false;
                    resizer.classList.remove('active');
                    document.body.style.cursor = '';
                    document.body.style.userSelect = '';
                }
            });
        })();

        // ── Vertical Resizer (Editor ↔ Results) ──
        (function() {
            var resizer = document.getElementById('resizerV');
            var resultsPane = document.getElementById('sqlResults');
            var isResizing = false;

            resizer.addEventListener('mousedown', function(e) {
                isResizing = true;
                resizer.classList.add('active');
                document.body.style.cursor = 'row-resize';
                document.body.style.userSelect = 'none';
                e.preventDefault();
            });

            document.addEventListener('mousemove', function(e) {
                if (!isResizing) return;
                var container = resultsPane.parentElement;
                var containerRect = container.getBoundingClientRect();
                var newHeight = containerRect.bottom - e.clientY;
                newHeight = Math.max(80, Math.min(newHeight, containerRect.height - 200));
                resultsPane.style.height = newHeight + 'px';
            });

            document.addEventListener('mouseup', function() {
                if (isResizing) {
                    isResizing = false;
                    resizer.classList.remove('active');
                    document.body.style.cursor = '';
                    document.body.style.userSelect = '';
                }
            });
        })();
    </script>
@endsection
