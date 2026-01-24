<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> EdullAll - LMS, Tutors, Education & Online Course Html Template</title>
    <link rel="shortcut icon" href="{{ asset('assets/public/images/logo/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/plyr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/main.css') }}"></head>
<body>
<!-- ==================== Header Start Here ==================== -->
<header class="header">
    <div class="container container--xl">
        <nav class="header-inner flex-between gap-8">

            <div class="header-content-wrapper flex-align flex-grow-1">
                <!-- Logo Start -->
                <div class="logo">
                    <a href="index.html" class="link">
                        <img src="{{ Storage::url('sqlmastery.png') }}" alt="Logo">
                    </a>
                </div>
                <!-- Logo End  -->

                <!-- Menu Start  -->
                <div class="header-menu d-lg-block d-none">

                    <ul class="nav-menu flex-align ">
                        <li class="nav-menu__item">
                            <a href="{{route('public.courses.index')}}" class="nav-menu__link"> Курсы</a>
                        </li>
                        <li class="nav-menu__item">
                            <a href="courses.index" class="nav-menu__link"> Тренажёр</a>
                        </li>
                        <li class="nav-menu__item has-submenu activePage">
                            <a href="javascript:void(0)" class="nav-menu__link"> Ещё</a>
                            <ul class="nav-submenu scroll-sm">
                                <li class="nav-submenu__item activePage">
                                    <a href="index.html" class="nav-submenu__link hover-bg-neutral-30"> Песочница</a>
                                </li>
                                <li class="nav-submenu__item">
                                    <a href="index-2.html" class="nav-submenu__link hover-bg-neutral-30"> Статьи и туториалы</a>
                                </li>
                                <li class="nav-submenu__item">
                                    <a href="index-3.html" class="nav-submenu__link hover-bg-neutral-30"> Справочник</a>
                                </li>
                                <li class="nav-submenu__item">
                                    <a href="index-4.html" class="nav-submenu__link hover-bg-neutral-30"> Вопросы с собеседований</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- Menu End  -->
            </div>

            <!-- Header Right start -->
            <div class="header-right flex-align">
                <form action="#" class="search-form position-relative d-xl-block d-none">
                    <input type="text" class="common-input rounded-pill bg-main-25 pe-44 border-neutral-30" placeholder="Search...">
                    <button type="submit" class="w-36 h-36 bg-main-600 hover-bg-main-700 rounded-circle flex-center text-md text-white position-absolute top-50 translate-middle-y inset-inline-end-0 me-8">
                        <i class="ph-bold ph-magnifying-glass"></i>
                    </button>
                </form>
                <a href="{{route('login')}}" class="info-action w-52 h-52 bg-main-25 hover-bg-main-600 border border-neutral-30 rounded-circle flex-center text-2xl text-neutral-500 hover-text-white hover-border-main-600">
                    <i class="ph ph-user-circle"></i>
                </a>
                <button type="button" class="toggle-mobileMenu d-lg-none text-neutral-200 flex-center">
                    <i class="ph ph-list"></i>
                </button>
            </div>
            <!-- Header Right End  -->
        </nav>
    </div>
</header>
<!-- ==================== Header End Here ==================== -->
