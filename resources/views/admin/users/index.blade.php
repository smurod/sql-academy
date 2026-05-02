@extends('admin.layouts.app')

@section('title', 'Список пользователей — SQLMastery Admin')

@section('page-header')
    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:1rem;flex-wrap:wrap;">
        <div>
            <div class="admin-breadcrumbs">
                <a href="{{ route('dashboard') }}">Главная</a>
                <i class="bi bi-chevron-right"></i>
                <span>Пользователи</span>
            </div>

            <h1 class="admin-page-title">Список <span>пользователей</span></h1>
            <p class="admin-page-subtitle">
                Просмотр, редактирование, удаление и управление правами доступа пользователей.
            </p>
        </div>
    </div>
@endsection

@section('content')
    <style>
        .admin-table-card {
            position: relative;
            border-radius: 24px;
            border: 1px solid var(--border-color);
            background: var(--panel-bg);
            overflow: hidden;
            backdrop-filter: blur(14px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.22);
        }

        .admin-table-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59,130,246,0.07), rgba(147,51,234,0.04), transparent 60%);
            pointer-events: none;
        }

        .admin-table-head {
            position: relative;
            z-index: 1;
            padding: 1.3rem 1.4rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-table-head h2 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .admin-table-head p {
            margin-top: .35rem;
            color: var(--text-secondary);
            font-size: .88rem;
        }

        .admin-table-wrap {
            position: relative;
            z-index: 1;
            overflow-x: auto;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        .admin-table th {
            text-align: left;
            padding: .95rem 1rem;
            color: var(--text-muted);
            font-size: .76rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }

        .admin-table td {
            padding: 1rem;
            color: var(--text-primary);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: .94rem;
            vertical-align: middle;
        }

        .admin-table tr:hover td {
            background: rgba(255,255,255,0.02);
        }

        .admin-id-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            padding: .42rem .6rem;
            border-radius: 999px;
            background: var(--bg-soft);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            font-family: 'JetBrains Mono', monospace;
            font-size: .8rem;
        }

        .admin-user-name {
            font-weight: 700;
            color: var(--text-primary);
        }

        .admin-user-email {
            color: var(--text-secondary);
            font-size: .85rem;
        }

        .admin-status-badge {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .4rem .7rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 600;
            border: 1px solid transparent;
        }

        .admin-status-active {
            color: #86efac;
            background: rgba(34,197,94,0.10);
            border-color: rgba(34,197,94,0.18);
        }

        .admin-status-inactive {
            color: #fca5a5;
            background: rgba(239,68,68,0.10);
            border-color: rgba(239,68,68,0.18);
        }

        .admin-role-badge {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .4rem .7rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 600;
            border: 1px solid transparent;
        }

        .admin-role-admin {
            color: #c4b5fd;
            background: rgba(139,92,246,0.10);
            border-color: rgba(139,92,246,0.18);
        }

        .admin-role-user {
            color: #93c5fd;
            background: rgba(59,130,246,0.10);
            border-color: rgba(59,130,246,0.18);
        }

        .admin-verified-badge {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            font-size: .82rem;
        }

        .admin-verified-yes {
            color: #86efac;
        }

        .admin-verified-no {
            color: var(--text-muted);
        }

        .admin-provider-badge {
            display: inline-flex;
            align-items: center;
            padding: .35rem .6rem;
            border-radius: 999px;
            font-size: .76rem;
            font-weight: 600;
            background: var(--bg-soft);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            text-transform: capitalize;
        }

        .admin-date-text {
            color: var(--text-secondary);
            font-size: .85rem;
            white-space: nowrap;
        }

        .admin-action-btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .75rem .95rem;
            border-radius: 12px;
            font-size: .86rem;
            font-weight: 600;
            border: 1px solid var(--border-color);
            background: var(--bg-soft);
            color: var(--text-primary);
            transition: all .22s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .admin-action-btn:hover {
            transform: translateY(-2px);
        }

        .admin-action-btn.primary:hover {
            border-color: rgba(59,130,246,0.2);
            background: rgba(59,130,246,0.08);
        }

        .admin-action-btn.danger:hover {
            border-color: rgba(239,68,68,0.2);
            background: rgba(239,68,68,0.08);
        }

        .admin-actions-cell {
            display: flex;
            gap: .5rem;
            flex-wrap: nowrap;
        }

        .admin-empty-state {
            position: relative;
            z-index: 1;
            padding: 2rem 1.5rem;
            color: var(--text-secondary);
        }
    </style>

    <div class="admin-table-card">
        <div class="admin-table-head">
            <h2>Пользователи</h2>
            <p>Всего пользователей: {{ $users->count() }}</p>
        </div>

        @if($users->count())
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя / Email</th>
                        <th>Роль</th>
                        <th>Статус</th>
                        <th>Email подтверждён</th>
                        <th>Провайдер</th>
                        <th>Дата регистрации</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <span class="admin-id-badge">#{{ $user->id }}</span>
                            </td>

                            <td>
                                <div class="admin-user-name">{{ $user->name }}</div>
                                <div class="admin-user-email">{{ $user->email }}</div>
                            </td>

                            <td>
                                @if($user->is_admin)
                                    <span class="admin-role-badge admin-role-admin">
                                        <i class="bi bi-shield-fill-check"></i> Админ
                                    </span>
                                @else
                                    <span class="admin-role-badge admin-role-user">
                                        <i class="bi bi-person-fill"></i> Пользователь
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($user->is_active)
                                    <span class="admin-status-badge admin-status-active">
                                        <i class="bi bi-check-circle-fill"></i> Активен
                                    </span>
                                @else
                                    <span class="admin-status-badge admin-status-inactive">
                                        <i class="bi bi-x-circle-fill"></i> Заблокирован
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($user->email_verified_at)
                                    <span class="admin-verified-badge admin-verified-yes">
                                        <i class="bi bi-patch-check-fill"></i> Да
                                    </span>
                                @else
                                    <span class="admin-verified-badge admin-verified-no">
                                        <i class="bi bi-patch-exclamation"></i> Нет
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($user->provider)
                                    <span class="admin-provider-badge">{{ $user->provider }}</span>
                                @else
                                    <span style="color:var(--text-muted);font-size:.85rem;">—</span>
                                @endif
                            </td>

                            <td>
                                <span class="admin-date-text">
                                    {{ $user->created_at->format('d.m.Y') }}
                                </span>
                            </td>

                            <td>
                                <div class="admin-actions-cell">
                                    <a class="admin-action-btn primary"
                                       href="{{ route('users.show', $user) }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="admin-empty-state">
                Пользователи ещё не зарегистрированы.
            </div>
        @endif
    </div>
@endsection
