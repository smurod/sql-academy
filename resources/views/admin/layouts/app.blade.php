<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SQLMastery Admin')</title>

    <script>
        (function () {
            const savedTheme = localStorage.getItem('admin-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="{{ asset('assets/admin/dist/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/tinymce/tinymce.min.js') }}"></script>

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

            --sidebar-width: 300px;
            --sidebar-collapsed-width: 92px;
            --header-height: 78px;
        }

        body {
            --bg-dark: #0a0a1a;
            --bg-card: #111127;
            --bg-elevated: #171731;
            --bg-soft: rgba(255,255,255,0.03);

            --text-primary: #ffffff;
            --text-secondary: #9ca3af;
            --text-muted: #6b7280;

            --border-color: rgba(255,255,255,0.08);
            --border-strong: rgba(255,255,255,0.14);

            --panel-bg: rgba(17,17,39,0.82);
            --header-bg: rgba(10,10,26,0.78);
            --sidebar-bg: rgba(10,10,26,0.92);
            --dropdown-bg: rgba(17,17,39,0.96);
            --footer-bg: #050510;

            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(59,130,246,0.10), transparent 28%),
                radial-gradient(circle at top right, rgba(147,51,234,0.10), transparent 24%),
                radial-gradient(circle at bottom center, rgba(6,182,212,0.07), transparent 24%),
                var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        html[data-theme="light"] body {
            --bg-dark: #f4f7fb;
            --bg-card: #ffffff;
            --bg-elevated: #eef4ff;
            --bg-soft: rgba(15,23,42,0.04);

            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #64748b;

            --border-color: rgba(15,23,42,0.08);
            --border-strong: rgba(15,23,42,0.14);

            --panel-bg: rgba(255,255,255,0.92);
            --header-bg: rgba(255,255,255,0.86);
            --sidebar-bg: rgba(255,255,255,0.92);
            --dropdown-bg: rgba(255,255,255,0.98);
            --footer-bg: #eaf1f8;

            background:
                radial-gradient(circle at top left, rgba(59,130,246,0.10), transparent 28%),
                radial-gradient(circle at top right, rgba(147,51,234,0.08), transparent 24%),
                radial-gradient(circle at bottom center, rgba(6,182,212,0.06), transparent 24%),
                #f4f7fb;
        }

        a { text-decoration: none; color: inherit; }
        button, input, textarea, select { font-family: inherit; }

        .admin-layout {
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
            min-height: 100vh;
            transition: grid-template-columns .3s ease;
        }

        .admin-layout.sidebar-collapsed {
            grid-template-columns: var(--sidebar-collapsed-width) 1fr;
        }

        .admin-main {
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .admin-content {
            flex: 1;
            padding: 1.7rem;
        }

        .admin-page-header {
            margin-bottom: 1.25rem;
        }

        .admin-breadcrumbs {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            color: var(--text-secondary);
            font-size: .86rem;
            margin-bottom: .8rem;
        }

        .admin-breadcrumbs i {
            font-size: .72rem;
            opacity: .7;
        }

        .admin-page-title {
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1.05;
        }

        .admin-page-title span {
            background: linear-gradient(135deg, var(--primary), var(--accent), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .admin-page-subtitle {
            color: var(--text-secondary);
            line-height: 1.75;
            max-width: 820px;
            font-size: 1rem;
            margin-top: .8rem;
        }

        @media (max-width: 1100px) {
            .admin-layout,
            .admin-layout.sidebar-collapsed {
                grid-template-columns: 1fr;
            }

            .admin-content {
                padding: 1rem;
            }
        }
    </style>

    @yield('styles')
</head>
<body>
<div class="admin-layout" id="adminLayout">
    @include('admin.layouts.sidebar')

    <div class="admin-main">
        @include('admin.layouts.header')

        <main class="admin-content">
            <div class="admin-page-header">
                @hasSection('page-header')
                    @yield('page-header')
                @else
                    <div>
                        <div class="admin-breadcrumbs">
                            <span>Админка</span>
                            <i class="bi bi-chevron-right"></i>
                            <span>Панель управления</span>
                        </div>
                        <h1 class="admin-page-title">SQL<span>Mastery</span> Admin</h1>
                        <p class="admin-page-subtitle">
                            Управление курсами, уроками, задачами и платформой.
                        </p>
                    </div>
                @endif
            </div>

            @yield('content')
        </main>

        @include('admin.layouts.footer')
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const layout = document.getElementById('adminLayout');
        const sidebar = document.getElementById('adminSidebar');
        const sidebarToggle = document.getElementById('adminSidebarToggle');

        const savedSidebarState = localStorage.getItem('admin-sidebar-collapsed');
        if (window.innerWidth > 1100 && savedSidebarState === 'true') {
            layout.classList.add('sidebar-collapsed');
        }

        if (sidebarToggle && layout && sidebar) {
            sidebarToggle.addEventListener('click', function (e) {
                e.stopPropagation();

                if (window.innerWidth <= 1100) {
                    sidebar.classList.toggle('mobile-open');
                } else {
                    layout.classList.toggle('sidebar-collapsed');
                    localStorage.setItem(
                        'admin-sidebar-collapsed',
                        layout.classList.contains('sidebar-collapsed')
                    );
                }
            });
        }

        document.addEventListener('click', function (e) {
            if (
                window.innerWidth <= 1100 &&
                sidebar &&
                sidebar.classList.contains('mobile-open') &&
                !sidebar.contains(e.target) &&
                (!sidebarToggle || !sidebarToggle.contains(e.target))
            ) {
                sidebar.classList.remove('mobile-open');
            }
        });
    });
</script>

@yield('scripts')
</body>
</html>
