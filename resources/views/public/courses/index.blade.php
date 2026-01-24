@extends('public.layouts.app')

@section('content')
    <!-- ==================== Breadcrumb Start Here ==================== -->
    <section class="breadcrumb py-120 bg-main-25 position-relative z-1 overflow-hidden mb-0">
        <img src="assets/public/images/shapes/shape1.png" alt="" class="shape one animation-rotation d-md-block d-none">
        <img src="assets/public/images/shapes/shape2.png" alt="" class="shape two animation-scalation d-md-block d-none">
        <img src="assets/public/images/shapes/shape3.png" alt="" class="shape eight animation-walking d-md-block d-none">
        <img src="assets/public/images/shapes/shape5.png" alt="" class="shape six animation-walking d-md-block d-none">
        <img src="assets/public/images/shapes/shape4.png" alt="" class="shape four animation-scalation">
        <img src="assets/public/images/shapes/shape4.png" alt="" class="shape nine animation-scalation">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb__wrapper">
                        <h1 class="breadcrumb__title display-4 fw-semibold text-center">Просмотр списка курсов</h1>
                        <ul class="breadcrumb__list d-flex align-items-center justify-content-center gap-4">
                            <li class="breadcrumb__item">
                                <a href="{{route('public.home')}}" class="breadcrumb__link text-neutral-500 hover-text-main-600 fw-medium">
                                    <i class="text-lg d-inline-flex ph-bold ph-house"></i> Главная страница</a>
                            </li>
                            <li class="breadcrumb__item">
                                <i class="text-neutral-500 d-flex ph-bold ph-caret-right"></i>
                            </li>
                            <li class="breadcrumb__item">
                                <span class="text-main-two-600"> Курсы </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Breadcrumb End Here ==================== -->

    <!-- ============================== Course List View Section Start ============================== -->
    <section class="course-list-view py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="sidebar rounded-12 bg-main-25 p-32 border border-neutral-30">
                        <form action="{{route('public.courses.index')}}" method="get" id="filterForm">
                            <div class="flex-between mb-24">
                                <h4 class="mb-0">Filter</h4>
                                <button type="button" class="sidebar-close text-xl text-neutral-500 d-lg-none hover-text-main-600">
                                    <i class="ph-bold ph-x"></i>
                                </button>
                            </div>

                            <div class="position-relative">
                                <input type="text" class="common-input pe-48 rounded-pill" name="search" value="{{ request('search') }}" placeholder="Поиск по названию">
                                <button type="submit" class="text-neutral-500 text-xl d-flex position-absolute top-50 translate-middle-y inset-inline-end-0 me-24 hover-text-main-600"><i class="ph-bold ph-magnifying-glass"></i></button>
                            </div>
                            <span class="d-block border border-neutral-30 border-dashed my-24"></span>

                            <h6 class="text-lg mb-24 fw-medium">Types of Categories</h6>
                            <div class="d-flex flex-column gap-16">
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="3254">
                                        <label class="form-check-label fw-normal flex-grow-1" for="3254">Health and Wellness Courses</label>
                                    </div>
                                    <span class="text-neutral-500">3254</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="1522">
                                        <label class="form-check-label fw-normal flex-grow-1" for="1522">Language Courses</label>
                                    </div>
                                    <span class="text-neutral-500">1522</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="2545">
                                        <label class="form-check-label fw-normal flex-grow-1" for="2545">Computer and Technology</label>
                                    </div>
                                    <span class="text-neutral-500">2545</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="3215">
                                        <label class="form-check-label fw-normal flex-grow-1" for="3215">HealthWellnessCourses</label>
                                    </div>
                                    <span class="text-neutral-500">3215</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="5526">
                                        <label class="form-check-label fw-normal flex-grow-1" for="5526">Business and Finance Courses</label>
                                    </div>
                                    <span class="text-neutral-500">5526</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="1563">
                                        <label class="form-check-label fw-normal flex-grow-1" for="1563">Academic Courses</label>
                                    </div>
                                    <span class="text-neutral-500">1563</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="4154">
                                        <label class="form-check-label fw-normal flex-grow-1" for="4154">Art and Creative Courses</label>
                                    </div>
                                    <span class="text-neutral-500">4154</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="categories1">
                                        <label class="form-check-label fw-normal flex-grow-1" for="categories1">HealthWellnessCourses</label>
                                    </div>
                                    <span class="text-neutral-500">3215</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="4146">
                                        <label class="form-check-label fw-normal flex-grow-1" for="4146">Professional Development</label>
                                    </div>
                                    <span class="text-neutral-500">4146</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="4955">
                                        <label class="form-check-label fw-normal flex-grow-1" for="4955">Science and Engineering</label>
                                    </div>
                                    <span class="text-neutral-500">4955</span>
                                </div>
                            </div>
                            <a href="course.html" class="text-sm text-main-600 fw-semibold mt-24 hover-text-decoration-underline">See All </a>
                            <span class="d-block border border-neutral-30 border-dashed my-24"></span>

                            <h6 class="text-lg mb-24 fw-medium">Pricing scale</h6>
                            <div class="custom--range">
                                <div id="slider-range"></div>
                                <div class="custom--range__content">
                                    <input type="text" class="custom--range__prices text-neutral-600 text-start text-md fw-medium w-100 text-center bg-transparent border-0 outline-0" id="amount" readonly>
                                </div>
                            </div>
                            <span class="d-block border border-neutral-30 border-dashed my-24"></span>

                            <h6 class="text-lg mb-24 fw-medium">Star Category</h6>
                            <div class="d-flex flex-column gap-16">
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="star5">
                                        <label class="form-check-label fw-normal flex-grow-1 flex-align gap-8" for="star5">
                                            <span class="text-warning-600 text-xl d-flex"><i class="ph-fill ph-star"></i></span>
                                            5 Star
                                        </label>
                                    </div>
                                    <span class="text-neutral-500">122</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="star4">
                                        <label class="form-check-label fw-normal flex-grow-1 flex-align gap-8" for="star4">
                                            <span class="text-warning-600 text-xl d-flex"><i class="ph-fill ph-star"></i></span>
                                            4 Star
                                        </label>
                                    </div>
                                    <span class="text-neutral-500">356</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="star3">
                                        <label class="form-check-label fw-normal flex-grow-1 flex-align gap-8" for="star3">
                                            <span class="text-warning-600 text-xl d-flex"><i class="ph-fill ph-star"></i></span>
                                            3 Star
                                        </label>
                                    </div>
                                    <span class="text-neutral-500">356</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="star2">
                                        <label class="form-check-label fw-normal flex-grow-1 flex-align gap-8" for="star2">
                                            <span class="text-warning-600 text-xl d-flex"><i class="ph-fill ph-star"></i></span>
                                            2 Star
                                        </label>
                                    </div>
                                    <span class="text-neutral-500">213</span>
                                </div>
                                <div class="flex-between gap-16">
                                    <div class="form-check common-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="categories" id="star1s">
                                        <label class="form-check-label fw-normal flex-grow-1 flex-align gap-8" for="star1s">
                                            <span class="text-warning-600 text-xl d-flex"><i class="ph-fill ph-star"></i></span>
                                            1 Star
                                        </label>
                                    </div>
                                    <span class="text-neutral-500">10</span>
                                </div>
                            </div>
                            <span class="d-block border border-neutral-30 border-dashed my-24"></span>

                            <h6 class="text-lg mb-24 fw-medium">Popular Tags</h6>
                            <div class="flex-align flex-wrap gap-12">
                                <a href="course.html" class="border border-neutral-30 px-20 py-12 rounded-pill bg-white text-neutral-500 hover-border-main-600 hover-text-main-600">UI/UX Design</a>
                                <a href="course.html" class="border border-neutral-30 px-20 py-12 rounded-pill bg-white text-neutral-500 hover-border-main-600 hover-text-main-600">Web Development</a>
                                <a href="course.html" class="border border-neutral-30 px-20 py-12 rounded-pill bg-white text-neutral-500 hover-border-main-600 hover-text-main-600">Wordpress</a>
                                <a href="course.html" class="border border-neutral-30 px-20 py-12 rounded-pill bg-white text-neutral-500 hover-border-main-600 hover-text-main-600">Machine Learning</a>
                                <a href="course.html" class="border border-neutral-30 px-20 py-12 rounded-pill bg-white text-neutral-500 hover-border-main-600 hover-text-main-600">AI</a>
                                <a href="course.html" class="border border-neutral-30 px-20 py-12 rounded-pill bg-white text-neutral-500 hover-border-main-600 hover-text-main-600">Laravel</a>
                                <a href="course.html" class="border border-neutral-30 px-20 py-12 rounded-pill bg-white text-neutral-500 hover-border-main-600 hover-text-main-600">Python</a>
                            </div>
                            <a href="course.html" class="text-sm text-main-600 fw-semibold mt-24 hover-text-decoration-underline">More Tags </a>
                            <span class="d-block border border-neutral-30 border-dashed my-24"></span>

                            <h6 class="text-lg mb-24 fw-medium">Level</h6>
                            <div class="d-flex flex-column gap-16">
                                <div class="form-check common-check mb-0">
                                    <input class="form-check-input" type="checkbox" name="level[]"
                                           value="beginner"
                                           id="lvl-beg"
                                        {{ in_array('beginner', request('level', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-normal flex-grow-1" for="AllLevels">Beginner</label>
                                </div>
                                <div class="form-check common-check mb-0">
                                    <input class="form-check-input" type="checkbox" name="level[]"
                                           value="middle"
                                           id="lvl-mid"
                                        {{ in_array('middle', request('level', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-normal flex-grow-1" for="Beginner">Middle</label>
                                </div>
                                <div class="form-check common-check mb-0">
                                    <input class="form-check-input" type="checkbox" name="level[]"
                                           value="advanced"
                                           id="lvl-adv"
                                        {{ in_array('advanced', request('level', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-normal flex-grow-1" for="Intermediate">Advanced</label>
                                </div>

                            </div>
                            <span class="d-block border border-neutral-30 border-dashed my-24"></span>

                            <input type="submit" value="Применить" class="btn btn-main rounded-pill flex-align gap-16 fw-semibold w-100"><br>
                            <button type="reset" class="btn btn-outline-main rounded-pill flex-center gap-16 fw-semibold w-100">
                                <i class="ph-bold ph-arrow-clockwise d-flex text-lg"></i>
                                Reset Filters
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="course-list-wrapper">
                        <div class="flex-between gap-16 flex-wrap mb-40">
                            <span class="text-neutral-500">Показано {{ $courses->count() }} из {{ $courses->total() }} результатов</span>
                            <div class="flex-align gap-16">
                                <div class="flex-align gap-8">
                                    <span class="text-neutral-500 flex-shrink-0">Sort By :</span>
                                    <select class="form-select ps-20 pe-28 py-8 fw-medium rounded-pill bg-main-25 border border-neutral-30 text-neutral-700">
                                        <option value="1">Newest</option>
                                        <option value="1">Trending</option>
                                        <option value="1">Popular</option>
                                    </select>
                                </div>
                                <button type="button" class="list-bar-btn text-xl w-40 h-40 bg-main-600 text-white rounded-8 flex-center d-lg-none">
                                    <i class="ph-bold ph-funnel"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row gy-4">
                        @foreach($courses as $course)
                            <div class="col-12">
                                <div class="course-item bg-main-25 rounded-16 p-12 h-100 border border-neutral-30 list-view">
                                    <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                        <a href="course-details.html" class="w-100 h-100">
                                            @if($course->image)
                                                <img src="{{ Storage::url($course->image) }}" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                            @else
                                                <img src="{{ Storage::url('no_image.png') }}" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                            @endif
                                        </a>
                                        <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                            <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                            <span class="text-lg fw-medium">{{$course->duration}} Mouth</span>
                                        </div>
                                        <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                            <i class="ph ph-heart"></i>
                                        </button>
                                    </div>
                                    <div class="course-item__content flex-grow-1">
                                        <div class="">
                                            <h4 class="mb-28">
                                                <a href="course-details.html" class="link text-line-2">{{$course->title}}</a>
                                            </h4>
                                            <div class="flex-between gap-8 flex-wrap mb-16">
                                                <div class="flex-align gap-8">
                                                    <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                                    <span class="text-neutral-700 text-lg fw-medium">{{$course->lessons_count}} уроков</span>
                                                </div>
                                                <div class="flex-align gap-8">
                                                    <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                                    <span class="text-neutral-700 text-lg fw-medium">{{$course->level}}</span>
                                                </div>
                                            </div>
                                            <div class="flex-between gap-8 flex-wrap">
                                                <div class="flex-align gap-4">
                                                    <span class="text-2xl fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                    <span class="text-lg text-neutral-700">
                                                        4.7
                                                        <span class="text-neutral-100">(6.4k)</span>
                                                    </span>
                                                </div>
                                                <div class="flex-align gap-8">
                                                    <span class="text-neutral-700 text-2xl d-flex">
                                                        <img src="assets/public/images/thumbs/user-img1.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                                                    </span>
                                                    <span class="text-neutral-700 text-lg fw-medium">AnikaZ</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                            <h4 class="mb-0 text-main-two-600">$148</h4>
                                            <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                                Enroll Now
                                                <i class="ph ph-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    {{ $courses->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
        <div class="explore-course py-120 position-relative z-1">
            <div class="section-heading text-center style-flex gap-24">
                <div class="container section-heading__content">
                    <a href="{{route('public.courses.grid-view')}}" class="btn btn-main rounded-pill flex-align gap-8" tabindex="0">
                        Больше курсов
                        <i class="ph ph-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================== Course List View Section End ============================== -->

@endsection
