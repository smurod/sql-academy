@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-12">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Добавление курса</div></div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{route('tasks.update', $task)}}" method="post">
                @csrf
                @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="col-md-12">
                        <label for="validationCustom04" class="form-label">Урок</label>
                        <select class="form-select" name="lesson_id" required>
                            @foreach($lessons as $lesson)
                                <option value="{{ $lesson->id }}"
                                    {{ old('lesson_id', $model->lesson_id ?? '') == $lesson->id ? 'selected' : '' }}>
                                    {{ $lesson->title }}
                                </option>
                            @endforeach
                        </select><br>
                        <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                    <div class="mb-12">
                        <label class="form-label">Название задание</label>
                        <input
                            name="title"
                            type="text"
                            class="form-control"
                            value="{{$task->title}}"
                        /><br>
                    </div>
                    <div class="mb-12">
                        <label class="form-label">Текст задание</label>
                        <input
                            name="task_text"
                            type="text"
                            class="form-control"
                            value="{{$task->task_text}}"
                        /><br>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Уровень</label>
                        <select class="form-select" name="difficulty" required>
                            <option disabled value="">Выберите уровень...</option>

                            <option value="beginner" {{ (old('difficulty', $task->difficulty) == 'beginner') ? 'selected' : '' }}>
                                Beginner
                            </option>

                            <option value="middle" {{ (old('difficulty', $task->difficulty) == 'middle') ? 'selected' : '' }}>
                                Middle
                            </option>

                            <option value="advanced" {{ (old('difficulty', $task->difficulty) == 'advanced') ? 'selected' : '' }}>
                                Advanced
                            </option>
                        </select><br>
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
