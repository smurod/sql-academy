<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <a href="{{ url('/') }}" class="nav-logo">
            <div class="nav-logo-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <ellipse cx="12" cy="5" rx="9" ry="3"/>
                    <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/>
                    <path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/>
                </svg>
            </div>
            <span class="nav-logo-text">SQL <span>Academy</span></span>
        </a>
        <div class="nav-links">
            <a href="{{ route('public.courses.index') }}" class="nav-link {{ request()->is('*course*') ? 'active' : '' }}">
                <i class="bi bi-book"></i><span>Курс</span>
            </a>
            <a href="{{ route('public.tasks.index') }}" class="nav-link {{ request()->is('*tasks*') ? 'active' : '' }}">
                <i class="bi bi-code-square"></i><span>Тренажёр</span>
            </a>
            <a href="{{ route('sandbox.form') }}" class="nav-link {{ request()->is('*sandbox*') ? 'active' : '' }}">
                <i class="bi bi-terminal"></i><span>Песочница</span>
            </a>
            <a href="{{ url('/interviews') }}" class="nav-link {{ request()->is('interviews*') ? 'active' : '' }}">
                <i class="bi bi-briefcase"></i><span>Собеседования</span>
            </a>
        </div>
        <div class="nav-right">
            <a href="{{ route('login') }}" class="btn-login">Войти</a>
        </div>
        <button class="burger" id="burgerBtn"><i class="bi bi-list"></i></button>
    </div>
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ url('/course') }}" class="mobile-link {{ request()->is('course*') ? 'active' : '' }}">
            <i class="bi bi-book"></i> Курс
        </a>
        <a href="{{ url('/tasks') }}" class="mobile-link {{ request()->is('tasks*') ? 'active' : '' }}">
            <i class="bi bi-code-square"></i> Тренажёр
        </a>
        <a href="{{ url('/sandbox') }}" class="mobile-link {{ request()->is('sandbox*') ? 'active' : '' }}">
            <i class="bi bi-terminal"></i> Песочница
        </a>
        <a href="{{ url('/interviews') }}" class="mobile-link {{ request()->is('interviews*') ? 'active' : '' }}">
            <i class="bi bi-briefcase"></i> Собеседования
        </a>
        <button class="mobile-login">Войти</button>
    </div>
</nav>
