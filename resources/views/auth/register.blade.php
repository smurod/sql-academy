<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Регистрация — SQL Academy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

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
            --bg-elevated: #1a1a35;
            --text-primary: #ffffff;
            --text-secondary: #9ca3af;
            --text-muted: #6b7280;
            --border-color: rgba(255,255,255,0.1);
            --glow-primary: rgba(59,130,246,0.5);
            --glow-secondary: rgba(147,51,234,0.5);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            min-height: 100vh;
        }

        a { text-decoration: none; color: inherit; }

        .particles {
            position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden;
        }

        .particle {
            position: absolute; width: 4px; height: 4px; background: var(--secondary);
            border-radius: 50%; opacity: 0.3; animation: float-particle linear infinite;
        }

        @keyframes float-particle {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.3; } 90% { opacity: 0.3; }
            100% { transform: translateY(-100vh) rotate(720deg); opacity: 0; }
        }

        .auth-layout {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            z-index: 1;
        }

        .auth-wrapper { width: 100%; max-width: 480px; }

        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .auth-logo-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 25px var(--glow-primary);
        }

        .auth-logo-text { font-weight: 800; font-size: 1.4rem; letter-spacing: -0.02em; }

        .auth-logo-text span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        .auth-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary), var(--primary), var(--accent));
        }

        .auth-header { text-align: center; margin-bottom: 2rem; }

        .auth-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            border-radius: 18px;
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 1.25rem;
            box-shadow: 0 10px 30px var(--glow-secondary);
            animation: pulse-glow 3s ease-in-out infinite;
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 10px 30px var(--glow-primary); }
            50% { box-shadow: 0 15px 40px var(--glow-secondary); }
        }

        .auth-icon i { font-size: 1.5rem; color: white; }

        .auth-header h1 { font-size: 1.75rem; font-weight: 800; letter-spacing: -0.03em; margin-bottom: 0.5rem; }
        .auth-header p { color: var(--text-muted); font-size: 0.9rem; }

        .auth-form { display: flex; flex-direction: column; gap: 1.25rem; }

        .form-group { display: flex; flex-direction: column; gap: 0.5rem; }

        .form-label { font-size: 0.85rem; font-weight: 600; color: var(--text-secondary); letter-spacing: 0.02em; }

        .form-input {
            width: 100%; padding: 0.8rem 1rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input::placeholder { color: var(--text-muted); }

        .form-input:focus {
            border-color: var(--primary);
            background: rgba(59,130,246,0.05);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }

        .form-input.error { border-color: var(--danger); background: rgba(239,68,68,0.05); }
        .form-input.error:focus { box-shadow: 0 0 0 3px rgba(239,68,68,0.1); }

        .form-error { font-size: 0.78rem; color: var(--danger); display: flex; align-items: center; gap: 0.375rem; }
        .form-error i { font-size: 0.85rem; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .auth-submit {
            width: 100%; padding: 0.9rem;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: var(--text-primary);
            border: none; border-radius: 14px;
            font-size: 0.95rem; font-weight: 700; font-family: inherit;
            cursor: pointer; transition: all 0.3s ease;
            position: relative; overflow: hidden;
            box-shadow: 0 8px 25px var(--glow-secondary);
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            margin-top: 0.25rem;
        }

        .auth-submit::before {
            content: '';
            position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .auth-submit:hover { transform: translateY(-3px); box-shadow: 0 15px 40px var(--glow-secondary); }
        .auth-submit:hover::before { left: 100%; }
        .auth-submit:active { transform: translateY(-1px); }

        .auth-divider { display: flex; align-items: center; gap: 1rem; margin: 0.5rem 0; }
        .auth-divider::before, .auth-divider::after { content: ''; flex: 1; height: 1px; background: var(--border-color); }
        .auth-divider span { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.08em; font-weight: 500; }

        .auth-socials { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }

        .social-btn {
            display: flex; align-items: center; justify-content: center; gap: 0.625rem;
            padding: 0.8rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 0.85rem; font-weight: 500; font-family: inherit;
            transition: all 0.3s ease; cursor: pointer;
        }

        .social-btn:hover {
            border-color: rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.08);
            transform: translateY(-2px);
        }

        .social-btn img { width: 20px; height: 20px; }

        .social-btn.google:hover { border-color: rgba(234,67,53,0.3); box-shadow: 0 4px 15px rgba(234,67,53,0.15); }
        .social-btn.github:hover { border-color: rgba(255,255,255,0.3); box-shadow: 0 4px 15px rgba(255,255,255,0.1); }

        .auth-footer { text-align: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); }
        .auth-footer p { font-size: 0.85rem; color: var(--text-muted); }
        .auth-footer a { color: var(--primary); font-weight: 600; transition: all 0.3s ease; }
        .auth-footer a:hover { color: var(--accent); text-decoration: underline; }

        .auth-back { text-align: center; margin-top: 1.5rem; }
        .auth-back a { font-size: 0.85rem; color: var(--text-muted); display: inline-flex; align-items: center; gap: 0.375rem; transition: all 0.3s ease; }
        .auth-back a:hover { color: var(--text-primary); }
        .auth-back a i { transition: transform 0.3s ease; }
        .auth-back a:hover i { transform: translateX(-3px); }

        /* Password Strength */
        .password-strength { display: flex; gap: 0.25rem; margin-top: 0.25rem; }
        .strength-bar { flex: 1; height: 3px; border-radius: 2px; background: rgba(255,255,255,0.08); transition: all 0.3s ease; }
        .strength-bar.active.weak { background: var(--danger); }
        .strength-bar.active.medium { background: var(--warning); }
        .strength-bar.active.strong { background: var(--success); }
        .strength-text { font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem; transition: color 0.3s ease; }

        @media (max-width: 480px) {
            .auth-card { padding: 1.75rem 1.25rem; border-radius: 18px; }
            .auth-header h1 { font-size: 1.5rem; }
            .form-row { grid-template-columns: 1fr; }
            .auth-socials { grid-template-columns: 1fr; }
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
                    <ellipse cx="12" cy="5" rx="9" ry="3"/>
                    <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/>
                    <path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/>
                </svg>
            </div>
            <div class="auth-logo-text">SQL<span>Academy</span></div>
        </a>

        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h1>Создать аккаунт</h1>
                <p>Начните изучение SQL бесплатно</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Имя</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                           class="form-input @error('name') error @enderror"
                           placeholder="Ваше имя" required autofocus autocomplete="name">
                    @error('name')
                    <div class="form-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           class="form-input @error('email') error @enderror"
                           placeholder="you@example.com" required autocomplete="username">
                    @error('email')
                    <div class="form-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">Пароль</label>
                        <input id="password" type="password" name="password"
                               class="form-input @error('password') error @enderror"
                               placeholder="••••••••" required autocomplete="new-password">
                        @error('password')
                        <div class="form-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <div class="password-strength">
                            <div class="strength-bar" id="str1"></div>
                            <div class="strength-bar" id="str2"></div>
                            <div class="strength-bar" id="str3"></div>
                            <div class="strength-bar" id="str4"></div>
                        </div>
                        <div class="strength-text" id="strengthText"></div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Подтверждение</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               class="form-input" placeholder="••••••••" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="auth-submit">
                    <i class="bi bi-rocket-takeoff-fill"></i> Зарегистрироваться
                </button>
            </form>

            <div class="auth-divider"><span>или</span></div>

            <div class="auth-socials">
                <a href="{{ url('auth/google') }}" class="social-btn google">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google"> Google
                </a>
                <a href="{{ url('auth/github') }}" class="social-btn github">
                    <img src="https://www.svgrepo.com/show/361509/github-logo.svg" alt="GitHub"> GitHub
                </a>
            </div>

            <div class="auth-footer">
                <p>Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
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
        for (var i = 0; i < 30; i++) {
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

    // Password strength
    var pwd = document.getElementById('password');
    var bars = [document.getElementById('str1'), document.getElementById('str2'), document.getElementById('str3'), document.getElementById('str4')];
    var stxt = document.getElementById('strengthText');

    if (pwd) {
        pwd.addEventListener('input', function() {
            var v = this.value, s = 0;
            if (v.length >= 4) s++;
            if (v.length >= 8) s++;
            if (/[A-Z]/.test(v) && /[a-z]/.test(v)) s++;
            if (/[0-9]/.test(v) && /[^A-Za-z0-9]/.test(v)) s++;

            var lvl = ['', 'weak', 'medium', 'medium', 'strong'];
            var txt = ['', 'Слабый', 'Средний', 'Хороший', 'Надёжный'];
            var col = ['', 'var(--danger)', 'var(--warning)', 'var(--warning)', 'var(--success)'];

            bars.forEach(function(b, i) {
                b.className = 'strength-bar';
                if (i < s) { b.classList.add('active', lvl[s]); }
            });

            stxt.textContent = v.length > 0 ? txt[s] : '';
            stxt.style.color = col[s] || 'var(--text-muted)';
        });
    }
</script>
</body>
</html>
