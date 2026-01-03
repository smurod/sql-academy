@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-12">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">Редактирование урока</div>
            </div>
            <!--end::Header-->

            <!--begin::Form-->
            <form action="{{ route('lessons.update', $lesson->id) }}" method="post">
                @csrf
                @method('put')

                <!--begin::Body-->
                <div class="card-body">

                    <div class="mb-12">
                        <label class="form-label">Название урока</label>
                        <input
                            name="title"
                            type="text"
                            class="form-control"
                            value="{{ $lesson->title }}"
                        />
                    </div>

                    <div class="mb-12">
                        <label class="form-label">Теория урока</label>
                        <script src="{{ asset('assets/admin/dist/js/tinymce/tinymce.min.js') }}"></script>
                        <textarea name="theory_text" class="form-control">{{ $lesson->theory_text }}</textarea>
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
                            value="{{ $lesson->lesson_order }}"
                        />
                    </div>

                </div>
                <!--end::Body-->

                <!--begin::Footer-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Сохранить
                    </button>
                </div>
                <!--end::Footer-->

            </form>
            <!--end::Form-->
        </div>
        <!--end::Quick Example-->
    </div>
@endsection
