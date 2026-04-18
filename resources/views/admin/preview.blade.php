<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQLMastery Admin — Workspace Preview</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #9333ea;
            --accent: #06b6d4;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;

            --bg-dark: #0a0a1a;
            --bg-card: #111127;
            --bg-elevated: #171731;
            --bg-panel: rgba(17,17,39,0.80);

            --text-primary: #ffffff;
            --text-secondary: #9ca3af;
            --text-muted: #6b7280;

            --border-color: rgba(255,255,255,0.08);
            --border-strong: rgba(255,255,255,0.14);

            --glow-primary: rgba(59,130,246,0.30);
            --glow-secondary: rgba(147,51,234,0.25);

            --sidebar-width: 300px;
            --header-height: 78px;

            --radius-xl: 28px;
            --radius-lg: 22px;
            --radius-md: 18px;
            --radius-sm: 14px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            background:
                radial-gradient(circle at top left, rgba(59,130,246,0.10), transparent 28%),
                radial-gradient(circle at top right, rgba(147,51,234,0.10), transparent 24%),
                radial-gradient(circle at bottom center, rgba(6,182,212,0.07), transparent 24%),
                var(--bg-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; }
        button, input { font-family: inherit; }

        .workspace {
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            background: rgba(10,10,26,0.92);
            backdrop-filter: blur(22px);
            border-right: 1px solid var(--border-color);
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            z-index: 20;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: .9rem;
            padding: .9rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(59,130,246,0.10), rgba(147,51,234,0.08), rgba(6,182,212,0.04));
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.03);
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 12px 28px var(--glow-primary);
            flex-shrink: 0;
        }

        .brand-title {
            font-weight: 800;
            font-size: 1.08rem;
            letter-spacing: -0.03em;
        }

        .brand-title span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-sub {
            margin-top: .2rem;
            font-size: .76rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .sidebar-block {
            margin-top: 1.2rem;
            padding: 1rem;
            border-radius: 22px;
            border: 1px solid var(--border-color);
            background: rgba(255,255,255,0.03);
        }

        .sidebar-block-top {
            display: flex;
            align-items: center;
            gap: .8rem;
        }

        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            flex-shrink: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: .94rem;
        }

        .user-role {
            color: var(--text-secondary);
            font-size: .82rem;
            margin-top: .2rem;
        }

        .status-pill {
            margin-top: .9rem;
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .45rem .75rem;
            border-radius: 999px;
            font-size: .78rem;
            color: #86efac;
            background: rgba(34,197,94,0.10);
            border: 1px solid rgba(34,197,94,0.18);
        }

        .status-pill::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--success);
            box-shadow: 0 0 14px rgba(34,197,94,0.7);
        }

        .nav-section {
            margin-top: 1.3rem;
        }

        .nav-title {
            color: var(--text-muted);
            font-size: .75rem;
            letter-spacing: .14em;
            text-transform: uppercase;
            margin: 0 .85rem .7rem;
        }

        .nav-list {
            display: flex;
            flex-direction: column;
            gap: .35rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: .9rem;
            padding: .95rem 1rem;
            border-radius: 16px;
            color: var(--text-secondary);
            border: 1px solid transparent;
            transition: all .28s ease;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        .nav-link:hover {
            color: var(--text-primary);
            background: rgba(255,255,255,0.04);
            border-color: var(--border-color);
            transform: translateX(4px);
        }

        .nav-link.active {
            color: var(--text-primary);
            background: linear-gradient(135deg, rgba(59,130,246,0.16), rgba(147,51,234,0.10));
            border-color: rgba(59,130,246,0.20);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.04);
        }

        .nav-link small {
            margin-left: auto;
            color: var(--text-muted);
            font-size: .72rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .sidebar-footer {
            margin-top: auto;
        }

        .sql-tip {
            margin-top: 1.2rem;
            padding: 1rem;
            border-radius: 22px;
            border: 1px solid rgba(59,130,246,0.18);
            background: linear-gradient(135deg, rgba(59,130,246,0.08), rgba(6,182,212,0.05));
        }

        .sql-tip-head {
            display: flex;
            align-items: center;
            gap: .65rem;
            margin-bottom: .75rem;
            font-weight: 700;
        }

        .sql-tip-head i {
            color: var(--primary);
        }

        .sql-tip code {
            font-family: 'JetBrains Mono', monospace;
            font-size: .82rem;
            display: block;
            color: #93c5fd;
            line-height: 1.7;
            margin-bottom: .75rem;
        }

        .sql-tip p {
            color: var(--text-secondary);
            font-size: .86rem;
            line-height: 1.6;
        }

        /* MAIN */
        .main {
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .header {
            position: sticky;
            top: 0;
            z-index: 15;
            height: var(--header-height);
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 1rem;
            padding: 0 1.8rem;
            border-bottom: 1px solid var(--border-color);
            background: rgba(10,10,26,0.76);
            backdrop-filter: blur(18px);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .search {
            position: relative;
            width: min(460px, 100%);
        }

        .search input {
            width: 100%;
            padding: .95rem 1rem .95rem 2.9rem;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            background: rgba(255,255,255,0.04);
            color: var(--text-primary);
            outline: none;
            transition: all .25s ease;
        }

        .search input:focus {
            border-color: rgba(59,130,246,0.28);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.08);
        }

        .search i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: .7rem;
        }

        .icon-btn {
            width: 46px;
            height: 46px;
            border: 1px solid var(--border-color);
            border-radius: 14px;
            background: rgba(255,255,255,0.04);
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .25s ease;
            position: relative;
        }

        .icon-btn:hover {
            color: var(--text-primary);
            border-color: rgba(59,130,246,0.20);
            transform: translateY(-2px);
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: .75rem;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: .35rem .7rem .35rem .35rem;
            background: rgba(255,255,255,0.04);
        }

        .header-user .avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
        }

        .header-user strong {
            display: block;
            font-size: .9rem;
        }

        .header-user span {
            display: block;
            margin-top: .12rem;
            font-size: .76rem;
            color: var(--text-muted);
        }

        .content {
            padding: 1.7rem;
        }

        .hero-panel {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            border: 1px solid var(--border-color);
            background:
                radial-gradient(circle at top right, rgba(59,130,246,0.16), transparent 26%),
                radial-gradient(circle at bottom left, rgba(147,51,234,0.12), transparent 24%),
                linear-gradient(135deg, rgba(17,17,39,0.96), rgba(23,23,49,0.96));
            padding: 1.8rem;
            margin-bottom: 1.25rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.32);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 1.5rem;
            align-items: stretch;
        }

        .breadcrumbs {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            color: var(--text-secondary);
            font-size: .86rem;
            margin-bottom: .8rem;
        }

        .breadcrumbs i {
            font-size: .72rem;
            opacity: .7;
        }

        .hero-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1.05;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--primary), var(--accent), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            color: var(--text-secondary);
            line-height: 1.75;
            max-width: 760px;
            font-size: 1rem;
            margin-top: 1rem;
        }

        .hero-actions {
            display: flex;
            gap: .8rem;
            flex-wrap: wrap;
            margin-top: 1.35rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: .65rem;
            padding: .95rem 1.25rem;
            border-radius: 14px;
            font-weight: 600;
            border: 1px solid transparent;
            transition: all .25s ease;
        }

        .btn-primary {
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 12px 28px var(--glow-primary);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
        }

        .btn-secondary {
            color: #fff;
            background: rgba(255,255,255,0.04);
            border-color: var(--border-color);
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            border-color: rgba(59,130,246,0.22);
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 1.6rem;
        }

        .hero-stat {
            position: relative;
        }

        .hero-stat strong {
            display: block;
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .hero-stat span {
            display: block;
            margin-top: .25rem;
            color: var(--text-muted);
            font-size: .84rem;
        }

        .sql-console {
            position: relative;
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            background: rgba(10,10,26,0.84);
            align-self: stretch;
        }

        .console-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: .9rem 1rem;
            border-bottom: 1px solid var(--border-color);
            background: rgba(255,255,255,0.03);
        }

        .console-left {
            display: flex;
            align-items: center;
            gap: .8rem;
        }

        .dots {
            display: flex;
            gap: .45rem;
        }

        .dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
        }

        .dot.red { background: #ff5f56; }
        .dot.yellow { background: #ffbd2e; }
        .dot.green { background: #27ca40; }

        .console-tab {
            font-family: 'JetBrains Mono', monospace;
            font-size: .82rem;
            color: #cbd5e1;
        }

        .console-run {
            font-size: .8rem;
            color: #86efac;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }

        .console-body {
            padding: 1rem 1rem 1.1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: .84rem;
            line-height: 1.8;
        }

        .line {
            display: grid;
            grid-template-columns: 24px 1fr;
            gap: .9rem;
        }

        .line-no {
            color: #64748b;
            text-align: right;
            user-select: none;
        }

        .kw { color: #c792ea; }
        .tbl { color: #82aaff; }
        .col { color: #80cbc4; }
        .fn { color: #ffcb6b; }
        .cm { color: #546e7a; }
        .as { color: #c3e88d; }

        .console-result {
            border-top: 1px solid var(--border-color);
            background: rgba(255,255,255,0.03);
            padding: .9rem 1rem 1rem;
        }

        .result-head {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: .75rem;
            font-size: .78rem;
            color: var(--text-secondary);
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'JetBrains Mono', monospace;
            font-size: .77rem;
        }

        .result-table th,
        .result-table td {
            padding: .55rem .65rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            text-align: left;
        }

        .result-table th {
            color: #94a3b8;
            font-weight: 600;
        }

        .result-table td {
            color: #dbeafe;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .metric-card,
        .panel {
            position: relative;
            border-radius: 24px;
            border: 1px solid var(--border-color);
            background: var(--bg-panel);
            overflow: hidden;
            backdrop-filter: blur(14px);
        }

        .metric-card::before,
        .panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59,130,246,0.07), rgba(147,51,234,0.04), transparent 60%);
            pointer-events: none;
        }

        .metric-card {
            padding: 1.2rem;
            transition: all .3s ease;
        }

        .metric-card:hover {
            transform: translateY(-5px);
            border-color: rgba(59,130,246,0.18);
        }

        .metric-top {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            align-items: center;
            position: relative;
            z-index: 1;
            margin-bottom: .95rem;
        }

        .metric-top span {
            color: var(--text-secondary);
            font-size: .9rem;
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            box-shadow: 0 10px 24px rgba(0,0,0,0.22);
        }

        .metric-value {
            position: relative;
            z-index: 1;
            font-size: 1.9rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .metric-note {
            position: relative;
            z-index: 1;
            margin-top: .35rem;
            color: var(--text-muted);
            font-size: .84rem;
        }

        .grid-main {
            display: grid;
            grid-template-columns: 1.4fr .95fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .panel {
            padding: 1.2rem;
            box-shadow: 0 14px 40px rgba(0,0,0,0.24);
        }

        .panel-head {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .panel-title {
            font-size: 1.05rem;
            font-weight: 700;
        }

        .panel-sub {
            color: var(--text-secondary);
            font-size: .84rem;
            margin-top: .25rem;
        }

        .panel-link {
            color: #7dd3fc;
            font-size: .9rem;
            font-weight: 600;
        }

        .workspace-list {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: .8rem;
        }

        .workspace-item {
            display: flex;
            align-items: flex-start;
            gap: .9rem;
            padding: 1rem;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.05);
            background: rgba(255,255,255,0.03);
            transition: all .25s ease;
        }

        .workspace-item:hover {
            background: rgba(59,130,246,0.05);
            border-color: rgba(59,130,246,0.16);
        }

        .workspace-item-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #fff;
        }

        .workspace-item-title {
            font-weight: 700;
            margin-bottom: .25rem;
        }

        .workspace-item-text {
            color: var(--text-secondary);
            line-height: 1.6;
            font-size: .9rem;
        }

        .workspace-item-meta {
            margin-top: .45rem;
            color: var(--text-muted);
            font-size: .78rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .table-wrap {
            position: relative;
            z-index: 1;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: .9rem 1rem;
            color: var(--text-muted);
            font-size: .76rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 1rem;
            color: #e5e7eb;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: .94rem;
            vertical-align: middle;
        }

        tr:hover td {
            background: rgba(255,255,255,0.02);
        }

        .mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: .84rem;
            color: #cbd5e1;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .38rem .68rem;
            border-radius: 999px;
            font-size: .76rem;
            font-weight: 600;
            border: 1px solid transparent;
        }

        .badge-success {
            color: #86efac;
            background: rgba(34,197,94,0.10);
            border-color: rgba(34,197,94,0.18);
        }

        .badge-warning {
            color: #fcd34d;
            background: rgba(245,158,11,0.10);
            border-color: rgba(245,158,11,0.18);
        }

        .badge-info {
            color: #7dd3fc;
            background: rgba(6,182,212,0.10);
            border-color: rgba(6,182,212,0.18);
        }

        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .progress-list,
        .activity-list {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: .8rem;
        }

        .progress-item,
        .activity-item {
            padding: 1rem;
            border-radius: 18px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.05);
        }

        .progress-head {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: .7rem;
        }

        .progress-head strong {
            font-size: .92rem;
        }

        .progress-head span {
            color: var(--text-secondary);
            font-size: .84rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .progress-bar {
            height: 8px;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
            box-shadow: 0 0 18px rgba(59,130,246,0.28);
        }

        .activity-row {
            display: flex;
            gap: .8rem;
            align-items: flex-start;
        }

        .activity-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-top: .35rem;
            flex-shrink: 0;
        }

        .activity-title {
            font-weight: 700;
            margin-bottom: .25rem;
        }

        .activity-text {
            color: var(--text-secondary);
            line-height: 1.6;
            font-size: .9rem;
        }

        .activity-time {
            margin-top: .4rem;
            color: var(--text-muted);
            font-size: .78rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .footer {
            margin-top: 1.2rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: .88rem;
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        @media (max-width: 1320px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .grid-main,
            .bottom-grid,
            .hero-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 1100px) {
            .workspace {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: relative;
                height: auto;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
            }

            .header {
                grid-template-columns: 1fr;
                height: auto;
                padding: 1rem 1.2rem;
            }

            .header-right {
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .search {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .content {
                padding: 1rem;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }

            .hero-actions {
                flex-direction: column;
            }

            .hero-actions .btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
<div class="workspace">

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <ellipse cx="12" cy="5" rx="9" ry="3"/>
                    <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/>
                    <path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/>
                </svg>
            </div>
            <div>
                <div class="brand-title">SQL <span>Mastery</span></div>
                <div class="brand-sub">Workspace Admin</div>
            </div>
        </div>

        <div class="sidebar-block">
            <div class="sidebar-block-top">
                <div class="avatar">A</div>
                <div>
                    <div class="user-name">Admin User</div>
                    <div class="user-role">Content & Platform Manager</div>
                </div>
            </div>
            <div class="status-pill">Система активна</div>
        </div>

        <div class="nav-section">
            <div class="nav-title">Control Center</div>
            <div class="nav-list">
                <a href="#" class="nav-link active">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Обзор</span>
                    <small>HOME</small>
                </a>
                <a href="#" class="nav-link">
                    <i class="bi bi-bar-chart-line-fill"></i>
                    <span>Метрики</span>
                    <small>STAT</small>
                </a>
                <a href="#" class="nav-link">
                    <i class="bi bi-lightning-charge-fill"></i>
                    <span>Активность</span>
                    <small>LIVE</small>
                </a>
            </div>
        </div>

        <div class="nav-section">
            <div class="nav-title">Learning Content</div>
            <div class="nav-list">
                <a href="#" class="nav-link">
                    <i class="bi bi-collection-fill"></i>
                    <span>Модули</span>
                    <small>MOD</small>
                </a>
                <a href="#" class="nav-link">
                    <i class="bi bi-journal-richtext"></i>
                    <span>Уроки</span>
                    <small>LESS</small>
                </a>
                <a href="#" class="nav-link">
                    <i class="bi bi-list-check"></i>
                    <span>Задачи</span>
                    <small>TASK</small>
                </a>
                <a href="#" class="nav-link">
                    <i class="bi bi-terminal-fill"></i>
                    <span>Песочница</span>
                    <small>SQL</small>
                </a>
            </div>
        </div>

        <div class="nav-section">
            <div class="nav-title">Platform</div>
            <div class="nav-list">
                <a href="#" class="nav-link">
                    <i class="bi bi-people-fill"></i>
                    <span>Пользователи</span>
                    <small>USR</small>
                </a>
                <a href="#" class="nav-link">
                    <i class="bi bi-award-fill"></i>
                    <span>Сертификаты</span>
                    <small>CERT</small>
                </a>
                <a href="#" class="nav-link">
                    <i class="bi bi-gear-fill"></i>
                    <span>Настройки</span>
                    <small>CFG</small>
                </a>
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="sql-tip">
                <div class="sql-tip-head">
                    <i class="bi bi-code-slash"></i>
                    <span>SQL Insight</span>
                </div>
                <code>SELECT COUNT(*)<br>FROM tasks<br>WHERE status = 'draft';</code>
                <p>Сейчас в системе 12 черновиков, требующих проверки перед публикацией.</p>
            </div>
        </div>
    </aside>

    <main class="main">
        <header class="header">
            <div class="header-left">
                <div class="search">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Поиск по модулям, урокам, задачам и пользователям...">
                </div>
            </div>

            <div class="header-right">
                <button class="icon-btn"><i class="bi bi-command"></i></button>
                <button class="icon-btn"><i class="bi bi-bell-fill"></i></button>
                <button class="icon-btn"><i class="bi bi-box-arrow-up-right"></i></button>

                <div class="header-user">
                    <div class="avatar">A</div>
                    <div>
                        <strong>Admin User</strong>
                        <span>admin@sqlmastery.test</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="content">

            <section class="hero-panel">
                <div class="hero-grid">
                    <div>
                        <div class="breadcrumbs">
                            <span>Админка</span>
                            <i class="bi bi-chevron-right"></i>
                            <span>Workspace</span>
                        </div>

                        <h1 class="hero-title">
                            Центр управления <span>SQLMastery</span>
                        </h1>

                        <p class="hero-desc">
                            Не просто dashboard, а рабочее пространство для управления курсами, задачами, пользователями и SQL-контентом.
                            Этот вариант специально смещён в сторону editor/workspace интерфейса, чтобы админка ощущалась частью SQL-платформы.
                        </p>

                        <div class="hero-actions">
                            <a href="#" class="btn btn-primary">
                                <i class="bi bi-plus-circle-fill"></i>
                                <span>Создать модуль</span>
                            </a>

                            <a href="#" class="btn btn-secondary">
                                <i class="bi bi-code-square"></i>
                                <span>Добавить задачу</span>
                            </a>
                        </div>

                        <div class="hero-stats">
                            <div class="hero-stat">
                                <strong>18</strong>
                                <span>модулей курса</span>
                            </div>
                            <div class="hero-stat">
                                <strong>84</strong>
                                <span>практических задач</span>
                            </div>
                            <div class="hero-stat">
                                <strong>46</strong>
                                <span>уроков</span>
                            </div>
                            <div class="hero-stat">
                                <strong>1 284</strong>
                                <span>пользователей</span>
                            </div>
                        </div>
                    </div>

                    <div class="sql-console">
                        <div class="console-head">
                            <div class="console-left">
                                <div class="dots">
                                    <span class="dot red"></span>
                                    <span class="dot yellow"></span>
                                    <span class="dot green"></span>
                                </div>
                                <div class="console-tab">admin-insight.sql</div>
                            </div>
                            <div class="console-run">
                                <i class="bi bi-play-fill"></i>
                                <span>Executed</span>
                            </div>
                        </div>

                        <div class="console-body">
                            <div class="line"><div class="line-no">1</div><div><span class="cm">-- latest content overview</span></div></div>
                            <div class="line"><div class="line-no">2</div><div><span class="kw">SELECT</span> <span class="fn">COUNT</span>(*) <span class="kw">AS</span> <span class="as">published_tasks</span></div></div>
                            <div class="line"><div class="line-no">3</div><div><span class="kw">FROM</span> <span class="tbl">tasks</span></div></div>
                            <div class="line"><div class="line-no">4</div><div><span class="kw">WHERE</span> <span class="col">status</span> = <span class="as">'published'</span>;</div></div>
                        </div>

                        <div class="console-result">
                            <div class="result-head">
                                <span>Result: 72 rows matched</span>
                                <span>0.024s</span>
                            </div>
                            <table class="result-table">
                                <thead>
                                <tr>
                                    <th>metric</th>
                                    <th>value</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>published_tasks</td>
                                    <td>72</td>
                                </tr>
                                <tr>
                                    <td>draft_tasks</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>active_modules</td>
                                    <td>18</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="cards-grid">
                <div class="metric-card">
                    <div class="metric-top">
                        <span>Модули</span>
                        <div class="metric-icon" style="background:linear-gradient(135deg,#3b82f6,#2563eb)">
                            <i class="bi bi-collection-fill"></i>
                        </div>
                    </div>
                    <div class="metric-value">18</div>
                    <div class="metric-note">структура курса почти завершена</div>
                </div>

                <div class="metric-card">
                    <div class="metric-top">
                        <span>Задачи</span>
                        <div class="metric-icon" style="background:linear-gradient(135deg,#9333ea,#7e22ce)">
                            <i class="bi bi-list-check"></i>
                        </div>
                    </div>
                    <div class="metric-value">84</div>
                    <div class="metric-note">12 материалов ждут публикации</div>
                </div>

                <div class="metric-card">
                    <div class="metric-top">
                        <span>Уроки</span>
                        <div class="metric-icon" style="background:linear-gradient(135deg,#06b6d4,#0891b2)">
                            <i class="bi bi-journal-code"></i>
                        </div>
                    </div>
                    <div class="metric-value">46</div>
                    <div class="metric-note">контент активно обновляется</div>
                </div>

                <div class="metric-card">
                    <div class="metric-top">
                        <span>Пользователи</span>
                        <div class="metric-icon" style="background:linear-gradient(135deg,#22c55e,#059669)">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <div class="metric-value">1 284</div>
                    <div class="metric-note">+86 регистраций за период</div>
                </div>
            </section>

            <section class="grid-main">
                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <div class="panel-title">Последние задачи</div>
                            <div class="panel-sub">Пример index-таблицы, адаптированной под SQL workspace стиль</div>
                        </div>
                        <a href="#" class="panel-link">Открыть список</a>
                    </div>

                    <div class="table-wrap">
                        <table>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Задача</th>
                                <th>SQL Topic</th>
                                <th>Статус</th>
                                <th>Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="mono">#104</td>
                                <td>JOIN по нескольким таблицам</td>
                                <td class="mono">JOIN / RELATIONS</td>
                                <td><span class="badge badge-success">Published</span></td>
                                <td class="mono">2h ago</td>
                            </tr>
                            <tr>
                                <td class="mono">#103</td>
                                <td>Агрегация и GROUP BY</td>
                                <td class="mono">AGGREGATION</td>
                                <td><span class="badge badge-info">Review</span></td>
                                <td class="mono">today 09:12</td>
                            </tr>
                            <tr>
                                <td class="mono">#102</td>
                                <td>Подзапросы в SELECT</td>
                                <td class="mono">SUBQUERY</td>
                                <td><span class="badge badge-warning">Draft</span></td>
                                <td class="mono">yesterday</td>
                            </tr>
                            <tr>
                                <td class="mono">#101</td>
                                <td>Оконные функции</td>
                                <td class="mono">WINDOW FUNC</td>
                                <td><span class="badge badge-success">Published</span></td>
                                <td class="mono">3d ago</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <div class="panel-title">Быстрые операции</div>
                            <div class="panel-sub">Не просто ссылки, а workspace actions</div>
                        </div>
                    </div>

                    <div class="workspace-list">
                        <a href="#" class="workspace-item">
                            <div class="workspace-item-icon" style="background:linear-gradient(135deg,#3b82f6,#2563eb)">
                                <i class="bi bi-plus-square-fill"></i>
                            </div>
                            <div>
                                <div class="workspace-item-title">Создать модуль</div>
                                <div class="workspace-item-text">Добавить новый раздел курса и определить его порядок в программе.</div>
                                <div class="workspace-item-meta">action.create.module()</div>
                            </div>
                        </a>

                        <a href="#" class="workspace-item">
                            <div class="workspace-item-icon" style="background:linear-gradient(135deg,#9333ea,#7e22ce)">
                                <i class="bi bi-code-square"></i>
                            </div>
                            <div>
                                <div class="workspace-item-title">Создать задачу</div>
                                <div class="workspace-item-text">Подготовить новое SQL-задание для тренажёра и связать его с уроком.</div>
                                <div class="workspace-item-meta">action.create.task()</div>
                            </div>
                        </a>

                        <a href="#" class="workspace-item">
                            <div class="workspace-item-icon" style="background:linear-gradient(135deg,#06b6d4,#0891b2)">
                                <i class="bi bi-journal-text"></i>
                            </div>
                            <div>
                                <div class="workspace-item-title">Редактировать уроки</div>
                                <div class="workspace-item-text">Изменить теоретические материалы, примеры и последовательность уроков.</div>
                                <div class="workspace-item-meta">action.open.lessons()</div>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

            <section class="bottom-grid">
                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <div class="panel-title">Прогресс наполнения</div>
                            <div class="panel-sub">Состояние ключевых разделов платформы</div>
                        </div>
                    </div>

                    <div class="progress-list">
                        <div class="progress-item">
                            <div class="progress-head">
                                <strong>Модули курса</strong>
                                <span>18 / 20</span>
                            </div>
                            <div class="progress-bar"><div class="progress-fill" style="width:90%"></div></div>
                        </div>

                        <div class="progress-item">
                            <div class="progress-head">
                                <strong>Практические задачи</strong>
                                <span>84 / 100</span>
                            </div>
                            <div class="progress-bar"><div class="progress-fill" style="width:84%"></div></div>
                        </div>

                        <div class="progress-item">
                            <div class="progress-head">
                                <strong>Материалы и пояснения</strong>
                                <span>32 / 50</span>
                            </div>
                            <div class="progress-bar"><div class="progress-fill" style="width:64%"></div></div>
                        </div>

                        <div class="progress-item">
                            <div class="progress-head">
                                <strong>Проверка черновиков</strong>
                                <span>12 / 24</span>
                            </div>
                            <div class="progress-bar"><div class="progress-fill" style="width:50%"></div></div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <div class="panel-title">Последняя активность</div>
                            <div class="panel-sub">События админ-панели в живом формате</div>
                        </div>
                    </div>

                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-row">
                                <div class="activity-dot" style="background:#22c55e; box-shadow:0 0 18px rgba(34,197,94,.65)"></div>
                                <div>
                                    <div class="activity-title">Задача “JOIN по нескольким таблицам” опубликована</div>
                                    <div class="activity-text">Материал сохранён и теперь доступен в публичной части SQL-тренажёра.</div>
                                    <div class="activity-time">event.publish_task() · 10m ago</div>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-row">
                                <div class="activity-dot" style="background:#3b82f6; box-shadow:0 0 18px rgba(59,130,246,.65)"></div>
                                <div>
                                    <div class="activity-title">Создан новый модуль “Оконные функции”</div>
                                    <div class="activity-text">Модуль добавлен в программу обучения и ожидает наполнения уроками.</div>
                                    <div class="activity-time">event.create_module() · 1h ago</div>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-row">
                                <div class="activity-dot" style="background:#f59e0b; box-shadow:0 0 18px rgba(245,158,11,.65)"></div>
                                <div>
                                    <div class="activity-title">Черновик задачи требует доработки</div>
                                    <div class="activity-text">Не заполнен ожидаемый результат и часть SQL test cases для автоматической проверки.</div>
                                    <div class="activity-time">event.review_required() · today 08:41</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="footer">
                <div>© 2024 SQLMastery Workspace Preview</div>
                <div>SQL-oriented admin concept for content management</div>
            </footer>
        </div>
    </main>
</div>
</body>
</html>
