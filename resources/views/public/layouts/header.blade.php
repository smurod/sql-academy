<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <a href="{{ route('public.home') }}" class="nav-logo">
            <div class="nav-logo-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <ellipse cx="12" cy="5" rx="9" ry="3"/>
                    <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/>
                    <path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/>
                </svg>
            </div>
            <span class="nav-logo-text">SQL <span>Mastery</span></span>
        </a>

        <div class="nav-links">
            <a href="{{ route('public.courses.index') }}" class="nav-link {{ request()->routeIs('public.courses.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i><span>Курс</span>
            </a>

            <a href="{{ route('public.tasks.index') }}" class="nav-link {{ request()->routeIs('public.tasks.*') ? 'active' : '' }}">
                <i class="bi bi-code-square"></i><span>Тренажёр</span>
            </a>

            <a href="{{ route('sandbox.form') }}" class="nav-link {{ request()->routeIs('sandbox.*') ? 'active' : '' }}">
                <i class="bi bi-terminal"></i><span>Песочница</span>
            </a>

            <a href="{{ url('/interviews') }}" class="nav-link {{ request()->is('interviews*') ? 'active' : '' }}">
                <i class="bi bi-briefcase"></i><span>Собеседования</span>
            </a>

            @role('admin')
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('admin*') ? 'active' : '' }}">
                <i class="bi bi-shield-lock"></i><span>Админка</span>
            </a>
            @endrole
        </div>

        <div class="nav-right">
            @auth
                <a href="{{ route('profile.edit') }}" class="nav-link">
                    <i class="bi bi-person-circle"></i>
                    <span>{{ \Illuminate\Support\Str::limit(auth()->user()->name, 12) }}</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-login">Выйти</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-login">Войти</a>
            @endauth
        </div>

        <button class="burger" id="burgerBtn">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('public.courses.index') }}" class="mobile-link {{ request()->routeIs('public.courses.*') ? 'active' : '' }}">
            <i class="bi bi-book"></i> Курс
        </a>

        <a href="{{ route('public.tasks.index') }}" class="mobile-link {{ request()->routeIs('public.tasks.*') ? 'active' : '' }}">
            <i class="bi bi-code-square"></i> Тренажёр
        </a>

        <a href="{{ route('sandbox.form') }}" class="mobile-link {{ request()->routeIs('sandbox.*') ? 'active' : '' }}">
            <i class="bi bi-terminal"></i> Песочница
        </a>

        <a href="{{ url('/interviews') }}" class="mobile-link {{ request()->is('interviews*') ? 'active' : '' }}">
            <i class="bi bi-briefcase"></i> Собеседования
        </a>

        @role('admin')
        <a href="{{ route('dashboard') }}" class="mobile-link {{ request()->is('admin*') ? 'active' : '' }}">
            <i class="bi bi-shield-lock"></i> Админка
        </a>
        @endrole

        @auth
            <a href="{{ route('profile.edit') }}" class="mobile-link">
                <i class="bi bi-person-circle"></i> Профиль
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="mobile-login">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="mobile-login" style="text-align:center; display:block;">
                Войти
            </a>
        @endauth
    </div>
</nav>
