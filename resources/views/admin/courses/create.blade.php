@extends('admin.layouts.app')
@section('page-header')
    <x-breadcrumb
        title="Добавление курса"
        :items="[
    ['label' => 'Home', 'url'=> route('dashboard')],
    ['label' => 'Курсы', 'url'=> route('courses.index')],
    ['label' => 'Добавление курса', 'url'=> route('courses.create')],
]"
    ></x-breadcrumb>
@endsection
@section('content')
    <div class="col-md-12">
    <!--begin::Quick Example-->
    <div class="card card-primary card-outline mb-12">
        <!--begin::Header-->
        <div class="card-header"><div class="card-title">Добавление курса</div></div>
        <!--end::Header-->
        <!--begin::Form-->


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('courses.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-3xl font-bold mb-6 text-center">Добавление курса</h2>

                <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Название курса -->
                    <div>
                        <label class="block text-lg font-medium text-gray-700 mb-2" for="title">Название курса</label>
                        <input type="text" name="title" id="title"
                               class="w-full border border-gray-300 rounded-md p-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Введите название курса">
                    </div>

                    <!-- Описание -->
                    <div>
                        <label class="block text-lg font-medium text-gray-700 mb-2" for="description">Описание</label>
                        <textarea name="description" id="description" rows="6"
                                  class="w-full border border-gray-300 rounded-md p-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Введите описание курса"></textarea>
                    </div>

                    <!-- Дата начала -->
                    <div>
                        <label class="block text-lg font-medium text-gray-700 mb-2" for="start_date">Дата начала</label>
                        <input type="date" name="start_date" id="start_date"
                               class="w-full border border-gray-300 rounded-md p-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Продолжительность -->
                    <div>
                        <label class="block text-lg font-medium text-gray-700 mb-2" for="duration">Продолжительность (месяцев)</label>
                        <input type="number" name="duration" id="duration"
                               class="w-full border border-gray-300 rounded-md p-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Введите количество месяцев">
                    </div>

                    <!-- Фото курса -->
                    <div>
                        <label class="block text-lg font-medium text-gray-700 mb-2" for="image">Фото курса</label>
                        <input type="file" name="image" id="image"
                               class="w-full text-gray-600">
                    </div>

                    <!-- Дополнительная информация -->
                    <div>
                        <label class="block text-lg font-medium text-gray-700 mb-2" for="extra_info">Дополнительная информация</label>
                        <textarea name="extra_info" id="extra_info" rows="5"
                                  class="w-full border border-gray-300 rounded-md p-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Введите дополнительную информацию"></textarea>
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

                    <!-- Кнопка отправки -->
                    <div>
                        <button type="submit"
                                class="w-full bg-blue-600 text-white font-bold py-3 text-lg rounded-md hover:bg-blue-700 transition">
                            Добавить курс
                        </button>
                    </div>
                </form>
            </div>


            <!--end::Body-->
            <!--begin::Footer-->


            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Quick Example-->
    </div>

@endsection
