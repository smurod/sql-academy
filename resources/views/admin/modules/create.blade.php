@extends('admin.layouts.app')

@section('page-header')
    <x-breadcrumb
        title="Добавление модуля"
        :items="[
            ['label' => 'Home', 'url'=> route('dashboard')],
            ['label' => 'Модули', 'url'=> route('modules.index')],
            ['label' => 'Добавление модуля', 'url'=> route('modules.create')],
        ]"
    ></x-breadcrumb>
@endsection

@section('content')
    <div class="col-md-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-12">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">Добавление модуля</div>
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

            <form action="{{ route('modules.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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
                            rows="6"
                            placeholder="Введите описание модуля"
                        ></textarea>
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Body-->

                <!--begin::Footer-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        Добавить модуль
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
