<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Подтверждение email — SQL Academy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #3b82f6; --primary-dark: #2563eb; --secondary: #9333ea;
            --accent: #06b6d4; --success: #22c55e; --warning: #f59e0b; --danger: #ef4444;
            --bg-dark: #0a0a1a; --bg-card: #111127;
            --text-primary: #ffffff; --text-secondary: #9ca3af; --text-muted: #6b7280;
            --border-color: rgba(255,255,255,0.1);
            --glow-primary: rgba(59,130,246,0.5); --glow-secondary: rgba(147,51,234,0.5);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-dark); color: var(--text-primary);
            -webkit-font-smoothing: antialiased; min-height: 100vh;
        }

        a { text-decoration: none; color: inherit; }

        .particles { position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
        .particle {
            position: absolute; width: 4px; height: 4px; background: var(--primary);
            border-radius: 50%; opacity: 0.3; animation: float-particle linear infinite;
        }
        @keyframes float-particle {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.3; } 90% { opacity: 0.3; }
            100% { transform: translateY(-100vh) rotate(720deg); opacity: 0; }
        }

        .auth-layout {
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            padding: 2rem 1rem; position: relative; z-index: 1;
        }

        .auth-wrapper { width: 100%; max-width: 480px; }

        .auth-logo {
            display: flex; align-items: center; justify-content: center;
            gap: 0.75rem; margin-bottom: 2rem;
        }

        .auth-logo-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 25px var(--glow-primary);
        }

        .auth-logo-text { font-weight: 800; font-size: 1.4rem; letter-spacing: -0.02em; }
        .auth-logo-text span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        .auth-card {
            background: var(--bg-card); border: 1px solid var(--border-color);
            border-radius: 24px; padding: 2.5rem; position: relative; overflow: hidden;
        }

        .auth-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent), var(--success));
        }

        .auth-header { text-align: center; margin-bottom: 1.5rem; }

        .auth-icon {
            width: 72px; height: 72px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 20px; display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 1.25rem;
            box-shadow: 0 10px 30px var(--glow-primary);
            animation: pulse-glow 3s ease-in-out infinite;
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 10px 30px var(--glow-primary); }
            50% { box-shadow: 0 15px 40px rgba(6,182,212,0.4); }
        }

        .auth-icon i { font-size: 1.75rem; color: white; }
        .auth-header h1 { font-size: 1.5rem; font-weight: 800; letter-spacing: -0.03em; margin-bottom: 0.5rem; }

        .auth-desc {
            color: var(--text-muted); font-size: 0.875rem; line-height: 1.7;
            margin-bottom: 1.5rem; text-align: center;
        }

        .auth-status-success {
            background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.2);
            color: var(--success); padding: 0.875rem 1rem; border-radius: 12px;
            font-size: 0.85rem; margin-bottom: 1.5rem;
            display: flex; align-items: flex-start; gap: 0.625rem; line-height: 1.5;
        }

        .auth-status-success i { font-size: 1.1rem; flex-shrink: 0; margin-top: 0.1rem; }

        .auth-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .auth-submit {
            padding: 0.85rem 1.75rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--text-primary); border: none; border-radius: 14px;
            font-size: 0.9rem; font-weight: 700; font-family: inherit; cursor: pointer;
            transition: all 0.3s ease; position: relative; overflow: hidden;
            box-shadow: 0 8px 25px var(--glow-primary);
            display: inline-flex; align-items: center; gap: 0.5rem;
        }

        .auth-submit::before {
            content: ''; position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .auth-submit:hover { transform: translateY(-3px); box-shadow: 0 15px 40px var(--glow-primary); }
        .auth-submit:hover::before { left: 100%; }

        .auth-logout {
            padding: 0.85rem 1.5rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            color: var(--text-secondary);
            font-size: 0.9rem; font-weight: 500; font-family: inherit; cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex; align-items: center; gap: 0.5rem;
        }

        .auth-logout:hover {
            color: var(--danger);
            border-color: rgba(239,68,68,0.3);
            background: rgba(239,68,68,0.05);
        }

        .auth-back { text-align: center; margin-top: 1.5rem; }
        .auth-back a { font-size: 0.85rem; color: var(--text-muted); display: inline-flex; align-items: center; gap: 0.375rem; transition: all 0.3s ease; }
        .auth-back a:hover { color: var(--text-primary); }
        .auth-back a i { transition: transform 0.3s ease; }
        .auth-back a:hover i { transform: translateX(-3px); }

        /* ── Email animation ── */
        .email-anim {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .email-anim-envelope {
            position: relative;
            animation: envelope-float 3s ease-in-out infinite;
        }

        @keyframes envelope-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @media (max-width: 480px) {
            .auth-card { padding: 1.75rem 1.25rem; border-radius: 18px; }
            .auth-header h1 { font-size: 1.35rem; }
            .auth-actions { flex-direction: column; }
            .auth-submit, .auth-logout { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

<div class="particles" id="particles"></div>

<div class="auth-layout">
    <div class="auth-wrapper">

        <a href="{{ url('/') }}" class="auth-logo">
            <div class="auth-logo-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/><path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/>
                </svg>
            </div>
            <div class="auth-logo-text">SQL<span>Academy</span></div>
        </a>

        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="bi bi-envelope-check-fill"></i>
                </div>
                <h1>Проверьте вашу почту</h1>
            </div>

            <div class="auth-desc">
                Спасибо за регистрацию! Мы отправили вам письмо со ссылкой для подтверждения email.
                Если вы не получили письмо, мы с удовольствием отправим вам другое.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="auth-status-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Новая ссылка для подтверждения была отправлена на email, указанный при регистрации.</span>
                </div>
            @endif

            <div class="auth-actions">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="auth-submit">
                        <i class="bi bi-arrow-repeat"></i> Отправить повторно
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="auth-logout">
                        <i class="bi bi-box-arrow-right"></i> Выйти
                    </button>
                </form>
            </div>
        </div>

        <div class="auth-back">
            <a href="{{ url('/') }}"><i class="bi bi-arrow-left"></i> Вернуться на главную</a>
        </div>
    </div>
</div>

<script>
    (function() {
        var c = document.getElementById('particles');
        for (var i = 0; i < 25; i++) {
            var p = document.createElement('div');
            p.className = 'particle';
            p.style.left = Math.random() * 100 + '%';
            p.style.animationDuration = (Math.random() * 20 + 10) + 's';
            p.style.animationDelay = (Math.random() * 20) + 's';
            p.style.width = (Math.random() * 4 + 2) + 'px';
            p.style.height = p.style.width;
            c.appendChild(p);
        }
    })();
</script>
</body>
</html>
