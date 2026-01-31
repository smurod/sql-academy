
@extends('admin.layouts.app')

@section('page-header')
    <x-breadcrumb
        title="Просмотр урока"
        :items="[
            ['label' => 'Home', 'url'=> route('dashboard')],
            ['label' => 'Модули', 'url'=> route('modules.index')],
            ['label' => 'Уроки', 'url'=> route('modules.show', $lesson->module_id)],
            ['label' => 'Просмотр урока', 'url'=> route('lessons.show', $lesson)],
        ]"
    ></x-breadcrumb>
@endsection

@section('content')
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-md-12">
                    <!--begin::Lesson Details-->
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">{{ $lesson->title }}</div>
                            <div class="card-tools">
                                <a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil me-1"></i>
                                    Редактировать
                                </a>
                            </div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Info Row-->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Модуль:</label>
                                        <p class="mb-0">{{ $lesson->module->title }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Порядок:</label>
                                        <p class="mb-0">{{ $lesson->lesson_order }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">ID урока:</label>
                                        <p class="mb-0">{{ $lesson->id }}</p>
                                    </div>
                                </div>
                            </div>
                            <!--end::Info Row-->

                            <!--begin::Description-->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Описание:</label>
                                <p class="mb-0">{{ $lesson->theory_text }}</p>
                            </div>
                            <!--end::Description-->

                            <!--begin::Lecture-->
                            @if($lesson->lecture)
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Лекция:</label>
                                    <div class="border rounded p-3 bg-light">
                                        <p class="mb-0" style="white-space: pre-wrap;">{{ $lesson->lecture }}</p>
                                    </div>
                                </div>
                            @endif
                            <!--end::Lecture-->

                            <!--begin::Code-->
                            @if($lesson->code)
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Код:</label>
                                    <div class="border rounded p-3 bg-dark text-light">
                                        <pre class="mb-0" style="font-family: monospace;"><code>{{ $lesson->code }}</code></pre>
                                    </div>
                                </div>
                            @endif
                            <!--end::Code-->

                            <!--begin::Files Row-->
                            <div class="row">
                                <!--begin::Presentation-->
                                @if($lesson->presentation)
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Презентация:</label>
                                        <div class="border rounded p-3">
                                            <a href="{{ Storage::url($lesson->presentation) }}" target="_blank" class="btn btn-outline-primary w-100">
                                                <i class="bi bi-file-earmark-pdf me-2"></i>
                                                Открыть презентацию
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <!--end::Presentation-->

                                <!--begin::Video-->
                                @if($lesson->video)
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Видео:</label>
                                        <div class="border rounded p-3">
                                            <video controls class="w-100" style="max-height: 300px;">
                                                <source src="{{ Storage::url($lesson->video) }}" type="video/mp4">
                                                Ваш браузер не поддерживает видео.
                                            </video>
                                        </div>
                                    </div>
                                @endif
                                <!--end::Video-->
                            </div>
                            <!--end::Files Row-->
                        </div>
                        <!--end::Body-->

                        <!--begin::Footer-->
                        <div class="card-footer">
                            <a href="{{ route('modules.show', $lesson->module_id) }}" class="btn btn-default">
                                <i class="bi bi-arrow-left me-1"></i>
                                Назад к списку уроков
                            </a>
                            <div class="float-end">
                                <a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil me-1"></i>
                                    Редактировать
                                </a>
                                <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" class="d-inline" onsubmit="return confirm('Вы уверены, что хотите удалить этот урок?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash me-1"></i>
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Lesson Details-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
