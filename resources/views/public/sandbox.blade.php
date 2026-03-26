@extends('public.layouts.app')

@section('title', 'SQL Песочница — Свободный редактор')

@section('styles')
    <style>
        .sandbox-wrapper { padding: 2rem 0 4rem; }

        .sandbox-hero { max-width: 1620px; margin: 0 auto; padding: 0 2rem 1.75rem; }
        .sandbox-hero-inner {
            display: flex; align-items: flex-end; justify-content: space-between;
            flex-wrap: wrap; gap: 1.25rem;
        }
        .sandbox-hero-left h1 { font-size: 2rem; font-weight: 800; letter-spacing: -0.02em; margin-bottom: 0.375rem; }
        .sandbox-hero-left p { color: var(--text-secondary); font-size: 1rem; }
        .sandbox-hero-right { display: flex; align-items: center; gap: 0.75rem; }
        .sandbox-hero-stat {
            display: flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.125rem;
            background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;
            font-size: 0.85rem; color: var(--text-secondary); transition: all 0.3s ease;
        }
        .sandbox-hero-stat:hover { border-color: rgba(59,130,246,0.3); background: rgba(59,130,246,0.05); }
        .sandbox-hero-stat i { color: var(--primary); font-size: 1rem; }

        .sandbox-container { max-width: 1620px; margin: 0 auto; padding: 0 2rem; }
        .sandbox-page {
            display: flex;
            height: 78vh; min-height: 580px; max-height: 900px;
            overflow: hidden;
            border-radius: 20px;
            background: #12121a;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            gap: 0;
        }

        /* ══════════════════════════════════════
           LEFT: EDITOR + RESULTS
           ══════════════════════════════════════ */
        .sandbox-main {
            width: 44%; min-width: 360px;
            display: flex; flex-direction: column;
            overflow: hidden;
            background: #0d1117;
            border: 2px solid rgba(59,130,246,0.25);
            border-radius: 16px;
            margin: 6px;
            margin-right: 0;
            box-shadow:
                0 0 20px rgba(59,130,246,0.05),
                inset 0 0 30px rgba(59,130,246,0.02);
        }

        .sandbox-toolbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.625rem 1.25rem;
            background: rgba(59,130,246,0.04);
            border-bottom: 1px solid rgba(59,130,246,0.12);
            flex-shrink: 0;
            border-radius: 14px 14px 0 0;
        }
        .sandbox-toolbar-left { display: flex; align-items: center; gap: 0.875rem; }
        .stl-label {
            font-size: 0.85rem; font-weight: 600; color: var(--text-secondary);
            display: flex; align-items: center; gap: 0.5rem;
        }
        .stl-label i { color: var(--primary); font-size: 1rem; }

        .stl-tabs { display: flex; gap: 0.25rem; }
        .stl-tab {
            padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.825rem;
            font-family: 'JetBrains Mono', monospace; background: none; border: none;
            color: var(--text-muted); transition: all 0.3s ease;
            display: flex; align-items: center; gap: 0.5rem; cursor: pointer;
        }
        .stl-tab:hover { background: rgba(255,255,255,0.05); color: var(--text-secondary); }
        .stl-tab.active { background: rgba(255,255,255,0.1); color: var(--text-primary); }
        .stl-tab .close-tab {
            font-size: 0.7rem; opacity: 0; transition: opacity 0.2s;
            border: none; background: none; color: inherit; padding: 0 0.125rem;
            cursor: pointer; border-radius: 3px;
        }
        .stl-tab:hover .close-tab { opacity: 0.5; }
        .stl-tab .close-tab:hover { opacity: 1; background: rgba(255,255,255,0.1); }

        .stl-new {
            width: 30px; height: 30px; border-radius: 8px; background: none;
            border: 1px dashed var(--border-color); color: var(--text-muted);
            font-size: 0.9rem; display: flex; align-items: center; justify-content: center;
            transition: all 0.3s ease; cursor: pointer;
        }
        .stl-new:hover { border-color: var(--primary); color: var(--primary); }

        .sandbox-toolbar-right { display: flex; align-items: center; gap: 0.5rem; }
        .st-action {
            padding: 0.5rem 0.625rem; border-radius: 8px; background: none; border: none;
            color: var(--text-muted); font-size: 0.9rem; transition: all 0.3s ease; cursor: pointer;
            position: relative;
        }
        .st-action:hover { background: rgba(255,255,255,0.08); color: var(--text-primary); }

        .st-action-tooltip {
            position: absolute; bottom: calc(100% + 6px); left: 50%; transform: translateX(-50%);
            background: #1a1a2e; color: var(--text-primary); font-size: 0.7rem;
            padding: 0.3rem 0.6rem; border-radius: 6px; white-space: nowrap;
            pointer-events: none; opacity: 0; transition: opacity 0.2s;
            border: 1px solid var(--border-color);
        }
        .st-action:hover .st-action-tooltip { opacity: 1; }

        /* Editor area */
        .sandbox-form { display: flex; flex-direction: column; flex: 1; min-height: 0; overflow: hidden; }
        .sandbox-editor { flex: 1; min-height: 80px; position: relative; }
        .sandbox-editor textarea {
            width: 100%; height: 100%; background: #0d1117; color: var(--text-primary);
            border: none; padding: 0.875rem 1.25rem; font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem; line-height: 1.8; resize: none; outline: none; tab-size: 2;
        }
        .sandbox-editor textarea::placeholder { color: var(--text-muted); }

        .sandbox-run-bar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.625rem 1.25rem; background: rgba(0,0,0,0.15);
            border-top: 1px solid rgba(59,130,246,0.08); flex-shrink: 0;
        }
        .srb-left { display: flex; align-items: center; gap: 1.25rem; font-size: 0.8rem; color: var(--text-muted); }
        .srb-left kbd {
            background: rgba(255,255,255,0.08); padding: 0.15rem 0.5rem; border-radius: 4px;
            border: 1px solid var(--border-color); font-size: 0.72rem; color: var(--text-secondary);
        }
        .srb-right { display: flex; gap: 0.625rem; }

        .sb-run-btn {
            display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1.5rem;
            background: var(--success); color: var(--text-primary); border: none; border-radius: 12px;
            font-size: 0.85rem; font-weight: 600; font-family: inherit; transition: all 0.3s ease; cursor: pointer;
        }
        .sb-run-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(34,197,94,0.4); }
        .sb-run-btn.loading { opacity: 0.7; pointer-events: none; }

        .sb-clear-btn {
            display: flex; align-items: center; justify-content: center;
            width: 36px; height: 36px; background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-color); border-radius: 10px;
            color: var(--text-muted); font-size: 0.9rem; transition: all 0.3s ease; cursor: pointer;
        }
        .sb-clear-btn:hover { border-color: var(--danger); color: var(--danger); }

        /* RESIZER V */
        .sb-resizer-v {
            height: 10px; cursor: row-resize;
            background: rgba(59,130,246,0.04);
            border-top: 1px solid rgba(59,130,246,0.1);
            border-bottom: 1px solid rgba(34,197,94,0.1);
            transition: background 0.3s ease;
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .sb-resizer-v::after {
            content: '';
            width: 40px; height: 3px;
            background: rgba(255,255,255,0.08);
            border-radius: 2px;
        }
        .sb-resizer-v:hover, .sb-resizer-v.active { background: rgba(59,130,246,0.12); }
        .sb-resizer-v:hover::after, .sb-resizer-v.active::after { background: var(--primary); }

        /* RESULTS */
        .sandbox-results {
            height: 220px; min-height: 80px;
            display: flex; flex-direction: column;
            overflow: hidden;
            background: #0b0f14;
            border-top: 2px solid rgba(34,197,94,0.2);
            border-radius: 0 0 14px 14px;
        }

        .sandbox-results-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.5rem 1rem;
            background: rgba(34,197,94,0.03);
            border-bottom: 1px solid rgba(34,197,94,0.06);
            flex-shrink: 0; z-index: 5;
        }

        .sr-tabs { display: flex; gap: 0.375rem; }
        .sr-tab {
            padding: 0.35rem 0.75rem; border-radius: 8px; font-size: 0.8rem; font-weight: 500;
            background: none; border: none; color: var(--text-muted); font-family: inherit;
            transition: all 0.3s ease; cursor: pointer;
        }
        .sr-tab:hover { color: var(--text-secondary); }
        .sr-tab.active { background: rgba(255,255,255,0.08); color: var(--text-primary); }
        .sr-info { font-size: 0.75rem; color: var(--text-muted); }

        .sandbox-results-body { flex: 1; overflow: auto; position: relative; }
        .sandbox-results-body::-webkit-scrollbar { width: 6px; height: 6px; }
        .sandbox-results-body::-webkit-scrollbar-track { background: rgba(0,0,0,0.1); }
        .sandbox-results-body::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 3px; }

        .sb-result-empty {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            height: 100%; min-height: 100px; color: var(--text-muted); gap: 0.5rem;
            padding: 1.5rem; text-align: center;
        }
        .sb-result-empty i { font-size: 2rem; opacity: 0.3; }

        .sb-result-msg {
            display: flex; align-items: center; gap: 0.875rem;
            padding: 1rem 1.25rem; margin: 0.75rem; border-radius: 10px;
        }
        .sb-result-msg.success { background: rgba(34,197,94,0.08); border: 1px solid rgba(34,197,94,0.2); }
        .sb-result-msg.error { background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2); }
        .sb-result-msg i { font-size: 1.25rem; flex-shrink: 0; }
        .sb-result-msg.success i { color: var(--success); }
        .sb-result-msg.error i { color: var(--danger); }
        .sb-msg-content h4 { font-size: 0.9rem; font-weight: 600; margin-bottom: 0.2rem; }
        .sb-msg-content h4.success { color: var(--success); }
        .sb-msg-content h4.error { color: var(--danger); }
        .sb-msg-content p {
            font-size: 0.8rem; color: var(--text-secondary);
            font-family: 'JetBrains Mono', monospace; line-height: 1.5; word-break: break-word;
        }

        .sb-table-wrap { width: 100%; height: 100%; overflow: auto; }
        .sb-result-table {
            width: 100%; border-collapse: separate; border-spacing: 0;
            font-family: 'JetBrains Mono', monospace; font-size: 0.8rem;
        }
        .sb-result-table thead { position: sticky; top: 0; z-index: 10; }
        .sb-result-table thead th {
            text-align: left; padding: 0.625rem 1rem; background: #1a1a35;
            color: var(--primary); font-weight: 600; font-size: 0.75rem;
            text-transform: uppercase; letter-spacing: 0.03em;
            border-bottom: 2px solid rgba(59,130,246,0.3); white-space: nowrap;
        }
        .sb-result-table tbody tr { transition: background 0.15s ease; }
        .sb-result-table tbody tr:hover { background: rgba(59,130,246,0.05); }
        .sb-result-table tbody tr:nth-child(even) { background: rgba(255,255,255,0.015); }
        .sb-result-table tbody tr:nth-child(even):hover { background: rgba(59,130,246,0.05); }
        .sb-result-table tbody td {
            padding: 0.5rem 1rem; color: var(--text-secondary);
            border-bottom: 1px solid rgba(255,255,255,0.04);
            white-space: nowrap; max-width: 280px; overflow: hidden; text-overflow: ellipsis;
        }
        .sb-result-table tbody td.null-val { color: var(--text-muted); font-style: italic; }
        .sb-result-table .row-num {
            color: var(--text-muted); font-size: 0.65rem; text-align: right;
            padding-right: 0.5rem; width: 35px; user-select: none;
        }
        .sb-result-table thead .row-num-header {
            text-align: right; padding-right: 0.5rem; width: 35px; color: var(--text-muted);
        }

        /* RESIZER H */
        .sb-resizer-h {
            width: 10px; cursor: col-resize;
            background: transparent;
            transition: background 0.3s ease;
            flex-shrink: 0; z-index: 30;
            display: flex; align-items: center; justify-content: center;
        }
        .sb-resizer-h::after {
            content: '';
            width: 3px; height: 40px;
            background: rgba(255,255,255,0.06);
            border-radius: 2px;
            transition: background 0.3s;
        }
        .sb-resizer-h:hover, .sb-resizer-h.active { background: rgba(147,51,234,0.08); }
        .sb-resizer-h:hover::after, .sb-resizer-h.active::after { background: var(--primary); }

        /* ══════════════════════════════════════
           RIGHT: ERD PANEL
           ══════════════════════════════════════ */
        .sandbox-erd-panel {
            flex: 1; min-width: 350px;
            display: flex; flex-direction: column;
            overflow: hidden;
            background: #0d1117;
            border: 2px solid rgba(147,51,234,0.25);
            border-radius: 16px;
            margin: 6px;
            margin-left: 0;
            box-shadow:
                0 0 20px rgba(147,51,234,0.05),
                inset 0 0 30px rgba(147,51,234,0.02);
            position: relative;
        }

        .erd-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.625rem 1rem;
            background: rgba(147,51,234,0.04);
            border-bottom: 1px solid rgba(147,51,234,0.1);
            flex-shrink: 0; z-index: 20;
            border-radius: 14px 14px 0 0;
        }
        .erd-header-left { display: flex; align-items: center; gap: 0.75rem; }
        .erd-title {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.8rem; font-weight: 600; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.06em;
        }
        .erd-title i { color: rgba(147,51,234,0.7); font-size: 0.9rem; }

        .erd-schema-select { position: relative; }
        .erd-schema-btn {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.4rem 0.75rem;
            background: rgba(255,255,255,0.06);
            border: 1px solid var(--border-color);
            border-radius: 8px; color: var(--text-primary);
            font-size: 0.825rem; font-family: inherit;
            cursor: pointer; transition: all 0.2s ease;
        }
        .erd-schema-btn:hover { border-color: var(--primary); background: rgba(59,130,246,0.08); }
        .erd-schema-btn .schema-icon { font-size: 1rem; }
        .erd-schema-btn .bi-chevron-down { font-size: 0.6rem; color: var(--text-muted); transition: transform 0.2s; }
        .erd-schema-select.open .erd-schema-btn .bi-chevron-down { transform: rotate(180deg); }

        .erd-schema-dropdown {
            display: none; position: absolute; top: calc(100% + 4px); left: 0;
            min-width: 220px; background: var(--bg-elevated);
            border: 1px solid var(--border-color); border-radius: 10px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.4); z-index: 100; overflow: hidden;
        }
        .erd-schema-select.open .erd-schema-dropdown { display: block; }

        .erd-schema-option {
            display: flex; align-items: center; gap: 0.625rem;
            width: 100%; padding: 0.625rem 1rem;
            background: none; border: none; color: var(--text-secondary);
            font-size: 0.825rem; font-family: inherit;
            cursor: pointer; text-align: left; transition: all 0.15s;
        }
        .erd-schema-option:hover { background: rgba(59,130,246,0.08); color: var(--text-primary); }
        .erd-schema-option.active { background: rgba(59,130,246,0.12); color: var(--primary); }
        .erd-schema-option .schema-opt-icon { font-size: 1.1rem; }
        .erd-schema-option .schema-opt-count {
            margin-left: auto; font-size: 0.7rem; color: var(--text-muted);
            background: rgba(255,255,255,0.06); padding: 0.1rem 0.4rem; border-radius: 4px;
        }

        .erd-header-right { display: flex; align-items: center; gap: 0.375rem; }
        .erd-tool-btn {
            width: 32px; height: 32px; border-radius: 8px;
            background: none; border: 1px solid transparent;
            color: var(--text-muted); font-size: 0.85rem;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.2s;
        }
        .erd-tool-btn:hover {
            background: rgba(255,255,255,0.06); color: var(--text-primary);
            border-color: var(--border-color);
        }

        .erd-zoom-label {
            font-size: 0.7rem; color: var(--text-muted);
            padding: 0.2rem 0.5rem; background: rgba(255,255,255,0.04);
            border-radius: 4px; font-family: 'JetBrains Mono', monospace;
            min-width: 40px; text-align: center; user-select: none;
        }

        /* Canvas */
        .erd-canvas-wrap {
            flex: 1; position: relative; overflow: hidden; cursor: grab;
            background:
                radial-gradient(circle at 1px 1px, rgba(147,51,234,0.04) 1px, transparent 0);
            background-size: 24px 24px;
            border-radius: 0 0 14px 14px;
        }
        .erd-canvas-wrap.dragging-card { cursor: default; }
        .erd-canvas-wrap.panning { cursor: grabbing; }

        .erd-canvas {
            position: absolute;
            top: 0; left: 0;
            transform-origin: 0 0;
        }

        .erd-svg-layer {
            position: absolute;
            pointer-events: none;
            z-index: 1;
            overflow: visible;
        }
        .erd-svg-layer path { pointer-events: stroke; }

        /* ══════════════════════════════════════
           ERD TABLE CARDS — ИСПРАВЛЕНО
           ══════════════════════════════════════ */
        .erd-table-card {
            position: absolute;
            min-width: 220px;
            /* max-width убран — карточка подстраивается под контент */
            background: #1e2233;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            z-index: 10; user-select: none;
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
            cursor: move;
            white-space: nowrap;
        }
        .erd-table-card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.5);
            border-color: rgba(255,255,255,0.15);
        }
        .erd-table-card.dragging {
            box-shadow: 0 12px 40px rgba(59,130,246,0.3);
            border-color: rgba(59,130,246,0.4);
            z-index: 50; transition: none;
        }
        .erd-table-card.highlighted {
            border-color: rgba(59,130,246,0.5);
            box-shadow: 0 0 20px rgba(59,130,246,0.2);
        }

        .erd-card-header {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.5rem 0.75rem;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 9px 9px 0 0;
        }
        .erd-card-header i { font-size: 0.8rem; color: rgba(255,255,255,0.7); }
        .erd-card-title {
            font-size: 0.8rem; font-weight: 700; color: #fff;
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.02em; flex: 1;
        }
        .erd-card-count {
            font-size: 0.6rem; color: rgba(255,255,255,0.5);
            background: rgba(0,0,0,0.2); padding: 0.1rem 0.35rem; border-radius: 4px;
        }

        .erd-card-body { padding: 0; }

        .erd-col-row {
            display: flex; align-items: center; gap: 0.375rem;
            padding: 0.3rem 0.75rem;
            font-size: 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            transition: background 0.15s;
            position: relative;
            white-space: nowrap;
            overflow: hidden;
        }
        .erd-col-row:last-child { border-bottom: none; border-radius: 0 0 9px 9px; }
        .erd-col-row:hover { background: rgba(59,130,246,0.06); }
        .erd-col-row.highlighted { background: rgba(59,130,246,0.12); }

        .erd-key-icon { width: 16px; text-align: center; flex-shrink: 0; font-size: 0.75rem; line-height: 1; }
        .erd-key-pk { color: #fbbf24; }
        .erd-key-fk { color: #60a5fa; }
        .erd-key-pkfk { color: #f97316; }
        .erd-key-none { color: var(--text-muted); font-size: 0.5rem; }

        .erd-nullable { font-size: 0.6rem; flex-shrink: 0; width: 8px; text-align: center; }
        .erd-nullable-yes { color: var(--text-muted); }
        .erd-nullable-no { color: #34d399; }

        /* Имя столбца — сжимается если мало места, обрезается с ... */
        .erd-col-name {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            color: var(--text-primary);
            font-weight: 500;
            flex: 1;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .erd-col-row .erd-key-pk ~ .erd-col-name,
        .erd-col-row .erd-key-pkfk ~ .erd-col-name { font-weight: 700; }

        /* Тип данных — НИКОГДА не сжимается, всегда виден полностью */
        .erd-col-type {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.6rem;
            color: var(--text-muted);
            flex-shrink: 0;
            text-transform: uppercase;
            padding-left: 0.5rem;
            white-space: nowrap;
        }

        .erd-anchor {
            position: absolute; width: 8px; height: 8px; border-radius: 50%;
            background: #3b82f6; top: 50%; transform: translateY(-50%);
            opacity: 0; transition: opacity 0.2s; z-index: 5;
        }
        .erd-anchor-left { left: -4px; }
        .erd-anchor-right { right: -4px; }
        .erd-table-card:hover .erd-anchor,
        .erd-table-card.highlighted .erd-anchor { opacity: 0.6; }

        .erd-rel-path {
            fill: none; stroke: #4b5563; stroke-width: 1.5;
            transition: stroke 0.2s, stroke-width 0.2s;
        }
        .erd-rel-path:hover, .erd-rel-path.highlighted { stroke: #3b82f6; stroke-width: 2.5; }

        /* TIPS */
        .sandbox-tips { max-width: 1620px; margin: 2rem auto 0; padding: 0 2rem; }
        .sandbox-tips-title {
            font-size: 1rem; font-weight: 600; color: var(--text-muted);
            margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;
        }
        .sandbox-tips-title i { color: var(--primary); }
        .sandbox-tips-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; }
        .sandbox-tip {
            display: flex; align-items: flex-start; gap: 0.875rem; padding: 1rem;
            background: var(--bg-card); border: 1px solid var(--border-color);
            border-radius: 14px; transition: all 0.3s ease;
        }
        .sandbox-tip:hover {
            border-color: rgba(59,130,246,0.2); transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .sandbox-tip-icon {
            width: 38px; height: 38px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; flex-shrink: 0;
        }
        .sandbox-tip h4 { font-size: 0.85rem; font-weight: 600; margin-bottom: 0.2rem; }
        .sandbox-tip p { font-size: 0.75rem; color: var(--text-muted); line-height: 1.4; }

        @media (max-width: 1200px) { .sandbox-tips-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 1024px) {
            .sandbox-page { flex-direction: column; height: auto; max-height: none; }
            .sandbox-main { width: auto; min-width: unset; border-radius: 16px; margin: 6px 6px 0 6px; }
            .sandbox-erd-panel { min-width: unset; height: 400px; border-radius: 16px; margin: 0 6px 6px 6px; }
            .sandbox-results { border-radius: 0 0 14px 14px; }
            .sb-resizer-h { display: none; }
        }
        @media (max-width: 768px) {
            .sandbox-hero-inner { flex-direction: column; align-items: flex-start; }
            .sandbox-hero-right { display: none; }
            .sandbox-tips-grid { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    <div class="sandbox-wrapper">

        <div class="sandbox-hero">
            <div class="sandbox-hero-inner">
                <div class="sandbox-hero-left">
                    <div class="section-tag" style="margin-bottom: 0.75rem;">
                        <i class="bi bi-terminal-fill"></i> Песочница
                    </div>
                    <h1>SQL <span class="gradient-text">Песочница</span></h1>
                    <p>Свободная среда для экспериментов — выберите схему и пишите любые запросы</p>
                </div>
                <div class="sandbox-hero-right">
                    <div class="sandbox-hero-stat"><i class="bi bi-database"></i> {{ count($schemas) }} схем</div>
                    <div class="sandbox-hero-stat"><i class="bi bi-lightning-charge"></i> Мгновенно</div>
                    <div class="sandbox-hero-stat"><i class="bi bi-infinity"></i> Без ограничений</div>
                </div>
            </div>
        </div>

        <div class="sandbox-container">
            <div class="sandbox-page">

                <div class="sandbox-main" id="sandboxMain">
                    <div class="sandbox-toolbar">
                        <div class="sandbox-toolbar-left">
                            <span class="stl-label"><i class="bi bi-terminal"></i> Редактор</span>
                            <div class="stl-tabs" id="editorTabs"></div>
                            <button type="button" class="stl-new" id="addTabBtn" title="Новая вкладка"><i class="bi bi-plus"></i></button>
                        </div>
                        <div class="sandbox-toolbar-right">
                            <button type="button" class="st-action" id="copyBtn">
                                <i class="bi bi-clipboard"></i>
                                <span class="st-action-tooltip">Копировать</span>
                            </button>
                            <button type="button" class="st-action" id="formatBtn">
                                <i class="bi bi-code-slash"></i>
                                <span class="st-action-tooltip">Форматировать</span>
                            </button>
                        </div>
                    </div>
                    @include('public.sandbox.form')
                    <div class="sb-resizer-v" id="sbResizerV"></div>
                    @include('public.sandbox.result')
                </div>

                <div class="sb-resizer-h" id="sbResizerH"></div>

                <div class="sandbox-erd-panel" id="erdPanel">
                    <div class="erd-header">
                        <div class="erd-header-left">
                            <div class="erd-title"><i class="bi bi-diagram-3"></i> <span>ERD Схема</span></div>
                            <div class="erd-schema-select" id="erdSchemaSelect">
                                <button type="button" class="erd-schema-btn" id="erdSchemaBtn">
                                    <span class="schema-icon" id="erdSchemaIcon">{{ $schemas[0]['icon'] ?? '📁' }}</span>
                                    <span id="erdSchemaName">{{ $schemas[0]['name'] ?? 'Выберите' }}</span>
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <div class="erd-schema-dropdown" id="erdSchemaDropdown">
                                    @foreach($schemas as $i => $schema)
                                        <button type="button" class="erd-schema-option {{ $i === 0 ? 'active' : '' }}" data-schema-index="{{ $i }}">
                                            <span class="schema-opt-icon">{{ $schema['icon'] }}</span>
                                            <span>{{ $schema['name'] }}</span>
                                            <span class="schema-opt-count">{{ count($schema['tables']) }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="erd-header-right">
                            <button type="button" class="erd-tool-btn" id="erdAutoLayout" title="Авто-расположение"><i class="bi bi-grid-3x3-gap"></i></button>
                            <button type="button" class="erd-tool-btn" id="erdZoomIn" title="Приблизить"><i class="bi bi-zoom-in"></i></button>
                            <span class="erd-zoom-label" id="erdZoomLabel">100%</span>
                            <button type="button" class="erd-tool-btn" id="erdZoomOut" title="Отдалить"><i class="bi bi-zoom-out"></i></button>
                            <button type="button" class="erd-tool-btn" id="erdFitView" title="Вписать"><i class="bi bi-fullscreen"></i></button>
                        </div>
                    </div>
                    <div class="erd-canvas-wrap" id="erdCanvasWrap">
                        <div class="erd-canvas" id="erdCanvas">
                            <svg class="erd-svg-layer" id="erdSvg">
                                <defs>
                                    <marker id="crowfoot-many" viewBox="0 0 12 12" refX="12" refY="6" markerWidth="12" markerHeight="12" orient="auto-start-reverse">
                                        <path d="M 0,0 L 12,6 L 0,12" fill="none" stroke="#4b5563" stroke-width="1.5"/>
                                    </marker>
                                    <marker id="crowfoot-one" viewBox="0 0 12 12" refX="12" refY="6" markerWidth="12" markerHeight="12" orient="auto-start-reverse">
                                        <line x1="10" y1="0" x2="10" y2="12" stroke="#4b5563" stroke-width="1.5"/>
                                        <line x1="6" y1="0" x2="6" y2="12" stroke="#4b5563" stroke-width="1.5"/>
                                    </marker>
                                    <marker id="crowfoot-many-hl" viewBox="0 0 12 12" refX="12" refY="6" markerWidth="12" markerHeight="12" orient="auto-start-reverse">
                                        <path d="M 0,0 L 12,6 L 0,12" fill="none" stroke="#3b82f6" stroke-width="1.5"/>
                                    </marker>
                                    <marker id="crowfoot-one-hl" viewBox="0 0 12 12" refX="12" refY="6" markerWidth="12" markerHeight="12" orient="auto-start-reverse">
                                        <line x1="10" y1="0" x2="10" y2="12" stroke="#3b82f6" stroke-width="1.5"/>
                                        <line x1="6" y1="0" x2="6" y2="12" stroke="#3b82f6" stroke-width="1.5"/>
                                    </marker>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="sandbox-tips">
            <div class="sandbox-tips-title"><i class="bi bi-lightbulb"></i> Полезные советы</div>
            <div class="sandbox-tips-grid">
                <div class="sandbox-tip">
                    <div class="sandbox-tip-icon" style="background:rgba(59,130,246,0.12);color:var(--primary);"><i class="bi bi-keyboard"></i></div>
                    <div><h4>Горячие клавиши</h4><p><kbd style="background:rgba(255,255,255,0.08);padding:0.1rem 0.4rem;border-radius:3px;font-size:0.7rem;border:1px solid var(--border-color);">Ctrl+Enter</kbd> — выполнить</p></div>
                </div>
                <div class="sandbox-tip">
                    <div class="sandbox-tip-icon" style="background:rgba(34,197,94,0.12);color:var(--success);"><i class="bi bi-diagram-3"></i></div>
                    <div><h4>ERD Диаграмма</h4><p>Перетаскивайте таблицы, масштабируйте колёсиком</p></div>
                </div>
                <div class="sandbox-tip">
                    <div class="sandbox-tip-icon" style="background:rgba(147,51,234,0.12);color:var(--secondary);"><i class="bi bi-code-slash"></i></div>
                    <div><h4>Форматирование</h4><p>Нажмите кнопку для красивого SQL</p></div>
                </div>
                <div class="sandbox-tip">
                    <div class="sandbox-tip-icon" style="background:rgba(245,158,11,0.12);color:var(--warning);"><i class="bi bi-mouse"></i></div>
                    <div><h4>Навигация</h4><p>Зажмите ЛКМ на пустом месте для панорамирования</p></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function() {
            'use strict';

            var schemasData = @json($schemas);
            var currentSchemaIndex = 0;

            var editor = document.getElementById('sandboxEditor');
            var form = document.getElementById('sandboxForm');
            var runBtn = document.getElementById('sbRunBtn');
            var resultsBody = document.getElementById('sbResultsBody');
            var resultsInfo = document.getElementById('sbResultsInfo');
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var erdCanvasWrap = document.getElementById('erdCanvasWrap');
            var erdCanvas = document.getElementById('erdCanvas');
            var erdSvg = document.getElementById('erdSvg');
            var erdZoomLabel = document.getElementById('erdZoomLabel');

            var erdState = {
                zoom: 1, panX: 0, panY: 0,
                isPanning: false, panStartX: 0, panStartY: 0,
                cards: {},
                relationships: [],
                dragCard: null, dragOffsetX: 0, dragOffsetY: 0
            };

            // ══════════════════════════════════════
            //  SQL FORMATTER
            // ══════════════════════════════════════
            function formatSQL(sql) {
                if (!sql.trim()) return sql;
                var f = sql.replace(/\s+/g, ' ').trim();
                var kws = ['select','from','where','and','or','order by','group by','having',
                    'left join','right join','inner join','cross join','full outer join','join',
                    'on','set','values','insert into','update','delete from','create table',
                    'alter table','drop table','limit','offset','union all','union',
                    'case','when','then','else','end','in','exists','not','between','like',
                    'as','distinct','into','asc','desc','null','is','count','sum','avg',
                    'min','max','if','ifnull','coalesce'];
                kws.forEach(function(kw) {
                    f = f.replace(new RegExp('\\b' + kw.replace(/\s+/g, '\\s+') + '\\b', 'gi'), kw.toUpperCase());
                });
                ['SELECT','FROM','WHERE','ORDER BY','GROUP BY','HAVING','LEFT JOIN','RIGHT JOIN',
                    'INNER JOIN','CROSS JOIN','JOIN','FULL OUTER JOIN','LIMIT','OFFSET','UNION ALL',
                    'UNION','INSERT INTO','UPDATE','DELETE FROM','SET','VALUES'].forEach(function(kw) {
                    f = f.replace(new RegExp('\\s+(' + kw.replace(/\s+/g, '\\s+') + ')\\b', 'g'), '\n$1');
                });
                f = f.replace(/\s+(AND)\b/g, '\n  AND').replace(/\s+(OR)\b/g, '\n  OR');
                var m = f.match(/^SELECT\s+([\s\S]*?)\nFROM/);
                if (m) f = f.replace(m[1], '\n  ' + m[1].replace(/,\s*/g, ',\n  '));
                f = f.replace(/\n{3,}/g, '\n\n').trim();
                if (!f.endsWith(';')) f += ';';
                return f;
            }

            document.getElementById('formatBtn').addEventListener('click', function() {
                editor.value = formatSQL(editor.value);
                tabs[activeTab].content = editor.value;
                var btn = this;
                btn.innerHTML = '<i class="bi bi-check-lg"></i><span class="st-action-tooltip">Готово!</span>';
                setTimeout(function() { btn.innerHTML = '<i class="bi bi-code-slash"></i><span class="st-action-tooltip">Форматировать</span>'; }, 1200);
            });

            // ══════════════════════════════════════
            //  SCHEMA SELECTOR
            // ══════════════════════════════════════
            var schemaSelect = document.getElementById('erdSchemaSelect');
            document.getElementById('erdSchemaBtn').addEventListener('click', function(e) {
                e.stopPropagation(); schemaSelect.classList.toggle('open');
            });
            document.addEventListener('click', function(e) {
                if (!schemaSelect.contains(e.target)) schemaSelect.classList.remove('open');
            });
            document.querySelectorAll('.erd-schema-option').forEach(function(opt) {
                opt.addEventListener('click', function() {
                    switchSchema(parseInt(this.dataset.schemaIndex));
                    schemaSelect.classList.remove('open');
                });
            });

            function switchSchema(idx) {
                currentSchemaIndex = idx;
                var s = schemasData[idx];
                document.getElementById('erdSchemaIcon').textContent = s.icon;
                document.getElementById('erdSchemaName').textContent = s.name;
                document.querySelectorAll('.erd-schema-option').forEach(function(o, i) {
                    o.classList.toggle('active', i === idx);
                });
                buildERD(s);
            }

            // ══════════════════════════════════════
            //  MEASURE CARD — точные размеры из DOM
            // ══════════════════════════════════════
            function measureCard(tableName) {
                var cd = erdState.cards[tableName];
                if (!cd) return;

                cd.width = cd.el.offsetWidth;
                cd.height = cd.el.offsetHeight;

                // Измеряем реальные Y-позиции каждого поля ОТНОСИТЕЛЬНО карточки
                cd.fieldOffsets = {};
                var cardTop = cd.el.offsetTop;
                var rows = cd.el.querySelectorAll('.erd-col-row');
                rows.forEach(function(row) {
                    var colName = row.dataset.column;
                    // offsetTop относительно ближайшего positioned parent = card (position:absolute)
                    var rowTop = row.offsetTop;
                    var rowH = row.offsetHeight;
                    cd.fieldOffsets[colName] = rowTop + rowH / 2;
                });
            }

            function measureAllCards() {
                Object.keys(erdState.cards).forEach(function(tn) {
                    measureCard(tn);
                });
            }

            // ══════════════════════════════════════
            //  GET FIELD POSITION — из измеренных данных
            // ══════════════════════════════════════
            function getFieldPosition(tableName, fieldName, side) {
                var cd = erdState.cards[tableName];
                if (!cd || !cd.fieldOffsets) return null;

                var yOffset = cd.fieldOffsets[fieldName];
                if (yOffset === undefined) return null;

                var cy = cd.y + yOffset;

                if (side === 'left') {
                    return { x: cd.x, y: cy };
                } else {
                    return { x: cd.x + cd.width, y: cy };
                }
            }

            // ══════════════════════════════════════
            //  RENDER TABLE CARD
            // ══════════════════════════════════════
            function renderTableCard(table, x, y) {
                var card = document.createElement('div');
                card.className = 'erd-table-card';
                card.dataset.table = table.name;
                card.style.left = x + 'px';
                card.style.top = y + 'px';

                var hdr = document.createElement('div');
                hdr.className = 'erd-card-header';
                hdr.innerHTML = '<i class="bi bi-table"></i><span class="erd-card-title">' +
                    esc(table.name) + '</span><span class="erd-card-count">' +
                    table.columns.length + '</span>';
                card.appendChild(hdr);

                var body = document.createElement('div');
                body.className = 'erd-card-body';

                table.columns.forEach(function(col, ci) {
                    var row = document.createElement('div');
                    row.className = 'erd-col-row';
                    row.dataset.column = col.name;
                    row.dataset.table = table.name;
                    row.dataset.colIndex = ci;

                    var kh = '';
                    if (col.key === 'pk_fk') kh = '<span class="erd-key-icon erd-key-pkfk"><i class="bi bi-key-fill"></i></span>';
                    else if (col.key === 'pk') kh = '<span class="erd-key-icon erd-key-pk"><i class="bi bi-key-fill"></i></span>';
                    else if (col.key === 'fk') kh = '<span class="erd-key-icon erd-key-fk"><i class="bi bi-link-45deg"></i></span>';
                    else kh = '<span class="erd-key-icon erd-key-none">•</span>';

                    var nh = col.nullable
                        ? '<span class="erd-nullable erd-nullable-yes">◇</span>'
                        : '<span class="erd-nullable erd-nullable-no">◆</span>';

                    row.innerHTML = kh + nh +
                        '<span class="erd-col-name">' + esc(col.name) + '</span>' +
                        '<span class="erd-col-type">' + esc(col.type) + '</span>';

                    var aL = document.createElement('div');
                    aL.className = 'erd-anchor erd-anchor-left';
                    row.appendChild(aL);
                    var aR = document.createElement('div');
                    aR.className = 'erd-anchor erd-anchor-right';
                    row.appendChild(aR);

                    body.appendChild(row);
                });

                card.appendChild(body);
                erdCanvas.appendChild(card);

                erdState.cards[table.name] = {
                    el: card,
                    x: x,
                    y: y,
                    width: 0,
                    height: 0,
                    fieldOffsets: {},
                    table: table
                };

                return card;
            }

            // ══════════════════════════════════════
            //  AUTO LAYOUT
            // ══════════════════════════════════════
            function autoLayout(schema) {
                var tables = schema.tables;
                if (!tables || !tables.length) return {};

                var deps = {};
                var tNames = tables.map(function(t) { return t.name; });
                tables.forEach(function(t) { deps[t.name] = []; });

                tables.forEach(function(t) {
                    t.columns.forEach(function(c) {
                        if (c.fk_to && tNames.indexOf(c.fk_to.table) !== -1) {
                            deps[t.name].push(c.fk_to.table);
                        }
                    });
                });

                var levels = {}, vis = {};
                function gl(n) {
                    if (levels[n] !== undefined) return levels[n];
                    if (vis[n]) return 0;
                    vis[n] = true;
                    var mx = -1;
                    (deps[n] || []).forEach(function(p) {
                        var pl = gl(p);
                        if (pl > mx) mx = pl;
                    });
                    levels[n] = mx + 1;
                    return levels[n];
                }
                tables.forEach(function(t) { gl(t.name); });

                var lg = {}, ml = 0;
                tables.forEach(function(t) {
                    var lv = levels[t.name] || 0;
                    if (lv > ml) ml = lv;
                    if (!lg[lv]) lg[lv] = [];
                    lg[lv].push(t);
                });

                // Грубая оценка высоты карточки
                var estRowH = 28;
                var estHeaderH = 34;

                var pos = {};
                var xGap = 300, yGap = 35, sX = 50, sY = 50;

                for (var lv = 0; lv <= ml; lv++) {
                    var g = lg[lv] || [];
                    var x = sX + lv * xGap;
                    var y = sY;
                    g.forEach(function(t) {
                        pos[t.name] = { x: x, y: y };
                        y += estHeaderH + t.columns.length * estRowH + 8 + yGap;
                    });
                }

                return pos;
            }

            // ══════════════════════════════════════
            //  RELATIONSHIPS
            // ══════════════════════════════════════
            function renderRelationships(schema) {
                erdState.relationships.forEach(function(r) {
                    if (r.pathEl) r.pathEl.remove();
                });
                erdState.relationships = [];

                var tNames = schema.tables.map(function(t) { return t.name; });

                schema.tables.forEach(function(t) {
                    t.columns.forEach(function(col) {
                        if (!col.fk_to || tNames.indexOf(col.fk_to.table) === -1) return;

                        var rel = {
                            fromTable: t.name,
                            fromCol: col.name,
                            toTable: col.fk_to.table,
                            toCol: col.fk_to.column,
                            pathEl: null
                        };

                        var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                        path.classList.add('erd-rel-path');
                        rel.pathEl = path;

                        path.addEventListener('mouseenter', function() { hlRel(rel, true); });
                        path.addEventListener('mouseleave', function() { hlRel(rel, false); });

                        erdSvg.appendChild(path);
                        erdState.relationships.push(rel);
                    });
                });

                updAllPaths();
            }

            function updAllPaths() {
                erdState.relationships.forEach(function(rel) {
                    updPath(rel);
                });
            }

            function updPath(rel) {
                var fc = erdState.cards[rel.fromTable];
                var tc = erdState.cards[rel.toTable];
                if (!fc || !tc) {
                    if (rel.pathEl) rel.pathEl.setAttribute('d', '');
                    return;
                }

                // Определяем с какой стороны подключать
                var fcCenterX = fc.x + fc.width / 2;
                var tcCenterX = tc.x + tc.width / 2;
                var fs, ts;

                if (fcCenterX <= tcCenterX) {
                    fs = 'right'; ts = 'left';
                } else {
                    fs = 'left'; ts = 'right';
                }

                var from = getFieldPosition(rel.fromTable, rel.fromCol, fs);
                var to = getFieldPosition(rel.toTable, rel.toCol, ts);

                if (!from || !to) {
                    if (rel.pathEl) rel.pathEl.setAttribute('d', '');
                    return;
                }

                // Ортогональный путь
                var dx = to.x - from.x;
                var midX;
                var gap = 50;

                if (fs === 'right' && ts === 'left') {
                    // from → ... → to (слева направо)
                    if (dx > gap * 2) {
                        midX = from.x + dx / 2;
                    } else {
                        midX = from.x + gap;
                    }
                } else if (fs === 'left' && ts === 'right') {
                    // from ← ... ← to (справа налево)
                    if (-dx > gap * 2) {
                        midX = from.x + dx / 2;
                    } else {
                        midX = from.x - gap;
                    }
                } else {
                    midX = (from.x + to.x) / 2;
                }

                var d = 'M ' + from.x + ' ' + from.y +
                    ' L ' + midX + ' ' + from.y +
                    ' L ' + midX + ' ' + to.y +
                    ' L ' + to.x + ' ' + to.y;

                rel.pathEl.setAttribute('d', d);

                // Crow's foot markers
                var hl = rel.pathEl.classList.contains('highlighted');
                rel.pathEl.setAttribute('marker-start', 'url(#crowfoot-many' + (hl ? '-hl' : '') + ')');
                rel.pathEl.setAttribute('marker-end', 'url(#crowfoot-one' + (hl ? '-hl' : '') + ')');
            }

            function hlRel(rel, on) {
                rel.pathEl.classList.toggle('highlighted', on);
                [
                    { table: rel.fromTable, col: rel.fromCol },
                    { table: rel.toTable, col: rel.toCol }
                ].forEach(function(item) {
                    var cd = erdState.cards[item.table];
                    if (!cd) return;
                    cd.el.classList.toggle('highlighted', on);
                    var r = cd.el.querySelector('.erd-col-row[data-column="' + item.col + '"]');
                    if (r) r.classList.toggle('highlighted', on);
                });
                updPath(rel);
            }

            // ══════════════════════════════════════
            //  BUILD ERD
            // ══════════════════════════════════════
            function buildERD(schema) {
                // Очищаем
                erdCanvas.querySelectorAll('.erd-table-card').forEach(function(c) { c.remove(); });
                erdState.relationships.forEach(function(r) { if (r.pathEl) r.pathEl.remove(); });
                erdState.cards = {};
                erdState.relationships = [];

                if (!schema.tables || !schema.tables.length) return;

                var positions = autoLayout(schema);

                // 1. Рендерим все карточки
                schema.tables.forEach(function(table) {
                    var pos = positions[table.name] || { x: 50, y: 50 };
                    renderTableCard(table, pos.x, pos.y);
                });

                // 2. Ждём один кадр чтобы DOM отрисовался, затем измеряем
                requestAnimationFrame(function() {
                    measureAllCards();

                    // 3. Рендерим связи ПОСЛЕ измерения
                    renderRelationships(schema);

                    // 4. Fit view
                    setTimeout(fitView, 30);
                });
            }

            // ══════════════════════════════════════
            //  DRAG & DROP
            // ══════════════════════════════════════
            function initDragAndDrop() {
                var dragStarted = false;

                erdCanvasWrap.addEventListener('pointerdown', function(e) {
                    var tc = e.target.closest('.erd-table-card');
                    if (!tc) return;

                    var tn = tc.dataset.table;
                    var cd = erdState.cards[tn];
                    if (!cd) return;

                    e.preventDefault();
                    e.stopPropagation();

                    erdState.dragCard = tn;
                    dragStarted = false;

                    // Координаты мыши в canvas-пространстве
                    var wrapRect = erdCanvasWrap.getBoundingClientRect();
                    var mouseCanvasX = (e.clientX - wrapRect.left - erdState.panX) / erdState.zoom;
                    var mouseCanvasY = (e.clientY - wrapRect.top - erdState.panY) / erdState.zoom;

                    erdState.dragOffsetX = mouseCanvasX - cd.x;
                    erdState.dragOffsetY = mouseCanvasY - cd.y;

                    tc.classList.add('dragging');
                    erdCanvasWrap.classList.add('dragging-card');
                    tc.setPointerCapture(e.pointerId);

                    function onMove(ev) {
                        if (!erdState.dragCard) return;
                        dragStarted = true;

                        var wr = erdCanvasWrap.getBoundingClientRect();
                        var mx = (ev.clientX - wr.left - erdState.panX) / erdState.zoom;
                        var my = (ev.clientY - wr.top - erdState.panY) / erdState.zoom;

                        var nx = mx - erdState.dragOffsetX;
                        var ny = my - erdState.dragOffsetY;

                        // Границы = видимая область при текущем zoom
                        var wrapW = erdCanvasWrap.clientWidth;
                        var wrapH = erdCanvasWrap.clientHeight;

                        var visLeft = -erdState.panX / erdState.zoom;
                        var visTop = -erdState.panY / erdState.zoom;
                        var visRight = visLeft + wrapW / erdState.zoom;
                        var visBottom = visTop + wrapH / erdState.zoom;

                        var margin = 30;
                        nx = Math.max(visLeft - cd.width + margin, Math.min(nx, visRight - margin));
                        ny = Math.max(visTop - cd.height + margin, Math.min(ny, visBottom - margin));

                        cd.x = nx;
                        cd.y = ny;
                        cd.el.style.left = nx + 'px';
                        cd.el.style.top = ny + 'px';

                        // Обновляем ВСЕ линии
                        updAllPaths();
                    }

                    function onUp() {
                        if (erdState.dragCard) {
                            var c = erdState.cards[erdState.dragCard];
                            if (c) c.el.classList.remove('dragging');
                            erdState.dragCard = null;
                            erdCanvasWrap.classList.remove('dragging-card');
                        }
                        document.removeEventListener('pointermove', onMove);
                        document.removeEventListener('pointerup', onUp);
                    }

                    document.addEventListener('pointermove', onMove);
                    document.addEventListener('pointerup', onUp);
                });
            }

            // ══════════════════════════════════════
            //  ZOOM & PAN
            // ══════════════════════════════════════
            function initZoomPan() {
                erdCanvasWrap.addEventListener('wheel', function(e) {
                    e.preventDefault();
                    var d = e.deltaY > 0 ? -0.08 : 0.08;
                    var nz = Math.min(3, Math.max(0.15, erdState.zoom + d));
                    var wr = erdCanvasWrap.getBoundingClientRect();
                    var cx = e.clientX - wr.left;
                    var cy = e.clientY - wr.top;
                    var r = nz / erdState.zoom;
                    erdState.panX = cx - (cx - erdState.panX) * r;
                    erdState.panY = cy - (cy - erdState.panY) * r;
                    erdState.zoom = nz;
                    applyTf();
                }, { passive: false });

                erdCanvasWrap.addEventListener('pointerdown', function(e) {
                    if (e.target.closest('.erd-table-card')) return;
                    e.preventDefault();
                    erdState.isPanning = true;
                    erdState.panStartX = e.clientX - erdState.panX;
                    erdState.panStartY = e.clientY - erdState.panY;
                    erdCanvasWrap.classList.add('panning');
                    erdCanvasWrap.setPointerCapture(e.pointerId);
                });

                erdCanvasWrap.addEventListener('pointermove', function(e) {
                    if (!erdState.isPanning) return;
                    erdState.panX = e.clientX - erdState.panStartX;
                    erdState.panY = e.clientY - erdState.panStartY;
                    applyTf();
                });

                erdCanvasWrap.addEventListener('pointerup', function() {
                    if (erdState.isPanning) {
                        erdState.isPanning = false;
                        erdCanvasWrap.classList.remove('panning');
                    }
                });

                document.getElementById('erdZoomIn').addEventListener('click', function() {
                    erdState.zoom = Math.min(3, erdState.zoom + 0.15);
                    applyTf();
                });
                document.getElementById('erdZoomOut').addEventListener('click', function() {
                    erdState.zoom = Math.max(0.15, erdState.zoom - 0.15);
                    applyTf();
                });
                document.getElementById('erdFitView').addEventListener('click', fitView);
                document.getElementById('erdAutoLayout').addEventListener('click', function() {
                    if (schemasData[currentSchemaIndex]) buildERD(schemasData[currentSchemaIndex]);
                });
            }

            function applyTf() {
                erdCanvas.style.transform = 'translate(' + erdState.panX + 'px,' + erdState.panY + 'px) scale(' + erdState.zoom + ')';
                erdZoomLabel.textContent = Math.round(erdState.zoom * 100) + '%';
            }

            function fitView() {
                var keys = Object.keys(erdState.cards);
                if (!keys.length) return;

                var mnX = Infinity, mnY = Infinity, mxX = -Infinity, mxY = -Infinity;
                keys.forEach(function(k) {
                    var c = erdState.cards[k];
                    mnX = Math.min(mnX, c.x);
                    mnY = Math.min(mnY, c.y);
                    mxX = Math.max(mxX, c.x + c.width);
                    mxY = Math.max(mxY, c.y + c.height);
                });

                var p = 60;
                var cW = mxX - mnX + p * 2;
                var cH = mxY - mnY + p * 2;
                var wW = erdCanvasWrap.clientWidth;
                var wH = erdCanvasWrap.clientHeight;
                var sc = Math.max(0.2, Math.min(Math.min(wW / cW, wH / cH), 1.3));

                erdState.zoom = sc;
                erdState.panX = (wW - cW * sc) / 2 - (mnX - p) * sc;
                erdState.panY = (wH - cH * sc) / 2 - (mnY - p) * sc;
                applyTf();
            }

            // ══════════════════════════════════════
            //  RESIZERS
            // ══════════════════════════════════════
            (function() {
                var r = document.getElementById('sbResizerH');
                var mp = document.getElementById('sandboxMain');
                var dr = false;
                r.addEventListener('mousedown', function(e) {
                    dr = true; r.classList.add('active');
                    document.body.style.cursor = 'col-resize';
                    document.body.style.userSelect = 'none';
                    e.preventDefault();
                });
                document.addEventListener('mousemove', function(e) {
                    if (!dr) return;
                    var pr = document.querySelector('.sandbox-page').getBoundingClientRect();
                    var nw = e.clientX - pr.left;
                    nw = Math.max(300, Math.min(nw, pr.width - 350));
                    mp.style.width = nw + 'px';
                    mp.style.minWidth = nw + 'px';
                    mp.style.flex = 'none';
                });
                document.addEventListener('mouseup', function() {
                    if (dr) {
                        dr = false; r.classList.remove('active');
                        document.body.style.cursor = '';
                        document.body.style.userSelect = '';
                    }
                });
            })();

            (function() {
                var r = document.getElementById('sbResizerV');
                var rs = document.getElementById('sbResults');
                var d = false;
                r.addEventListener('mousedown', function(e) {
                    d = true; r.classList.add('active');
                    document.body.style.cursor = 'row-resize';
                    document.body.style.userSelect = 'none';
                    e.preventDefault();
                });
                document.addEventListener('mousemove', function(e) {
                    if (!d) return;
                    var cr = rs.parentElement.getBoundingClientRect();
                    var nh = cr.bottom - e.clientY;
                    nh = Math.max(80, Math.min(nh, cr.height - 150));
                    rs.style.height = nh + 'px';
                });
                document.addEventListener('mouseup', function() {
                    if (d) {
                        d = false; r.classList.remove('active');
                        document.body.style.cursor = '';
                        document.body.style.userSelect = '';
                    }
                });
            })();

            // ══════════════════════════════════════
            //  TABS
            // ══════════════════════════════════════
            var tabs = [{ name: 'query_1.sql', content: '' }];
            var activeTab = 0, tabCounter = 1;
            var tabsC = document.getElementById('editorTabs');

            function renderTabs() {
                var h = '';
                tabs.forEach(function(t, i) {
                    h += '<button type="button" class="stl-tab ' + (i === activeTab ? 'active' : '') +
                        '" data-tab="' + i + '">' + t.name +
                        (tabs.length > 1 ? ' <span class="close-tab" data-close="' + i + '">×</span>' : '') +
                        '</button>';
                });
                tabsC.innerHTML = h;
                tabsC.querySelectorAll('.stl-tab').forEach(function(b) {
                    b.addEventListener('click', function(e) {
                        if (e.target.classList.contains('close-tab')) return;
                        swTab(parseInt(this.dataset.tab));
                    });
                });
                tabsC.querySelectorAll('.close-tab').forEach(function(b) {
                    b.addEventListener('click', function(e) {
                        e.stopPropagation();
                        clTab(parseInt(this.dataset.close));
                    });
                });
            }

            function swTab(i) {
                tabs[activeTab].content = editor.value;
                activeTab = i;
                editor.value = tabs[activeTab].content;
                renderTabs();
                editor.focus();
            }

            function clTab(i) {
                if (tabs.length <= 1) return;
                tabs.splice(i, 1);
                if (activeTab >= tabs.length) activeTab = tabs.length - 1;
                editor.value = tabs[activeTab].content;
                renderTabs();
            }

            document.getElementById('addTabBtn').addEventListener('click', function() {
                tabs[activeTab].content = editor.value;
                tabCounter++;
                tabs.push({ name: 'query_' + tabCounter + '.sql', content: '' });
                activeTab = tabs.length - 1;
                editor.value = '';
                renderTabs();
                editor.focus();
            });

            renderTabs();

            // ══════════════════════════════════════
            //  EXECUTE
            // ══════════════════════════════════════
            function execQ() {
                var sql = editor.value.trim();
                if (!sql) return;
                runBtn.classList.add('loading');
                runBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Выполняется...';
                resultsInfo.textContent = 'Выполняется...';
                var st = performance.now();

                const sandboxUrl = "{{ route('sandbox.execute') }}";

                fetch(sandboxUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ sql: sql })
                })
                    .then(function(r) { return r.json(); })
                    .then(function(d) {
                        renderRes(d, ((performance.now() - st) / 1000).toFixed(3));
                    })
                    .catch(function(e) {
                        renderRes({ status: 'error', message: e.message || 'Ошибка сети' }, '0');
                    })
                    .finally(function() {
                        runBtn.classList.remove('loading');
                        runBtn.innerHTML = '<i class="bi bi-play-fill"></i> Выполнить';
                    });
            }

            runBtn.addEventListener('click', function(e) { e.preventDefault(); execQ(); });
            form.addEventListener('submit', function(e) { e.preventDefault(); execQ(); });
            editor.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 'Enter') { e.preventDefault(); execQ(); }
                if (e.key === 'Tab') {
                    e.preventDefault();
                    var s = this.selectionStart;
                    this.value = this.value.substring(0, s) + '  ' + this.value.substring(this.selectionEnd);
                    this.selectionStart = this.selectionEnd = s + 2;
                }
            });

            // ══════════════════════════════════════
            //  RENDER RESULT
            // ══════════════════════════════════════
            function renderRes(data, el) {
                if (data.status === 'ok' && data.rows && data.rows.length > 0) {
                    var cols = Object.keys(data.rows[0]);
                    var h = '<div class="sb-table-wrap"><table class="sb-result-table"><thead><tr><th class="row-num-header">#</th>';
                    cols.forEach(function(c) { h += '<th>' + esc(c) + '</th>'; });
                    h += '</tr></thead><tbody>';
                    data.rows.forEach(function(row, idx) {
                        h += '<tr><td class="row-num">' + (idx + 1) + '</td>';
                        cols.forEach(function(c) {
                            var v = row[c];
                            h += v === null || v === undefined
                                ? '<td class="null-val">NULL</td>'
                                : '<td>' + esc(String(v)) + '</td>';
                        });
                        h += '</tr>';
                    });
                    h += '</tbody></table></div>';
                    resultsBody.innerHTML = h;
                    resultsInfo.textContent = data.count + ' строк • ' + el + 'с';
                } else if (data.status === 'ok' && data.affected_rows !== undefined) {
                    resultsBody.innerHTML = '<div class="sb-result-msg success"><i class="bi bi-check-circle-fill"></i><div class="sb-msg-content"><h4 class="success">Запрос выполнен</h4><p>' + esc(data.message) + ' — ' + data.affected_rows + ' строк</p></div></div>';
                    resultsInfo.textContent = 'OK • ' + el + 'с';
                } else if (data.status === 'ok') {
                    resultsBody.innerHTML = '<div class="sb-result-msg success"><i class="bi bi-check-circle-fill"></i><div class="sb-msg-content"><h4 class="success">Выполнено</h4><p>0 строк</p></div></div>';
                    resultsInfo.textContent = '0 строк • ' + el + 'с';
                } else {
                    resultsBody.innerHTML = '<div class="sb-result-msg error"><i class="bi bi-exclamation-triangle-fill"></i><div class="sb-msg-content"><h4 class="error">Ошибка SQL</h4><p>' + esc(data.message || 'Неизвестная ошибка') + '</p></div></div>';
                    resultsInfo.textContent = 'Ошибка';
                }
            }

            // ══════════════════════════════════════
            //  CLEAR / COPY
            // ══════════════════════════════════════
            document.getElementById('sbClearBtn').addEventListener('click', function() {
                editor.value = '';
                tabs[activeTab].content = '';
                resultsBody.innerHTML = '<div class="sb-result-empty"><i class="bi bi-terminal"></i><span>Выполните запрос</span></div>';
                resultsInfo.textContent = '';
                editor.focus();
            });

            document.getElementById('copyBtn').addEventListener('click', function() {
                navigator.clipboard.writeText(editor.value).then(function() {
                    var b = document.getElementById('copyBtn');
                    b.innerHTML = '<i class="bi bi-check-lg"></i><span class="st-action-tooltip">Скопировано!</span>';
                    setTimeout(function() {
                        b.innerHTML = '<i class="bi bi-clipboard"></i><span class="st-action-tooltip">Копировать</span>';
                    }, 1500);
                });
            });

            document.querySelectorAll('.sr-tab').forEach(function(t) {
                t.addEventListener('click', function() {
                    document.querySelectorAll('.sr-tab').forEach(function(x) { x.classList.remove('active'); });
                    this.classList.add('active');
                });
            });

            function esc(s) {
                var d = document.createElement('div');
                d.textContent = s;
                return d.innerHTML;
            }

            // ══════════════════════════════════════
            //  INIT
            // ══════════════════════════════════════
            initDragAndDrop();
            initZoomPan();
            if (schemasData.length > 0) buildERD(schemasData[0]);

        })();
    </script>
@endsection
