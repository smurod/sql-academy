@extends('public.layouts.app')

@section('title', 'Урок: ' . $lesson->title)

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css"/>
    <style>

        /* ═══════════════════════════════════════════
           RESET
        ═══════════════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; }
        html, body { overflow-x: hidden; }

        /* ═══════════════════════════════════════════
           ПЕРЕМЕННЫЕ
        ═══════════════════════════════════════════ */
        :root {
            --hh   : 72px;
            --sbw  : 260px;
            --tocw : 240px;
            --tbh  : 52px;
            --glass: rgba(255,255,255,0.03);
            --gb   : rgba(255,255,255,0.07);
            --r-md : 12px;
            --r-sm : 8px;
            --accent: #8b5cf6;
        }

        /* ═══════════════════════════════════════════
           СТРАНИЦА
        ═══════════════════════════════════════════ */
        .lp-page { display: block; background: var(--bg-main); }

        /* ═══════════════════════════════════════════
           STICKY ВЕРХ
        ═══════════════════════════════════════════ */
        .lp-sticky {
            position  : sticky;
            top       : var(--hh);
            display   : flex;
            height    : calc(100vh - var(--hh));
            overflow  : hidden;
            z-index   : 10;
            background: var(--bg-main);
        }

        /* ═══════════════════════════════════════════
           SIDEBAR
        ═══════════════════════════════════════════ */
        .lp-sb {
            width         : var(--sbw);
            min-width     : var(--sbw);
            height        : 100%;
            display       : flex;
            flex-direction: column;
            background    : rgba(13, 13, 30, 0.6);
            backdrop-filter: blur(12px);
            border-right  : 1px solid var(--gb);
            flex-shrink   : 0;
        }

        .lp-sb-head {
            padding      : 1rem 1.1rem 0.85rem;
            border-bottom: 1px solid var(--gb);
            flex-shrink  : 0;
            background   : linear-gradient(180deg, rgba(59,130,246,0.05), transparent);
        }

        .lp-sb-back {
            display        : inline-flex;
            align-items    : center;
            gap            : 0.4rem;
            font-size      : 0.75rem;
            font-weight    : 500;
            color          : var(--text-muted);
            text-decoration: none;
            margin-bottom  : 0.75rem;
            padding        : 0.3rem 0.65rem;
            border-radius  : var(--r-sm);
            border         : 1px solid var(--gb);
            background     : var(--glass);
            transition     : all 0.2s ease;
        }
        .lp-sb-back:hover {
            color       : var(--primary);
            border-color: rgba(59,130,246,0.4);
            background  : rgba(59,130,246,0.06);
            transform   : translateX(-2px);
        }

        .lp-sb-module {
            font-size    : 0.82rem;
            font-weight  : 700;
            color        : var(--text-primary);
            line-height  : 1.4;
            margin-bottom: 0.2rem;
        }

        .lp-sb-meta {
            display    : flex;
            align-items: center;
            gap        : 0.4rem;
            font-size  : 0.68rem;
            color      : var(--text-muted);
        }
        .lp-sb-meta-dot {
            width        : 3px;
            height       : 3px;
            border-radius: 50%;
            background   : var(--text-muted);
            opacity      : 0.5;
        }

        .lp-sb-list {
            flex           : 1;
            overflow-y     : auto;
            padding        : 0.5rem 0;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.08) transparent;
        }
        .lp-sb-list::-webkit-scrollbar       { width: 3px; }
        .lp-sb-list::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 3px; }

        .lp-sb-item {
            display        : flex;
            align-items    : center;
            gap            : 0.65rem;
            padding        : 0.55rem 1.1rem;
            margin         : 0.15rem 0.5rem;
            text-decoration: none;
            color          : inherit;
            border-left    : 2px solid transparent;
            border-radius  : 0 var(--r-sm) var(--r-sm) 0;
            transition     : all 0.2s ease;
        }
        .lp-sb-item:hover  { background: rgba(255,255,255,0.03); }
        .lp-sb-item.active {
            background       : rgba(59,130,246,0.08);
            border-left-color: var(--primary);
            box-shadow       : inset 0 0 12px rgba(59,130,246,0.05);
        }

        .lp-sb-num {
            width          : 24px;
            height         : 24px;
            border-radius  : 50%;
            border         : 1px solid var(--gb);
            background     : var(--glass);
            display        : flex;
            align-items    : center;
            justify-content: center;
            font-size      : 0.65rem;
            font-weight    : 700;
            color          : var(--text-muted);
            flex-shrink    : 0;
            transition     : all 0.2s ease;
        }
        .lp-sb-item.active .lp-sb-num {
            background  : linear-gradient(135deg, var(--primary), var(--accent));
            color       : #fff;
            border-color: transparent;
            box-shadow  : 0 0 12px rgba(59,130,246,0.4);
        }

        .lp-sb-body    { flex: 1; min-width: 0; }
        .lp-sb-ititle {
            font-size    : 0.8rem;
            font-weight  : 500;
            color        : var(--text-secondary);
            white-space  : nowrap;
            overflow     : hidden;
            text-overflow: ellipsis;
            line-height  : 1.4;
        }
        .lp-sb-item.active .lp-sb-ititle { color: var(--primary); font-weight: 600; }

        .lp-sb-itype {
            display    : flex;
            align-items: center;
            gap        : 0.3rem;
            font-size  : 0.65rem;
            color      : var(--text-muted);
            margin-top : 0.12rem;
        }

        /* ═══════════════════════════════════════════
           ЦЕНТР
        ═══════════════════════════════════════════ */
        .lp-center {
            flex          : 1;
            display       : flex;
            flex-direction: column;
            overflow      : hidden;
            min-width     : 0;
        }

        .lp-topbar {
            height         : var(--tbh);
            display        : flex;
            align-items    : center;
            justify-content: space-between;
            padding        : 0 1.3rem;
            background     : rgba(13, 13, 30, 0.5);
            backdrop-filter: blur(12px);
            border-bottom  : 1px solid var(--gb);
            flex-shrink    : 0;
            gap            : 0.75rem;
        }

        .lp-tb-l { display: flex; align-items: center; gap: 0.6rem; min-width: 0; flex: 1; }
        .lp-tb-r { display: flex; align-items: center; gap: 0.5rem;  flex-shrink: 0; }

        .lp-nav-btn {
            width          : 30px;
            height         : 30px;
            border-radius  : var(--r-sm);
            border         : 1px solid var(--gb);
            background     : var(--glass);
            color          : var(--text-secondary);
            display        : flex;
            align-items    : center;
            justify-content: center;
            font-size      : 0.82rem;
            text-decoration: none;
            transition     : all 0.2s ease;
            flex-shrink    : 0;
        }
        .lp-nav-btn:hover    { border-color: rgba(59,130,246,0.5); color: var(--primary); background: rgba(59,130,246,0.08); transform: scale(1.05); }
        .lp-nav-btn.disabled { opacity: 0.2; pointer-events: none; }

        .lp-badge {
            padding      : 0.22rem 0.7rem;
            border-radius: 20px;
            font-size    : 0.68rem;
            font-weight  : 700;
            background   : linear-gradient(135deg, var(--primary), var(--accent));
            color        : #fff;
            box-shadow   : 0 2px 10px rgba(59,130,246,0.3);
            flex-shrink  : 0;
        }

        .lp-lesson-title {
            font-size    : 0.92rem;
            font-weight  : 700;
            color        : var(--text-primary);
            white-space  : nowrap;
            overflow     : hidden;
            text-overflow: ellipsis;
            min-width    : 0;
        }

        .lp-type-tag {
            display      : inline-flex;
            align-items  : center;
            gap          : 0.3rem;
            padding      : 0.22rem 0.7rem;
            border-radius: 20px;
            font-size    : 0.68rem;
            font-weight  : 600;
            backdrop-filter: blur(4px);
        }
        .lp-type-tag.theory   { background: rgba(59,130,246,0.12);  color: #60a5fa; border: 1px solid rgba(59,130,246,0.25); }
        .lp-type-tag.practice { background: rgba(34,197,94,0.12);   color: #4ade80; border: 1px solid rgba(34,197,94,0.25);  }
        .lp-type-tag.parent   { background: rgba(168,85,247,0.12);  color: #c084fc; border: 1px solid rgba(168,85,247,0.25); }

        /* Только лекция скроллится */
        .lp-scroll {
            flex           : 1;
            overflow-y     : auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.06) transparent;
        }
        .lp-scroll::-webkit-scrollbar       { width: 4px; }
        .lp-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        .lp-article {
            max-width: 780px;
            margin   : 0 auto;
            padding  : 2.5rem 2rem;
        }

        /* ── Типографика ── */
        .lp-body h2 {
            font-size     : 1.45rem;
            font-weight   : 800;
            color         : var(--text-primary);
            letter-spacing: -0.025em;
            margin        : 2.2rem 0 1rem;
            line-height   : 1.3;
            padding-bottom: 0.5rem;
            border-bottom : 1px solid rgba(255,255,255,0.05);
            background    : linear-gradient(90deg, var(--text-primary), rgba(255,255,255,0.7));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .lp-body h2:first-child { margin-top: 0; }
        .lp-body h3 {
            font-size  : 1.05rem;
            font-weight: 700;
            color      : var(--text-primary);
            margin     : 1.8rem 0 0.6rem;
        }
        .lp-body p {
            font-size    : 0.95rem;
            line-height  : 1.9;
            color        : var(--text-secondary);
            margin-bottom: 1rem;
        }
        .lp-body ul, .lp-body ol { padding-left: 1.4rem; margin-bottom: 1rem; }
        .lp-body li {
            font-size    : 0.93rem;
            line-height  : 1.85;
            color        : var(--text-secondary);
            margin-bottom: 0.3rem;
        }
        .lp-body strong { color: var(--text-primary); font-weight: 600; }

        .lp-body code:not(pre code) {
            background   : rgba(139, 92, 246, 0.1);
            color        : #c4b5fd;
            padding      : 0.15rem 0.45rem;
            border-radius: var(--r-sm);
            font-family  : 'JetBrains Mono', monospace;
            font-size    : 0.84em;
            border       : 1px solid rgba(139, 92, 246, 0.15);
        }

        .lp-body pre {
            border-radius: var(--r-md) !important;
            margin       : 1.2rem 0 !important;
            border       : 1px solid var(--gb) !important;
            background   : #0a0a1a !important;
            position     : relative;
            overflow     : hidden !important;
            box-shadow   : 0 8px 24px rgba(0,0,0,0.2);
        }
        .lp-body pre::before {
            content   : '';
            position  : absolute;
            top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, var(--primary), var(--accent), transparent);
            opacity   : 0.5;
        }
        .lp-body pre code {
            font-family: 'JetBrains Mono', monospace !important;
            font-size  : 0.85rem !important;
            line-height: 1.8 !important;
            padding    : 1.2rem 1.4rem !important;
            display    : block;
        }

        .lp-body table {
            width          : 100%;
            border-collapse: separate;
            border-spacing : 0;
            margin         : 1.2rem 0;
            font-size      : 0.88rem;
            border         : 1px solid var(--gb);
            border-radius  : var(--r-md);
            overflow       : hidden;
        }
        .lp-body th {
            background    : rgba(59,130,246,0.06);
            border-bottom : 1px solid var(--gb);
            padding       : 0.7rem 1rem;
            text-align    : left;
            font-weight   : 700;
            font-size     : 0.78rem;
            color         : var(--text-primary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .lp-body td {
            border-bottom: 1px solid rgba(255,255,255,0.03);
            padding      : 0.6rem 1rem;
            color        : var(--text-secondary);
        }
        .lp-body tr:last-child td { border-bottom: none; }
        .lp-body tr:nth-child(even) td { background: rgba(255,255,255,0.01); }
        .lp-body tr:hover td      { background: rgba(59,130,246,0.03); }

        .lp-body .alert-tip,
        .lp-body .alert-info,
        .lp-body .alert-warning {
            padding      : 1rem 1.2rem;
            border-radius: var(--r-md);
            margin       : 1.2rem 0;
            font-size    : 0.88rem;
            line-height  : 1.75;
            border-left  : 3px solid;
            backdrop-filter: blur(8px);
        }
        .lp-body .alert-tip     { background: rgba(34,197,94,0.05);  border-color: #22c55e; color: var(--text-secondary); }
        .lp-body .alert-info    { background: rgba(59,130,246,0.06); border-color: var(--primary); color: var(--text-secondary); }
        .lp-body .alert-warning { background: rgba(245,158,11,0.06); border-color: #f59e0b; color: var(--text-secondary); }

        /* ═══════════════════════════════════════════
           FOOTER NAV (Внизу)
        ═══════════════════════════════════════════ */
        .lp-footer {
            max-width: 820px;
            margin: 0 auto;
            padding: 2.5rem 2rem 4rem;
        }
        .lp-footer-inner {
            display        : flex;
            align-items    : center;
            justify-content: space-between;
            gap            : 1rem;
            padding        : 1.5rem 1.8rem;
            background     : rgba(13, 13, 30, 0.5);
            backdrop-filter: blur(12px);
            border         : 1px solid var(--gb);
            border-radius  : 16px;
            box-shadow     : 0 10px 30px rgba(0,0,0,0.15);
        }

        .lp-foot-link {
            display        : inline-flex;
            align-items    : center;
            gap            : 0.5rem;
            padding        : 0.7rem 1.1rem;
            border-radius  : var(--r-md);
            border         : 1px solid var(--gb);
            background     : var(--glass);
            color          : var(--text-secondary);
            font-size      : 0.82rem;
            font-weight    : 500;
            text-decoration: none;
            max-width      : 200px;
            min-width      : 0;
            transition     : all 0.2s ease;
        }
        .lp-foot-link span    { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .lp-foot-link:hover   { border-color: rgba(59,130,246,0.4); color: var(--primary); background: rgba(59,130,246,0.06); transform: translateY(-2px); }
        .lp-foot-spacer       { min-width: 200px; }

        .btn-complete {
            display        : inline-flex;
            align-items    : center;
            gap            : 0.55rem;
            padding        : 0.7rem 1.8rem;
            border-radius  : var(--r-md);
            border         : none;
            background     : linear-gradient(135deg, #2563eb, var(--accent));
            color          : #fff;
            font-size      : 0.88rem;
            font-weight    : 600;
            cursor         : pointer;
            text-decoration: none;
            transition     : all 0.25s ease;
            box-shadow     : 0 4px 18px rgba(37,99,235,0.3);
            flex-shrink    : 0;
        }
        .btn-complete:hover:not(:disabled) { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(37,99,235,0.45); }

        .btn-complete:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            filter: grayscale(0.5);
            box-shadow: none;
        }

        .btn-hint {
            font-size: 0.72rem;
            color: #f87171;
            text-align: center;
            margin-top: 0.5rem;
            opacity: 0.9;
        }

        .badge-done {
            display      : inline-flex;
            align-items  : center;
            gap          : 0.45rem;
            padding      : 0.7rem 1.2rem;
            border-radius: var(--r-md);
            background   : rgba(34,197,94,0.08);
            border       : 1px solid rgba(34,197,94,0.25);
            color        : #4ade80;
            font-size    : 0.88rem;
            font-weight  : 600;
            flex-shrink  : 0;
            box-shadow   : 0 0 15px rgba(34,197,94,0.1);
        }

        /* ═══════════════════════════════════════════
           TOC
        ═══════════════════════════════════════════ */
        .lp-toc {
            width          : var(--tocw);
            min-width      : var(--tocw);
            height         : 100%;
            overflow-y     : auto;
            padding        : 1.2rem 1rem;
            border-left    : 1px solid var(--gb);
            background     : rgba(13, 13, 30, 0.4);
            backdrop-filter: blur(12px);
            flex-shrink    : 0;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.06) transparent;
        }
        .lp-toc::-webkit-scrollbar       { width: 3px; }
        .lp-toc::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 3px; }

        .lp-toc-ttl {
            font-size     : 0.65rem;
            font-weight   : 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color         : var(--text-muted);
            margin-bottom : 0.8rem;
            padding-bottom: 0.5rem;
            border-bottom : 1px solid var(--gb);
        }

        .lp-toc-list { list-style: none; padding: 0; margin: 0; }
        .lp-toc-item { margin-bottom: 0.05rem; }

        .lp-toc-link {
            display        : block;
            padding        : 0.3rem 0.55rem;
            border-radius  : var(--r-sm);
            font-size      : 0.75rem;
            color          : var(--text-muted);
            text-decoration: none;
            line-height    : 1.45;
            transition     : all 0.15s ease;
            border-left    : 2px solid transparent;
        }
        .lp-toc-link:hover  { color: var(--text-primary); background: var(--glass); }
        .lp-toc-link.active { color: var(--primary); background: rgba(59,130,246,0.08); border-left-color: var(--primary); font-weight: 600; }
        .lp-toc-link.h3     { padding-left: 1rem; font-size: 0.7rem; }

        /* ═══════════════════════════════════════════
           ПРАКТИКА — Эффект перекрытия
        ═══════════════════════════════════════════ */
        .lp-practice-outer {
            position: relative;
            z-index: 20;
            background: linear-gradient(180deg, #060610 0%, #030308 100%);
            border-top: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 -15px 50px rgba(0,0,0,0.6);
            margin-top: -1px;
        }

        .prac-root {
            height        : calc(100vh - var(--hh));
            display       : flex;
            flex-direction: column;
            overflow      : hidden;
        }

        .prac-hdr {
            display        : flex;
            align-items    : center;
            justify-content: space-between;
            padding        : 0.85rem 1.8rem;
            border-bottom  : 1px solid var(--gb);
            background     : linear-gradient(180deg, rgba(59,130,246,0.04), transparent);
            flex-shrink    : 0;
        }
        .prac-hdr-l { display: flex; align-items: center; gap: 0.8rem; }
        .prac-hdr-icon {
            width          : 36px;
            height         : 36px;
            border-radius  : 10px;
            background     : linear-gradient(135deg, rgba(59,130,246,0.2), rgba(139,92,246,0.2));
            border         : 1px solid rgba(59,130,246,0.25);
            display        : flex;
            align-items    : center;
            justify-content: center;
            color          : #60a5fa;
            font-size      : 0.95rem;
            flex-shrink    : 0;
            box-shadow     : 0 0 15px rgba(59,130,246,0.15);
        }
        .prac-hdr-title { font-size: 0.95rem; font-weight: 800; color: var(--text-primary); letter-spacing: -0.02em; }
        .prac-hdr-sub   { font-size: 0.66rem; color: var(--text-muted); margin-top: 0.08rem; }

        .prac-progress { display: flex; align-items: center; gap: 0.7rem; }
        .prac-prog-lbl  { font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); min-width: 36px; text-align: right; }
        .prac-prog-track { width: 130px; height: 6px; border-radius: 3px; background: rgba(255,255,255,0.06); overflow: hidden; }
        .prac-prog-fill  { height: 100%; border-radius: 3px; background: linear-gradient(90deg, var(--primary), var(--accent)); transition: width 0.4s ease; box-shadow: 0 0 8px rgba(139,92,246,0.4); }

        .prac-nav {
            display      : flex;
            align-items  : center;
            gap          : 0.6rem;
            padding      : 0.55rem 1.8rem;
            border-bottom: 1px solid var(--gb);
            background   : rgba(0,0,0,0.15);
            flex-shrink  : 0;
        }

        .prac-arrow {
            width          : 28px;
            height         : 28px;
            border-radius  : var(--r-sm);
            border         : 1px solid var(--gb);
            background     : var(--glass);
            color          : var(--text-muted);
            display        : flex;
            align-items    : center;
            justify-content: center;
            cursor         : pointer;
            font-size      : 0.75rem;
            transition     : all 0.2s ease;
            flex-shrink    : 0;
        }
        .prac-arrow:hover:not(:disabled)    { border-color: rgba(59,130,246,0.4); color: var(--primary); background: rgba(59,130,246,0.08); transform: scale(1.05); }
        .prac-arrow:disabled { opacity: 0.2; pointer-events: none; }

        .prac-task-info { flex: 1; display: flex; align-items: center; gap: 0.5rem; min-width: 0; }
        .prac-task-name { font-size: 0.88rem; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .prac-diff {
            display      : inline-flex;
            align-items  : center;
            gap          : 0.25rem;
            padding      : 0.16rem 0.52rem;
            border-radius: 20px;
            font-size    : 0.65rem;
            font-weight  : 700;
            flex-shrink  : 0;
        }
        .prac-diff.easy   { background: rgba(34,197,94,0.12);  color: #4ade80; }
        .prac-diff.medium { background: rgba(245,158,11,0.12); color: #fbbf24; }
        .prac-diff.hard   { background: rgba(239,68,68,0.12);  color: #f87171; }

        .prac-solved-tag {
            display      : none;
            align-items  : center;
            gap          : 0.25rem;
            font-size    : 0.65rem;
            font-weight  : 700;
            color        : #4ade80;
            background   : rgba(34,197,94,0.1);
            border       : 1px solid rgba(34,197,94,0.25);
            padding      : 0.16rem 0.52rem;
            border-radius: 20px;
            flex-shrink  : 0;
        }
        .prac-solved-tag.show { display: inline-flex; }

        .prac-task-card {
            flex      : 1;
            display   : flex;
            flex-direction: column;
            overflow  : hidden;
            min-height: 0;
        }

        .prac-body {
            display              : grid;
            grid-template-columns: 1fr 1fr;
            flex                 : 1;
            overflow             : hidden;
            min-height           : 0;
        }

        .prac-left {
            border-right  : 1px solid var(--gb);
            display       : flex;
            flex-direction: column;
            overflow      : hidden;
        }

        .prac-desc {
            padding      : 1.1rem 1.5rem;
            border-bottom: 1px solid var(--gb);
            flex-shrink  : 0;
        }
        .prac-desc p { font-size: 0.9rem; line-height: 1.8; color: var(--text-secondary); margin: 0; }
        .prac-desc code {
            background   : rgba(139, 92, 246, 0.1);
            color        : #c4b5fd;
            padding      : 0.12rem 0.35rem;
            border-radius: 4px;
            font-family  : 'JetBrains Mono', monospace;
            font-size    : 0.82em;
        }

        .prac-erd {
            flex          : 1;
            display       : flex;
            flex-direction: column;
            overflow      : hidden;
            min-height    : 0;
        }

        .prac-erd-bar {
            display        : flex;
            align-items    : center;
            justify-content: space-between;
            padding        : 0.45rem 0.9rem;
            border-bottom  : 1px solid var(--gb);
            background     : rgba(139,92,246,0.02);
            flex-shrink    : 0;
        }

        .prac-erd-lbl {
            display       : flex;
            align-items   : center;
            gap           : 0.35rem;
            font-size     : 0.62rem;
            font-weight   : 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color         : var(--text-muted);
        }

        .prac-erd-tools { display: flex; gap: 0.2rem; }

        .perd-btn {
            width          : 24px;
            height         : 24px;
            border-radius  : var(--r-sm);
            border         : 1px solid transparent;
            background     : transparent;
            color          : var(--text-muted);
            font-size      : 0.7rem;
            display        : flex;
            align-items    : center;
            justify-content: center;
            cursor         : pointer;
            transition     : all 0.15s ease;
        }
        .perd-btn:hover { background: rgba(139,92,246,0.1); border-color: rgba(139,92,246,0.25); color: var(--text-primary); }

        .prac-erd-outer {
            flex           : 1;
            position       : relative;
            overflow       : hidden;
            cursor         : grab;
            background     : radial-gradient(circle at 1px 1px, rgba(139,92,246,0.03) 1px, transparent 0);
            background-size: 22px 22px;
            min-height     : 0;
        }
        .prac-erd-outer.panning { cursor: grabbing; }

        .prac-erd-canvas {
            position        : absolute;
            top             : 0;
            left            : 0;
            transform-origin: 0 0;
        }

        .prac-erd-svg {
            position      : absolute;
            pointer-events: none;
            z-index       : 1;
            overflow      : visible;
        }

        .perd-card {
            position     : absolute;
            min-width    : 155px;
            background   : linear-gradient(180deg, #15152e, #101028);
            border       : 1px solid rgba(255,255,255,0.1);
            border-radius: var(--r-md);
            box-shadow   : 0 6px 22px rgba(0,0,0,0.4);
            z-index      : 10;
            cursor       : move;
            user-select  : none;
            white-space  : nowrap;
            transition   : box-shadow 0.2s ease, border-color 0.2s ease;
        }
        .perd-card:hover { border-color: rgba(139,92,246,0.3); box-shadow: 0 10px 30px rgba(0,0,0,0.5), 0 0 0 1px rgba(139,92,246,0.15); }

        .perd-card-head {
            display      : flex;
            align-items  : center;
            gap          : 0.3rem;
            padding      : 0.42rem 0.68rem;
            background   : linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 11px 11px 0 0;
        }
        .perd-card-head i { font-size: 0.58rem; color: rgba(255,255,255,0.7); }
        .perd-card-tname  { font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 700; color: #fff; }

        .perd-col-row {
            display      : flex;
            align-items  : center;
            gap          : 0.3rem;
            padding      : 0.22rem 0.68rem;
            font-size    : 0.6rem;
            border-bottom: 1px solid rgba(255,255,255,0.025);
            transition   : background 0.15s ease;
        }
        .perd-col-row:last-child { border-bottom: none; border-radius: 0 0 11px 11px; }
        .perd-col-row:hover      { background: rgba(139,92,246,0.06); }

        .perd-col-key      { width: 12px; text-align: center; flex-shrink: 0; }
        .perd-col-key.pk   { color: #fbbf24; font-size: 0.58rem; }
        .perd-col-key.fk   { color: #60a5fa; font-size: 0.58rem; }
        .perd-col-key.none { color: rgba(255,255,255,0.1); font-size: 0.28rem; }
        .perd-col-name { font-family: 'JetBrains Mono', monospace; font-size: 0.6rem; color: var(--text-primary); flex: 1; }
        .perd-col-type { font-family: 'JetBrains Mono', monospace; font-size: 0.52rem; color: var(--text-muted); opacity: 0.6; }

        .perd-path { fill: none; stroke: #4d5a72; stroke-width: 1.5; }

        .prac-right {
            display       : flex;
            flex-direction: column;
            overflow      : hidden;
        }

        .prac-ed-bar {
            display      : flex;
            align-items  : center;
            gap          : 0.4rem;
            padding      : 0.55rem 1.2rem;
            border-bottom: 1px solid var(--gb);
            background   : rgba(59,130,246,0.02);
            font-size    : 0.72rem;
            font-weight  : 600;
            color        : var(--text-muted);
            flex-shrink  : 0;
        }
        .prac-ed-bar i { color: #60a5fa; }
        .prac-db-badge {
            margin-left  : auto;
            padding      : 0.18rem 0.55rem;
            border-radius: var(--r-sm);
            background   : rgba(255,255,255,0.04);
            border       : 1px solid var(--gb);
            font-size    : 0.65rem;
            color        : var(--text-muted);
        }

        .prac-ed-area {
            flex      : 1;
            position  : relative;
            background: #08081a;
            min-height: 0;
        }
        .prac-ed-area textarea {
            position   : absolute;
            inset      : 0;
            width      : 100%;
            height     : 100%;
            background : transparent;
            border     : none;
            padding    : 1rem 1.2rem;
            font-family: 'JetBrains Mono', monospace;
            font-size  : 0.86rem;
            line-height: 1.85;
            color      : #e2e8f0;
            resize     : none;
            outline    : none;
            caret-color: #60a5fa;
        }
        .prac-ed-area textarea::placeholder { color: rgba(255,255,255,0.08); }

        .prac-act-bar {
            display      : flex;
            align-items  : center;
            gap          : 0.4rem;
            padding      : 0.55rem 1.2rem;
            background   : rgba(0,0,0,0.25);
            border-top   : 1px solid var(--gb);
            flex-shrink  : 0;
        }

        .prac-solved-inline      { display: none; align-items: center; gap: 0.35rem; font-size: 0.78rem; font-weight: 600; color: #4ade80; margin-right: auto; }
        .prac-solved-inline.show { display: flex; }

        .btn-run {
            display    : inline-flex; align-items: center; gap: 0.3rem;
            padding    : 0.45rem 0.95rem;
            border     : none; border-radius: var(--r-sm);
            font-size  : 0.78rem; font-weight: 600; font-family: inherit;
            cursor     : pointer; color: #fff;
            background : linear-gradient(135deg, #16a34a, #15803d);
            box-shadow : 0 3px 10px rgba(22,163,74,0.25);
            transition : all 0.2s ease;
        }
        .btn-run:hover { transform: translateY(-2px); box-shadow: 0 5px 16px rgba(22,163,74,0.35); }

        .btn-check {
            display    : inline-flex; align-items: center; gap: 0.3rem;
            padding    : 0.45rem 0.95rem;
            border     : none; border-radius: var(--r-sm);
            font-size  : 0.78rem; font-weight: 600; font-family: inherit;
            cursor     : pointer; color: #fff;
            background : linear-gradient(135deg, #2563eb, var(--accent));
            box-shadow : 0 3px 10px rgba(37,99,235,0.25);
            transition : all 0.2s ease;
        }
        .btn-check:hover { transform: translateY(-2px); box-shadow: 0 5px 16px rgba(37,99,235,0.35); }

        .prac-results {
            border-top: 1px solid rgba(34,197,94,0.07);
            background: #050518;
            flex-shrink: 0;
        }
        .prac-results-bar {
            padding       : 0.3rem 1.2rem;
            font-size     : 0.6rem;
            font-weight   : 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color         : var(--text-muted);
            border-bottom : 1px solid rgba(255,255,255,0.03);
        }
        .prac-results-body {
            padding        : 0.35rem;
            max-height     : 160px;
            overflow       : auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.04) transparent;
        }

        .prac-msg { display: flex; align-items: flex-start; gap: 0.5rem; padding: 0.5rem 0.8rem; border-radius: var(--r-sm); margin: 0.18rem 0; }
        .prac-msg.ok  { background: rgba(34,197,94,0.05);  border: 1px solid rgba(34,197,94,0.1); }
        .prac-msg.err { background: rgba(239,68,68,0.05);  border: 1px solid rgba(239,68,68,0.1); }
        .prac-msg i   { font-size: 0.9rem; flex-shrink: 0; margin-top: 0.08rem; }
        .prac-msg.ok  i { color: #4ade80; }
        .prac-msg.err i { color: #f87171; }
        .prac-msg-body h4   { font-size: 0.72rem; font-weight: 600; margin: 0 0 0.08rem; }
        .prac-msg-body h4.ok-h  { color: #4ade80; }
        .prac-msg-body h4.err-h { color: #f87171; }
        .prac-msg-body p    { font-size: 0.66rem; color: var(--text-secondary); font-family: 'JetBrains Mono', monospace; margin: 0; word-break: break-word; }

        .prac-tbl-wrap { overflow-x: auto; }
        .prac-tbl      { width: 100%; border-collapse: separate; border-spacing: 0; font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; }
        .prac-tbl th   { text-align: left; padding: 0.28rem 0.6rem; background: #0b0b22; color: #60a5fa; font-size: 0.6rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid rgba(59,130,246,0.15); white-space: nowrap; position: sticky; top: 0; z-index: 1; }
        .prac-tbl td   { padding: 0.26rem 0.6rem; color: var(--text-secondary); border-bottom: 1px solid rgba(255,255,255,0.02); white-space: nowrap; }
        .prac-tbl tr:hover td { background: rgba(59,130,246,0.03); }

        /* ═══════════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════════ */
        @media (max-width: 1200px) { .lp-toc { display: none; } }
        @media (max-width: 900px)  {
            .lp-sb      { display: none; }
            .prac-body  { grid-template-columns: 1fr; }
            .prac-left  { border-right: none; border-bottom: 1px solid var(--gb); max-height: 280px; }
            .lp-footer-inner { flex-direction: column; }
            .lp-foot-spacer  { display: none; }
        }
        @media (max-width: 640px) {
            .lp-article { padding: 1.5rem 1rem; }
            .lp-footer  { padding: 1.5rem 1rem 3rem; }
            .prac-hdr   { padding: 0.75rem 1rem; }
            .lp-footer-inner { padding: 1rem; }
        }
    </style>
@endsection


@section('content')

    <div class="lp-page">

        {{-- ══════════════════ STICKY ВЕРХНЯЯ ЧАСТЬ ══════════════════ --}}
        <div class="lp-sticky">

            {{-- SIDEBAR --}}
            <aside class="lp-sb">
                <div class="lp-sb-head">
                    <a href="{{ route('public.courses.index') }}" class="lp-sb-back">
                        <i class="bi bi-arrow-left"></i> Назад к курсу
                    </a>
                    <div class="lp-sb-module">
                        Модуль {{ $module->order_index }} · {{ $module->title }}
                    </div>
                    <div class="lp-sb-meta">
                        <span>Урок {{ $lesson->lesson_order }}</span>
                        <span class="lp-sb-meta-dot"></span>
                        <span>из {{ $moduleLessons->count() }}</span>
                    </div>
                </div>

                <div class="lp-sb-list">
                    @foreach($moduleLessons as $ml)
                        <a href="{{ route('public.courses.show', $ml) }}"
                           class="lp-sb-item {{ $ml->id === $lesson->id ? 'active' : '' }}">
                            <div class="lp-sb-num">{{ $ml->lesson_order }}</div>
                            <div class="lp-sb-body">
                                <div class="lp-sb-ititle">{{ $ml->title }}</div>
                                <div class="lp-sb-itype">
                                    @if($ml->lesson_type === 'practice')
                                        <i class="bi bi-code-slash"></i> Практика
                                    @elseif($ml->lesson_type === 'parent')
                                        <i class="bi bi-folder"></i> Раздел
                                    @else
                                        <i class="bi bi-book"></i> Теория
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </aside>

            {{-- ЦЕНТРАЛЬНАЯ КОЛОНКА --}}
            <div class="lp-center">

                {{-- Topbar --}}
                <div class="lp-topbar">
                    <div class="lp-tb-l">
                        @if($previousLesson)
                            <a href="{{ route('public.courses.show', $previousLesson) }}"
                               class="lp-nav-btn" title="{{ $previousLesson->title }}">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        @else
                            <span class="lp-nav-btn disabled"><i class="bi bi-chevron-left"></i></span>
                        @endif

                        <span class="lp-badge">#{{ $lesson->lesson_order }}</span>
                        <span class="lp-lesson-title">{{ $lesson->title }}</span>

                        @if($nextLesson)
                            <a href="{{ route('public.courses.show', $nextLesson) }}"
                               class="lp-nav-btn" title="{{ $nextLesson->title }}">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        @else
                            <span class="lp-nav-btn disabled"><i class="bi bi-chevron-right"></i></span>
                        @endif
                    </div>
                    <div class="lp-tb-r">
                    <span class="lp-type-tag {{ $lesson->lesson_type }}">
                        @if($lesson->lesson_type === 'practice')
                            <i class="bi bi-code-slash"></i> Практика
                        @elseif($lesson->lesson_type === 'parent')
                            <i class="bi bi-folder"></i> Раздел
                        @else
                            <i class="bi bi-book"></i> Теория
                        @endif
                    </span>
                    </div>
                </div>

                {{-- ЛЕКЦИЯ (только она скроллится) --}}
                <div class="lp-scroll" id="lpScroll">

                    @if($lesson->content)
                        <div class="lp-article">
                            <div class="lp-body" id="lpBody">
                                {!! $lesson->content !!}
                            </div>
                        </div>
                    @else
                        <div style="display:flex;flex-direction:column;align-items:center;
                                justify-content:center;padding:5rem 2rem;text-align:center;
                                color:var(--text-muted);gap:0.75rem;">
                            <i class="bi bi-file-earmark-x" style="font-size:2.5rem;opacity:0.25;"></i>
                            <p style="margin:0;font-size:0.88rem;">Содержимое этого урока пока не добавлено.</p>
                        </div>
                    @endif

                </div>{{-- /lp-scroll --}}
            </div>{{-- /lp-center --}}

            {{-- TOC --}}
            <nav class="lp-toc" id="lpToc">
                <div class="lp-toc-ttl">Навигация по статье</div>
                <ul class="lp-toc-list" id="lpTocList"></ul>
            </nav>

        </div>{{-- /lp-sticky --}}


        {{-- ══════════════════ ПРАКТИКА ══════════════════ --}}
        @if(isset($lessonTasks) && $lessonTasks->count() > 0)

            @php
                $total          = $lessonTasks->count();
                $solvedIds      = [];
                $completedCount = 0;
                if(auth()->check()){
                    $solvedIds = \App\Models\UsersRating::where('user_id', auth()->id())
                        ->where('type', 'task')
                        ->whereIn('source_id', $lessonTasks->pluck('id')->toArray())
                        ->pluck('source_id')->toArray();
                    $completedCount = count(array_unique($solvedIds));
                }
                $pct = $total ? round($completedCount / $total * 100) : 0;
                $allTasksSolved = ($total > 0 && $completedCount === $total);
            @endphp

            <div class="lp-practice-outer">
                <div class="prac-root" id="pracRoot">

                    {{-- Шапка --}}
                    <div class="prac-hdr">
                        <div class="prac-hdr-l">
                            <div class="prac-hdr-icon">
                                <i class="bi bi-terminal-fill"></i>
                            </div>
                            <div>
                                <div class="prac-hdr-title">Задания для самопроверки</div>
                                <div class="prac-hdr-sub">Закрепи знания на практике</div>
                            </div>
                        </div>
                        <div class="prac-progress">
                            <span class="prac-prog-lbl">{{ $completedCount }}/{{ $total }}</span>
                            <div class="prac-prog-track">
                                <div class="prac-prog-fill" style="width:{{ $pct }}%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Навигация --}}
                    <div class="prac-nav">
                        <button class="prac-arrow" id="pracPrev" disabled>
                            <i class="bi bi-arrow-left"></i>
                        </button>
                        <div class="prac-task-info">
                            <span class="prac-task-name" id="pracTaskName"></span>
                            <span class="prac-diff"       id="pracDiff"></span>
                            <span class="prac-solved-tag" id="pracSolvedTag">
                            <i class="bi bi-check-circle-fill"></i> Решено
                        </span>
                        </div>
                        <button class="prac-arrow" id="pracNext">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>

                    {{-- Карточки задач --}}
                    @foreach($lessonTasks as $idx => $task)
                        @php
                            $dp       = $task->difficulty_percent;
                            $dc       = $dp <= 30 ? 'easy'  : ($dp <= 60 ? 'medium' : 'hard');
                            $dl       = $dp <= 30 ? 'Легко' : ($dp <= 60 ? 'Средне' : 'Сложно');
                            $isSolved = in_array($task->id, $solvedIds);
                        @endphp

                        <div class="prac-task-card"
                             id="ptask-{{ $task->id }}"
                             data-index="{{ $idx }}"
                             data-task-id="{{ $task->id }}"
                             data-title="{{ $task->title }}"
                             data-dc="{{ $dc }}"
                             data-dl="{{ $dl }}"
                             data-solved="{{ $isSolved ? '1' : '0' }}"
                             style="{{ $idx > 0 ? 'display:none;' : '' }}">

                            <div class="prac-body">

                                {{-- ЛЕВАЯ --}}
                                <div class="prac-left">
                                    <div class="prac-desc">
                                        <p>{{ $task->task_text }}</p>
                                    </div>
                                    <div class="prac-erd">
                                        <div class="prac-erd-bar">
                                            <div class="prac-erd-lbl">
                                                <i class="bi bi-diagram-3"></i> Схема БД
                                            </div>
                                            <div class="prac-erd-tools">
                                                <button class="perd-btn perd-fit"
                                                        data-tid="{{ $task->id }}" title="Вписать">
                                                    <i class="bi bi-fullscreen"></i>
                                                </button>
                                                <button class="perd-btn perd-zi"
                                                        data-tid="{{ $task->id }}" title="Приблизить">
                                                    <i class="bi bi-zoom-in"></i>
                                                </button>
                                                <button class="perd-btn perd-zo"
                                                        data-tid="{{ $task->id }}" title="Отдалить">
                                                    <i class="bi bi-zoom-out"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="prac-erd-outer" id="perd-outer-{{ $task->id }}">
                                            <div class="prac-erd-canvas" id="perd-canvas-{{ $task->id }}">
                                                <svg class="prac-erd-svg" id="perd-svg-{{ $task->id }}">
                                                    <defs>
                                                        <marker id="mk-{{ $task->id }}"
                                                                viewBox="0 0 10 10" refX="9" refY="5"
                                                                markerWidth="7" markerHeight="7"
                                                                orient="auto-start-reverse">
                                                            <path d="M0,0 L10,5 L0,10"
                                                                  fill="none" stroke="#4d5a72" stroke-width="1.5"/>
                                                        </marker>
                                                    </defs>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ПРАВАЯ --}}
                                <div class="prac-right">
                                    <div class="prac-ed-bar">
                                        <i class="bi bi-terminal-fill"></i> SQL редактор
                                        <span class="prac-db-badge">MySQL 8.1</span>
                                    </div>
                                    <div class="prac-ed-area">
                                    <textarea
                                        id="peditor-{{ $task->id }}"
                                        data-task-id="{{ $task->id }}"
                                        placeholder="-- Напишите SQL запрос...&#10;&#10;SELECT * FROM ...;"
                                        spellcheck="false"
                                        autocomplete="off"
                                    ></textarea>
                                    </div>
                                    <div class="prac-act-bar">
                                        <div class="prac-solved-inline {{ $isSolved ? 'show' : '' }}"
                                             id="psolved-{{ $task->id }}">
                                            <i class="bi bi-check-circle-fill"></i> Задача решена!
                                        </div>
                                        <button class="btn-run"   data-task-id="{{ $task->id }}">
                                            <i class="bi bi-play-fill"></i> Run
                                        </button>
                                        <button class="btn-check" data-task-id="{{ $task->id }}">
                                            <i class="bi bi-check2-circle"></i> Check
                                        </button>
                                    </div>
                                    <div class="prac-results">
                                        <div class="prac-results-bar">Результат</div>
                                        <div class="prac-results-body" id="presults-{{ $task->id }}"></div>
                                    </div>
                                </div>

                            </div>{{-- /prac-body --}}
                        </div>{{-- /prac-task-card --}}
                    @endforeach

                </div>{{-- /prac-root --}}
            </div>{{-- /lp-practice-outer --}}
        @else
            @php
                $allTasksSolved = true;
            @endphp
        @endif


        {{-- ══════════════════ FOOTER НАВИГАЦИЯ (Внизу) ══════════════════ --}}
        <div class="lp-footer">
            <div class="lp-footer-inner">

                @if($previousLesson)
                    <a href="{{ route('public.courses.show', $previousLesson) }}" class="lp-foot-link">
                        <i class="bi bi-arrow-left" style="flex-shrink:0;"></i>
                        <span>{{ $previousLesson->title }}</span>
                    </a>
                @else
                    <div class="lp-foot-spacer"></div>
                @endif

                @if($isCompleted)
                    <div class="badge-done">
                        <i class="bi bi-check-circle-fill"></i> Урок пройден
                    </div>
                @elseif(auth()->check())
                    <form method="POST" action="{{ route('public.lesson.complete', $lesson) }}" id="completeLessonForm" style="display:flex; flex-direction:column; align-items:center;">
                        @csrf
                        <button type="submit" class="btn-complete" id="btnCompleteLesson" {{ ($allTasksSolved ?? true) ? '' : 'disabled' }}>
                            <i class="bi bi-check2"></i> Завершить урок
                        </button>
                        @if(!($allTasksSolved ?? true))
                            <span class="btn-hint" id="completeHint">Решите все задачи для прохождения</span>
                        @else
                            <span class="btn-hint" id="completeHint" style="display:none;">Решите все задачи для прохождения</span>
                        @endif
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-complete">
                        <i class="bi bi-check2"></i> Завершить урок
                    </a>
                @endif

                @if($nextLesson)
                    <a href="{{ route('public.courses.show', $nextLesson) }}"
                       class="lp-foot-link" style="justify-content:flex-end;">
                        <span>{{ $nextLesson->title }}</span>
                        <i class="bi bi-arrow-right" style="flex-shrink:0;"></i>
                    </a>
                @else
                    <div class="lp-foot-spacer"></div>
                @endif

            </div>
        </div>

    </div>{{-- /lp-page --}}
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-sql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-json.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
    <script>
        (function(){
            'use strict';

            // Безопасное получение CSRF-токена
            var csrfMeta = document.querySelector('meta[name="csrf-token"]');
            var csrf = csrfMeta ? csrfMeta.getAttribute('content') : '';

            var taskIds     = @json($lessonTasks->pluck('id') ?? []);
            var taskSchemas = @json($taskSchemas ?? []);
            var curIdx      = 0;
            var erdInited   = {};
            var erdStates   = {};

            document.addEventListener('DOMContentLoaded', function(){
                Prism.highlightAll();
                buildTOC();
                if(taskIds.length) updateNav();
                initScrollLogic();
            });

            /* ─────────────────── УМНЫЙ СКРОЛЛ ─────────────────── */
            function initScrollLogic() {
                var stickyEl = document.querySelector('.lp-sticky');
                var scrollEl = document.getElementById('lpScroll');

                if (stickyEl && scrollEl) {
                    stickyEl.addEventListener('wheel', function(e) {
                        var sbList = e.target.closest('.lp-sb-list');
                        if (sbList) {
                            var atTop = sbList.scrollTop <= 0;
                            var atBottom = sbList.scrollTop + sbList.clientHeight >= sbList.scrollHeight - 1;
                            if ((e.deltaY < 0 && !atTop) || (e.deltaY > 0 && !atBottom)) {
                                e.preventDefault();
                                sbList.scrollTop += e.deltaY;
                                return;
                            }
                        }

                        var atTopL = scrollEl.scrollTop <= 0;
                        var atBottomL = scrollEl.scrollTop + scrollEl.clientHeight >= scrollEl.scrollHeight - 1;

                        if (e.deltaY > 0 && atBottomL) return;
                        if (e.deltaY < 0 && atTopL) return;

                        e.preventDefault();
                        scrollEl.scrollTop += e.deltaY;
                    }, { passive: false });
                }
            }

            /* ─────────────────── TOC ─────────────────── */
            function buildTOC(){
                var body = document.getElementById('lpBody');
                var list = document.getElementById('lpTocList');
                if(!body || !list) return;

                var heads = body.querySelectorAll('h2, h3');
                if(!heads.length){
                    var toc = document.getElementById('lpToc');
                    if(toc) toc.style.display = 'none';
                    return;
                }

                heads.forEach(function(h, i){
                    if(!h.id) h.id = 'hd-' + i;
                    var li = document.createElement('li');
                    li.className = 'lp-toc-item';
                    var a = document.createElement('a');
                    a.href      = '#' + h.id;
                    a.className = 'lp-toc-link' + (h.tagName === 'H3' ? ' h3' : '');
                    a.textContent = h.textContent;
                    a.addEventListener('click', function(e){
                        e.preventDefault();
                        var sc  = document.getElementById('lpScroll');
                        var tgt = document.getElementById(h.id);
                        if(sc && tgt) sc.scrollTo({ top: tgt.offsetTop - 16, behavior: 'smooth' });
                    });
                    li.appendChild(a);
                    list.appendChild(li);
                });

                var sc    = document.getElementById('lpScroll');
                var links = list.querySelectorAll('.lp-toc-link');
                sc.addEventListener('scroll', function(){
                    var st = sc.scrollTop + 90;
                    var active = null;
                    heads.forEach(function(h){ if(h.offsetTop <= st) active = h.id; });
                    links.forEach(function(a){
                        a.classList.toggle('active', a.getAttribute('href') === '#' + active);
                    });
                }, { passive: true });
            }

            /* ─────────────────── НАВИГАЦИЯ ЗАДАЧ ─────────────────── */
            var prevBtn = document.getElementById('pracPrev');
            var nextBtn = document.getElementById('pracNext');

            function updateNav(){
                taskIds.forEach(function(id){
                    var el = document.getElementById('ptask-' + id);
                    if(el) el.style.display = 'none';
                });

                var curId = taskIds[curIdx];
                var card  = document.getElementById('ptask-' + curId);
                if(!card) return;
                card.style.display = '';

                document.getElementById('pracTaskName').textContent =
                    (curIdx + 1) + '. ' + card.dataset.title;

                var db = document.getElementById('pracDiff');
                db.className = 'prac-diff ' + card.dataset.dc;
                db.innerHTML = '<i class="bi bi-circle-fill" style="font-size:.34rem;"></i> ' + card.dataset.dl;

                var st = document.getElementById('pracSolvedTag');
                st.style.display = card.dataset.solved === '1' ? 'inline-flex' : 'none';

                if(prevBtn) prevBtn.disabled = curIdx === 0;
                if(nextBtn) nextBtn.disabled = curIdx === taskIds.length - 1;

                if(!erdInited[curId]){
                    erdInited[curId] = true;
                    setTimeout(function(){ initERD(curId, taskSchemas[curId]); }, 60);
                }
            }

            if(prevBtn) prevBtn.addEventListener('click', function(){
                if(curIdx > 0){ curIdx--; updateNav(); }
            });
            if(nextBtn) nextBtn.addEventListener('click', function(){
                if(curIdx < taskIds.length - 1){ curIdx++; updateNav(); }
            });

            /* ─────────────────── HELPERS ─────────────────── */
            function esc(s){ var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }

            function buildTable(rows){
                if(!rows || !rows.length)
                    return '<div style="padding:.32rem .6rem;color:var(--text-muted);font-size:.66rem;">0 строк</div>';
                var cols = Object.keys(rows[0]);
                var h = '<div class="prac-tbl-wrap"><table class="prac-tbl"><thead><tr>';
                cols.forEach(function(c){ h += '<th>' + esc(c) + '</th>'; });
                h += '</tr></thead><tbody>';
                rows.forEach(function(row){
                    h += '<tr>';
                    cols.forEach(function(c){
                        var v = row[c];
                        h += '<td>' + (v === null ? '<i style="opacity:.28">NULL</i>' : esc(String(v))) + '</td>';
                    });
                    h += '</tr>';
                });
                return h + '</tbody></table></div>';
            }

            function msgBox(type, title, text){
                var ic  = type === 'ok' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
                var cls = type === 'ok' ? 'ok-h' : 'err-h';
                return '<div class="prac-msg ' + type + '">' +
                    '<i class="bi ' + ic + '"></i>' +
                    '<div class="prac-msg-body">' +
                    '<h4 class="' + cls + '">' + esc(title) + '</h4>' +
                    (text ? '<p>' + esc(text) + '</p>' : '') +
                    '</div></div>';
            }

            /* ─────────────────── RUN ─────────────────── */
            document.querySelectorAll('.btn-run').forEach(function(btn){
                btn.addEventListener('click', function(){
                    var id  = this.dataset.taskId;
                    var sql = document.getElementById('peditor-' + id).value.trim();
                    var res = document.getElementById('presults-' + id);
                    if(!sql) return;
                    res.innerHTML = '<div style="padding:.32rem .6rem;color:var(--text-muted);font-size:.66rem;">Выполняется...</div>';
                    fetch('/public/tasks/' + id + '/run', {
                        method : 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json' // Заставляет Laravel возвращать JSON при ошибках
                        },
                        body   : JSON.stringify({ sql: sql })
                    })
                        .then(function(r) {
                            if (!r.ok) {
                                return r.text().then(function(text) {
                                    throw new Error('Ошибка ' + r.status + ': ' + text.substring(0, 100));
                                });
                            }
                            return r.json();
                        })
                        .then(function(d){
                            if(d.status === 'ok' && d.rows && d.rows.length)
                                res.innerHTML = buildTable(d.rows);
                            else if(d.status === 'ok')
                                res.innerHTML = msgBox('ok', 'Запрос выполнен', '0 строк');
                            else
                                res.innerHTML = msgBox('err', 'Ошибка SQL', d.message || '');
                        })
                        .catch(function(e){ res.innerHTML = msgBox('err', 'Сетевая ошибка', e.message); });
                });
            });

            /* ─────────────────── CHECK ─────────────────── */
            document.querySelectorAll('.btn-check').forEach(function(btn){
                btn.addEventListener('click', function(){
                    var id  = this.dataset.taskId;
                    var sql = document.getElementById('peditor-' + id).value.trim();
                    var res = document.getElementById('presults-' + id);
                    if(!sql) return;
                    res.innerHTML = '<div style="padding:.32rem .6rem;color:var(--text-muted);font-size:.66rem;">Проверяется...</div>';
                    fetch('/public/tasks/' + id + '/check', {
                        method : 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json' // Заставляет Laravel возвращать JSON при ошибках
                        },
                        body   : JSON.stringify({ sql: sql })
                    })
                        .then(function(r) {
                            if (!r.ok) {
                                return r.text().then(function(text) {
                                    throw new Error('Ошибка ' + r.status + ': ' + text.substring(0, 100));
                                });
                            }
                            return r.json();
                        })
                        .then(function(d){
                            if(d.status === 'ok'){
                                res.innerHTML = msgBox('ok', 'Верно! Задача решена', '');
                                if(d.rows && d.rows.length) res.innerHTML += buildTable(d.rows);

                                var sb   = document.getElementById('psolved-' + id);
                                var card = document.getElementById('ptask-'   + id);
                                if(sb)   sb.classList.add('show');
                                if(card) card.dataset.solved = '1';
                                document.getElementById('pracSolvedTag').style.display = 'inline-flex';
                                updateProgress();
                                checkLessonCompletion();
                                confetti({ particleCount: 110, spread: 68, origin: { y: 0.6 } });
                            } else {
                                res.innerHTML = msgBox('err', d.message || 'Результат не совпадает', '');
                                if(d.rows && d.rows.length) res.innerHTML += buildTable(d.rows);
                            }
                        })
                        .catch(function(e){ res.innerHTML = msgBox('err', 'Сетевая ошибка', e.message); });
                });
            });

            function updateProgress(){
                var solved = document.querySelectorAll('.prac-task-card[data-solved="1"]').length;
                var total  = taskIds.length;
                var pct    = total ? Math.round(solved / total * 100) : 0;
                var fill   = document.querySelector('.prac-prog-fill');
                var lbl    = document.querySelector('.prac-prog-lbl');
                if(fill) fill.style.width = pct + '%';
                if(lbl)  lbl.textContent  = solved + '/' + total;
            }

            function checkLessonCompletion() {
                var totalSolved = document.querySelectorAll('.prac-task-card[data-solved="1"]').length;
                var btnComplete = document.getElementById('btnCompleteLesson');
                var hintComplete = document.getElementById('completeHint');

                if (btnComplete && taskIds.length > 0) {
                    if (totalSolved === taskIds.length) {
                        btnComplete.removeAttribute('disabled');
                        if (hintComplete) hintComplete.style.display = 'none';
                    } else {
                        btnComplete.setAttribute('disabled', 'disabled');
                        if (hintComplete) hintComplete.style.display = 'block';
                    }
                }
            }

            /* ─────────────────── ERD ─────────────────── */
            function initERD(taskId, schema){
                var outer  = document.getElementById('perd-outer-'  + taskId);
                var canvas = document.getElementById('perd-canvas-' + taskId);
                var svg    = document.getElementById('perd-svg-'    + taskId);
                if(!outer || !canvas || !svg) return;
                if(!schema || !schema.tables || !schema.tables.length) return;

                var S = { zoom:1, panX:0, panY:0, isPanning:false, panSX:0, panSY:0, cards:{}, rels:[], drag:null };
                erdStates[taskId] = S;

                function autoLayout(tables){
                    var names = tables.map(function(t){ return t.name; });
                    var deps  = {};
                    tables.forEach(function(t){ deps[t.name] = []; });
                    tables.forEach(function(t){
                        t.columns.forEach(function(c){
                            if(c.fk_to && names.indexOf(c.fk_to.table) !== -1)
                                deps[t.name].push(c.fk_to.table);
                        });
                    });
                    var levels = {}, vis = {};
                    function lvl(n){
                        if(levels[n] !== undefined) return levels[n];
                        if(vis[n]) return 0;
                        vis[n] = true;
                        var mx = -1;
                        (deps[n] || []).forEach(function(p){ var l = lvl(p); if(l > mx) mx = l; });
                        return levels[n] = mx + 1;
                    }
                    tables.forEach(function(t){ lvl(t.name); });
                    var groups = {}, maxL = 0;
                    tables.forEach(function(t){
                        var l = levels[t.name] || 0;
                        if(l > maxL) maxL = l;
                        if(!groups[l]) groups[l] = [];
                        groups[l].push(t);
                    });
                    var pos = {};
                    for(var l = 0; l <= maxL; l++){
                        var g = groups[l] || [];
                        var x = 20 + l * 210, y = 20;
                        g.forEach(function(t){
                            pos[t.name] = { x: x, y: y };
                            y += 30 + t.columns.length * 21 + 18;
                        });
                    }
                    return pos;
                }

                function renderCard(t, x, y){
                    var el       = document.createElement('div');
                    el.className       = 'perd-card';
                    el.dataset.table   = t.name;
                    el.style.left      = x + 'px';
                    el.style.top       = y + 'px';

                    var hdr       = document.createElement('div');
                    hdr.className = 'perd-card-head';
                    hdr.innerHTML = '<i class="bi bi-table"></i><span class="perd-card-tname">' + esc(t.name) + '</span>';
                    el.appendChild(hdr);

                    t.columns.forEach(function(c){
                        var row           = document.createElement('div');
                        row.className      = 'perd-col-row';
                        row.dataset.column = c.name;
                        var ki = (c.key === 'pk' || c.key === 'pk_fk')
                            ? '<span class="perd-col-key pk"><i class="bi bi-key-fill"></i></span>'
                            : c.key === 'fk'
                                ? '<span class="perd-col-key fk"><i class="bi bi-link-45deg"></i></span>'
                                : '<span class="perd-col-key none">•</span>';
                        row.innerHTML = ki +
                            '<span class="perd-col-name">' + esc(c.name) + '</span>' +
                            '<span class="perd-col-type">' + esc(c.type) + '</span>';
                        el.appendChild(row);
                    });

                    canvas.appendChild(el);
                    S.cards[t.name] = { el: el, x: x, y: y, w: 0, h: 0, fo: {} };
                }

                function measure(){
                    Object.keys(S.cards).forEach(function(n){
                        var c = S.cards[n];
                        c.w = c.el.offsetWidth;
                        c.h = c.el.offsetHeight;
                        c.fo = {};
                        c.el.querySelectorAll('.perd-col-row').forEach(function(r){
                            c.fo[r.dataset.column] = r.offsetTop + r.offsetHeight / 2;
                        });
                    });
                }

                function fpos(tn, fn, side){
                    var c = S.cards[tn]; if(!c) return null;
                    var yo = c.fo[fn];   if(yo === undefined) return null;
                    return side === 'left' ? { x: c.x, y: c.y + yo } : { x: c.x + c.w, y: c.y + yo };
                }

                function buildRels(tables){
                    S.rels.forEach(function(r){ if(r.p) r.p.remove(); });
                    S.rels = [];
                    var names = tables.map(function(t){ return t.name; });
                    tables.forEach(function(t){
                        t.columns.forEach(function(c){
                            if(!c.fk_to || names.indexOf(c.fk_to.table) === -1) return;
                            var p = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                            p.classList.add('perd-path');
                            p.setAttribute('marker-end', 'url(#mk-' + taskId + ')');
                            svg.appendChild(p);
                            S.rels.push({ ft: t.name, fc: c.name, tt: c.fk_to.table, tc: c.fk_to.column, p: p });
                        });
                    });
                    updatePaths();
                }

                function updatePaths(){
                    S.rels.forEach(function(r){
                        var fc = S.cards[r.ft], tc = S.cards[r.tt];
                        if(!fc || !tc){ r.p.setAttribute('d', ''); return; }
                        var fromSide = fc.x + fc.w / 2 <= tc.x + tc.w / 2 ? 'right' : 'left';
                        var toSide   = fromSide === 'right' ? 'left' : 'right';
                        var from     = fpos(r.ft, r.fc, fromSide);
                        var to       = fpos(r.tt, r.tc, toSide);
                        if(!from || !to){ r.p.setAttribute('d', ''); return; }
                        var mx = (from.x + to.x) / 2;
                        r.p.setAttribute('d',
                            'M' + from.x + ',' + from.y +
                            ' L' + mx    + ',' + from.y +
                            ' L' + mx    + ',' + to.y   +
                            ' L' + to.x  + ',' + to.y
                        );
                    });
                }

                function applyT(){
                    canvas.style.transform =
                        'translate(' + S.panX + 'px,' + S.panY + 'px) scale(' + S.zoom + ')';
                }

                function fitView(){
                    var keys = Object.keys(S.cards); if(!keys.length) return;
                    var mnX = Infinity, mnY = Infinity, mxX = -Infinity, mxY = -Infinity;
                    keys.forEach(function(k){
                        var c = S.cards[k];
                        mnX = Math.min(mnX, c.x); mnY = Math.min(mnY, c.y);
                        mxX = Math.max(mxX, c.x + c.w);
                        mxY = Math.max(mxY, c.y + c.h);
                    });
                    var pad = 20;
                    var cw  = mxX - mnX + pad * 2, ch = mxY - mnY + pad * 2;
                    var ow  = outer.clientWidth,    oh = outer.clientHeight;
                    var scale = Math.max(0.15, Math.min(ow / cw, oh / ch, 1.3));
                    S.zoom = scale;
                    S.panX = (ow - cw * scale) / 2 - (mnX - pad) * scale;
                    S.panY = (oh - ch * scale) / 2 - (mnY - pad) * scale;
                    applyT();
                }

                function build(){
                    canvas.querySelectorAll('.perd-card').forEach(function(c){ c.remove(); });
                    S.rels.forEach(function(r){ if(r.p) r.p.remove(); });
                    S.cards = {}; S.rels = [];
                    var tables = schema.tables;
                    var pos    = autoLayout(tables);
                    tables.forEach(function(t){
                        var p = pos[t.name] || { x: 20, y: 20 };
                        renderCard(t, p.x, p.y);
                    });
                    requestAnimationFrame(function(){
                        measure();
                        buildRels(tables);
                        setTimeout(fitView, 30);
                    });
                }

                /* Drag */
                canvas.addEventListener('pointerdown', function(e){
                    var ce = e.target.closest('.perd-card'); if(!ce) return;
                    e.preventDefault(); e.stopPropagation();
                    var name = ce.dataset.table;
                    var card = S.cards[name]; if(!card) return;
                    S.drag = name;
                    var rect = outer.getBoundingClientRect();
                    var dox  = (e.clientX - rect.left - S.panX) / S.zoom - card.x;
                    var doy  = (e.clientY - rect.top  - S.panY) / S.zoom - card.y;
                    ce.setPointerCapture(e.pointerId);
                    function onMove(ev){
                        if(!S.drag) return;
                        var r  = outer.getBoundingClientRect();
                        card.x = (ev.clientX - r.left - S.panX) / S.zoom - dox;
                        card.y = (ev.clientY - r.top  - S.panY) / S.zoom - doy;
                        card.el.style.left = card.x + 'px';
                        card.el.style.top  = card.y + 'px';
                        updatePaths();
                    }
                    function onUp(){
                        S.drag = null;
                        document.removeEventListener('pointermove', onMove);
                        document.removeEventListener('pointerup',   onUp);
                    }
                    document.addEventListener('pointermove', onMove);
                    document.addEventListener('pointerup',   onUp);
                });

                /* Pan */
                outer.addEventListener('pointerdown', function(e){
                    if(e.target.closest('.perd-card')) return;
                    S.isPanning = true;
                    S.panSX = e.clientX - S.panX;
                    S.panSY = e.clientY - S.panY;
                    outer.classList.add('panning');
                    outer.setPointerCapture(e.pointerId);
                });
                outer.addEventListener('pointermove', function(e){
                    if(!S.isPanning) return;
                    S.panX = e.clientX - S.panSX;
                    S.panY = e.clientY - S.panSY;
                    applyT();
                });
                outer.addEventListener('pointerup', function(){
                    S.isPanning = false;
                    outer.classList.remove('panning');
                });

                /* Wheel */
                outer.addEventListener('wheel', function(e){
                    e.preventDefault();
                    var d     = e.deltaY > 0 ? -0.08 : 0.08;
                    var nz    = Math.min(2.5, Math.max(0.15, S.zoom + d));
                    var rect  = outer.getBoundingClientRect();
                    var cx    = e.clientX - rect.left;
                    var cy    = e.clientY - rect.top;
                    var ratio = nz / S.zoom;
                    S.panX    = cx - (cx - S.panX) * ratio;
                    S.panY    = cy - (cy - S.panY) * ratio;
                    S.zoom    = nz;
                    applyT();
                }, { passive: false });

                /* Кнопки */
                var fb = document.querySelector('.perd-fit[data-tid="' + taskId + '"]');
                var zi = document.querySelector('.perd-zi[data-tid="'  + taskId + '"]');
                var zo = document.querySelector('.perd-zo[data-tid="'  + taskId + '"]');
                if(fb) fb.addEventListener('click', fitView);
                if(zi) zi.addEventListener('click', function(){ S.zoom = Math.min(2.5, S.zoom + 0.15); applyT(); });
                if(zo) zo.addEventListener('click', function(){ S.zoom = Math.max(0.15, S.zoom - 0.15); applyT(); });

                build();
            }

        })();
    </script>
@endsection
