@extends('admin.layouts.app')

@section('title', 'Создать урок — SQLMastery Admin')

@section('page-header')
    <div>
        <div class="admin-breadcrumbs">
            <a href="{{ route('dashboard') }}">Главная</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('modules.index') }}">Модули</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('modules.show', $module->id) }}">{{ $module->title }}</a>
            <i class="bi bi-chevron-right"></i>
            <span>Создать урок</span>
        </div>

        <h1 class="admin-page-title">Создать <span>урок</span></h1>
        <p class="admin-page-subtitle">
            Добавьте новый урок в модуль и заполните содержимое с помощью визуального редактора.
        </p>
    </div>
@endsection

@section('content')
    <style>
        .admin-form-page {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 1rem;
        }

        .admin-form-card,
        .admin-side-card {
            position: relative;
            border-radius: 24px;
            border: 1px solid var(--border-color);
            background: var(--panel-bg);
            overflow: hidden;
            backdrop-filter: blur(14px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.22);
        }

        .admin-form-card::before,
        .admin-side-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59,130,246,0.07), rgba(147,51,234,0.04), transparent 60%);
            pointer-events: none;
        }

        .admin-form-head {
            position: relative;
            z-index: 1;
            padding: 1.35rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-form-head h2 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
        }

        .admin-form-head p {
            margin-top: .35rem;
            color: var(--text-secondary);
            font-size: .9rem;
        }

        .admin-form-body {
            position: relative;
            z-index: 1;
            padding: 1.5rem;
        }

        .admin-errors {
            margin-bottom: 1rem;
            border: 1px solid rgba(239,68,68,0.22);
            background: rgba(239,68,68,0.08);
            color: #fca5a5;
            border-radius: 18px;
            padding: 1rem 1.1rem;
        }

        .admin-errors ul {
            margin: 0;
            padding-left: 1.1rem;
        }

        .admin-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
        }

        .admin-form-group {
            display: flex;
            flex-direction: column;
            gap: .55rem;
        }

        .admin-form-group.full {
            grid-column: 1 / -1;
        }

        .admin-form-label {
            color: var(--text-primary);
            font-size: .95rem;
            font-weight: 600;
        }

        .admin-required {
            color: #f87171;
        }

        .admin-form-static {
            width: 100%;
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            color: var(--text-primary);
            border-radius: 16px;
            padding: .95rem 1rem;
            font-weight: 600;
        }

        .admin-input {
            width: 100%;
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            color: var(--text-primary);
            border-radius: 16px;
            padding: .95rem 1rem;
            outline: none;
            transition: all .25s ease;
            font-size: .95rem;
        }

        .admin-input:focus {
            border-color: rgba(59,130,246,0.28);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.08);
        }

        .admin-help-text {
            color: var(--text-muted);
            font-size: .82rem;
            line-height: 1.5;
        }

        /* TinyMCE скругление */
        .tox-tinymce {
            border-radius: 16px !important;
            border-color: var(--border-color) !important;
            overflow: hidden;
        }

        .admin-form-actions {
            position: relative;
            z-index: 1;
            padding: 1.25rem 1.5rem 1.5rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: .75rem;
            flex-wrap: wrap;
        }

        .admin-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .65rem;
            padding: .92rem 1.2rem;
            border-radius: 14px;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all .25s ease;
        }

        .admin-btn-secondary {
            background: var(--bg-soft);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .admin-btn-secondary:hover { transform: translateY(-2px); }

        .admin-btn-primary {
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 12px 28px rgba(59,130,246,0.24);
        }

        .admin-btn-primary:hover { transform: translateY(-2px); }

        .admin-side-body {
            position: relative;
            z-index: 1;
            padding: 1.4rem;
        }

        .admin-side-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: .8rem;
        }

        .admin-side-list {
            display: flex;
            flex-direction: column;
            gap: .85rem;
        }

        .admin-side-item {
            display: flex;
            gap: .75rem;
            align-items: flex-start;
            padding: .9rem;
            border-radius: 16px;
            background: var(--bg-soft);
            border: 1px solid var(--border-color);
        }

        .admin-side-item i {
            color: var(--primary);
            font-size: 1rem;
            margin-top: .1rem;
        }

        .admin-side-item strong {
            display: block;
            font-size: .92rem;
            margin-bottom: .25rem;
        }

        .admin-side-item span {
            color: var(--text-secondary);
            font-size: .84rem;
            line-height: 1.5;
        }

        @media (max-width: 1200px) {
            .admin-form-page { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .admin-form-grid { grid-template-columns: 1fr; }
        }
    </style>

    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#content',
            height: 600,
            menubar: true,

            plugins: [
                'advlist', 'autolink', 'lists', 'link',
                'charmap', 'preview', 'anchor', 'searchreplace',
                'visualblocks', 'code', 'fullscreen',
                'table', 'help', 'wordcount',
                'codesample',
            ],

            toolbar:
                'undo redo | blocks | ' +
                'bold italic underline strikethrough | ' +
                'bullist numlist | ' +
                'alignleft aligncenter alignright | ' +
                'link table | ' +
                'codesample code | ' +
                'fullscreen | help',

            codesample_languages: [
                { text: 'SQL',        value: 'sql'        },
                { text: 'PHP',        value: 'php'        },
                { text: 'JavaScript', value: 'javascript' },
                { text: 'HTML',       value: 'markup'     },
                { text: 'CSS',        value: 'css'        },
                { text: 'JSON',       value: 'json'       },
                { text: 'Bash',       value: 'bash'       },
                { text: 'Text',       value: 'none'       },
            ],

            skin: 'oxide-dark',
            content_css: 'dark',

            valid_elements: '*[*]',
            extended_valid_elements: '*[*]',

            promotion: false,
        });
    </script>

    <div class="admin-form-page">
        <div class="admin-form-card">
            <div class="admin-form-head">
                <h2>Новый урок</h2>
                <p>Создание урока для модуля: <strong>{{ $module->title }}</strong></p>
            </div>

            <div class="admin-form-body">
                @if ($errors->any())
                    <div class="admin-errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- ❌ Убрали enctype="multipart/form-data" — файлы не загружаем --}}
                <form action="{{ route('modules.lessons.store', $module) }}" method="POST">
                    @csrf

                    <div class="admin-form-grid">

                        {{-- Модуль (только отображение) --}}
                        <div class="admin-form-group full">
                            <label class="admin-form-label">Модуль</label>
                            <div class="admin-form-static">{{ $module->title }}</div>
                        </div>

                        {{-- Название --}}
                        <div class="admin-form-group">
                            <label for="title" class="admin-form-label">
                                Название <span class="admin-required">*</span>
                            </label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="admin-input"
                                value="{{ old('title') }}"
                                placeholder="Введите название урока"
                                required
                            />
                        </div>

                        {{-- Порядок --}}
                        <div class="admin-form-group">
                            <label for="lesson_order" class="admin-form-label">
                                Порядок <span class="admin-required">*</span>
                            </label>
                            <input
                                type="number"
                                name="lesson_order"
                                id="lesson_order"
                                class="admin-input"
                                value="{{ old('lesson_order') }}"
                                placeholder="Порядковый номер"
                                required
                            />
                        </div>

                        {{-- Тип урока --}}
                        <div class="admin-form-group full">
                            <label for="lesson_type" class="admin-form-label">
                                Тип урока <span class="admin-required">*</span>
                            </label>
                            <select name="lesson_type" id="lesson_type" class="admin-input">
                                <option value="theory"
                                    {{ old('lesson_type') === 'theory' ? 'selected' : '' }}>
                                    Теория
                                </option>
                                <option value="practice"
                                    {{ old('lesson_type') === 'practice' ? 'selected' : '' }}>
                                    Практика
                                </option>
                                <option value="parent"
                                    {{ old('lesson_type') === 'parent' ? 'selected' : '' }}>
                                    Родительский
                                </option>
                            </select>
                        </div>

                        {{-- HTML контент через TinyMCE --}}
                        <div class="admin-form-group full">
                            <label for="content" class="admin-form-label">
                                Содержимое урока <span class="admin-required">*</span>
                            </label>

                            <textarea
                                name="content"
                                id="content"
                                rows="20"
                            >{!! old('content') !!}</textarea>

                            <div class="admin-help-text">
                                Используйте редактор для форматирования текста.
                                Для вставки кода нажмите кнопку
                                <strong>«Insert/Edit Code Sample»</strong>
                                и выберите язык (SQL, PHP и др.).
                            </div>
                        </div>

                    </div>

                    <div class="admin-form-actions">
                        <a href="{{ route('modules.show', $module->id) }}" class="admin-btn admin-btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            <span>Отмена</span>
                        </a>

                        <button type="submit" class="admin-btn admin-btn-primary">
                            <i class="bi bi-plus-circle-fill"></i>
                            <span>Создать урок</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Боковые подсказки --}}
        <div class="admin-side-card">
            <div class="admin-side-body">
                <div class="admin-side-title">Подсказки</div>

                <div class="admin-side-list">
                    <div class="admin-side-item">
                        <i class="bi bi-sort-numeric-down"></i>
                        <div>
                            <strong>Порядок урока</strong>
                            <span>Следите чтобы порядок уроков внутри модуля оставался последовательным.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-type-h1"></i>
                        <div>
                            <strong>Заголовки</strong>
                            <span>Используйте Heading 2 и Heading 3 для структурирования урока по разделам.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-code-slash"></i>
                        <div>
                            <strong>Вставка кода</strong>
                            <span>Кнопка «Code Sample» добавляет блок кода с подсветкой. Выберите язык SQL для запросов.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-eye"></i>
                        <div>
                            <strong>Предпросмотр</strong>
                            <span>Кнопка «Preview» покажет как будет выглядеть урок перед сохранением.</span>
                        </div>
                    </div>

                    <div class="admin-side-item">
                        <i class="bi bi-braces"></i>
                        <div>
                            <strong>Исходный HTML</strong>
                            <span>Кнопка «Source Code» позволяет редактировать чистый HTML напрямую.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
