<!-- ========================= Banner Section Start =============================== -->
<section class="banner py-80 position-relative overflow-hidden">

    <img src="assets/public/images/shapes/shape1.png" alt="" class="shape one animation-rotation">
    <img src="assets/public/images/shapes/shape2.png" alt="" class="shape two animation-scalation">
    <img src="assets/public/images/shapes/shape3.png" alt="" class="shape three animation-walking">
    <img src="assets/public/images/shapes/shape4.png" alt="" class="shape four animation-scalation">
    <img src="assets/public/images/shapes/shape5.png" alt="" class="shape five animation-walking">

    <div class="container">
        <div class="row gy-5 align-items-center">
            <div class="col-xl-6">
                <div class="banner-content pe-md-4">
                    <div class="flex-align gap-8 mb-16" data-aos="fade-down">
                        <span class="w-8 h-8 bg-main-600 rounded-circle"></span>
                        <h5 class="text-main-600 mb-0"> Прокачай свои SQL навыки</h5>
                    </div>

                    <h1 class="display2 mb-24 wow bounceInLeft">Интерактивный онлайн <span class="text-main-two-600 wow bounceInRight" data-wow-duration="2s" data-wow-delay=".5s">курс</span>
                        по <span class="text-main-600 wow bounceInUp" data-wow-duration="1s" data-wow-delay=".5s">SQL</span>
                    </h1>
                    <p class="text-neutral-500 text-line-2 wow bounceInUp">Освойте SQL, обучаясь на упражнениях, приближенных к реальным профессиональным задачам</p>
                    <div class="buttons-wrapper flex-align flex-wrap gap-24 mt-40">
                        <a href="{{route('public.courses.index')}}" class="btn btn-main rounded-pill flex-align gap-8" data-aos="fade-right">
                            Смотреть проекты
                            <i class="ph-bold ph-arrow-up-right d-flex text-lg"></i>
                        </a>
                        <a href="about.html" class="btn btn-outline-main rounded-pill flex-align gap-8" data-aos="fade-left">
                            О нас
                            <i class="ph-bold ph-arrow-up-right d-flex text-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="banner-thumb position-relative">
                    <img src="{{ Storage::url('banner.png') }}" alt="" class="banner-thumb__img rounded-12 wow bounceIn" data-wow-duration="3s" data-wow-delay=".5s" data-tilt data-tilt-max="12" data-tilt-speed="500" data-tilt-perspective="5000" data-tilt-full-page-listening data-tilt-scale="1.02">

                    <img src="assets/public/images/shapes/curve-arrow.png" alt="" class="curve-arrow position-absolute">

                    <div class="banner-box one px-24 py-12 rounded-12 bg-white fw-medium box-shadow-lg d-inline-block" data-aos="fade-down">
                        <span class="text-main-600">36k+</span> Enrolled Students
                        <div class="enrolled-students mt-12">
                            <img src="assets/public/images/thumbs/enroll-student-img1.png" alt="" class="w-48 h-48 rounded-circle object-fit-cover">
                            <img src="assets/public/images/thumbs/enroll-student-img2.png" alt="" class="w-48 h-48 rounded-circle object-fit-cover">
                            <img src="assets/public/images/thumbs/enroll-student-img3.png" alt="" class="w-48 h-48 rounded-circle object-fit-cover">
                            <img src="assets/public/images/thumbs/enroll-student-img4.png" alt="" class="w-48 h-48 rounded-circle object-fit-cover">
                            <img src="assets/public/images/thumbs/enroll-student-img5.png" alt="" class="w-48 h-48 rounded-circle object-fit-cover">
                            <img src="assets/public/images/thumbs/enroll-student-img6.png" alt="" class="w-48 h-48 rounded-circle object-fit-cover">
                        </div>
                    </div>
                    <div class="banner-box two px-24 py-12 rounded-12 bg-white fw-medium box-shadow-lg flex-align d-inline-flex gap-16" data-aos="fade-up">
                        <span class="banner-box__icon flex-shrink-0 w-48 h-48 bg-purple-400 text-white text-2xl flex-center rounded-circle"><i class="ph ph-watch"></i></span>
                        <div>
                            <h6 class="mb-4">20% OFF</h6>
                            <span class="">For All Courses</span>
                        </div>
                    </div>
                    <div class="banner-box three px-24 py-12 rounded-12 bg-white fw-medium box-shadow-lg flex-align d-inline-flex gap-16" data-aos="fade-left">
                        <span class="banner-box__icon flex-shrink-0 w-48 h-48 bg-main-50 text-main-600 text-2xl flex-center rounded-circle"><i class="ph ph-phone-call"></i></span>
                        <div>
                            <span class="">Online Supports</span>
                            <a href="tel:(704)555-0127" class="mt-8 fw-medium text-xl d-block text-main-600 hover-text-main-500">(704) 555-0127</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= Banner SEction End =============================== -->
