@extends('admin.layouts.app')

@section('title', 'Просмотр пользователя — SQLMastery Admin')

@section('page-header')
    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:1rem;flex-wrap:wrap;">
        <div>
            <div class="admin-breadcrumbs">
                <a href="{{ route('dashboard') }}">Главная</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('users.index') }}">Пользователи</a>
                <i class="bi bi-chevron-right"></i>
                <span>Просмотр пользователя</span>
            </div>

            <h1 class="admin-page-title">Просмотр <span>пользователя</span></h1>
            <p class="admin-page-subtitle">
                Детальная информация о пользователе, его статусе и правах доступа.
            </p>
        </div>

    </div>
@endsection

@section('content')
    <style>
        .admin-show-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 1rem;
        }

        .admin-show-card,
        .admin-show-side {
            position: relative;
            border-radius: 24px;
            border: 1px solid var(--border-color);
            background: var(--panel-bg);
            overflow: hidden;
            backdrop-filter: blur(14px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.22);
        }

        .admin-show-card::before,
        .admin-show-side::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59,130,246,0.07), rgba(147,51,234,0.04), transparent 60%);
            pointer-events: none;
        }

        .admin-show-head {
            position: relative;
            z-index: 1;
            padding: 1.35rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-show-head h2 {
            font-size: 1.2rem;
            font-weight: 800;
            margin: 0;
        }

        .admin-show-body {
            position: relative;
            z-index: 1;
            padding: 1.5rem;
        }

        .admin-show-info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.2rem;
        }

        .admin-info-box {
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            border-radius: 18px;
            padding: 1rem;
        }

        .admin-info-box label {
            display: block;
            color: var(--text-muted);
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: .45rem;
        }

        .admin-info-box div {
            color: var(--text-primary);
            font-weight: 600;
        }

        .admin-show-section + .admin-show-section {
            margin-top: 1.2rem;
        }

        .admin-show-section-title {
            font-size: .98rem;
            font-weight: 700;
            margin-bottom: .65rem;
        }

        .admin-show-block {
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            border-radius: 18px;
            padding: 1rem 1.1rem;
            color: var(--text-secondary);
            line-height: 1.7;
        }

        .admin-show-footer {
            position: relative;
            z-index: 1;
            padding: 1.25rem 1.5rem 1.5rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .75rem;
        }

        .admin-show-btn {
            display: inline-flex;
            align-items: center;
            gap: .65rem;
            padding: .92rem 1.2rem;
            border-radius: 14px;
            font-weight: 600;
            border: 1px solid transparent;
            transition: all .25s ease;
        }

        .admin-show-btn.secondary {
            background: var(--bg-soft);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .admin-show-btn.primary {
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

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

        .admin-side-item {
            padding: .9rem;
            border-radius: 16px;
            background: var(--bg-soft);
            border: 1px solid var(--border-color);
            margin-bottom: .75rem;
        }

        @media (max-width: 1200px) {
            .admin-show-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="admin-show-layout">

        <div class="admin-show-card">
            <div class="admin-show-head">
                <h2>{{ $user->name }}</h2>
            </div>

            <div class="admin-show-body">

                <div class="admin-show-info-grid">
                    <div class="admin-info-box">
                        <label>ID</label>
                        <div>#{{ $user->id }}</div>
                    </div>

                    <div class="admin-info-box">
                        <label>Роль</label>
                        <div>
                            {{ $user->is_admin ? 'Администратор' : 'Пользователь' }}
                        </div>
                    </div>

                    <div class="admin-info-box">
                        <label>Статус</label>
                        <div>
                            {{ $user->is_active ? 'Активен' : 'Заблокирован' }}
                        </div>
                    </div>
                </div>

                <div class="admin-show-section">
                    <div class="admin-show-section-title">Email</div>
                    <div class="admin-show-block">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="admin-show-section">
                    <div class="admin-show-section-title">Email подтверждён</div>
                    <div class="admin-show-block">
                        @if($user->email_verified_at)
                            Да ({{ $user->email_verified_at->format('d.m.Y H:i') }})
                        @else
                            Нет
                        @endif
                    </div>
                </div>

                <div class="admin-show-section">
                    <div class="admin-show-section-title">Провайдер авторизации</div>
                    <div class="admin-show-block">
                        {{ $user->provider ?? 'Не используется' }}
                    </div>
                </div>

                <div class="admin-show-section">
                    <div class="admin-show-section-title">Дата регистрации</div>
                    <div class="admin-show-block">
                        {{ $user->created_at->format('d.m.Y H:i') }}
                    </div>
                </div>

            </div>

            <div class="admin-show-footer">
                <a href="{{ route('users.index') }}" class="admin-show-btn secondary">
                    <i class="bi bi-arrow-left"></i>
                    Назад
                </a>

            </div>
        </div>

        <div class="admin-show-side">
            <div class="admin-side-body">
                <div class="admin-side-title">Информация</div>

                <div class="admin-side-item">
                    <strong>Просмотр профиля</strong>
                    <div>Здесь отображаются основные данные выбранного пользователя.</div>
                </div>

                <div class="admin-side-item">
                    <strong>Редактирование</strong>
                    <div>Вы можете изменить роль, статус или другие параметры пользователя.</div>
                </div>

                <div class="admin-side-item">
                    <strong>Безопасность</strong>
                    <div>Проверьте подтверждение email и способ авторизации.</div>
                </div>
            </div>
        </div>

    </div>
@endsection
