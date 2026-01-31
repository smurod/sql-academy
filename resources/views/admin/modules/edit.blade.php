@extends('admin.layouts.app')

@section('page-header')
    <x-breadcrumb
        title="Редактирование модуля"
        :items="[
            ['label' => 'Home', 'url'=> route('dashboard')],
            ['label' => 'Модули', 'url'=> route('modules.index')],
            ['label' => 'Редактирование модуля', 'url'=> route('modules.edit', $module)],
        ]"
    ></x-breadcrumb>
@endsection

@section('content')
    <div class="col-md-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-12">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">Редактирование модуля: {{ $module->title }}</div>
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

            <form action="{{ route('modules.update', $module) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Скрытое поле с course_id = 1 -->
                <input type="hidden" name="course_id" value="1">

                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Название модуля <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="form-control"
                                    placeholder="Введите название модуля"
                                    value="{{ old('title', $module->title) }}"
                                    required
                                />
                            </div>
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="order_index" class="form-label">Порядковый номер <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    name="order_index"
                                    id="order_index"
                                    class="form-control"
                                    placeholder="Введите порядковый номер"
                                    value="{{ old('order_index', $module->order_index) }}"
                                    min="1"
                                    required
                                />
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                    <!--begin::Description-->
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea
                            name="description"
                            id="description"
                            class="form-control"

                            Brother, [31.01.2026 13:01]
                            rows="6"
                            placeholder="Введите описание модуля"
                        >{{ old('description', $module->description) }}</textarea>
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Body-->

                <!--begin::Footer-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Сохранить изменения
                    </button>
                    <a href="{{ route('modules.index') }}" class="btn btn-default float-end">
                        <i class="bi bi-x-circle me-1"></i>
                        Отмена
                    </a>
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Quick Example-->
    </div>
@endsection
