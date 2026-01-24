@extends('admin.layouts.app')
@section('content')

    <div class="col-md-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-12">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Добавление курса</div></div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{route('courses.update', $course)}}" method="post">
                @csrf
                @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="mb-12">
                        <label class="form-label">Название курса</label>
                        <input
                            name="title"
                            type="text"
                            class="form-control"
                            value="{{$course->title}}"
                        />
                    </div>
                    <div class="mb-12">
                        <label class="form-label">Описание курса</label>

                        <script>
                            $(document).ready(function () { $("#input").cleditor(); });
                        </script>

                        <textarea id="input" name="description">{{ old('description', $course->description) }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Уровень</label>
                        <select class="form-select" name="level" required>
                            <option disabled value="">Выберите уровень...</option>

                            <option value="beginner" {{ (old('level', $course->level) == 'beginner') ? 'selected' : '' }}>
                                Beginner
                            </option>

                            <option value="middle" {{ (old('level', $course->level) == 'middle') ? 'selected' : '' }}>
                                Middle
                            </option>

                            <option value="advanced" {{ (old('level', $course->level) == 'advanced') ? 'selected' : '' }}>
                                Advanced
                            </option>
                        </select>
                        <div class="invalid-feedback">Please select a valid state.</div>
                    </div>

                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    <a class="btn btn-outline-warning" href="{{route('courses.index')}}">Отмена</a>
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Quick Example-->
    </div>

@endsection
