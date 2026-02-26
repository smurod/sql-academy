@extends('public.layouts.app')

@section('title', 'SQL Academy — Онлайн платформа для изучения SQL')

@section('styles')
    <style>
        /* ── HERO SECTION ── */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: var(--bg-dark);
            margin-top: -72px;
            padding-top: 72px;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }

        .hero-gradient-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            animation: float-orb 20s ease-in-out infinite;
        }

        .hero-gradient-orb:nth-child(1) {
            width: 800px; height: 800px; top: -300px; left: -200px;
            background: radial-gradient(circle, rgba(59,130,246,0.3) 0%, transparent 70%);
        }

        .hero-gradient-orb:nth-child(2) {
            width: 600px; height: 600px; top: 50%; right: -150px;
            background: radial-gradient(circle, rgba(147,51,234,0.25) 0%, transparent 70%);
            animation-delay: -5s;
        }

        .hero-gradient-orb:nth-child(3) {
            width: 500px; height: 500px; bottom: -100px; left: 30%;
            background: radial-gradient(circle, rgba(6,182,212,0.2) 0%, transparent 70%);
            animation-delay: -10s;
        }

        .hero-gradient-orb:nth-child(4) {
            width: 400px; height: 400px; top: 20%; left: 50%;
            background: radial-gradient(circle, rgba(236,72,153,0.15) 0%, transparent 70%);
            animation-delay: -15s;
        }

        @keyframes float-orb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(50px, -30px) scale(1.1); }
            50% { transform: translate(-30px, 50px) scale(0.95); }
            75% { transform: translate(-50px, -20px) scale(1.05); }
        }

        .grid-bg {
            position: absolute; inset: 0; opacity: 0.03;
            background-image:
                linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 80px 80px;
            mask-image: radial-gradient(ellipse at center, black 30%, transparent 70%);
        }

        .hero-inner {
            position: relative; max-width: 1400px; margin: 0 auto; padding: 6rem 2rem;
            width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;
        }

        .hero-content { animation: fadeInUp 1s ease 0.5s both; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.625rem;
            background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.2);
            border-radius: 9999px; padding: 0.5rem 1.25rem; color: var(--primary);
            font-size: 0.875rem; font-weight: 500; animation: badge-glow 3s ease-in-out infinite;
        }

        @keyframes badge-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59,130,246,0.1); }
            50% { box-shadow: 0 0 30px rgba(59,130,246,0.3); }
        }

        .pulse {
            width: 10px; height: 10px; border-radius: 50%; background: var(--success); position: relative;
        }

        .pulse::before {
            content: ''; position: absolute; inset: -4px; border-radius: 50%;
            background: var(--success); animation: pulse-ring 1.5s ease-in-out infinite;
        }

        @keyframes pulse-ring {
            0% { transform: scale(0.5); opacity: 0.8; }
            100% { transform: scale(1.5); opacity: 0; }
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900;
            line-height: 1.1; margin: 1.75rem 0; letter-spacing: -0.03em;
        }

        .hero-title .word {
            display: inline-block; animation: word-reveal 0.8s ease forwards;
            opacity: 0; transform: translateY(20px);
        }

        .hero-title .word:nth-child(1) { animation-delay: 0.6s; }
        .hero-title .word:nth-child(2) { animation-delay: 0.7s; }
        .hero-title .word:nth-child(3) { animation-delay: 0.8s; }
        .hero-title .word:nth-child(4) { animation-delay: 0.9s; }
        .hero-title .word:nth-child(5) { animation-delay: 1s; }

        @keyframes word-reveal { to { opacity: 1; transform: translateY(0); } }

        .hero-desc {
            font-size: 1.25rem; color: var(--text-secondary); line-height: 1.8;
            max-width: 580px; animation: fadeInUp 1s ease 1.1s both;
        }

        .hero-btns {
            display: flex; gap: 1.25rem; flex-wrap: wrap;
            margin-top: 2rem; animation: fadeInUp 1s ease 1.3s both;
        }

        .hero-btns .btn-outline i {
            font-size: 1.25rem;
            animation: play-pulse 2s ease-in-out infinite;
        }

        @keyframes play-pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }

        .hero-stats {
            display: flex; gap: 3rem; margin-top: 3rem;
            animation: fadeInUp 1s ease 1.5s both;
        }

        .hero-stat { position: relative; }

        .hero-stat::after {
            content: ''; position: absolute; right: -1.5rem; top: 50%;
            transform: translateY(-50%); width: 1px; height: 40px;
            background: linear-gradient(to bottom, transparent, var(--border-color), transparent);
        }

        .hero-stat:last-child::after { display: none; }

        .mini-stat-val {
            font-size: 1.75rem; font-weight: 800; display: flex; align-items: center; gap: 0.375rem;
            background: linear-gradient(135deg, var(--text-primary), var(--text-secondary));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        .mini-stat-val i { -webkit-text-fill-color: #facc15; }

        .mini-stat-label { font-size: 0.875rem; color: var(--text-muted); margin-top: 0.25rem; }

        /* ── SQL EDITOR HERO ── */
        .editor-wrap {
            position: relative; animation: fadeInRight 1s ease 0.8s both;
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(60px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .editor-glow {
            position: absolute; inset: -30px;
            background: linear-gradient(135deg, var(--glow-primary), var(--glow-secondary));
            border-radius: 30px; filter: blur(60px); opacity: 0.5;
            animation: glow-pulse 4s ease-in-out infinite;
        }

        @keyframes glow-pulse {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.05); }
        }

        .editor {
            position: relative; background: var(--bg-elevated); border-radius: 20px;
            border: 1px solid var(--border-color); box-shadow: 0 40px 100px rgba(0,0,0,0.5);
            overflow: hidden; transition: transform 0.3s ease;
        }

        .editor-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.25rem; background: rgba(0,0,0,0.3);
            border-bottom: 1px solid var(--border-color);
        }

        .editor-header-left { display: flex; align-items: center; gap: 1rem; }

        .traffic-lights { display: flex; gap: 0.5rem; }

        .dot { width: 14px; height: 14px; border-radius: 50%; transition: all 0.3s ease; }
        .dot-r { background: #ff5f56; }
        .dot-y { background: #ffbd2e; }
        .dot-g { background: #27ca40; }

        .editor-tabs { display: flex; gap: 0.25rem; }

        .editor-tab {
            padding: 0.375rem 1rem; border-radius: 8px; font-size: 0.8rem;
            font-family: 'JetBrains Mono', monospace; transition: all 0.3s ease;
        }

        .editor-tab.active { background: rgba(255,255,255,0.1); color: var(--text-primary); }
        .editor-tab.inactive { color: var(--text-muted); }
        .editor-tab.inactive:hover { background: rgba(255,255,255,0.05); color: var(--text-secondary); }

        .editor-actions { display: flex; gap: 0.5rem; }

        .editor-action {
            padding: 0.375rem; border-radius: 6px; color: var(--text-muted);
            transition: all 0.3s ease; background: transparent; border: none;
        }

        .editor-action:hover { background: rgba(255,255,255,0.1); color: var(--text-primary); }

        .editor-code {
            padding: 1.5rem; font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem; line-height: 1.9; overflow-x: auto;
        }

        .code-line { display: flex; transition: background 0.2s ease; }
        .code-line:hover { background: rgba(255,255,255,0.02); }

        .line-number {
            color: var(--text-muted); margin-right: 1.5rem; user-select: none;
            text-align: right; width: 20px; flex-shrink: 0;
        }

        .line-content { display: flex; flex-wrap: wrap; gap: 0.25rem; }

        .kw { color: #c792ea; font-weight: 600; }
        .col { color: #80cbc4; }
        .fn { color: #ffcb6b; }
        .alias { color: #c3e88d; }
        .tbl { color: #82aaff; }
        .op { color: var(--text-secondary); }
        .comment { color: #546e7a; font-style: italic; }
        .indent { margin-left: 2rem; }

        .typing-cursor {
            display: inline-block; width: 2px; height: 1.2em;
            background: var(--primary); margin-left: 2px; animation: blink 1s infinite;
        }

        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }

        .editor-run {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.5rem; background: rgba(0,0,0,0.2);
            border-top: 1px solid var(--border-color);
        }

        .run-info { display: flex; align-items: center; gap: 1rem; }

        .run-label {
            font-size: 0.8rem; color: var(--text-muted);
            display: flex; align-items: center; gap: 0.5rem;
        }

        .run-label i { color: var(--primary); }

        .run-status {
            display: flex; align-items: center; gap: 0.375rem; font-size: 0.75rem;
            color: var(--success); background: rgba(34,197,94,0.1);
            padding: 0.25rem 0.625rem; border-radius: 6px;
        }

        .run-btn {
            background: var(--success); color: var(--text-primary); border: none;
            padding: 0.5rem 1.25rem; border-radius: 10px; font-size: 0.85rem;
            font-weight: 600; display: flex; align-items: center; gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .run-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(34,197,94,0.4); }

        .editor-result {
            padding: 1.25rem 1.5rem; border-top: 1px solid var(--border-color);
            background: rgba(0,0,0,0.1);
        }

        .result-header {
            display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;
        }

        .result-ok {
            font-size: 0.85rem; color: var(--success);
            display: flex; align-items: center; gap: 0.5rem;
        }

        .result-time { font-size: 0.75rem; color: var(--text-muted); }

        .result-table {
            width: 100%; font-size: 0.8rem; font-family: 'JetBrains Mono', monospace;
            border-collapse: collapse;
        }

        .result-table th {
            text-align: left; padding: 0.625rem 1rem; color: var(--text-secondary);
            background: rgba(255,255,255,0.03); border-bottom: 1px solid var(--border-color);
            font-weight: 600;
        }

        .result-table td {
            padding: 0.625rem 1rem; color: var(--text-secondary);
            border-bottom: 1px solid rgba(255,255,255,0.03); transition: background 0.2s ease;
        }

        .result-table tr:hover td { background: rgba(255,255,255,0.02); }
        .result-table td.highlight { color: var(--success); font-weight: 500; }

        .floating-element {
            position: absolute; pointer-events: none; animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .float-card {
            background: var(--bg-elevated); border: 1px solid var(--border-color);
            border-radius: 12px; padding: 0.75rem 1rem; display: flex;
            align-items: center; gap: 0.5rem; font-size: 0.8rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .float-card i { color: var(--success); }

        .hero-wave { position: absolute; bottom: 0; left: 0; right: 0; }
        .hero-wave svg { display: block; width: 100%; }

        @media (max-width: 1024px) {
            .hero-inner { grid-template-columns: 1fr; text-align: center; }
            .hero-desc { margin: 0 auto; }
            .hero-btns { justify-content: center; }
            .hero-stats { justify-content: center; }
            .editor-wrap { display: none; }
        }

        /* ── FEATURES SECTION ── */
        .features { background: var(--bg-card); padding: 8rem 0; position: relative; overflow: hidden; }

        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; }

        .feature-card {
            position: relative; background: rgba(30,30,60,0.5); border: 1px solid var(--border-color);
            border-radius: 20px; padding: 2rem; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
        }

        .feature-card::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--glow-primary), transparent);
            opacity: 0; transition: opacity 0.4s ease;
        }

        .feature-card::after {
            content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05), transparent);
            transition: left 0.6s ease;
        }

        .feature-card:hover {
            border-color: rgba(59,130,246,0.3); transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.3);
        }

        .feature-card:hover::before { opacity: 0.1; }
        .feature-card:hover::after { left: 100%; }

        .feature-card-content { position: relative; z-index: 1; }

        .feature-icon {
            width: 60px; height: 60px; border-radius: 16px; display: flex;
            align-items: center; justify-content: center; margin-bottom: 1.5rem;
            font-size: 1.5rem; color: var(--text-primary); transition: all 0.4s ease;
        }

        .feature-card:hover .feature-icon { transform: scale(1.1) rotate(-5deg); }

        .feature-card h3 { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; }
        .feature-card p { color: var(--text-secondary); font-size: 0.95rem; line-height: 1.7; }

        .feature-link {
            display: inline-flex; align-items: center; gap: 0.5rem; margin-top: 1.25rem;
            color: var(--primary); font-size: 0.9rem; font-weight: 500;
            opacity: 0; transform: translateY(10px); transition: all 0.3s ease;
        }

        .feature-card:hover .feature-link { opacity: 1; transform: translateY(0); }

        @media (max-width: 1024px) { .features-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .features-grid { grid-template-columns: 1fr; } }

        /* ── COURSE SECTION ── */
        .course-section { background: var(--bg-dark); padding: 8rem 0; }

        .course-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center;
        }

        .course-content { display: flex; flex-direction: column; gap: 2rem; }
        .course-content > p { color: var(--text-secondary); font-size: 1.125rem; line-height: 1.8; }

        .course-features { display: flex; flex-direction: column; gap: 1rem; }

        .course-feature {
            display: flex; align-items: center; gap: 1rem; padding: 1rem;
            background: rgba(30,30,60,0.3); border-radius: 12px;
            border: 1px solid var(--border-color); transition: all 0.3s ease;
        }

        .course-feature:hover {
            background: rgba(59,130,246,0.1); border-color: rgba(59,130,246,0.2);
            transform: translateX(10px);
        }

        .course-feature-icon {
            width: 44px; height: 44px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }

        .course-feature span { font-weight: 500; }

        .modules { display: flex; flex-direction: column; gap: 1rem; }

        .module-item {
            display: flex; align-items: center; gap: 1.25rem; padding: 1.25rem;
            border-radius: 16px; border: 1px solid;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); position: relative; overflow: hidden;
        }

        .module-item.done { background: rgba(34,197,94,0.05); border-color: rgba(34,197,94,0.2); }
        .module-item.done:hover { border-color: rgba(34,197,94,0.4); box-shadow: 0 10px 40px rgba(34,197,94,0.1); }

        .module-item.pending { background: rgba(30,30,60,0.5); border-color: var(--border-color); }
        .module-item.pending:hover {
            border-color: rgba(59,130,246,0.3); transform: scale(1.02);
            box-shadow: 0 10px 40px rgba(59,130,246,0.1);
        }

        .module-item.current { background: rgba(59,130,246,0.1); border-color: rgba(59,130,246,0.3); }

        .module-item.current::after {
            content: 'Текущий'; position: absolute; top: 0.75rem; right: 0.75rem;
            padding: 0.25rem 0.625rem; background: var(--primary); color: var(--text-primary);
            font-size: 0.7rem; font-weight: 600; border-radius: 6px;
        }

        .module-num {
            width: 48px; height: 48px; border-radius: 12px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 1rem; transition: all 0.3s ease;
        }

        .module-num.done { background: rgba(34,197,94,0.2); color: var(--success); }
        .module-num.pending { background: rgba(255,255,255,0.05); color: var(--text-muted); }
        .module-num.current {
            background: var(--primary); color: var(--text-primary);
            box-shadow: 0 8px 20px var(--glow-primary);
        }

        .module-item:hover .module-num { transform: scale(1.1); }

        .module-content { flex: 1; min-width: 0; }

        .module-header {
            display: flex; align-items: center; justify-content: space-between; gap: 1rem;
        }

        .module-title { font-weight: 600; font-size: 1rem; }

        .module-lessons {
            color: var(--text-muted); font-size: 0.8rem; flex-shrink: 0;
            display: flex; align-items: center; gap: 0.375rem;
        }

        .module-desc { color: var(--text-muted); font-size: 0.85rem; margin-top: 0.375rem; }

        .module-progress {
            margin-top: 0.75rem; height: 4px; background: rgba(255,255,255,0.1);
            border-radius: 2px; overflow: hidden;
        }

        .module-progress-fill {
            height: 100%; background: linear-gradient(90deg, var(--success), var(--accent));
            border-radius: 2px;
        }

        @media (max-width: 1024px) { .course-grid { grid-template-columns: 1fr; } }

        /* ── STATS SECTION ── */
        .stats-section { background: var(--bg-card); padding: 6rem 0; position: relative; overflow: hidden; }

        .stats-card {
            position: relative; background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(147,51,234,0.1), rgba(6,182,212,0.1));
            border: 1px solid var(--border-color); border-radius: 24px;
            padding: 3rem 4rem; display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 3rem; text-align: center;
        }

        .stat-item { position: relative; z-index: 1; }

        .stat-icon {
            width: 64px; height: 64px; background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-color); border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem; font-size: 1.5rem; color: var(--primary);
            transition: all 0.4s ease;
        }

        .stat-item:hover .stat-icon {
            transform: scale(1.1) rotate(-5deg); background: var(--primary);
            color: var(--text-primary); box-shadow: 0 10px 30px var(--glow-primary);
        }

        .stat-value {
            font-size: clamp(2rem, 4vw, 3rem); font-weight: 800;
            background: linear-gradient(135deg, var(--text-primary), var(--primary));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        .stat-label { color: var(--text-secondary); font-size: 0.95rem; margin-top: 0.5rem; }

        @media (max-width: 1024px) { .stats-card { grid-template-columns: repeat(2, 1fr); padding: 2rem; } }
        @media (max-width: 640px) { .stats-card { grid-template-columns: 1fr; } }

        /* ── TESTIMONIALS ── */
        .testimonials { background: var(--bg-dark); padding: 8rem 0; overflow: hidden; }

        .testimonials-slider { position: relative; max-width: 100%; overflow: hidden; }

        .reviews-track {
            display: flex; gap: 2rem; animation: scroll-reviews 40s linear infinite;
        }

        .reviews-track:hover { animation-play-state: paused; }

        @keyframes scroll-reviews {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .review-card {
            flex-shrink: 0; width: 400px; background: rgba(30,30,60,0.5);
            border: 1px solid var(--border-color); border-radius: 20px; padding: 2rem;
            transition: all 0.4s ease; position: relative; overflow: hidden;
        }

        .review-card::before {
            content: '"'; position: absolute; top: 1rem; right: 1.5rem;
            font-size: 6rem; font-family: Georgia, serif;
            color: rgba(59,130,246,0.1); line-height: 1;
        }

        .review-card:hover {
            border-color: rgba(59,130,246,0.3); transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }

        .stars { display: flex; gap: 0.25rem; margin-bottom: 1.25rem; }
        .stars i { color: #fbbf24; font-size: 1rem; }

        .review-text {
            color: var(--text-secondary); font-size: 1rem; line-height: 1.7;
            margin-bottom: 1.5rem; position: relative; z-index: 1;
        }

        .review-author {
            display: flex; align-items: center; gap: 1rem; position: relative; z-index: 1;
        }

        .avatar {
            width: 50px; height: 50px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 1rem; color: var(--text-primary); flex-shrink: 0;
        }

        .author-name { font-weight: 600; font-size: 1rem; }
        .author-role { color: var(--text-muted); font-size: 0.85rem; margin-top: 0.125rem; }

        /* ── CTA ── */
        .cta { background: var(--bg-card); padding: 8rem 0; position: relative; overflow: hidden; }

        .cta-bg { position: absolute; inset: 0; }

        .cta-bg-orb { position: absolute; border-radius: 50%; filter: blur(80px); }

        .cta-bg-orb:nth-child(1) {
            width: 400px; height: 400px; top: -100px; left: -100px;
            background: var(--glow-primary); animation: cta-float 10s ease-in-out infinite;
        }

        .cta-bg-orb:nth-child(2) {
            width: 300px; height: 300px; bottom: -100px; right: -100px;
            background: var(--glow-secondary); animation: cta-float 10s ease-in-out infinite reverse;
        }

        @keyframes cta-float { 0%, 100% { transform: translate(0, 0); } 50% { transform: translate(50px, 50px); } }

        .cta-box {
            position: relative;
            background: linear-gradient(135deg, rgba(30,30,60,0.8), rgba(20,20,50,0.8));
            border: 1px solid var(--border-color); border-radius: 32px;
            padding: 5rem; text-align: center; display: flex;
            flex-direction: column; align-items: center; gap: 2rem;
            backdrop-filter: blur(20px); overflow: hidden;
        }

        .cta-icon {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 24px; display: flex; align-items: center; justify-content: center;
            font-size: 2rem; color: var(--text-primary);
            box-shadow: 0 20px 50px var(--glow-primary);
            animation: cta-icon-float 3s ease-in-out infinite; position: relative; z-index: 1;
        }

        @keyframes cta-icon-float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

        .cta-title {
            font-size: clamp(2rem, 4vw, 2.75rem); font-weight: 800;
            position: relative; z-index: 1;
        }

        .cta-desc {
            color: var(--text-secondary); font-size: 1.25rem; max-width: 600px;
            line-height: 1.7; position: relative; z-index: 1;
        }

        .cta-features {
            display: flex; gap: 2rem; flex-wrap: wrap; justify-content: center;
            position: relative; z-index: 1;
        }

        .cta-feature {
            display: flex; align-items: center; gap: 0.5rem;
            color: var(--text-secondary); font-size: 0.95rem;
        }

        .cta-feature i { color: var(--success); }

        @media (max-width: 640px) { .cta-box { padding: 3rem 1.5rem; } }
        @media (max-width: 768px) { .features, .course-section, .testimonials, .cta { padding: 5rem 0; } }
    </style>
@endsection

@section('content')
    <!-- HERO -->
    <section class="hero">
        <div class="hero-bg">
            <div class="hero-gradient-orb"></div>
            <div class="hero-gradient-orb"></div>
            <div class="hero-gradient-orb"></div>
            <div class="hero-gradient-orb"></div>
            <div class="grid-bg"></div>
        </div>

        <div class="hero-inner">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="pulse"></span>
                    Более 150 000 пользователей
                </div>

                <h1 class="hero-title">
                    <span class="word">Онлайн</span>
                    <span class="word">платформа</span>
                    <span class="word">для</span><br>
                    <span class="word gradient-text">изучения</span>
                    <span class="word gradient-text">SQL</span>
                </h1>

                <p class="hero-desc">
                    Интерактивный курс по SQL с нуля. Решайте задачи, практикуйтесь на реальных базах данных и получите сертификат о прохождении курса.
                </p>

                <div class="hero-btns">
                    <a href="{{ url('/course') }}" class="btn-primary">
                        <span>Начать обучение бесплатно</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <button class="btn-outline">
                        <i class="bi bi-play-circle"></i>
                        <span>Смотреть демо</span>
                    </button>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="mini-stat-val">80+</div>
                        <div class="mini-stat-label">SQL задач</div>
                    </div>
                    <div class="hero-stat">
                        <div class="mini-stat-val">30+</div>
                        <div class="mini-stat-label">Уроков</div>
                    </div>
                    <div class="hero-stat">
                        <div class="mini-stat-val">
                            <i class="bi bi-star-fill" style="color:#facc15;font-size:1rem;-webkit-text-fill-color:#facc15"></i>
                            4.9
                        </div>
                        <div class="mini-stat-label">Рейтинг</div>
                    </div>
                </div>
            </div>

            <div class="editor-wrap">
                <div class="editor-glow"></div>
                <div class="editor">
                    <div class="editor-header">
                        <div class="editor-header-left">
                            <div class="traffic-lights">
                                <span class="dot dot-r"></span>
                                <span class="dot dot-y"></span>
                                <span class="dot dot-g"></span>
                            </div>
                            <div class="editor-tabs">
                                <span class="editor-tab active">query.sql</span>
                                <span class="editor-tab inactive">schema.sql</span>
                                <span class="editor-tab inactive">data.sql</span>
                            </div>
                        </div>
                        <div class="editor-actions">
                            <button class="editor-action"><i class="bi bi-gear"></i></button>
                            <button class="editor-action"><i class="bi bi-arrows-fullscreen"></i></button>
                        </div>
                    </div>

                    <div class="editor-code">
                        <div class="code-line">
                            <span class="line-number">1</span>
                            <div class="line-content"><span class="comment">-- Получаем средний балл студентов по курсам</span></div>
                        </div>
                        <div class="code-line">
                            <span class="line-number">2</span>
                            <div class="line-content"><span class="kw">SELECT</span></div>
                        </div>
                        <div class="code-line">
                            <span class="line-number">3</span>
                            <div class="line-content">
                                <span class="indent"></span>
                                <span class="tbl">students</span><span class="op">.</span><span class="col">name</span><span class="op">,</span>
                            </div>
                        </div>
                        <div class="code-line">
                            <span class="line-number">4</span>
                            <div class="line-content">
                                <span class="indent"></span>
                                <span class="tbl">courses</span><span class="op">.</span><span class="col">title</span><span class="op">,</span>
                            </div>
                        </div>
                        <div class="code-line">
                            <span class="line-number">5</span>
                            <div class="line-content">
                                <span class="indent"></span>
                                <span class="fn">AVG</span><span class="op">(</span><span class="col">grade</span><span class="op">)</span>
                                <span class="kw"> AS </span><span class="alias">avg_grade</span>
                            </div>
                        </div>
                        <div class="code-line">
                            <span class="line-number">6</span>
                            <div class="line-content"><span class="kw">FROM</span> <span class="tbl">students</span></div>
                        </div>
                        <div class="code-line">
                            <span class="line-number">7</span>
                            <div class="line-content">
                                <span class="kw">JOIN</span> <span class="tbl">enrollments</span>
                                <span class="kw"> ON </span>
                                <span class="tbl">students</span><span class="op">.</span><span class="col">id</span>
                                <span class="op"> = </span>
                                <span class="tbl">enrollments</span><span class="op">.</span><span class="col">student_id</span>
                            </div>
                        </div>
                        <div class="code-line">
                            <span class="line-number">8</span>
                            <div class="line-content">
                                <span class="kw">JOIN</span> <span class="tbl">courses</span>
                                <span class="kw"> ON </span>
                                <span class="tbl">courses</span><span class="op">.</span><span class="col">id</span>
                                <span class="op"> = </span>
                                <span class="tbl">enrollments</span><span class="op">.</span><span class="col">course_id</span>
                            </div>
                        </div>
                        <div class="code-line">
                            <span class="line-number">9</span>
                            <div class="line-content">
                                <span class="kw">GROUP BY</span>
                                <span class="tbl"> students</span><span class="op">.</span><span class="col">name</span><span class="op">,</span>
                                <span class="tbl"> courses</span><span class="op">.</span><span class="col">title</span><span class="op">;</span>
                                <span class="typing-cursor"></span>
                            </div>
                        </div>
                    </div>

                    <div class="editor-run">
                        <div class="run-info">
                            <span class="run-label"><i class="bi bi-database"></i> PostgreSQL 15</span>
                            <span class="run-status"><i class="bi bi-lightning-charge-fill"></i> Готов</span>
                        </div>
                        <button class="run-btn"><i class="bi bi-play-fill"></i> Выполнить</button>
                    </div>

                    <div class="editor-result">
                        <div class="result-header">
                            <div class="result-ok"><i class="bi bi-check-circle-fill"></i> Результат: 3 строки за 0.042с</div>
                            <span class="result-time"><i class="bi bi-clock"></i> 14:32:05</span>
                        </div>
                        <table class="result-table">
                            <thead><tr><th>name</th><th>title</th><th>avg_grade</th></tr></thead>
                            <tbody>
                            <tr><td>Анна Иванова</td><td>SQL Basics</td><td class="highlight">4.8</td></tr>
                            <tr><td>Дмитрий Петров</td><td>Advanced SQL</td><td class="highlight">4.5</td></tr>
                            <tr><td>Мария Сидорова</td><td>SQL Basics</td><td class="highlight">4.9</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="floating-element" style="top: 5%; right: -5%;">
                    <div class="float-card"><i class="bi bi-check-circle-fill"></i><span>Верное решение!</span></div>
                </div>
                <div class="floating-element" style="top: 35%; right: -15%; animation-delay: -2s;">
                    <div class="float-card"><i class="bi bi-trophy-fill" style="color: #fbbf24;"></i><span>+50 XP</span></div>
                </div>
                <div class="floating-element" style="bottom: 25%; right: -10%; animation-delay: -4s;">
                    <div class="float-card"><i class="bi bi-lightning-charge-fill" style="color: #a855f7;"></i><span>Streak: 7 дней</span></div>
                </div>
            </div>
        </div>

        <div class="hero-wave">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 60L48 55C96 50 192 40 288 45C384 50 480 70 576 77.5C672 85 768 85 864 77.5C960 70 1056 55 1152 50C1248 45 1344 50 1392 52.5L1440 55V120H1392C1344 120 1248 120 1152 120C1056 120 960 120 864 120C768 120 672 120 576 120C480 120 384 120 288 120C192 120 96 120 48 120H0V60Z" fill="#111127"/>
            </svg>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="features section">
        <div class="section-inner">
            <div class="section-header reveal">
                <div class="section-tag"><i class="bi bi-stars"></i> Возможности</div>
                <h2 class="section-title">Всё что нужно для изучения SQL</h2>
                <p class="section-desc">Мы собрали лучшие инструменты для эффективного обучения SQL в одном месте</p>
            </div>

            <div class="features-grid">
                <div class="feature-card reveal" style="transition-delay: 0.1s;">
                    <div class="feature-card-content">
                        <div class="feature-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb); box-shadow: 0 10px 30px rgba(59,130,246,0.3);">
                            <i class="bi bi-book-half"></i>
                        </div>
                        <h3>Интерактивный курс</h3>
                        <p>Пошаговое обучение SQL от основ до продвинутых тем. Каждый урок содержит теорию и практические задания.</p>
                        <a href="{{ url('/course') }}" class="feature-link">Начать курс <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="feature-card reveal" style="transition-delay: 0.2s;">
                    <div class="feature-card-content">
                        <div class="feature-icon" style="background: linear-gradient(135deg, #a855f7, #9333ea); box-shadow: 0 10px 30px rgba(168,85,247,0.3);">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <h3>SQL Тренажёр</h3>
                        <p>Более 80 задач для практики на реальных базах данных. Мгновенная проверка результатов прямо в браузере.</p>
                        <a href="{{ url('/tasks') }}" class="feature-link">К задачам <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="feature-card reveal" style="transition-delay: 0.3s;">
                    <div class="feature-card-content">
                        <div class="feature-icon" style="background: linear-gradient(135deg, #f59e0b, #ea580c); box-shadow: 0 10px 30px rgba(245,158,11,0.3);">
                            <i class="bi bi-award"></i>
                        </div>
                        <h3>Сертификат</h3>
                        <p>Получите сертификат о прохождении курса для подтверждения ваших навыков работы с SQL.</p>
                        <a href="#" class="feature-link">Подробнее <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="feature-card reveal" style="transition-delay: 0.4s;">
                    <div class="feature-card-content">
                        <div class="feature-icon" style="background: linear-gradient(135deg, #22c55e, #059669); box-shadow: 0 10px 30px rgba(34,197,94,0.3);">
                            <i class="bi bi-terminal"></i>
                        </div>
                        <h3>Песочница SQL</h3>
                        <p>Свободная среда для экспериментов с SQL запросами. Создавайте свои таблицы и тестируйте запросы.</p>
                        <a href="{{ url('/sandbox') }}" class="feature-link">Открыть <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="feature-card reveal" style="transition-delay: 0.5s;">
                    <div class="feature-card-content">
                        <div class="feature-icon" style="background: linear-gradient(135deg, #06b6d4, #0d9488); box-shadow: 0 10px 30px rgba(6,182,212,0.3);">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>Сообщество</h3>
                        <p>Обсуждайте задачи, делитесь решениями и помогайте друг другу в нашем сообществе учеников.</p>
                        <a href="#" class="feature-link">Присоединиться <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="feature-card reveal" style="transition-delay: 0.6s;">
                    <div class="feature-card-content">
                        <div class="feature-icon" style="background: linear-gradient(135deg, #ec4899, #e11d48); box-shadow: 0 10px 30px rgba(236,72,153,0.3);">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h3>Рейтинг и прогресс</h3>
                        <p>Отслеживайте свой прогресс, соревнуйтесь с другими участниками и поднимайтесь в рейтинге.</p>
                        <a href="#" class="feature-link">Смотреть рейтинг <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COURSE STRUCTURE -->
    <section class="course-section section">
        <div class="section-inner">
            <div class="course-grid">
                <div class="course-content reveal-left">
                    <div class="section-tag"><i class="bi bi-mortarboard"></i> Программа курса</div>
                    <h2 class="section-title">Структурированный путь обучения</h2>
                    <p>Курс разделён на модули, каждый из которых покрывает определённую тему SQL. Двигайтесь от простого к сложному и закрепляйте знания на практике.</p>

                    <div class="course-features">
                        <div class="course-feature">
                            <div class="course-feature-icon" style="background: rgba(34,197,94,0.2);"><i class="bi bi-check-lg" style="color: #22c55e;"></i></div>
                            <span>Практические задания после каждого урока</span>
                        </div>
                        <div class="course-feature">
                            <div class="course-feature-icon" style="background: rgba(59,130,246,0.2);"><i class="bi bi-play-circle" style="color: #3b82f6;"></i></div>
                            <span>Видео объяснения сложных тем</span>
                        </div>
                        <div class="course-feature">
                            <div class="course-feature-icon" style="background: rgba(147,51,234,0.2);"><i class="bi bi-trophy" style="color: #9333ea;"></i></div>
                            <span>Достижения и награды за прогресс</span>
                        </div>
                    </div>

                    <div>
                        <a href="{{ url('/course') }}" class="btn-primary" style="width: fit-content;">
                            <span>Начать курс</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="modules reveal-right">
                    <div class="module-item done">
                        <div class="module-num done"><i class="bi bi-check-lg" style="font-size: 1.25rem;"></i></div>
                        <div class="module-content">
                            <div class="module-header">
                                <div class="module-title">Основы SQL</div>
                                <div class="module-lessons"><i class="bi bi-journal-text"></i> 6 уроков</div>
                            </div>
                            <div class="module-desc">SELECT, WHERE, ORDER BY, LIMIT</div>
                            <div class="module-progress"><div class="module-progress-fill" style="width: 100%;"></div></div>
                        </div>
                    </div>
                    <div class="module-item done">
                        <div class="module-num done"><i class="bi bi-check-lg" style="font-size: 1.25rem;"></i></div>
                        <div class="module-content">
                            <div class="module-header">
                                <div class="module-title">Фильтрация данных</div>
                                <div class="module-lessons"><i class="bi bi-journal-text"></i> 5 уроков</div>
                            </div>
                            <div class="module-desc">LIKE, IN, BETWEEN, IS NULL</div>
                            <div class="module-progress"><div class="module-progress-fill" style="width: 100%;"></div></div>
                        </div>
                    </div>
                    <div class="module-item current">
                        <div class="module-num current">03</div>
                        <div class="module-content">
                            <div class="module-header">
                                <div class="module-title">Агрегатные функции</div>
                                <div class="module-lessons"><i class="bi bi-journal-text"></i> 5 уроков</div>
                            </div>
                            <div class="module-desc">COUNT, SUM, AVG, MIN, MAX, GROUP BY</div>
                            <div class="module-progress"><div class="module-progress-fill" style="width: 40%;"></div></div>
                        </div>
                    </div>
                    <div class="module-item pending">
                        <div class="module-num pending">04</div>
                        <div class="module-content">
                            <div class="module-header">
                                <div class="module-title">Соединение таблиц</div>
                                <div class="module-lessons"><i class="bi bi-journal-text"></i> 7 уроков</div>
                            </div>
                            <div class="module-desc">JOIN, LEFT JOIN, RIGHT JOIN, CROSS JOIN</div>
                        </div>
                    </div>
                    <div class="module-item pending">
                        <div class="module-num pending">05</div>
                        <div class="module-content">
                            <div class="module-header">
                                <div class="module-title">Подзапросы</div>
                                <div class="module-lessons"><i class="bi bi-journal-text"></i> 4 урока</div>
                            </div>
                            <div class="module-desc">Вложенные запросы, EXISTS, ANY, ALL</div>
                        </div>
                    </div>
                    <div class="module-item pending">
                        <div class="module-num pending">06</div>
                        <div class="module-content">
                            <div class="module-header">
                                <div class="module-title">Продвинутый SQL</div>
                                <div class="module-lessons"><i class="bi bi-journal-text"></i> 6 уроков</div>
                            </div>
                            <div class="module-desc">Оконные функции, CTE, CASE</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <section class="stats-section section">
        <div class="section-inner">
            <div class="stats-card reveal-scale">
                <div class="stat-item">
                    <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                    <div class="stat-value">150,000+</div>
                    <div class="stat-label">Пользователей</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="bi bi-code-slash"></i></div>
                    <div class="stat-value">80+</div>
                    <div class="stat-label">SQL задач</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="bi bi-journal-text"></i></div>
                    <div class="stat-value">30+</div>
                    <div class="stat-label">Интерактивных уроков</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="bi bi-star-fill"></i></div>
                    <div class="stat-value">4.9<span style="font-size: 1rem; opacity: 0.7;">/5</span></div>
                    <div class="stat-label">Средний рейтинг</div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="testimonials section">
        <div class="section-inner">
            <div class="section-header reveal">
                <div class="section-tag"><i class="bi bi-chat-quote"></i> Отзывы</div>
                <h2 class="section-title">Что говорят наши ученики</h2>
                <p class="section-desc">Присоединяйтесь к тысячам студентов, которые уже прошли наш курс</p>
            </div>

            <div class="testimonials-slider">
                <div class="reviews-track">
                    @php
                        $reviews = [
                            ['text' => 'Отличная платформа! Прошёл курс за 2 недели и получил оффер на позицию, где требовался SQL.', 'name' => 'Алексей К.', 'role' => 'Junior Backend Developer', 'letter' => 'А', 'gradient' => 'linear-gradient(135deg, #3b82f6, #2563eb)'],
                            ['text' => 'Наконец-то нашла курс, где SQL объясняется просто и понятно. Тренажёр — это то, что нужно!', 'name' => 'Мария В.', 'role' => 'Аналитик данных', 'letter' => 'М', 'gradient' => 'linear-gradient(135deg, #a855f7, #9333ea)'],
                            ['text' => 'Песочница SQL — просто спасение для учёбы в университете. Можно быстро проверить любой запрос.', 'name' => 'Дмитрий С.', 'role' => 'Студент', 'letter' => 'Д', 'gradient' => 'linear-gradient(135deg, #22c55e, #059669)'],
                            ['text' => 'Лучший бесплатный ресурс для изучения SQL! Практические задания с реальными кейсами из индустрии.', 'name' => 'Елена П.', 'role' => 'Data Scientist', 'letter' => 'Е', 'gradient' => 'linear-gradient(135deg, #f59e0b, #ea580c)'],
                            ['text' => 'Прекрасная структура курса! За месяц освоил SQL на уровне, достаточном для работы.', 'name' => 'Иван М.', 'role' => 'Product Manager', 'letter' => 'И', 'gradient' => 'linear-gradient(135deg, #06b6d4, #0d9488)'],
                            ['text' => 'Сертификат от SQL Academy помог мне пройти собеседование. Рекомендую!', 'name' => 'Ольга Н.', 'role' => 'Business Analyst', 'letter' => 'О', 'gradient' => 'linear-gradient(135deg, #ec4899, #e11d48)'],
                        ];
                    @endphp

                    @for($i = 0; $i < 2; $i++)
                        @foreach($reviews as $review)
                            <div class="review-card">
                                <div class="stars">
                                    @for($s = 0; $s < 5; $s++)<i class="bi bi-star-fill"></i>@endfor
                                </div>
                                <p class="review-text">"{{ $review['text'] }}"</p>
                                <div class="review-author">
                                    <div class="avatar" style="background: {{ $review['gradient'] }};">{{ $review['letter'] }}</div>
                                    <div>
                                        <div class="author-name">{{ $review['name'] }}</div>
                                        <div class="author-role">{{ $review['role'] }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endfor
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta section">
        <div class="cta-bg">
            <div class="cta-bg-orb"></div>
            <div class="cta-bg-orb"></div>
        </div>
        <div class="section-inner">
            <div class="cta-box reveal-scale">
                <div class="cta-icon"><i class="bi bi-rocket-takeoff"></i></div>
                <h2 class="cta-title">Готовы начать изучение SQL?</h2>
                <p class="cta-desc">Присоединяйтесь к более чем 150 000 пользователей. Это абсолютно бесплатно!</p>
                <div class="cta-features">
                    <div class="cta-feature"><i class="bi bi-check-circle-fill"></i><span>Бесплатный доступ</span></div>
                    <div class="cta-feature"><i class="bi bi-check-circle-fill"></i><span>80+ практических задач</span></div>
                    <div class="cta-feature"><i class="bi bi-check-circle-fill"></i><span>Сертификат</span></div>
                    <div class="cta-feature"><i class="bi bi-check-circle-fill"></i><span>Без рекламы</span></div>
                </div>
                <a href="{{ url('/course') }}" class="btn-primary">
                    <span>Создать аккаунт бесплатно</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Hero title word animation
        document.querySelectorAll('.hero-title .word').forEach(function(word, index) {
            word.style.animationDelay = (0.6 + index * 0.1) + 's';
        });
    </script>
@endsection
