@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-12">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">Добавление урока</div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{ route('lessons.store') }}" method="post">
                @csrf
                <!--begin::Body-->
                <div class="card-body">

                    <div class="mb-12">
                        <label class="form-label">Курс</label>
                        <select name="course_id" class="form-select" required>
                            <option selected disabled value="">Выберите курс...</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-12">
                        <label class="form-label">Название урока</label>
                        <input
                            name="title"
                            type="text"
                            class="form-control"
                        />
                    </div>

                    <div class="mb-12">
                        <label class="form-label">Теория урока</label>
                        <script src="{{ asset('assets/admin/dist/js/tinymce/tinymce.min.js') }}"></script>
                        <textarea name="theory_text" class="form-control"></textarea>
                        <script type="text/javascript">
                            tinymce.init({
                                selector: 'textarea',
                                license_key: 'gpl',
                                plugins: 'a_tinymce_plugin',
                                a_plugin_option: true,
                                a_configuration_option: 400
                            });
                        </script>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Порядок урока</label>
                        <input
                            name="lesson_order"
                            type="number"
                            class="form-control"
                        />
                    </div>

                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Добавить
                    </button>
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Quick Example-->
    </div>
@endsection
