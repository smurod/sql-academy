@extends('public.layouts.app')

@section('title', 'Задача #' . $task->task_number . ' — ' . $task->title)

@section('styles')
    <style>
        /* ═══════════════════════════════════════════════════════════════
           TASK PAGE — 3-PANEL IDE LAYOUT
           ═══════════════════════════════════════════════════════════════ */

        .task-page {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 72px);
            overflow: hidden;
            background: #060611;
        }

        /* ═══════════════════════════════════════════════════════════════
           HEADER BAR
           ═══════════════════════════════════════════════════════════════ */

        .task-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.25rem;
            height: 54px;
            background: linear-gradient(180deg, #0e0e20 0%, #0a0a1a 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            flex-shrink: 0;
            z-index: 100;
            position: relative;
        }

        .task-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 10%;
            right: 10%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.2), rgba(147, 51, 234, 0.2), transparent);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        .nav-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: var(--text-muted);
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(147, 51, 234, 0.15));
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .nav-btn:hover {
            border-color: rgba(59, 130, 246, 0.3);
            color: var(--primary);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .nav-btn:hover::before { opacity: 1; }
        .nav-btn i { position: relative; z-index: 1; }
        .nav-btn.disabled { opacity: 0.2; pointer-events: none; }

        .header-title {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        .task-number {
            background: linear-gradient(135deg, #3b82f6, #7c3aed);
            color: #fff;
            font-weight: 700;
            font-size: 0.78rem;
            padding: 0.3rem 0.7rem;
            border-radius: 6px;
            letter-spacing: 0.03em;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }

        .task-title {
            font-weight: 600;
            font-size: 1rem;
            color: var(--text-primary);
            max-width: 320px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            letter-spacing: -0.01em;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.3rem 0.65rem;
            border-radius: 6px;
            letter-spacing: 0.02em;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .badge i { font-size: 0.55rem; }

        .badge.easy {
            background: rgba(34, 197, 94, 0.08);
            color: #4ade80;
            border-color: rgba(34, 197, 94, 0.15);
        }

        .badge.medium {
            background: rgba(245, 158, 11, 0.08);
            color: #fbbf24;
            border-color: rgba(245, 158, 11, 0.15);
        }

        .badge.hard {
            background: rgba(239, 68, 68, 0.08);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.15);
        }

        .badge.expert {
            background: rgba(147, 51, 234, 0.08);
            color: #a78bfa;
            border-color: rgba(147, 51, 234, 0.15);
        }

        .badge.xp {
            background: rgba(59, 130, 246, 0.08);
            color: #60a5fa;
            border-color: rgba(59, 130, 246, 0.15);
        }

        .badge.free {
            background: rgba(34, 197, 94, 0.06);
            color: #4ade80;
            border-color: rgba(34, 197, 94, 0.12);
        }

        .hint-toggle {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.35rem 0.85rem;
            background: rgba(245, 158, 11, 0.04);
            border: 1px solid rgba(245, 158, 11, 0.12);
            border-radius: 8px;
            color: rgba(245, 158, 11, 0.7);
            font-size: 0.78rem;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .hint-toggle:hover {
            background: rgba(245, 158, 11, 0.1);
            border-color: rgba(245, 158, 11, 0.3);
            color: var(--warning);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.15);
        }

        /* ═══════════════════════════════════════════════════════════════
           BODY — 3 PANELS
           ═══════════════════════════════════════════════════════════════ */

        .task-body {
            flex: 1;
            display: flex;
            overflow: hidden;
            min-height: 0;
            padding: 6px;
            gap: 0;
        }

        /* ═══════════════════════════════════════════════════════════════
           PANEL SHARED STYLES
           ═══════════════════════════════════════════════════════════════ */

        .panel {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-radius: 16px;
            position: relative;
        }

        .panel::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 16px;
            pointer-events: none;
            z-index: 1;
        }

        /* ═══════════════════════════════════════════════════════════════
           HORIZONTAL RESIZER
           ═══════════════════════════════════════════════════════════════ */

        .resizer-horizontal {
            width: 12px;
            cursor: col-resize;
            background: rgba(255, 255, 255, 0.01);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.25s ease;
            position: relative;
            z-index: 50;
            border-radius: 4px;
            margin: 0 1px;
        }

        .resizer-horizontal::after {
            content: '';
            width: 3px;
            height: 36px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 2px;
            transition: all 0.25s ease;
        }

        .resizer-horizontal:hover,
        .resizer-horizontal.active {
            background: rgba(59, 130, 246, 0.06);
        }

        .resizer-horizontal:hover::after,
        .resizer-horizontal.active::after {
            background: rgba(59, 130, 246, 0.5);
            height: 50px;
            width: 4px;
        }

        /* ═══════════════════════════════════════════════════════════════
           LEFT PANEL — DESCRIPTION
           ═══════════════════════════════════════════════════════════════ */

        .panel-desc {
            flex: 0 0 22%;
            min-width: 220px;
            background: #0c0c1b;
            border: 1.5px solid rgba(147, 51, 234, 0.12);
            box-shadow:
                0 0 40px rgba(147, 51, 234, 0.03),
                inset 0 1px 0 rgba(255, 255, 255, 0.03);
        }

        .panel-desc::before {
            background: linear-gradient(180deg, rgba(147, 51, 234, 0.02) 0%, transparent 30%);
        }

        .desc-panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            background: rgba(147, 51, 234, 0.04);
            border-bottom: 1px solid rgba(147, 51, 234, 0.08);
            flex-shrink: 0;
            border-radius: 14px 14px 0 0;
            position: relative;
            z-index: 2;
        }

        .desc-tabs {
            display: flex;
            gap: 0.3rem;
        }

        .desc-tab {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.45rem 0.85rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            font-family: inherit;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
        }

        .desc-tab i {
            font-size: 0.9rem;
            transition: color 0.25s ease;
        }

        .desc-tab:hover {
            color: var(--text-secondary);
            background: rgba(255, 255, 255, 0.03);
        }

        .desc-tab.active {
            color: #c084fc;
            background: rgba(147, 51, 234, 0.1);
            border: 1px solid rgba(147, 51, 234, 0.15);
        }

        .desc-tab.active i { color: #a855f7; }

        .desc-body {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
            position: relative;
            z-index: 2;
        }

        .desc-body::-webkit-scrollbar { width: 3px; }
        .desc-body::-webkit-scrollbar-track { background: transparent; }
        .desc-body::-webkit-scrollbar-thumb {
            background: rgba(147, 51, 234, 0.2);
            border-radius: 3px;
        }
        .desc-body::-webkit-scrollbar-thumb:hover { background: rgba(147, 51, 234, 0.35); }

        .desc-task-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.35;
            margin-bottom: 0.75rem;
            letter-spacing: -0.01em;
        }

        .desc-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.35rem;
            margin-bottom: 0.875rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        }

        .desc-meta-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.2rem;
            font-size: 0.68rem;
            font-weight: 500;
            color: var(--text-muted);
            background: rgba(255, 255, 255, 0.025);
            padding: 0.22rem 0.5rem;
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.04);
            transition: all 0.2s ease;
        }

        .desc-meta-tag:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.08);
        }

        .desc-meta-tag i { font-size: 0.62rem; }

        .desc-task-text {
            font-size: 0.88rem;
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 0.625rem;
        }

        .desc-task-text code {
            background: rgba(59, 130, 246, 0.08);
            padding: 0.1rem 0.4rem;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            color: #93c5fd;
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .desc-note {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.55;
            font-style: italic;
            margin-bottom: 0.625rem;
            padding-left: 0.75rem;
            border-left: 2px solid rgba(147, 51, 234, 0.2);
        }

        .desc-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.3rem;
            margin-top: 0.75rem;
            padding-top: 0.625rem;
            border-top: 1px solid rgba(255, 255, 255, 0.04);
        }

        .desc-tag {
            font-size: 0.62rem;
            font-weight: 500;
            color: rgba(147, 51, 234, 0.7);
            background: rgba(147, 51, 234, 0.06);
            padding: 0.17rem 0.42rem;
            border-radius: 4px;
            border: 1px solid rgba(147, 51, 234, 0.1);
            transition: all 0.2s ease;
        }

        .desc-tag:hover {
            background: rgba(147, 51, 234, 0.12);
            color: #c084fc;
        }

        .hint-block {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.05) 0%, rgba(245, 158, 11, 0.02) 100%);
            border: 1px solid rgba(245, 158, 11, 0.12);
            border-radius: 10px;
            padding: 0.75rem 0.875rem;
            margin-top: 0.875rem;
            display: none;
            position: relative;
            overflow: hidden;
        }

        .hint-block::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(180deg, #f59e0b, #d97706);
            border-radius: 3px 0 0 3px;
        }

        .hint-block.show { display: block; }

        .hint-block-title {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: #fbbf24;
            margin-bottom: 0.3rem;
            padding-left: 0.375rem;
        }

        .hint-block-text {
            font-size: 0.8rem;
            color: var(--text-secondary);
            line-height: 1.55;
            padding-left: 0.375rem;
        }

        .hint-block-text code {
            background: rgba(245, 158, 11, 0.08);
            padding: 0.08rem 0.3rem;
            border-radius: 3px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            color: #fbbf24;
        }

        /* ═══════════════════════════════════════════════════════════════
           CENTER PANEL — EDITOR
           ═══════════════════════════════════════════════════════════════ */

        .panel-editor {
            flex: 0 0 33%;
            min-width: 280px;
            background: #090914;
            border: 1.5px solid rgba(59, 130, 246, 0.15);
            box-shadow:
                0 0 40px rgba(59, 130, 246, 0.03),
                inset 0 1px 0 rgba(255, 255, 255, 0.03);
        }

        .panel-editor::before {
            background: linear-gradient(180deg, rgba(59, 130, 246, 0.02) 0%, transparent 30%);
        }

        .editor-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.65rem 1rem;
            background: rgba(59, 130, 246, 0.03);
            border-bottom: 1px solid rgba(59, 130, 246, 0.08);
            flex-shrink: 0;
            border-radius: 14px 14px 0 0;
            position: relative;
            z-index: 2;
        }

        .editor-header-left {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .editor-label {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-secondary);
        }

        .editor-label i {
            color: #60a5fa;
            font-size: 1.05rem;
        }

        .editor-schema {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-muted);
            background: rgba(255, 255, 255, 0.03);
            padding: 0.25rem 0.55rem;
            border-radius: 5px;
            border: 1px solid rgba(255, 255, 255, 0.04);
            font-family: 'JetBrains Mono', monospace;
        }

        .editor-header-right {
            display: flex;
            gap: 0.4rem;
        }

        .editor-tool-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: var(--text-muted);
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
        }

        .editor-tool-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 7px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.12), rgba(147, 51, 234, 0.12));
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .editor-tool-btn:hover {
            border-color: rgba(59, 130, 246, 0.25);
            color: #60a5fa;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(59, 130, 246, 0.12);
        }

        .editor-tool-btn:hover::before { opacity: 1; }
        .editor-tool-btn i { position: relative; z-index: 1; }

        .editor-tool-btn .tip {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) scale(0.9);
            background: #1e1e38;
            color: var(--text-primary);
            font-size: 0.68rem;
            font-weight: 500;
            padding: 0.35rem 0.65rem;
            border-radius: 6px;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: all 0.2s ease;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
        }

        .editor-tool-btn .tip::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 4px solid transparent;
            border-top-color: #1e1e38;
        }

        .editor-tool-btn:hover .tip {
            opacity: 1;
            transform: translateX(-50%) scale(1);
        }

        .editor-textarea-wrap {
            flex: 1;
            min-height: 60px;
            position: relative;
            z-index: 2;
        }

        .editor-textarea-wrap textarea {
            width: 100%;
            height: 100%;
            background: transparent;
            color: var(--text-primary);
            border: none;
            padding: 0.75rem 1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.88rem;
            line-height: 1.8;
            resize: none;
            outline: none;
            tab-size: 2;
            caret-color: #60a5fa;
        }

        .editor-textarea-wrap textarea::placeholder {
            color: rgba(255, 255, 255, 0.12);
        }

        .editor-action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 1rem;
            background: rgba(0, 0, 0, 0.2);
            border-top: 1px solid rgba(59, 130, 246, 0.06);
            flex-shrink: 0;
            position: relative;
            z-index: 2;
        }

        .editor-shortcuts {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .editor-shortcuts kbd {
            background: rgba(255, 255, 255, 0.06);
            padding: 0.12rem 0.4rem;
            border-radius: 3px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            font-size: 0.65rem;
            font-family: 'JetBrains Mono', monospace;
            color: var(--text-secondary);
        }

        .editor-buttons {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-reset {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 8px;
            color: var(--text-muted);
            font-size: 0.88rem;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .btn-reset:hover {
            border-color: rgba(239, 68, 68, 0.3);
            color: #f87171;
            background: rgba(239, 68, 68, 0.06);
        }

        .btn-run, .btn-check {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.45rem 1rem;
            border: none;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            color: #fff;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-run::before, .btn-check::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.1) 0%, transparent 60%);
            pointer-events: none;
        }

        .btn-run {
            background: linear-gradient(135deg, #16a34a, #15803d);
            box-shadow: 0 2px 8px rgba(22, 163, 74, 0.25);
        }

        .btn-run:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(22, 163, 74, 0.35);
        }

        .btn-check {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        }

        .btn-check:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .btn-run.loading, .btn-check.loading {
            opacity: 0.55;
            pointer-events: none;
            transform: none;
        }

        .btn-run i, .btn-check i { position: relative; z-index: 1; }

        /* ═══ Resizer Vertical ═══ */
        .resizer-vertical {
            height: 12px;
            cursor: row-resize;
            background: rgba(59, 130, 246, 0.02);
            border-top: 1px solid rgba(59, 130, 246, 0.06);
            border-bottom: 1px solid rgba(34, 197, 94, 0.06);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.25s ease;
            position: relative;
            z-index: 2;
        }

        .resizer-vertical::after {
            content: '';
            width: 36px;
            height: 3px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 2px;
            transition: all 0.25s ease;
        }

        .resizer-vertical:hover,
        .resizer-vertical.active {
            background: rgba(59, 130, 246, 0.06);
        }

        .resizer-vertical:hover::after,
        .resizer-vertical.active::after {
            background: rgba(59, 130, 246, 0.5);
            width: 50px;
        }

        /* ═══ Results Panel ═══ */
        .results-panel {
            height: 180px;
            min-height: 60px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: #070710;
            border-top: 1.5px solid rgba(34, 197, 94, 0.12);
            border-radius: 0 0 14px 14px;
            position: relative;
            z-index: 2;
        }

        .results-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.45rem 0.85rem;
            background: rgba(34, 197, 94, 0.02);
            border-bottom: 1px solid rgba(34, 197, 94, 0.04);
            flex-shrink: 0;
        }

        .results-tabs {
            display: flex;
            gap: 0.25rem;
        }

        .results-tab {
            padding: 0.3rem 0.7rem;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 500;
            background: none;
            border: none;
            color: var(--text-muted);
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .results-tab:hover { color: var(--text-secondary); }

        .results-tab.active {
            background: rgba(255, 255, 255, 0.06);
            color: var(--text-primary);
        }

        .results-info {
            font-size: 0.7rem;
            color: var(--text-muted);
            font-family: 'JetBrains Mono', monospace;
        }

        .results-body {
            flex: 1;
            overflow: auto;
        }

        .results-body::-webkit-scrollbar { width: 4px; height: 4px; }
        .results-body::-webkit-scrollbar-track { background: rgba(0, 0, 0, 0.2); }
        .results-body::-webkit-scrollbar-thumb { background: rgba(34, 197, 94, 0.15); border-radius: 2px; }

        .result-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: var(--text-muted);
            gap: 0.375rem;
        }

        .result-empty i { font-size: 1.6rem; opacity: 0.15; }
        .result-empty span { font-size: 0.78rem; }

        .result-msg {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.8rem 1.1rem;
            margin: 0.5rem 0.625rem;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }

        .result-msg::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            border-radius: 3px 0 0 3px;
        }

        .result-msg.success {
            background: rgba(34, 197, 94, 0.06);
            border: 1px solid rgba(34, 197, 94, 0.12);
        }

        .result-msg.success::before { background: #22c55e; }

        .result-msg.error {
            background: rgba(239, 68, 68, 0.06);
            border: 1px solid rgba(239, 68, 68, 0.12);
        }

        .result-msg.error::before { background: #ef4444; }

        .result-msg i { font-size: 1.2rem; flex-shrink: 0; }
        .result-msg.success i { color: #4ade80; }
        .result-msg.error i { color: #f87171; }

        .result-msg-content h4 {
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.1rem;
        }

        .result-msg-content h4.text-success { color: #4ade80; }
        .result-msg-content h4.text-error { color: #f87171; }

        .result-msg-content p {
            font-size: 0.74rem;
            color: var(--text-secondary);
            font-family: 'JetBrains Mono', monospace;
            line-height: 1.45;
            word-break: break-word;
        }

        .result-table-wrapper { width: 100%; height: 100%; overflow: auto; }

        .result-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.74rem;
        }

        .result-table thead { position: sticky; top: 0; z-index: 5; }

        .result-table th {
            text-align: left;
            padding: 0.55rem 0.8rem;
            background: #111128;
            color: #60a5fa;
            font-weight: 600;
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid rgba(59, 130, 246, 0.2);
            white-space: nowrap;
        }

        .result-table tbody tr { transition: background 0.12s ease; }
        .result-table tbody tr:hover { background: rgba(59, 130, 246, 0.04); }
        .result-table tbody tr:nth-child(even) { background: rgba(255, 255, 255, 0.01); }
        .result-table tbody tr:nth-child(even):hover { background: rgba(59, 130, 246, 0.04); }

        .result-table td {
            padding: 0.45rem 0.8rem;
            color: var(--text-secondary);
            border-bottom: 1px solid rgba(255, 255, 255, 0.025);
            white-space: nowrap;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .result-table td.null-value { color: var(--text-muted); font-style: italic; }

        .result-table .row-number {
            color: var(--text-muted);
            font-size: 0.6rem;
            text-align: right;
            width: 28px;
            user-select: none;
            opacity: 0.6;
        }

        /* ═══════════════════════════════════════════════════════════════
           RIGHT PANEL — ERD
           ═══════════════════════════════════════════════════════════════ */

        .panel-erd {
            flex: 1;
            min-width: 300px;
            background: #0b0b19;
            border: 1.5px solid rgba(147, 51, 234, 0.12);
            box-shadow:
                0 0 40px rgba(147, 51, 234, 0.03),
                inset 0 1px 0 rgba(255, 255, 255, 0.03);
        }

        .panel-erd::before {
            background: linear-gradient(180deg, rgba(147, 51, 234, 0.02) 0%, transparent 30%);
        }

        .erd-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.65rem 0.9rem;
            background: rgba(147, 51, 234, 0.03);
            border-bottom: 1px solid rgba(147, 51, 234, 0.08);
            flex-shrink: 0;
            z-index: 20;
            border-radius: 14px 14px 0 0;
            position: relative;
        }

        .erd-header-left {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .erd-title {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .erd-title i { color: rgba(147, 51, 234, 0.55); font-size: 1rem; }

        .erd-schema-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.3rem 0.7rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-primary);
            transition: all 0.2s ease;
        }

        .erd-header-right {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .erd-tool-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: none;
            border: 1px solid transparent;
            color: var(--text-muted);
            font-size: 0.82rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .erd-tool-btn:hover {
            background: rgba(147, 51, 234, 0.06);
            color: var(--text-primary);
            border-color: rgba(147, 51, 234, 0.15);
        }

        .erd-zoom-label {
            font-size: 0.65rem;
            color: var(--text-muted);
            padding: 0.18rem 0.45rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
            min-width: 40px;
            text-align: center;
            user-select: none;
            border: 1px solid rgba(255, 255, 255, 0.04);
        }

        .erd-canvas-wrapper {
            flex: 1;
            position: relative;
            overflow: hidden;
            cursor: grab;
            background:
                radial-gradient(circle at 1px 1px, rgba(147, 51, 234, 0.025) 1px, transparent 0);
            background-size: 22px 22px;
            border-radius: 0 0 14px 14px;
        }

        .erd-canvas-wrapper.is-dragging { cursor: default; }
        .erd-canvas-wrapper.is-panning { cursor: grabbing; }

        .erd-canvas {
            position: absolute;
            top: 0;
            left: 0;
            transform-origin: 0 0;
        }

        .erd-svg-layer {
            position: absolute;
            pointer-events: none;
            z-index: 1;
            overflow: visible;
        }

        .erd-svg-layer path { pointer-events: stroke; }

        .erd-card {
            position: absolute;
            min-width: 210px;
            background: linear-gradient(180deg, #1c1c35 0%, #181830 100%);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 12px;
            box-shadow:
                0 4px 24px rgba(0, 0, 0, 0.35),
                0 0 0 1px rgba(255, 255, 255, 0.02) inset;
            z-index: 10;
            user-select: none;
            transition: box-shadow 0.25s ease, border-color 0.25s ease, transform 0.15s ease;
            cursor: move;
            white-space: nowrap;
        }

        .erd-card:hover {
            box-shadow: 0 8px 36px rgba(0, 0, 0, 0.5), 0 0 20px rgba(59, 130, 246, 0.05);
            border-color: rgba(255, 255, 255, 0.12);
            transform: translateY(-1px);
        }

        .erd-card.is-dragging {
            box-shadow: 0 16px 48px rgba(59, 130, 246, 0.2), 0 0 30px rgba(59, 130, 246, 0.08);
            border-color: rgba(59, 130, 246, 0.35);
            z-index: 50;
            transition: none;
            transform: none;
        }

        .erd-card.is-highlighted {
            border-color: rgba(59, 130, 246, 0.4);
            box-shadow: 0 0 24px rgba(59, 130, 246, 0.15);
        }

        .erd-card-header {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 0.75rem;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 60%, #1d4ed8 100%);
            border-radius: 11px 11px 0 0;
            position: relative;
            overflow: hidden;
        }

        .erd-card-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        .erd-card-header i { font-size: 0.75rem; color: rgba(255, 255, 255, 0.6); }

        .erd-card-name {
            font-size: 0.78rem;
            font-weight: 700;
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.02em;
            flex: 1;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .erd-card-count {
            font-size: 0.52rem;
            color: rgba(255, 255, 255, 0.4);
            background: rgba(0, 0, 0, 0.2);
            padding: 0.08rem 0.3rem;
            border-radius: 4px;
            font-weight: 600;
        }

        .erd-card-body { padding: 0; }

        .erd-column-row {
            display: flex;
            align-items: center;
            gap: 0.325rem;
            padding: 0.3rem 0.75rem;
            font-size: 0.72rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.025);
            transition: background 0.15s ease;
            position: relative;
            white-space: nowrap;
            overflow: hidden;
        }

        .erd-column-row:last-child {
            border-bottom: none;
            border-radius: 0 0 11px 11px;
        }

        .erd-column-row:hover { background: rgba(59, 130, 246, 0.05); }
        .erd-column-row.is-highlighted { background: rgba(59, 130, 246, 0.1); }

        .erd-key-icon {
            width: 14px;
            text-align: center;
            flex-shrink: 0;
            font-size: 0.7rem;
            line-height: 1;
        }

        .erd-key-icon.pk { color: #fbbf24; filter: drop-shadow(0 0 3px rgba(251, 191, 36, 0.3)); }
        .erd-key-icon.fk { color: #60a5fa; filter: drop-shadow(0 0 3px rgba(96, 165, 250, 0.3)); }
        .erd-key-icon.pkfk { color: #fb923c; filter: drop-shadow(0 0 3px rgba(251, 146, 60, 0.3)); }
        .erd-key-icon.none { color: rgba(255, 255, 255, 0.1); font-size: 0.4rem; }

        .erd-nullable {
            font-size: 0.55rem;
            flex-shrink: 0;
            width: 8px;
            text-align: center;
        }

        .erd-nullable.yes { color: var(--text-muted); }
        .erd-nullable.no { color: #34d399; }

        .erd-col-name {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            color: var(--text-primary);
            font-weight: 500;
            flex: 1;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .erd-column-row .erd-key-icon.pk ~ .erd-col-name,
        .erd-column-row .erd-key-icon.pkfk ~ .erd-col-name { font-weight: 700; }

        .erd-col-type {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.55rem;
            color: var(--text-muted);
            flex-shrink: 0;
            text-transform: lowercase;
            padding-left: 0.5rem;
            white-space: nowrap;
            opacity: 0.7;
        }

        .erd-anchor {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #3b82f6;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
            transition: opacity 0.2s ease, transform 0.2s ease;
            z-index: 5;
            box-shadow: 0 0 6px rgba(59, 130, 246, 0.4);
        }

        .erd-anchor.left { left: -4px; }
        .erd-anchor.right { right: -4px; }

        .erd-card:hover .erd-anchor,
        .erd-card.is-highlighted .erd-anchor {
            opacity: 0.6;
        }

        .erd-rel-path {
            fill: none;
            stroke: #3d4555;
            stroke-width: 1.5;
            transition: stroke 0.2s ease, stroke-width 0.2s ease;
        }

        .erd-rel-path:hover,
        .erd-rel-path.is-highlighted {
            stroke: #3b82f6;
            stroke-width: 2.5;
        }

        /* ═══════════════════════════════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════════════════════════════ */

        @media (max-width: 1024px) {
            .task-body {
                flex-direction: column;
            }

            .panel-desc {
                flex: 0 0 auto;
                min-width: unset;
                height: 22%;
                min-height: 120px;
            }

            .panel-editor {
                flex: 0 0 auto;
                min-width: unset;
                height: 40%;
                min-height: 200px;
            }

            .panel-erd {
                flex: 1;
                min-width: unset;
                min-height: 180px;
            }

            .resizer-horizontal {
                width: auto;
                height: 12px;
                cursor: row-resize;
                margin: 1px 0;
            }

            .resizer-horizontal::after {
                width: 36px;
                height: 3px;
            }

            .resizer-horizontal:hover::after,
            .resizer-horizontal.active::after {
                width: 50px;
                height: 4px;
            }
        }

        @media (max-width: 640px) {
            .header-right { display: none; }
            .task-title { max-width: 150px; }
            .editor-shortcuts { display: none; }
        }

        body.is-resizing {
            user-select: none !important;
            -webkit-user-select: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="task-page">

        <div class="task-header">
            <div class="header-left">
                <a href="{{ route('public.tasks.index') }}" class="nav-btn" title="К списку задач"><i class="bi bi-arrow-left"></i></a>
                @if($prevTask)
                    <a href="{{ route('public.tasks.show', $prevTask) }}" class="nav-btn" title="Предыдущая задача"><i class="bi bi-chevron-left"></i></a>
                @else
                    <span class="nav-btn disabled"><i class="bi bi-chevron-left"></i></span>
                @endif
                <div class="header-title">
                    <span class="task-number">#{{ $task->task_number }}</span>
                    <span class="task-title">{{ $task->title }}</span>
                </div>
                @if($nextTask)
                    <a href="{{ route('public.tasks.show', $nextTask) }}" class="nav-btn" title="Следующая задача"><i class="bi bi-chevron-right"></i></a>
                @else
                    <span class="nav-btn disabled"><i class="bi bi-chevron-right"></i></span>
                @endif
            </div>
            <div class="header-right">
                @php
                    $dp = $task->difficulty_percent;
                    $dc = match(true) { $dp <= 30 => 'easy', $dp <= 60 => 'medium', $dp <= 85 => 'hard', default => 'expert' };
                @endphp
                <span class="badge {{ $dc }}"><i class="bi bi-circle-fill"></i> {{ $task->difficulty_label }}</span>
                <span class="badge xp"><i class="bi bi-star-fill"></i> {{ $task->points }} XP</span>
                @if($task->is_free)
                    <span class="badge free"><i class="bi bi-unlock-fill"></i> Free</span>
                @endif
                @if($task->hint)
                    <button class="hint-toggle" id="hintToggle"><i class="bi bi-lightbulb"></i> Подсказка</button>
                @endif
            </div>
        </div>

        <div class="task-body" id="taskBody">

            <div class="panel panel-desc" id="panelDesc">
                <div class="desc-panel-header">
                    <div class="desc-tabs">
                        <button class="desc-tab active" data-panel="task"><i class="bi bi-file-text"></i> Задача</button>
                        <button class="desc-tab" data-panel="discuss"><i class="bi bi-chat-dots"></i> Обсуждение</button>
                    </div>
                </div>
                <div class="desc-body">
                    <div id="panelTask">
                        <h2 class="desc-task-title">{{ $task->title }}</h2>

                        <div class="desc-meta">
                            <span class="desc-meta-tag"><i class="bi bi-database"></i> {{ $schemaData['icon'] }} {{ $schemaData['name'] }}</span>
                            <span class="desc-meta-tag"><i class="bi bi-code-slash"></i> {{ strtoupper($task->sql_type) }}</span>
                            @if($task->lesson_id)
                                <span class="desc-meta-tag"><i class="bi bi-journal-text"></i> Урок {{ $task->lesson_id }}</span>
                            @endif
                            @if($task->company)
                                <span class="desc-meta-tag"><i class="bi bi-building"></i> {{ $task->company }}</span>
                            @endif
                        </div>

                        <p class="desc-task-text">{{ $task->task_text }}</p>

                        @if($task->description && $task->description !== $task->task_text)
                            <p class="desc-note">{{ $task->description }}</p>
                        @endif

                        @if($task->tags)
                            <div class="desc-tags">
                                @foreach(explode(',', $task->tags) as $tag)
                                    <span class="desc-tag">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        @endif

                        @if($task->hint)
                            <div class="hint-block" id="hintBlock">
                                <div class="hint-block-title"><i class="bi bi-lightbulb-fill"></i> Подсказка</div>
                                <div class="hint-block-text">{{ $task->hint }}</div>
                            </div>
                        @endif
                    </div>

                    <div id="panelDiscuss" style="display: none;">
                        <h2 class="desc-task-title">Обсуждение</h2>
                        <p class="desc-note">Раздел обсуждения появится в ближайшем обновлении.</p>
                    </div>
                </div>
            </div>

            <div class="resizer-horizontal" id="resizerH1"></div>

            <div class="panel panel-editor" id="panelEditor">
                <div class="editor-header">
                    <div class="editor-header-left">
                        <span class="editor-label"><i class="bi bi-terminal-fill"></i> SQL</span>
                        <span class="editor-schema">{{ $schemaData['icon'] }} {{ $schemaData['name'] }}</span>
                    </div>
                    <div class="editor-header-right">
                        <button class="editor-tool-btn" id="formatBtn" title="Форматировать SQL">
                            <i class="bi bi-code-slash"></i>
                            <span class="tip">Форматировать</span>
                        </button>
                        <button class="editor-tool-btn" id="copyBtn" title="Копировать код">
                            <i class="bi bi-clipboard"></i>
                            <span class="tip">Копировать</span>
                        </button>
                    </div>
                </div>

                <div class="editor-textarea-wrap">
                    <textarea id="sqlEditor" placeholder="-- Напишите SQL-запрос здесь...&#10;&#10;SELECT * FROM passengers;" spellcheck="false" autocomplete="off" autocorrect="off" autocapitalize="off"></textarea>
                </div>

                <div class="editor-action-bar">
                    <div class="editor-shortcuts">
                        <kbd>Ctrl</kbd> + <kbd>Enter</kbd> — выполнить
                    </div>
                    <div class="editor-buttons">
                        <button class="btn-reset" id="resetBtn" title="Очистить"><i class="bi bi-arrow-counterclockwise"></i></button>
                        <button class="btn-run" id="runBtn"><i class="bi bi-play-fill"></i> Run</button>
                        <button class="btn-check" id="checkBtn"><i class="bi bi-check2-circle"></i> Check</button>
                    </div>
                </div>

                <div class="resizer-vertical" id="resizerV"></div>

                <div class="results-panel" id="resultsPanel">
                    <div class="results-header">
                        <div class="results-tabs">
                            <button class="results-tab active">Результат</button>
                            <button class="results-tab">Ожидаемый</button>
                        </div>
                        <span class="results-info" id="resultsInfo"></span>
                    </div>
                    <div class="results-body" id="resultsBody">
                        <div class="result-empty">
                            <i class="bi bi-terminal"></i>
                            <span>Выполните запрос, чтобы увидеть результат</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="resizer-horizontal" id="resizerH2"></div>

            <div class="panel panel-erd" id="panelErd">
                <div class="erd-header">
                    <div class="erd-header-left">
                        <div class="erd-title"><i class="bi bi-diagram-3"></i> ERD</div>
                        <div class="erd-schema-badge">
                            <span>{{ $schemaData['icon'] }}</span>
                            <span>{{ $schemaData['name'] }}</span>
                        </div>
                    </div>
                    <div class="erd-header-right">
                        <button class="erd-tool-btn" id="erdAutoLayout" title="Авто-расположение"><i class="bi bi-grid-3x3-gap"></i></button>
                        <button class="erd-tool-btn" id="erdZoomIn" title="Приблизить"><i class="bi bi-zoom-in"></i></button>
                        <span class="erd-zoom-label" id="erdZoomLabel">100%</span>
                        <button class="erd-tool-btn" id="erdZoomOut" title="Отдалить"><i class="bi bi-zoom-out"></i></button>
                        <button class="erd-tool-btn" id="erdFitView" title="Вписать всё"><i class="bi bi-fullscreen"></i></button>
                    </div>
                </div>

                <div class="erd-canvas-wrapper" id="erdCanvasWrapper">
                    <div class="erd-canvas" id="erdCanvas">
                        <svg class="erd-svg-layer" id="erdSvg">
                            <defs>
                                <marker id="crow-many" viewBox="0 0 12 12" refX="12" refY="6" markerWidth="12" markerHeight="12" orient="auto-start-reverse">
                                    <path d="M 0,0 L 12,6 L 0,12" fill="none" stroke="#3d4555" stroke-width="1.5"/>
                                </marker>
                                <marker id="crow-one" viewBox="0 0 12 12" refX="12" refY="6" markerWidth="12" markerHeight="12" orient="auto-start-reverse">
                                    <line x1="10" y1="0" x2="10" y2="12" stroke="#3d4555" stroke-width="1.5"/>
                                    <line x1="6" y1="0" x2="6" y2="12" stroke="#3d4555" stroke-width="1.5"/>
                                </marker>
                                <marker id="crow-many-hl" viewBox="0 0 12 12" refX="12" refY="6" markerWidth="12" markerHeight="12" orient="auto-start-reverse">
                                    <path d="M 0,0 L 12,6 L 0,12" fill="none" stroke="#3b82f6" stroke-width="1.5"/>
                                </marker>
                                <marker id="crow-one-hl" viewBox="0 0 12 12" refX="12" refY="6" markerWidth="12" markerHeight="12" orient="auto-start-reverse">
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
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>

    <script>
        (function() {
            'use strict';

            var schemaData = @json($schemaData);
            var csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            var runUrl = '{{ route("public.tasks.run", $task) }}';
            var checkUrl = '{{ route("public.tasks.check", $task) }}';

            var editor = document.getElementById('sqlEditor');
            var runBtn = document.getElementById('runBtn');
            var checkBtn = document.getElementById('checkBtn');
            var resultsBody = document.getElementById('resultsBody');
            var resultsInfo = document.getElementById('resultsInfo');
            var canvasWrapper = document.getElementById('erdCanvasWrapper');
            var canvas = document.getElementById('erdCanvas');
            var svgLayer = document.getElementById('erdSvg');
            var zoomLabel = document.getElementById('erdZoomLabel');

            var erdState = {
                zoom: 1, panX: 0, panY: 0,
                isPanning: false, panStartX: 0, panStartY: 0,
                cards: {}, relationships: [],
                dragCard: null, dragOffsetX: 0, dragOffsetY: 0
            };

            (function() {
                var taskBody = document.getElementById('taskBody');
                var panelDesc = document.getElementById('panelDesc');
                var panelEditor = document.getElementById('panelEditor');
                var panelErd = document.getElementById('panelErd');
                var resizerH1 = document.getElementById('resizerH1');
                var resizerH2 = document.getElementById('resizerH2');

                var isResizing = false;
                var currentResizer = null;

                function isMobileLayout() {
                    return window.innerWidth <= 1024;
                }

                function startResize(resizer, e) {
                    isResizing = true;
                    currentResizer = resizer;
                    resizer.classList.add('active');
                    document.body.classList.add('is-resizing');
                    e.preventDefault();
                }

                resizerH1.addEventListener('mousedown', function(e) { startResize(resizerH1, e); });
                resizerH2.addEventListener('mousedown', function(e) { startResize(resizerH2, e); });
                resizerH1.addEventListener('touchstart', function(e) { startResize(resizerH1, e); }, { passive: false });
                resizerH2.addEventListener('touchstart', function(e) { startResize(resizerH2, e); }, { passive: false });

                function onMove(clientX, clientY) {
                    if (!isResizing || !currentResizer) return;

                    var bodyRect = taskBody.getBoundingClientRect();
                    var mobile = isMobileLayout();

                    if (mobile) {
                        var totalHeight = bodyRect.height;
                        var relY = clientY - bodyRect.top;
                        var resizerSize = 14;

                        if (currentResizer === resizerH1) {
                            var descHeight = Math.max(80, Math.min(relY, totalHeight - 300));
                            var descPct = (descHeight / totalHeight) * 100;
                            panelDesc.style.flex = '0 0 ' + descPct + '%';
                            panelDesc.style.height = descPct + '%';
                        } else if (currentResizer === resizerH2) {
                            var descH = panelDesc.getBoundingClientRect().height;
                            var editorHeight = Math.max(150, Math.min(relY - descH - resizerSize, totalHeight - descH - 200));
                            var editorPct = (editorHeight / totalHeight) * 100;
                            panelEditor.style.flex = '0 0 ' + editorPct + '%';
                            panelEditor.style.height = editorPct + '%';
                        }
                    } else {
                        var totalWidth = bodyRect.width;
                        var relX = clientX - bodyRect.left;
                        var resizerSize = 14;

                        if (currentResizer === resizerH1) {
                            var descWidth = Math.max(180, Math.min(relX, totalWidth - 500));
                            var descPct = (descWidth / totalWidth) * 100;
                            panelDesc.style.flex = '0 0 ' + descPct + '%';
                            panelDesc.style.minWidth = '0';
                        } else if (currentResizer === resizerH2) {
                            var descW = panelDesc.getBoundingClientRect().width;
                            var editorWidth = Math.max(250, Math.min(relX - descW - resizerSize, totalWidth - descW - 300));
                            var editorPct = (editorWidth / totalWidth) * 100;
                            panelEditor.style.flex = '0 0 ' + editorPct + '%';
                            panelEditor.style.minWidth = '0';
                        }
                    }
                }

                document.addEventListener('mousemove', function(e) {
                    onMove(e.clientX, e.clientY);
                });

                document.addEventListener('touchmove', function(e) {
                    if (!isResizing) return;
                    var touch = e.touches[0];
                    onMove(touch.clientX, touch.clientY);
                    e.preventDefault();
                }, { passive: false });

                function stopResize() {
                    if (isResizing) {
                        isResizing = false;
                        if (currentResizer) currentResizer.classList.remove('active');
                        currentResizer = null;
                        document.body.classList.remove('is-resizing');
                    }
                }

                document.addEventListener('mouseup', stopResize);
                document.addEventListener('touchend', stopResize);
            })();

            document.querySelectorAll('.desc-tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.desc-tab').forEach(function(t) { t.classList.remove('active'); });
                    this.classList.add('active');
                    var panel = this.dataset.panel;
                    document.getElementById('panelTask').style.display = panel === 'task' ? 'block' : 'none';
                    document.getElementById('panelDiscuss').style.display = panel === 'discuss' ? 'block' : 'none';
                });
            });

            document.querySelectorAll('.results-tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.results-tab').forEach(function(t) { t.classList.remove('active'); });
                    this.classList.add('active');
                });
            });

            var hintToggleBtn = document.getElementById('hintToggle');
            if (hintToggleBtn) {
                hintToggleBtn.addEventListener('click', function() {
                    var block = document.getElementById('hintBlock');
                    if (block) block.classList.toggle('show');
                });
            }

            document.getElementById('formatBtn').addEventListener('click', function() {
                editor.value = formatSQL(editor.value);
            });

            document.getElementById('copyBtn').addEventListener('click', function() {
                navigator.clipboard.writeText(editor.value).then(function() {
                    var btn = document.getElementById('copyBtn');
                    var icon = btn.querySelector('i');
                    icon.className = 'bi bi-check-lg';
                    setTimeout(function() { icon.className = 'bi bi-clipboard'; }, 1200);
                });
            });

            function formatSQL(sql) {
                if (!sql.trim()) return sql;
                var f = sql.replace(/\s+/g, ' ').trim();

                var keywords = [
                    'select', 'from', 'where', 'and', 'or', 'order by', 'group by', 'having',
                    'left join', 'right join', 'inner join', 'cross join', 'join', 'on',
                    'limit', 'offset', 'union all', 'union', 'distinct', 'as', 'asc', 'desc',
                    'count', 'sum', 'avg', 'min', 'max', 'between', 'like', 'in', 'not',
                    'is', 'null', 'case', 'when', 'then', 'else', 'end', 'timediff', 'exists'
                ];

                keywords.forEach(function(kw) {
                    f = f.replace(new RegExp('\\b' + kw.replace(/\s+/g, '\\s+') + '\\b', 'gi'), kw.toUpperCase());
                });

                var lineBreakers = [
                    'SELECT', 'FROM', 'WHERE', 'ORDER BY', 'GROUP BY', 'HAVING',
                    'LEFT JOIN', 'RIGHT JOIN', 'INNER JOIN', 'CROSS JOIN', 'JOIN',
                    'LIMIT', 'OFFSET', 'UNION ALL', 'UNION'
                ];

                lineBreakers.forEach(function(kw) {
                    f = f.replace(new RegExp('\\s+(' + kw.replace(/\s+/g, '\\s+') + ')\\b', 'g'), '\n$1');
                });

                f = f.replace(/\s+(AND)\b/g, '\n  AND').replace(/\s+(OR)\b/g, '\n  OR');
                if (!f.endsWith(';')) f += ';';
                return f.trim();
            }

            function executeRun() {
                var sql = editor.value.trim();
                if (!sql) return;

                runBtn.classList.add('loading');
                runBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> ...';
                resultsInfo.textContent = 'Выполняется...';

                postRequest(runUrl, sql, function(data) {
                    renderResult(data);
                }, function() {
                    runBtn.classList.remove('loading');
                    runBtn.innerHTML = '<i class="bi bi-play-fill"></i> Run';
                });
            }

            function executeCheck() {
                var sql = editor.value.trim();
                if (!sql) return;

                checkBtn.classList.add('loading');
                checkBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> ...';
                resultsInfo.textContent = 'Проверяется...';

                postRequest(checkUrl, sql, function(data) {
                    renderCheckResult(data);
                }, function() {
                    checkBtn.classList.remove('loading');
                    checkBtn.innerHTML = '<i class="bi bi-check2-circle"></i> Check';
                });
            }

            function postRequest(url, sql, onSuccess, onFinally) {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ sql: sql })
                })
                    .then(function(response) { return response.json(); })
                    .then(onSuccess)
                    .catch(function(error) {
                        renderResult({ status: 'error', message: error.message || 'Ошибка сети' });
                    })
                    .finally(onFinally);
            }

            function renderResult(data) {
                if (data.status === 'ok' && data.rows && data.rows.length > 0) {
                    resultsBody.innerHTML = buildResultTable(data.rows);
                    resultsInfo.textContent = data.count + ' строк' + (data.time ? ' • ' + data.time + 'с' : '');
                } else if (data.status === 'ok') {
                    resultsBody.innerHTML = createMessage('success', 'Запрос выполнен', '0 строк возвращено');
                    resultsInfo.textContent = '0 строк';
                } else {
                    resultsBody.innerHTML = createMessage('error', 'Ошибка SQL', data.message || 'Неизвестная ошибка');
                    resultsInfo.textContent = 'Ошибка';
                }
            }

            function renderCheckResult(data) {
                if (data.status === 'error') {
                    var message = data.message || 'Результат запроса не совпадает с ожидаемым';
                    var detail = data.meta && data.meta.error ? data.meta.error : '';
                    resultsBody.innerHTML = createMessage('error', message, detail);
                    if (data.rows && data.rows.length > 0) {
                        resultsBody.innerHTML += buildResultTable(data.rows);
                    }
                    resultsInfo.textContent = '✗ Неверно';
                } else {
                    var html = createMessage('success', 'Решение верно', 'Переходите к следующей задаче!');
                    if (data.rows && data.rows.length > 0) {
                        html += buildResultTable(data.rows);
                    }
                    resultsBody.innerHTML = html;
                    resultsInfo.textContent = '✓ Верно' + (data.count ? ' • ' + data.count + ' строк' : '');

                    setTimeout(function() {
                        playSuccessConfetti();
                    }, 80);
                }
            }

            function createMessage(type, title, text) {
                var iconClass = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
                var titleClass = type === 'success' ? 'text-success' : 'text-error';
                return '<div class="result-msg ' + type + '">' +
                    '<i class="bi ' + iconClass + '"></i>' +
                    '<div class="result-msg-content">' +
                    '<h4 class="' + titleClass + '">' + escapeHtml(title) + '</h4>' +
                    (text ? '<p>' + escapeHtml(text) + '</p>' : '') +
                    '</div></div>';
            }

            function buildResultTable(rows) {
                var columns = Object.keys(rows[0]);
                var html = '<div class="result-table-wrapper"><table class="result-table"><thead><tr><th class="row-number">#</th>';

                columns.forEach(function(col) {
                    html += '<th>' + escapeHtml(col) + '</th>';
                });

                html += '</tr></thead><tbody>';

                rows.forEach(function(row, index) {
                    html += '<tr><td class="row-number">' + (index + 1) + '</td>';
                    columns.forEach(function(col) {
                        var value = row[col];
                        if (value === null || value === undefined) {
                            html += '<td class="null-value">NULL</td>';
                        } else {
                            html += '<td>' + escapeHtml(String(value)) + '</td>';
                        }
                    });
                    html += '</tr>';
                });

                return html + '</tbody></table></div>';
            }

            function playSuccessConfetti() {
                if (typeof confetti !== 'function') return;

                var successBox = resultsBody.querySelector('.result-msg.success');
                if (!successBox) return;

                var rect = successBox.getBoundingClientRect();
                var originX = (rect.left + rect.width / 2) / window.innerWidth;
                var originY = (rect.top + rect.height / 2) / window.innerHeight;

                confetti({
                    particleCount: 140,
                    spread: 70,
                    startVelocity: 55,
                    gravity: 1.15,
                    ticks: 220,
                    scalar: 1.05,
                    drift: 0,
                    origin: {
                        x: originX,
                        y: originY
                    },
                    angle: 90
                });

                confetti({
                    particleCount: 70,
                    spread: 55,
                    startVelocity: 48,
                    gravity: 1.2,
                    ticks: 220,
                    scalar: 0.9,
                    origin: {
                        x: originX,
                        y: originY
                    },
                    angle: 75
                });

                confetti({
                    particleCount: 70,
                    spread: 55,
                    startVelocity: 48,
                    gravity: 1.2,
                    ticks: 220,
                    scalar: 0.9,
                    origin: {
                        x: originX,
                        y: originY
                    },
                    angle: 105
                });
            }


            var isAuth = {{ auth()->check() ? 'true' : 'false' }};
            var loginUrl = '{{ url("/login") }}';

            function requireAuth(callback) {
                if (!isAuth) {
                    window.location.href = loginUrl;
                    return;
                }
                callback();
            }

            runBtn.addEventListener('click', function() {
                requireAuth(executeRun);
            });

            checkBtn.addEventListener('click', function() {
                requireAuth(executeCheck);
            });

            editor.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 'Enter') {
                    e.preventDefault();
                    requireAuth(executeRun);
                }
                if (e.key === 'Tab') {
                    e.preventDefault();
                    var start = this.selectionStart;
                    this.value = this.value.substring(0, start) + '  ' + this.value.substring(this.selectionEnd);
                    this.selectionStart = this.selectionEnd = start + 2;
                }
            });

            document.getElementById('resetBtn').addEventListener('click', function() {
                editor.value = '';
                resultsBody.innerHTML = '<div class="result-empty"><i class="bi bi-terminal"></i><span>Выполните запрос, чтобы увидеть результат</span></div>';
                resultsInfo.textContent = '';
                editor.focus();
            });



            function measureCard(tableName) {
                var card = erdState.cards[tableName];
                if (!card) return;

                card.width = card.element.offsetWidth;
                card.height = card.element.offsetHeight;
                card.fieldOffsets = {};

                card.element.querySelectorAll('.erd-column-row').forEach(function(row) {
                    card.fieldOffsets[row.dataset.column] = row.offsetTop + row.offsetHeight / 2;
                });
            }

            function measureAllCards() {
                Object.keys(erdState.cards).forEach(measureCard);
            }

            function getFieldPosition(tableName, fieldName, side) {
                var card = erdState.cards[tableName];
                if (!card || !card.fieldOffsets) return null;

                var yOffset = card.fieldOffsets[fieldName];
                if (yOffset === undefined) return null;

                return side === 'left'
                    ? { x: card.x, y: card.y + yOffset }
                    : { x: card.x + card.width, y: card.y + yOffset };
            }

            function renderTableCard(table, x, y) {
                var cardEl = document.createElement('div');
                cardEl.className = 'erd-card';
                cardEl.dataset.table = table.name;
                cardEl.style.left = x + 'px';
                cardEl.style.top = y + 'px';

                var header = document.createElement('div');
                header.className = 'erd-card-header';
                header.innerHTML = '<i class="bi bi-table"></i>' +
                    '<span class="erd-card-name">' + escapeHtml(table.name) + '</span>' +
                    '<span class="erd-card-count">' + table.columns.length + '</span>';
                cardEl.appendChild(header);

                var body = document.createElement('div');
                body.className = 'erd-card-body';

                table.columns.forEach(function(col) {
                    var row = document.createElement('div');
                    row.className = 'erd-column-row';
                    row.dataset.column = col.name;
                    row.dataset.table = table.name;

                    var keyHtml;
                    if (col.key === 'pk_fk') {
                        keyHtml = '<span class="erd-key-icon pkfk"><i class="bi bi-key-fill"></i></span>';
                    } else if (col.key === 'pk') {
                        keyHtml = '<span class="erd-key-icon pk"><i class="bi bi-key-fill"></i></span>';
                    } else if (col.key === 'fk') {
                        keyHtml = '<span class="erd-key-icon fk"><i class="bi bi-link-45deg"></i></span>';
                    } else {
                        keyHtml = '<span class="erd-key-icon none">•</span>';
                    }

                    var nullHtml = col.nullable
                        ? '<span class="erd-nullable yes">◇</span>'
                        : '<span class="erd-nullable no">◆</span>';

                    row.innerHTML = keyHtml + nullHtml +
                        '<span class="erd-col-name">' + escapeHtml(col.name) + '</span>' +
                        '<span class="erd-col-type">' + escapeHtml(col.type) + '</span>' +
                        '<div class="erd-anchor left"></div>' +
                        '<div class="erd-anchor right"></div>';

                    body.appendChild(row);
                });

                cardEl.appendChild(body);
                canvas.appendChild(cardEl);

                erdState.cards[table.name] = {
                    element: cardEl,
                    x: x, y: y,
                    width: 0, height: 0,
                    fieldOffsets: {},
                    table: table
                };
            }

            function computeAutoLayout(tables) {
                if (!tables || !tables.length) return {};

                var deps = {};
                var tableNames = tables.map(function(t) { return t.name; });
                tables.forEach(function(t) { deps[t.name] = []; });

                tables.forEach(function(t) {
                    t.columns.forEach(function(col) {
                        if (col.fk_to && tableNames.indexOf(col.fk_to.table) !== -1) {
                            deps[t.name].push(col.fk_to.table);
                        }
                    });
                });

                var levels = {};
                var visited = {};

                function getLevel(name) {
                    if (levels[name] !== undefined) return levels[name];
                    if (visited[name]) return 0;
                    visited[name] = true;

                    var maxParentLevel = -1;
                    (deps[name] || []).forEach(function(parent) {
                        var parentLevel = getLevel(parent);
                        if (parentLevel > maxParentLevel) maxParentLevel = parentLevel;
                    });

                    levels[name] = maxParentLevel + 1;
                    return levels[name];
                }

                tables.forEach(function(t) { getLevel(t.name); });

                var groups = {};
                var maxLevel = 0;

                tables.forEach(function(t) {
                    var level = levels[t.name] || 0;
                    if (level > maxLevel) maxLevel = level;
                    if (!groups[level]) groups[level] = [];
                    groups[level].push(t);
                });

                var positions = {};
                var xGap = 280;
                var yGap = 30;
                var startX = 40;
                var startY = 40;

                for (var level = 0; level <= maxLevel; level++) {
                    var group = groups[level] || [];
                    var x = startX + level * xGap;
                    var y = startY;

                    group.forEach(function(table) {
                        positions[table.name] = { x: x, y: y };
                        y += 32 + table.columns.length * 26 + 10 + yGap;
                    });
                }

                return positions;
            }

            function renderRelationships(tables) {
                erdState.relationships.forEach(function(rel) {
                    if (rel.pathElement) rel.pathElement.remove();
                });
                erdState.relationships = [];

                var tableNames = tables.map(function(t) { return t.name; });

                tables.forEach(function(table) {
                    table.columns.forEach(function(col) {
                        if (!col.fk_to || tableNames.indexOf(col.fk_to.table) === -1) return;

                        var rel = {
                            fromTable: table.name,
                            fromColumn: col.name,
                            toTable: col.fk_to.table,
                            toColumn: col.fk_to.column,
                            pathElement: null
                        };

                        var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                        path.classList.add('erd-rel-path');
                        rel.pathElement = path;

                        path.addEventListener('mouseenter', function() { highlightRelationship(rel, true); });
                        path.addEventListener('mouseleave', function() { highlightRelationship(rel, false); });

                        svgLayer.appendChild(path);
                        erdState.relationships.push(rel);
                    });
                });

                updateAllPaths();
            }

            function updateAllPaths() {
                erdState.relationships.forEach(updatePath);
            }

            function updatePath(rel) {
                var fromCard = erdState.cards[rel.fromTable];
                var toCard = erdState.cards[rel.toTable];

                if (!fromCard || !toCard) {
                    if (rel.pathElement) rel.pathElement.setAttribute('d', '');
                    return;
                }

                var fromCenterX = fromCard.x + fromCard.width / 2;
                var toCenterX = toCard.x + toCard.width / 2;
                var fromSide = fromCenterX <= toCenterX ? 'right' : 'left';
                var toSide = fromCenterX <= toCenterX ? 'left' : 'right';

                var from = getFieldPosition(rel.fromTable, rel.fromColumn, fromSide);
                var to = getFieldPosition(rel.toTable, rel.toColumn, toSide);

                if (!from || !to) {
                    if (rel.pathElement) rel.pathElement.setAttribute('d', '');
                    return;
                }

                var gap = 45;
                var dx = to.x - from.x;
                var midX;

                if (fromSide === 'right' && toSide === 'left') {
                    midX = dx > gap * 2 ? from.x + dx / 2 : from.x + gap;
                } else if (fromSide === 'left' && toSide === 'right') {
                    midX = -dx > gap * 2 ? from.x + dx / 2 : from.x - gap;
                } else {
                    midX = (from.x + to.x) / 2;
                }

                var d = 'M ' + from.x + ' ' + from.y +
                    ' L ' + midX + ' ' + from.y +
                    ' L ' + midX + ' ' + to.y +
                    ' L ' + to.x + ' ' + to.y;

                rel.pathElement.setAttribute('d', d);

                var isHighlighted = rel.pathElement.classList.contains('is-highlighted');
                var suffix = isHighlighted ? '-hl' : '';
                rel.pathElement.setAttribute('marker-start', 'url(#crow-many' + suffix + ')');
                rel.pathElement.setAttribute('marker-end', 'url(#crow-one' + suffix + ')');
            }

            function highlightRelationship(rel, isOn) {
                rel.pathElement.classList.toggle('is-highlighted', isOn);

                [
                    { table: rel.fromTable, column: rel.fromColumn },
                    { table: rel.toTable, column: rel.toColumn }
                ].forEach(function(item) {
                    var card = erdState.cards[item.table];
                    if (!card) return;
                    card.element.classList.toggle('is-highlighted', isOn);
                    var row = card.element.querySelector('.erd-column-row[data-column="' + item.column + '"]');
                    if (row) row.classList.toggle('is-highlighted', isOn);
                });

                updatePath(rel);
            }

            function buildERD() {
                canvas.querySelectorAll('.erd-card').forEach(function(c) { c.remove(); });
                erdState.relationships.forEach(function(r) { if (r.pathElement) r.pathElement.remove(); });
                erdState.cards = {};
                erdState.relationships = [];

                var tables = schemaData.tables;
                if (!tables || !tables.length) return;

                var positions = computeAutoLayout(tables);

                tables.forEach(function(table) {
                    var pos = positions[table.name] || { x: 40, y: 40 };
                    renderTableCard(table, pos.x, pos.y);
                });

                requestAnimationFrame(function() {
                    measureAllCards();
                    renderRelationships(tables);
                    setTimeout(fitView, 50);
                });
            }

            canvasWrapper.addEventListener('pointerdown', function(e) {
                var cardEl = e.target.closest('.erd-card');
                if (!cardEl) return;

                var tableName = cardEl.dataset.table;
                var card = erdState.cards[tableName];
                if (!card) return;

                e.preventDefault();
                e.stopPropagation();

                erdState.dragCard = tableName;

                var wrapperRect = canvasWrapper.getBoundingClientRect();
                var mouseCanvasX = (e.clientX - wrapperRect.left - erdState.panX) / erdState.zoom;
                var mouseCanvasY = (e.clientY - wrapperRect.top - erdState.panY) / erdState.zoom;

                erdState.dragOffsetX = mouseCanvasX - card.x;
                erdState.dragOffsetY = mouseCanvasY - card.y;

                cardEl.classList.add('is-dragging');
                canvasWrapper.classList.add('is-dragging');
                cardEl.setPointerCapture(e.pointerId);

                function onMove(ev) {
                    if (!erdState.dragCard) return;

                    var rect = canvasWrapper.getBoundingClientRect();
                    card.x = (ev.clientX - rect.left - erdState.panX) / erdState.zoom - erdState.dragOffsetX;
                    card.y = (ev.clientY - rect.top - erdState.panY) / erdState.zoom - erdState.dragOffsetY;

                    card.element.style.left = card.x + 'px';
                    card.element.style.top = card.y + 'px';

                    updateAllPaths();
                }

                function onUp() {
                    if (erdState.dragCard) {
                        var c = erdState.cards[erdState.dragCard];
                        if (c) c.element.classList.remove('is-dragging');
                        erdState.dragCard = null;
                        canvasWrapper.classList.remove('is-dragging');
                    }
                    document.removeEventListener('pointermove', onMove);
                    document.removeEventListener('pointerup', onUp);
                }

                document.addEventListener('pointermove', onMove);
                document.addEventListener('pointerup', onUp);
            });

            canvasWrapper.addEventListener('wheel', function(e) {
                e.preventDefault();

                var delta = e.deltaY > 0 ? -0.08 : 0.08;
                var newZoom = Math.min(3, Math.max(0.15, erdState.zoom + delta));

                var rect = canvasWrapper.getBoundingClientRect();
                var cursorX = e.clientX - rect.left;
                var cursorY = e.clientY - rect.top;
                var ratio = newZoom / erdState.zoom;

                erdState.panX = cursorX - (cursorX - erdState.panX) * ratio;
                erdState.panY = cursorY - (cursorY - erdState.panY) * ratio;
                erdState.zoom = newZoom;

                applyTransform();
            }, { passive: false });

            canvasWrapper.addEventListener('pointerdown', function(e) {
                if (e.target.closest('.erd-card')) return;

                e.preventDefault();
                erdState.isPanning = true;
                erdState.panStartX = e.clientX - erdState.panX;
                erdState.panStartY = e.clientY - erdState.panY;
                canvasWrapper.classList.add('is-panning');
                canvasWrapper.setPointerCapture(e.pointerId);
            });

            canvasWrapper.addEventListener('pointermove', function(e) {
                if (!erdState.isPanning) return;
                erdState.panX = e.clientX - erdState.panStartX;
                erdState.panY = e.clientY - erdState.panStartY;
                applyTransform();
            });

            canvasWrapper.addEventListener('pointerup', function() {
                if (erdState.isPanning) {
                    erdState.isPanning = false;
                    canvasWrapper.classList.remove('is-panning');
                }
            });

            document.getElementById('erdZoomIn').addEventListener('click', function() {
                erdState.zoom = Math.min(3, erdState.zoom + 0.15);
                applyTransform();
            });

            document.getElementById('erdZoomOut').addEventListener('click', function() {
                erdState.zoom = Math.max(0.15, erdState.zoom - 0.15);
                applyTransform();
            });

            document.getElementById('erdFitView').addEventListener('click', fitView);
            document.getElementById('erdAutoLayout').addEventListener('click', buildERD);

            function applyTransform() {
                canvas.style.transform = 'translate(' + erdState.panX + 'px, ' + erdState.panY + 'px) scale(' + erdState.zoom + ')';
                zoomLabel.textContent = Math.round(erdState.zoom * 100) + '%';
            }

            function fitView() {
                var keys = Object.keys(erdState.cards);
                if (!keys.length) return;

                var minX = Infinity, minY = Infinity, maxX = -Infinity, maxY = -Infinity;

                keys.forEach(function(key) {
                    var card = erdState.cards[key];
                    minX = Math.min(minX, card.x);
                    minY = Math.min(minY, card.y);
                    maxX = Math.max(maxX, card.x + card.width);
                    maxY = Math.max(maxY, card.y + card.height);
                });

                var padding = 50;
                var contentWidth = maxX - minX + padding * 2;
                var contentHeight = maxY - minY + padding * 2;
                var wrapperWidth = canvasWrapper.clientWidth;
                var wrapperHeight = canvasWrapper.clientHeight;

                var scale = Math.max(0.2, Math.min(Math.min(wrapperWidth / contentWidth, wrapperHeight / contentHeight), 1.3));

                erdState.zoom = scale;
                erdState.panX = (wrapperWidth - contentWidth * scale) / 2 - (minX - padding) * scale;
                erdState.panY = (wrapperHeight - contentHeight * scale) / 2 - (minY - padding) * scale;

                applyTransform();
            }

            (function() {
                var resizer = document.getElementById('resizerV');
                var resultsPanel = document.getElementById('resultsPanel');
                var isDragging = false;

                resizer.addEventListener('mousedown', function(e) {
                    isDragging = true;
                    resizer.classList.add('active');
                    document.body.style.cursor = 'row-resize';
                    document.body.classList.add('is-resizing');
                    e.preventDefault();
                });

                resizer.addEventListener('touchstart', function(e) {
                    isDragging = true;
                    resizer.classList.add('active');
                    document.body.classList.add('is-resizing');
                    e.preventDefault();
                }, { passive: false });

                function onMove(clientY) {
                    if (!isDragging) return;
                    var containerRect = resultsPanel.parentElement.getBoundingClientRect();
                    var newHeight = containerRect.bottom - clientY;
                    newHeight = Math.max(60, Math.min(newHeight, containerRect.height - 100));
                    resultsPanel.style.height = newHeight + 'px';
                }

                document.addEventListener('mousemove', function(e) { onMove(e.clientY); });
                document.addEventListener('touchmove', function(e) {
                    if (!isDragging) return;
                    onMove(e.touches[0].clientY);
                    e.preventDefault();
                }, { passive: false });

                function stopDrag() {
                    if (isDragging) {
                        isDragging = false;
                        resizer.classList.remove('active');
                        document.body.style.cursor = '';
                        document.body.classList.remove('is-resizing');
                    }
                }

                document.addEventListener('mouseup', stopDrag);
                document.addEventListener('touchend', stopDrag);
            })();

            function escapeHtml(str) {
                var div = document.createElement('div');
                div.textContent = str;
                return div.innerHTML;
            }

            buildERD();

        })();
    </script>
@endsection
