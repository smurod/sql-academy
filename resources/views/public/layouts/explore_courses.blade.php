<!-- ================================== Explore Course Section Start =========================== -->
<section class="explore-course py-120 bg-main-25 position-relative z-1">
    <img src="assets/public/images/shapes/shape2.png" alt="" class="shape six animation-scalation">

    <div class="container">
        <div class="section-heading text-center style-flex gap-24">
            <div class="section-heading__inner text-start">
                <h2 class="mb-0 wow bounceIn">Более {{ $courses->total()}} беслатных онлайн курсов по SQl</h2>
            </div>
            <div class="section-heading__content">
                <p class="section-heading__desc text-start mt-0 text-line-2 wow bounceInUp">Добро пожаловать в интерактивный каталог курсов по базам данных...</p>
                <a href="{{route('public.courses.index')}}" class="item-hover__text flex-align gap-8 text-main-600 mt-24 hover-text-decoration-underline transition-1" tabindex="0">
                    Смотреть курсы
                    <i class="ph ph-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="nav-tab-wrapper bg-white p-16 mb-40"  data-aos="zoom-out">
            <ul class="nav nav-pills common-tab gap-16" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill bg-main-25 text-md fw-medium text-neutral-500 flex-center w-100 gap-8 active" id="pills-categories-tab" data-bs-toggle="pill" data-bs-target="#pills-categories" type="button" role="tab" aria-controls="pills-categories" aria-selected="true">
                        <i class="text-xl d-flex ph-bold ph-squares-four"></i>
                        All Categories
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill bg-main-25 text-md fw-medium text-neutral-500 flex-center w-100 gap-8" id="pills-design-tab" data-bs-toggle="pill" data-bs-target="#pills-design" type="button" role="tab" aria-controls="pills-design" aria-selected="false">
                        <i class="text-xl d-flex ph-bold ph-magic-wand"></i>
                        Design
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill bg-main-25 text-md fw-medium text-neutral-500 flex-center w-100 gap-8" id="pills-programming-tab" data-bs-toggle="pill" data-bs-target="#pills-programming" type="button" role="tab" aria-controls="pills-programming" aria-selected="false">
                        <i class="text-xl d-flex ph-bold ph-code"></i>
                        Programming
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill bg-main-25 text-md fw-medium text-neutral-500 flex-center w-100 gap-8" id="pills-webDesign-tab" data-bs-toggle="pill" data-bs-target="#pills-webDesign" type="button" role="tab" aria-controls="pills-webDesign" aria-selected="false">
                        <i class="text-xl d-flex ph-bold ph-code"></i>
                        web Design
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill bg-main-25 text-md fw-medium text-neutral-500 flex-center w-100 gap-8" id="pills-Academic-tab" data-bs-toggle="pill" data-bs-target="#pills-Academic" type="button" role="tab" aria-controls="pills-Academic" aria-selected="false">
                        <i class="text-xl d-flex ph-bold ph-graduation-cap"></i>
                        Academic
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill bg-main-25 text-md fw-medium text-neutral-500 flex-center w-100 gap-8" id="pills-marketing-tab" data-bs-toggle="pill" data-bs-target="#pills-marketing" type="button" role="tab" aria-controls="pills-marketing" aria-selected="false">
                        <i class="text-xl d-flex ph-bold ph-chart-pie-slice"></i>
                        Marketing
                    </button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-categories" role="tabpanel" aria-labelledby="pills-categories-tab" tabindex="0">
                <div class="row gy-4">
                    @foreach($courses as $course)
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="200">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img1.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Digital Marketing</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">{{$course->lessons_count}}</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
            <div class="tab-pane fade" id="pills-design" role="tabpanel" aria-labelledby="pills-design-tab" tabindex="0">
                <div class="row gy-4">
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="200">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img1.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Digital Marketing</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="400">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img2.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">25h 06m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Python Programming</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img2.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Wade</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$499</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="600">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img3.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Photography Masterclass</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img3.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Cody</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$457</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="200">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img4.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Spanish Language Mastery: Beginner to Fluent</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img4.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Dustin</span>
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
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="400">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img5.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Financial Planning for Millennials</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img5.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Bruce</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$546</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="600">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img6.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Nutrition Essentials for Healthy Living</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img6.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Robert</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$345</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-programming" role="tabpanel" aria-labelledby="pills-programming-tab" tabindex="0">
                <div class="row gy-4">
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="200">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img1.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Digital Marketing</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="400">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img2.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">25h 06m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Python Programming</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img2.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Wade</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$499</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="600">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img3.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Photography Masterclass</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img3.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Cody</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$457</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="200">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img4.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Spanish Language Mastery: Beginner to Fluent</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img4.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Dustin</span>
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
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="400">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img5.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Financial Planning for Millennials</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img5.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Bruce</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$546</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="600">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img6.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Nutrition Essentials for Healthy Living</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img6.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Robert</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$345</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-webDesign" role="tabpanel" aria-labelledby="pills-webDesign-tab" tabindex="0">
                <div class="row gy-4">
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="200">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img1.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Digital Marketing</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="400">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img2.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">25h 06m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Python Programming</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img2.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Wade</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$499</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="600">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img3.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Photography Masterclass</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img3.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Cody</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$457</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="200">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img4.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Spanish Language Mastery: Beginner to Fluent</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img4.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Dustin</span>
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
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="400">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img5.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Financial Planning for Millennials</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img5.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Bruce</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$546</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="600">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img6.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Nutrition Essentials for Healthy Living</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img6.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Robert</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$345</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-Academic" role="tabpanel" aria-labelledby="pills-Academic-tab" tabindex="0">
                <div class="row gy-4">
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="200">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img1.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Digital Marketing</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="400">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img2.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">25h 06m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Python Programming</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img2.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Wade</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$499</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="600">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img3.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Photography Masterclass</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img3.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Cody</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$457</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="200">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img4.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Spanish Language Mastery: Beginner to Fluent</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img4.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Dustin</span>
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
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="400">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img5.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Financial Planning for Millennials</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img5.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Bruce</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$546</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="600">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img6.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Nutrition Essentials for Healthy Living</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img6.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Robert</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$345</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-marketing" role="tabpanel" aria-labelledby="pills-marketing-tab" tabindex="0">
                <div class="row gy-4">
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="200">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img1.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Digital Marketing</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="400">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img2.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">25h 06m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Python Programming</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img2.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Wade</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$499</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="600">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img3.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Introduction to Photography Masterclass</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img3.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Cody</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$457</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="200">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img4.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Spanish Language Mastery: Beginner to Fluent</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img4.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Dustin</span>
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
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="400">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img5.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Financial Planning for Millennials</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img5.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Bruce</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$546</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="600">
                        <div class="course-item bg-white rounded-16 p-12 h-100 box-shadow-md">
                            <div class="course-item__thumb rounded-12 overflow-hidden position-relative">
                                <a href="course-details.html" class="w-100 h-100">
                                    <img src="assets/public/images/thumbs/course-img6.png" alt="Course Image" class="course-item__img rounded-12 cover-img transition-2">
                                </a>
                                <div class="flex-align gap-8 bg-main-600 rounded-pill px-24 py-12 text-white position-absolute inset-block-start-0 inset-inline-start-0 mt-20 ms-20 z-1">
                                    <span class="text-2xl d-flex"><i class="ph ph-clock"></i></span>
                                    <span class="text-lg fw-medium">9h 36m</span>
                                </div>
                                <button type="button" class="wishlist-btn w-48 h-48 bg-white text-main-two-600 flex-center position-absolute inset-block-start-0 inset-inline-end-0 mt-20 me-20 z-1 text-2xl rounded-circle transition-2">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </div>
                            <div class="course-item__content">
                                <div class="">
                                    <h4 class="mb-28">
                                        <a href="course-details.html" class="link text-line-2">Nutrition Essentials for Healthy Living</a>
                                    </h4>
                                    <div class="flex-between gap-8 flex-wrap mb-16">
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-video-camera"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">20 Lessons</span>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="text-neutral-700 text-2xl d-flex"><i class="ph-bold ph-chart-bar"></i></span>
                                            <span class="text-neutral-700 text-lg fw-medium">Beginner</span>
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
                                <img src="assets/public/images/thumbs/user-img6.png" alt="User Image" class="w-32 h-32 object-fit-cover rounded-circle">
                            </span>
                                            <span class="text-neutral-700 text-lg fw-medium">Robert</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-between gap-8 pt-24 border-top border-neutral-50 mt-28 border-dashed border-0">
                                    <h4 class="mb-0 text-main-two-600">$345</h4>
                                    <a href="apply-admission.html" class="flex-align gap-8 text-main-600 hover-text-decoration-underline transition-1 fw-semibold" tabindex="0">
                                        Enroll Now
                                        <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================================== Explore Course Section End =========================== -->
