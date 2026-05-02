<aside class="admin-sidebar" id="adminSidebar">
    <style>
        .admin-sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            background: var(--sidebar-bg);
            backdrop-filter: blur(22px);
            border-right: 1px solid var(--border-color);
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            z-index: 20;
            transition: transform .3s ease, width .3s ease, padding .3s ease;
            overflow: hidden;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: .9rem;
            padding: .9rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(59,130,246,0.10), rgba(147,51,234,0.08), rgba(6,182,212,0.04));
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.03);
            flex-shrink: 0;
        }

        .admin-brand-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 12px 28px rgba(59,130,246,0.24);
            flex-shrink: 0;
        }

        .admin-brand-text {
            min-width: 0;
        }

        .admin-brand-title {
            font-weight: 800;
            font-size: 1.08rem;
            letter-spacing: -0.03em;
            color: var(--text-primary);
        }

        .admin-brand-title span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .admin-brand-sub {
            margin-top: .2rem;
            font-size: .76rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .admin-nav-section {
            margin-top: 1.3rem;
        }

        .admin-nav-title {
            color: var(--text-muted);
            font-size: .75rem;
            letter-spacing: .14em;
            text-transform: uppercase;
            margin: 0 .85rem .7rem;
        }

        .admin-nav-list {
            display: flex;
            flex-direction: column;
            gap: .35rem;
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: .9rem;
            padding: .95rem 1rem;
            border-radius: 16px;
            color: var(--text-secondary);
            border: 1px solid transparent;
            transition: all .28s ease;
            white-space: nowrap;
        }

        .admin-nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        .admin-nav-link span {
            transition: opacity .2s ease;
        }

        .admin-nav-link:hover {
            color: var(--text-primary);
            background: rgba(255,255,255,0.04);
            border-color: var(--border-color);
            transform: translateX(4px);
        }

        .admin-nav-link.active {
            color: var(--text-primary);
            background: linear-gradient(135deg, rgba(59,130,246,0.16), rgba(147,51,234,0.10));
            border-color: rgba(59,130,246,0.20);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.04);
        }

        .admin-sidebar-footer {
            margin-top: auto;
        }

        .admin-sidebar-tip {
            margin-top: 1.2rem;
            padding: 1rem;
            border-radius: 22px;
            border: 1px solid rgba(59,130,246,0.18);
            background: linear-gradient(135deg, rgba(59,130,246,0.08), rgba(6,182,212,0.05));
        }

        .admin-sidebar-tip-head {
            display: flex;
            align-items: center;
            gap: .65rem;
            margin-bottom: .75rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .admin-sidebar-tip-head i {
            color: var(--primary);
        }

        .admin-sidebar-tip p {
            color: var(--text-secondary);
            font-size: .86rem;
            line-height: 1.6;
        }

        .admin-layout.sidebar-collapsed .admin-sidebar {
            padding: 1rem .8rem;
        }

        .admin-layout.sidebar-collapsed .admin-brand {
            justify-content: center;
            padding: .8rem;
        }

        .admin-layout.sidebar-collapsed .admin-brand-text,
        .admin-layout.sidebar-collapsed .admin-nav-title,
        .admin-layout.sidebar-collapsed .admin-nav-link span,
        .admin-layout.sidebar-collapsed .admin-sidebar-tip {
            display: none;
        }

        .admin-layout.sidebar-collapsed .admin-nav-link {
            justify-content: center;
            padding: .95rem;
        }

        .admin-layout.sidebar-collapsed .admin-nav-link:hover {
            transform: none;
        }

        @media (max-width: 1100px) {
            .admin-sidebar {
                position: fixed;
                left: 0;
                top: 0;
                width: min(92vw, 340px);
                transform: translateX(-100%);
                border-right: 1px solid var(--border-color);
                box-shadow: 0 20px 60px rgba(0,0,0,0.35);
            }

            .admin-sidebar.mobile-open {
                transform: translateX(0);
            }
        }
    </style>

    <a href="{{ route('dashboard') }}" class="admin-brand">
        <div class="admin-brand-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <ellipse cx="12" cy="5" rx="9" ry="3"/>
                <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/>
                <path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/>
            </svg>
        </div>
        <div class="admin-brand-text">
            <div class="admin-brand-title">SQL <span>Mastery</span></div>
            <div class="admin-brand-sub">Admin Panel</div>
        </div>
    </a>

    <div class="admin-nav-section">
        <div class="admin-nav-title">Обзор</div>
        <div class="admin-nav-list">
            <a href="{{ route('dashboard') }}" class="admin-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Панель управления</span>
            </a>
        </div>
    </div>

    <div class="admin-nav-section">
        <div class="admin-nav-title">Обучение</div>
        <div class="admin-nav-list">
            <a href="{{route('users.index')}}" class="admin-nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                <i class="bi bi-person"></i>
                <span>Список пользователей</span>
            </a>

            <a href="{{ route('modules.index') }}" class="admin-nav-link {{ request()->routeIs('modules.index') ? 'active' : '' }}">
                <i class="bi bi-collection-fill"></i>
                <span>Список модулей</span>
            </a>

            <a href="{{ route('modules.create') }}" class="admin-nav-link {{ request()->routeIs('modules.create') ? 'active' : '' }}">
                <i class="bi bi-plus-square-fill"></i>
                <span>Добавить модуль</span>
            </a>

            <a href="{{ route('tasks.index') }}" class="admin-nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                <i class="bi bi-list-check"></i>
                <span>Список задач</span>
            </a>

            <a href="{{ route('tasks.create') }}" class="admin-nav-link {{ request()->routeIs('tasks.create') ? 'active' : '' }}">
                <i class="bi bi-code-square"></i>
                <span>Добавить задачу</span>
            </a>
        </div>
    </div>

    <div class="admin-sidebar-footer">
        <div class="admin-sidebar-tip">
            <div class="admin-sidebar-tip-head">
                <i class="bi bi-lightning-charge-fill"></i>
                <span>Быстрый доступ</span>
            </div>
            <p>
                Управляйте модулями и задачами в едином стиле SQLMastery, сохраняя весь текущий функционал проекта.
            </p>
        </div>
    </div>
</aside>
