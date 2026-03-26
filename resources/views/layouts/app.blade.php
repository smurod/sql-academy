<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

/home/smurod_8880/projects/laravel_ex1/resources/views/public/layouts/app.blade.php:
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SQL Academy — Онлайн платформа для изучения SQL')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ── FULL-HEIGHT PAGES (sandbox, tasks/show, course/show) ── */
        .page-content.full-height {
            padding-top: 72px;
        }

        /* Для обычных страниц с footer — плавный переход */
        .page-content > .section:first-child,
        .page-content > div:first-child {
            position: relative;
        }

        /* Разделитель между full-height контентом и footer */
        .page-footer-separator {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-color), transparent);
        }

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
            --glow-primary: rgba(59, 130, 246, 0.5);
            --glow-secondary: rgba(147, 51, 234, 0.5);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        a { text-decoration: none; cursor: pointer; }
        button { cursor: pointer; }

        /* ── LOADING SCREEN ── */
        .loading-screen {
            position: fixed; inset: 0; background: var(--bg-dark); z-index: 10000;
            display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 2rem;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        .loading-screen.hidden { opacity: 0; visibility: hidden; pointer-events: none; }
        .loader { position: relative; width: 120px; height: 120px; }
        .loader-ring { position: absolute; inset: 0; border: 3px solid transparent; border-radius: 50%; }
        .loader-ring:nth-child(1) { border-top-color: var(--primary); animation: spin 1s linear infinite; }
        .loader-ring:nth-child(2) { inset: 10px; border-right-color: var(--secondary); animation: spin 1.5s linear infinite reverse; }
        .loader-ring:nth-child(3) { inset: 20px; border-bottom-color: var(--accent); animation: spin 2s linear infinite; }
        .loader-logo {
            position: absolute; inset: 35px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            animation: pulse-glow 2s ease-in-out infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px var(--glow-primary); }
            50% { box-shadow: 0 0 40px var(--glow-secondary); }
        }
        .loading-text {
            font-size: 1.25rem; font-weight: 600;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
            background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; animation: gradient-shift 2s linear infinite;
        }
        @keyframes gradient-shift { to { background-position: 200% center; } }
        .loading-bar { width: 200px; height: 4px; background: rgba(255,255,255,0.1); border-radius: 2px; overflow: hidden; }
        .loading-bar-fill {
            height: 100%; background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
            border-radius: 2px; animation: loading-progress 2s ease-in-out forwards;
        }
        @keyframes loading-progress { 0% { width: 0%; } 50% { width: 70%; } 100% { width: 100%; } }

        /* ── SCROLL PROGRESS BAR ── */
        .scroll-progress {
            position: fixed; top: 0; left: 0; width: 0%; height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
            z-index: 1000; transition: width 0.1s ease;
        }

        /* ── PARTICLES ── */
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

        /* ── NAVBAR ── */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            background: rgba(10, 10, 26, 0.8); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color); transition: all 0.3s ease;
        }
        .navbar.scrolled { background: rgba(10, 10, 26, 0.95); box-shadow: 0 10px 40px rgba(0,0,0,0.3); }
        .nav-inner {
            max-width: 1400px; margin: 0 auto; padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between; height: 72px;
        }
        .nav-logo { display: flex; align-items: center; gap: 0.75rem; position: relative; }
        .nav-logo-icon {
            width: 44px; height: 44px; background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; position: relative; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .nav-logo-icon::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255,255,255,0.2));
            transform: translateX(-100%); transition: transform 0.5s ease;
        }
        .nav-logo:hover .nav-logo-icon { transform: scale(1.05) rotate(-5deg); box-shadow: 0 8px 25px var(--glow-primary); }
        .nav-logo:hover .nav-logo-icon::before { transform: translateX(100%); }
        .nav-logo-text { color: var(--text-primary); font-weight: 800; font-size: 1.4rem; letter-spacing: -0.02em; }
        .nav-logo-text span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .nav-links { display: flex; align-items: center; gap: 0.5rem; }
        .nav-link {
            position: relative; display: flex; align-items: center; gap: 0.5rem;
            padding: 0.625rem 1.25rem; border-radius: 12px; font-size: 0.9rem;
            font-weight: 500; color: var(--text-secondary); transition: all 0.3s ease; overflow: hidden;
        }
        .nav-link::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            opacity: 0; transition: opacity 0.3s ease;
        }
        .nav-link span, .nav-link i { position: relative; z-index: 1; }
        .nav-link i { transition: transform 0.3s ease; }
        .nav-link:hover { color: var(--text-primary); }
        .nav-link:hover::before { opacity: 0.15; }
        .nav-link:hover i { transform: scale(1.2); }
        .nav-link.active { color: var(--primary); background: rgba(59, 130, 246, 0.1); }
        .nav-link.active::after {
            content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);
            width: 20px; height: 3px; background: var(--primary); border-radius: 3px 3px 0 0;
        }
        .nav-right { display: flex; align-items: center; gap: 1rem; }
        .nav-icon-btn {
            background: rgba(255,255,255,0.05); border: 1px solid var(--border-color);
            color: var(--text-secondary); padding: 0.625rem; border-radius: 12px;
            font-size: 1.1rem; transition: all 0.3s ease; position: relative; overflow: hidden;
        }
        .nav-icon-btn:hover { color: var(--text-primary); border-color: var(--primary); box-shadow: 0 0 20px var(--glow-primary); }
        .btn-login {
            position: relative; background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--text-primary); border: none; padding: 0.625rem 1.5rem; border-radius: 12px;
            font-size: 0.9rem; font-weight: 600; transition: all 0.3s ease; overflow: hidden;
        }
        .btn-login::before {
            content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 10px 30px var(--glow-primary); }
        .btn-login:hover::before { left: 100%; }
        .burger { display: none; background: none; border: none; color: var(--text-primary); font-size: 1.5rem; padding: 0.5rem; }
        .mobile-menu {
            display: none; padding: 1.5rem; border-top: 1px solid var(--border-color);
            flex-direction: column; gap: 0.5rem; background: rgba(10,10,26,0.98); animation: slideDown 0.3s ease;
        }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .mobile-menu.open { display: flex; }
        .mobile-link {
            display: flex; align-items: center; gap: 1rem; padding: 1rem 1.25rem; border-radius: 12px;
            font-size: 1rem; font-weight: 500; color: var(--text-secondary); transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        .mobile-link:hover { background: rgba(255,255,255,0.05); color: var(--text-primary); border-color: var(--border-color); }
        .mobile-link.active { background: rgba(59,130,246,0.1); color: var(--primary); border-color: rgba(59,130,246,0.2); }
        .mobile-login {
            margin-top: 1rem; width: 100%; background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--text-primary); border: none; padding: 1rem; border-radius: 12px;
            font-size: 1rem; font-weight: 600; transition: all 0.3s ease;
        }
        .mobile-login:hover { box-shadow: 0 10px 30px var(--glow-primary); }
        @media (max-width: 1024px) {
            .nav-links, .nav-right { display: none; }
            .burger { display: block; }
        }

        /* ── SECTIONS COMMON ── */
        .section { position: relative; z-index: 1; }
        .section-inner { max-width: 1400px; margin: 0 auto; padding: 0 2rem; }
        .section-header { text-align: center; margin-bottom: 4rem; }
        .section-tag {
            display: inline-flex; align-items: center; gap: 0.5rem; color: var(--primary);
            font-weight: 600; font-size: 0.875rem; letter-spacing: 0.15em; text-transform: uppercase;
            padding: 0.5rem 1rem; background: rgba(59,130,246,0.1); border-radius: 9999px; margin-bottom: 1rem;
        }
        .section-title { font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; margin-top: 1rem; letter-spacing: -0.02em; }
        .section-desc {
            color: var(--text-secondary); font-size: 1.125rem; max-width: 680px;
            margin: 1.25rem auto 0; line-height: 1.7;
        }

        /* ── REVEAL ANIMATIONS ── */
        .reveal { opacity: 0; transform: translateY(60px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-60px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal-left.revealed { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(60px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal-right.revealed { opacity: 1; transform: translateX(0); }
        .reveal-scale { opacity: 0; transform: scale(0.9); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal-scale.revealed { opacity: 1; transform: scale(1); }

        /* ── BUTTONS COMMON ── */
        .btn-primary {
            position: relative; background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--text-primary); border: none; padding: 1rem 2rem; border-radius: 14px;
            font-size: 1rem; font-weight: 600; box-shadow: 0 10px 40px var(--glow-primary);
            transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.625rem; overflow: hidden;
        }
        .btn-primary::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--secondary), var(--accent));
            opacity: 0; transition: opacity 0.3s ease;
        }
        .btn-primary span, .btn-primary i { position: relative; z-index: 1; }
        .btn-primary i { transition: transform 0.3s ease; }
        .btn-primary:hover { transform: translateY(-4px); box-shadow: 0 20px 60px var(--glow-primary); }
        .btn-primary:hover::before { opacity: 1; }
        .btn-primary:hover i { transform: translateX(4px); }
        .btn-primary::after {
            content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 3s infinite;
        }
        @keyframes shimmer { 0% { left: -100%; } 50%, 100% { left: 100%; } }

        .btn-outline {
            position: relative; background: transparent; color: var(--text-primary);
            border: 2px solid var(--border-color); padding: 1rem 2rem; border-radius: 14px;
            font-size: 1rem; font-weight: 600; transition: all 0.3s ease;
            display: inline-flex; align-items: center; gap: 0.625rem; overflow: hidden;
        }
        .btn-outline::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            opacity: 0; transition: opacity 0.3s ease;
        }
        .btn-outline span, .btn-outline i { position: relative; z-index: 1; }
        .btn-outline:hover { border-color: transparent; transform: translateY(-4px); box-shadow: 0 20px 60px rgba(147,51,234,0.3); }
        .btn-outline:hover::before { opacity: 1; }

        /* ── FOOTER ── */
        .footer { background: #050510; border-top: 1px solid var(--border-color); padding: 5rem 0 2rem; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 3rem; margin-bottom: 4rem; }
        .footer-brand > p { color: var(--text-muted); font-size: 0.95rem; line-height: 1.7; margin-top: 1.25rem; max-width: 300px; }
        .social-links { display: flex; gap: 0.75rem; margin-top: 1.5rem; }
        .social-link {
            width: 44px; height: 44px; background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-color); border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-secondary); font-size: 1.1rem; transition: all 0.3s ease;
        }
        .social-link:hover {
            background: var(--primary); border-color: var(--primary); color: var(--text-primary);
            transform: translateY(-4px); box-shadow: 0 10px 25px var(--glow-primary);
        }
        .footer-col h4 { color: var(--text-primary); font-weight: 600; font-size: 1rem; margin-bottom: 1.5rem; }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 0.875rem; }
        .footer-col ul li a { color: var(--text-muted); font-size: 0.95rem; transition: all 0.3s ease; }
        .footer-col ul li a:hover { color: var(--text-primary); padding-left: 8px; }
        .footer-bottom {
            border-top: 1px solid var(--border-color); padding-top: 2rem;
            display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;
        }
        .footer-bottom p { color: var(--text-muted); font-size: 0.9rem; display: flex; align-items: center; gap: 0.375rem; }
        .footer-bottom p .heart { color: var(--danger); animation: heartbeat 1.5s ease-in-out infinite; }
        @keyframes heartbeat { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.2); } }
        @media (max-width: 1024px) { .footer-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) {
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }

        /* ── SCROLL TO TOP ── */
        .scroll-top {
            position: fixed; bottom: 2rem; right: 2rem; width: 56px; height: 56px;
            background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none;
            border-radius: 50%; color: var(--text-primary); font-size: 1.25rem;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden; transform: translateY(20px) scale(0.8);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); z-index: 99;
            box-shadow: 0 10px 30px var(--glow-primary);
        }
        .scroll-top.visible { opacity: 1; visibility: visible; transform: translateY(0) scale(1); }
        .scroll-top:hover { transform: translateY(-4px) scale(1.1); box-shadow: 0 15px 40px var(--glow-primary); }

        /* ── GRADIENT TEXT ── */
        .gradient-text {
            background: linear-gradient(135deg, var(--primary), var(--accent), var(--secondary));
            background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; animation: gradient-text-move 5s linear infinite;
        }
        @keyframes gradient-text-move { to { background-position: 200% center; } }

        /* ── PAGE CONTENT AREA ── */
        .page-content { padding-top: 72px; min-height: 100vh; position: relative; z-index: 1; }

        @media (max-width: 768px) {
            .section-inner { padding: 0 1.5rem; }
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- Loading Screen
<div class="loading-screen" id="loadingScreen">
    <div class="loader">
        <div class="loader-ring"></div>
        <div class="loader-ring"></div>
        <div class="loader-ring"></div>
        <div class="loader-logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <ellipse cx="12" cy="5" rx="9" ry="3"/>
                <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/>
                <path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/>
            </svg>
        </div>
    </div>
    <div class="loading-text">SQL Academy</div>
    <div class="loading-bar"><div class="loading-bar-fill"></div></div>
</div>
-->

<!-- Scroll Progress -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- Particles -->
<div class="particles" id="particles"></div>

@include('public.layouts.header')

<div class="page-content @yield('page-class')">
    @yield('content')
</div>

@include('public.layouts.footer')

<!-- Scroll to Top -->
<button class="scroll-top" id="scrollTop" aria-label="Scroll to top">
    <i class="bi bi-arrow-up"></i>
</button>

<script>
    // Loading Screen
    window.addEventListener('load', function() {
        setTimeout(function() {
            document.getElementById('loadingScreen').classList.add('hidden');
        }, 2500);
    });

    // Particles
    (function() {
        var c = document.getElementById('particles');
        for (var i = 0; i < 40; i++) {
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

    // Scroll handlers
    window.addEventListener('scroll', function() {
        var st = document.documentElement.scrollTop;
        var sh = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        document.getElementById('scrollProgress').style.width = (st / sh) * 100 + '%';

        var navbar = document.getElementById('navbar');
        navbar.classList.toggle('scrolled', st > 50);

        document.getElementById('scrollTop').classList.toggle('visible', st > 500);
    });

    document.getElementById('scrollTop').addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Burger
    var burger = document.getElementById('burgerBtn');
    var menu = document.getElementById('mobileMenu');
    burger.addEventListener('click', function() {
        menu.classList.toggle('open');
        burger.querySelector('i').className = menu.classList.contains('open') ? 'bi bi-x-lg' : 'bi bi-list';
    });

    // Reveal
    var els = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
    function revealOnScroll() {
        els.forEach(function(el) {
            if (el.getBoundingClientRect().top < window.innerHeight - 150) el.classList.add('revealed');
        });
    }
    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll();
</script>
@yield('scripts')
</body>
</html>
это resources/views/public/layouts/app.blade.php
3.Все кнопки оставить менять только стил и ничего больше
2.Просто заменить blade файлы с изменеными стилями
а ответ на первый вопрос таков:
/home/smurod_8880/projects/laravel_ex1/resources/views/auth/confirm-password.blade.php:
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
/home/smurod_8880/projects/laravel_ex1/resources/views/auth/forgot-password.blade.php:
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

/home/smurod_8880/projects/laravel_ex1/resources/views/auth/reset-password.blade.php:
<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
/home/smurod_8880/projects/laravel_ex1/resources/views/auth/verify-email.blade.php:
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>

/home/smurod_8880/projects/laravel_ex1/resources/views/layouts/app.blade.php:
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
</body>
</html>
/home/smurod_8880/projects/laravel_ex1/resources/views/layouts/guest.blade.php:
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
</body>
</html>
/home/smurod_8880/projects/laravel_ex1/resources/views/layouts/navigation.blade.php:
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
переписать все файлы со стилями других странриц мокго аналога sql-academy не меняя функционал
