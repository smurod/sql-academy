@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
    <!--begin::Quick Example-->
    <div class="card card-primary card-outline mb-12">
        <!--begin::Header-->
        <div class="card-header"><div class="card-title">Добавление курса</div></div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="{{route('courses.store')}}" method="post">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="mb-12">
                    <label class="form-label">Название курса</label>
                    <input
                        name="title"
                        type="text"
                        class="form-control"
                    />
                </div>
                <div class="mb-12">
                    <label class="form-label">Описание курса</label>
                    <script src="{{asset('assets/admin/dist/js/tinymce/tinymce.min.js')}}"></script>
                    <textarea name="description" class="form-control"></textarea>
                    <script type="text/javascript">
                        tinymce.init({
                            selector: 'textarea',  // change this value according to your HTML
                            license_key: 'gpl',
                            plugins: 'a_tinymce_plugin',
                            a_plugin_option: true,
                            a_configuration_option: 400
                        });
                    </script>

                </div>
                <div class="col-md-12">
                    <label class="form-label">Уровень</label>
                    <select class="form-select" name="level" required>
                        <option selected disabled value="">Выберите уровень...</option>
                        <option value="beginner">Beginner</option>
                        <option value="middle">Middle</option>
                        <option value="advanced">Advanced</option>
                    </select>
                    <div class="invalid-feedback">Please select a valid state.</div>
                </div>

            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Quick Example-->
    </div>
@endsection
