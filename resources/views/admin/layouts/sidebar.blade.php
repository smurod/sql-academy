<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
                src="{{asset('assets/admin/dist/assets/img/AdminLTELogo.png')}}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">SQLMastery</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
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
                            <a href="{{route('courses.index')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Список курсов</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('courses.create')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Добавление курсов</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Задачи по урокам</li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Задания
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('tasks.index')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Список задач</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('tasks.create')}}" class="nav-link">
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
