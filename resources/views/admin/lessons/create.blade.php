@extends('admin.layouts.app')
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
                            <div class="card-title">Создать урок</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('modules.lessons.store', $module) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Course Info-->
                                <div class="mb-3">
                                    <label class="form-label">Модуль</label>
                                    <p class="form-control-static"><strong>{{ $module->title }}</strong></p>
                                </div>
                                <!--end::Course Info-->

                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Название</label>
                                            <input
                                                type="text"
                                                name="title"
                                                id="title"
                                                class="form-control"
                                                placeholder="Введите название урока"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lesson_order" class="form-label">Порядок</label>
                                            <input
                                                type="number"
                                                name="lesson_order"
                                                id="lesson_order"
                                                class="form-control"
                                                placeholder="Порядковый номер"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->

                                <!--begin::Description-->
                                <div class="mb-3">
                                    <label for="theory_text" class="form-label">Описание</label>
                                    <input
                                        type="text"
                                        name="theory_text"
                                        id="theory_text"
                                        class="form-control"
                                        placeholder="Краткое описание урока"
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
                                    ></textarea>
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
                                    ></textarea>
                                </div>
                                <!--end::Code-->

                                <!--begin::Presentation-->
                                <div class="mb-3">
                                    <label for="presentation" class="form-label">Презентация (PDF/PPT)</label>
                                    <input
                                        type="file"
                                        name="presentation"
                                        id="presentation"
                                        class="form-control"
                                        accept=".pdf,.ppt,.pptx"
                                    />
                                    <small class="form-text text-muted">Форматы: PDF, PPT, PPTX</small>
                                </div>
                                <!--end::Presentation-->

                                <!--begin::Video-->
                                <div class="mb-3">
                                    <label for="video" class="form-label">Видео (MP4)</label>
                                    <input
                                        type="file"
                                        name="video"
                                        id="video"
                                        class="form-control"
                                        accept=".mp4"
                                    />
                                    <small class="form-text text-muted">Формат: MP4</small>
                                </div>
                                <!--end::Video-->
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Создать урок</button>
                                <a href="{{ route('modules.show', $module->id) }}" class="btn btn-default float-end">Отмена</a>
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
