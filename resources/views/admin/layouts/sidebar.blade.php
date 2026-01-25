<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img
                src="{{ asset('assets/admin/dist/assets/img/AdminLTELogo.png') }}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
            />
            <span class="brand-text fw-light">SQLMastery</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false"
            >
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>


                        <p>
                            Курсы
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('courses.index') }}"
                               class="nav-link {{ request()->routeIs('courses.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Список курсов</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('courses.create') }}"
                               class="nav-link {{ request()->routeIs('courses.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Добавить курс</p>
                            </a>
                        </li>
                    </ul>
                </li>

               <!-- ================= ЗАДАНИЯ ================= -->
                <li class="nav-header">Задачи по урокам</li>

                <li class="nav-item {{ request()->routeIs('tasks.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-list-check"></i>
                        <p>
                            Задания
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tasks.index') }}"
                               class="nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Список задач</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('tasks.create') }}"
                               class="nav-link {{ request()->routeIs('tasks.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Добавить задание</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
