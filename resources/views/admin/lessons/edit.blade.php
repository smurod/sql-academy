@extends('admin.layouts.app')

@section('page-header')
    <x-breadcrumb
        title="Редактирование урока"
        :items="[
            ['label' => 'Home', 'url'=> route('dashboard')],
            ['label' => 'Модули', 'url'=> route('modules.index')],
            ['label' => 'Уроки', 'url'=> route('modules.show', $lesson->module_id)],
            ['label' => 'Редактирование урока', 'url'=> route('lessons.edit', $lesson)],
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
                    <!--begin::General Form Elements-->
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Редактирование урока: {{ $lesson->title }}</div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Form-->
                        @if ($errors->any())
                            <div class="alert alert-danger mx-3 mt-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('lessons.update', $lesson) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Module Info-->
                                <div class="mb-3">
                                    <label class="form-label">Модуль</label>
                                    <p class="form-control-static"><strong>{{ $lesson->module->title }}</strong></p>
                                </div>
                                <!--end::Module Info-->

                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Название <span class="text-danger">*</span></label>
                                            <input
                                                type="text"
                                                name="title"
                                                id="title"
                                                class="form-control"
                                                placeholder="Введите название урока"
                                                value="{{ old('title', $lesson->title) }}"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lesson_order" class="form-label">Порядок <span class="text-danger">*</span></label>

                                            <input
                                                type="number"
                                                name="lesson_order"
                                                id="lesson_order"
                                                class="form-control"
                                                placeholder="Порядковый номер"
                                                value="{{ old('lesson_order', $lesson->lesson_order) }}"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->

                                <!--begin::Description-->
                                <div class="mb-3">
                                    <label for="theory_text" class="form-label">Описание <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        name="theory_text"
                                        id="theory_text"
                                        class="form-control"
                                        placeholder="Краткое описание урока"
                                        value="{{ old('theory_text', $lesson->theory_text) }}"
                                        required
                                    />
                                </div>
                                <!--end::Description-->

                                <!--begin::Lecture-->
                                <div class="mb-3">
                                    <label for="lecture" class="form-label">Лекция (текст)</label>
                                    <textarea
                                        name="lecture"
                                        id="lecture"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Введите текст лекции"
                                    >{{ old('lecture', $lesson->lecture) }}</textarea>
                                </div>
                                <!--end::Lecture-->

                                <!--begin::Code-->
                                <div class="mb-3">
                                    <label for="code" class="form-label">Код</label>
                                    <textarea
                                        name="code"
                                        id="code"
                                        class="form-control"
                                        rows="8"
                                        placeholder="Вставьте код"
                                        style="font-family: monospace;"
                                    >{{ old('code', $lesson->code) }}</textarea>
                                </div>
                                <!--end::Code-->

                                <!--begin::Presentation-->
                                <div class="mb-3">
                                    <label for="presentation" class="form-label">Презентация (PDF/PPT)</label>
                                    @if($lesson->presentation)
                                        <div class="mb-2">
                                            <small class="text-muted">
                                                Текущий файл:
                                                <a href="{{ Storage::url($lesson->presentation) }}" target="_blank" class="text-primary">
                                                    <i class="bi bi-file-earmark-pdf"></i> Скачать презентацию

                                                </a>
                                            </small>
                                        </div>
                                    @endif
                                    <input
                                        type="file"
                                        name="presentation"
                                        id="presentation"
                                        class="form-control"
                                        accept=".pdf,.ppt,.pptx"
                                    />
                                    <small class="form-text text-muted">Форматы: PDF, PPT, PPTX. Оставьте пустым, если не хотите менять файл.</small>
                                </div>
                                <!--end::Presentation-->

                                <!--begin::Video-->
                                <div class="mb-3">
                                    <label for="video" class="form-label">Видео (MP4)</label>
                                    @if($lesson->video)
                                        <div class="mb-2">
                                            <small class="text-muted">
                                                Текущий файл:
                                                <a href="{{ Storage::url($lesson->video) }}" target="_blank" class="text-primary">
                                                    <i class="bi bi-camera-video"></i> Открыть видео
                                                </a>
                                            </small>
                                        </div>
                                    @endif
                                    <input
                                        type="file"
                                        name="video"
                                        id="video"
                                        class="form-control"
                                        accept=".mp4"
                                    />
                                    <small class="form-text text-muted">Формат: MP4. Оставьте пустым, если не хотите менять файл.</small>
                                </div>
                                <!--end::Video-->
                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i>
                                    Сохранить изменения
                                </button>
                                <a href="{{ route('modules.show', $lesson->module_id) }}" class="btn btn-default float-end">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Отмена
                                </a>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::General Form Elements-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
