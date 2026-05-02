<header class="admin-header">
    <style>
        .admin-header {
            position: sticky;
            top: 0;
            z-index: 30;
            height: var(--header-height);
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 1rem;
            padding: 0 1.5rem;
            border-bottom: 1px solid var(--border-color);
            background: var(--header-bg);
            backdrop-filter: blur(18px);
        }

        .admin-header-left {
            display: flex;
            align-items: center;
            gap: .9rem;
            min-width: 0;
        }

        .admin-sidebar-toggle {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .25s ease;
            flex-shrink: 0;
        }

        .admin-sidebar-toggle:hover {
            color: var(--text-primary);
            border-color: rgba(59,130,246,0.18);
            transform: translateY(-2px);
        }

        .admin-search {
            position: relative;
            width: min(460px, 100%);
        }

        .admin-search i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .admin-search input {
            width: 100%;
            padding: .95rem 1rem .95rem 2.9rem;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            color: var(--text-primary);
            outline: none;
            transition: all .25s ease;
        }

        .admin-search input:focus {
            border-color: rgba(59,130,246,0.28);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.08);
        }

        .admin-header-right {
            display: flex;
            align-items: center;
            gap: .7rem;
        }

        .admin-icon-btn {
            width: 46px;
            height: 46px;
            border: 1px solid var(--border-color);
            border-radius: 14px;
            background: var(--bg-soft);
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .25s ease;
            position: relative;
            cursor: pointer;
        }

        .admin-icon-btn:hover {
            color: var(--text-primary);
            border-color: rgba(59,130,246,0.20);
            transform: translateY(-2px);
        }

        .admin-site-link {
            display: inline-flex;
            align-items: center;
            gap: .65rem;
            padding: .9rem 1rem;
            border-radius: 14px;
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            color: var(--text-secondary);
            transition: all .25s ease;
            font-size: .92rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .admin-site-link:hover {
            color: var(--text-primary);
            border-color: rgba(59,130,246,0.22);
            transform: translateY(-2px);
            background: rgba(59,130,246,0.06);
        }

        .admin-user-dropdown {
            position: relative;
        }

        .admin-user-box {
            display: flex;
            align-items: center;
            gap: .75rem;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: .35rem .7rem .35rem .35rem;
            background: var(--bg-soft);
            cursor: pointer;
            transition: all .25s ease;
            user-select: none;
        }

        .admin-user-box:hover {
            border-color: rgba(59,130,246,0.18);
        }

        .admin-user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            flex-shrink: 0;
        }

        .admin-user-meta strong {
            display: block;
            font-size: .9rem;
            line-height: 1.2;
            color: var(--text-primary);
        }

        .admin-user-meta span {
            display: block;
            margin-top: .12rem;
            font-size: .76rem;
            color: var(--text-muted);
            line-height: 1.2;
        }

        .admin-user-caret {
            color: var(--text-muted);
            font-size: .85rem;
            margin-left: .15rem;
        }

        .admin-user-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 240px;
            background: var(--dropdown-bg);
            border: 1px solid var(--border-color);
            border-radius: 18px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.18);
            padding: .6rem;
            display: none;
            z-index: 100;
            backdrop-filter: blur(16px);
        }

        .admin-user-menu.open {
            display: block;
        }

        .admin-user-menu a,
        .admin-user-menu button {
            width: 100%;
            border: none;
            background: transparent;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: .7rem;
            padding: .85rem .9rem;
            border-radius: 12px;
            text-align: left;
            font-size: .92rem;
            cursor: pointer;
        }

        .admin-user-menu a:hover,
        .admin-user-menu button:hover {
            background: var(--bg-soft);
            color: var(--text-primary);
        }

        @media (max-width: 1100px) {
            .admin-header {
                grid-template-columns: 1fr;
                height: auto;
                padding: 1rem;
            }

            .admin-header-right {
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .admin-search {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .admin-site-link span {
                display: none;
            }

            .admin-site-link {
                padding: .9rem;
            }
        }
    </style>

    <div class="admin-header-left">
        <button class="admin-sidebar-toggle" id="adminSidebarToggle" type="button" title="Свернуть / развернуть меню">
            <i class="bi bi-list"></i>
        </button>

        <div class="admin-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Поиск по админке...">
        </div>
    </div>

    <div class="admin-header-right">
        <button class="admin-icon-btn" id="themeToggleBtn" type="button" title="Сменить тему">
            <i class="bi bi-sun-fill" id="themeToggleIcon"></i>
        </button>

        <a href="{{ route('public.home') }}" class="admin-site-link" target="_blank" title="Открыть публичный сайт">
            <i class="bi bi-box-arrow-up-right"></i>
            <span>Открыть сайт</span>
        </a>

        <div class="admin-user-dropdown">
            <div class="admin-user-box" id="adminUserToggle">
                <div class="admin-user-avatar">
                    {{ mb_substr(auth()->user()->name ?? auth()->user()->email, 0, 1) }}
                </div>
                <div class="admin-user-meta">
                    <strong>{{ \Illuminate\Support\Str::limit(auth()->user()->name ?? 'Admin', 18) }}</strong>
                    <span>{{ auth()->user()->email }}</span>
                </div>
                <i class="bi bi-chevron-down admin-user-caret"></i>
            </div>

            <div class="admin-user-menu" id="adminUserMenu">
                <a href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Профиль</span>
                </a>

                <a href="{{ route('public.home') }}" target="_blank">
                    <i class="bi bi-house-door"></i>
                    <span>Перейти на сайт</span>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Выйти</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userToggle = document.getElementById('adminUserToggle');
            const userMenu = document.getElementById('adminUserMenu');

            if (userToggle && userMenu) {
                userToggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    userMenu.classList.toggle('open');
                });

                document.addEventListener('click', function (e) {
                    if (!userMenu.contains(e.target) && !userToggle.contains(e.target)) {
                        userMenu.classList.remove('open');
                    }
                });
            }

            const themeToggleBtn = document.getElementById('themeToggleBtn');
            const themeToggleIcon = document.getElementById('themeToggleIcon');

            function syncThemeIcon() {
                const current = document.documentElement.getAttribute('data-theme') || 'dark';
                themeToggleIcon.className = current === 'dark'
                    ? 'bi bi-sun-fill'
                    : 'bi bi-moon-stars-fill';
            }

            syncThemeIcon();

            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', function () {
                    const current = document.documentElement.getAttribute('data-theme') || 'dark';
                    const next = current === 'dark' ? 'light' : 'dark';

                    document.documentElement.setAttribute('data-theme', next);
                    localStorage.setItem('admin-theme', next);
                    syncThemeIcon();
                });
            }
        });
    </script>
</header>
