@extends('public.layouts.app')

@section('title', 'Рейтинг — SQL Мастер')

@section('styles')
    <style>
        .rating-page {
            padding: 2rem 0 4rem;
            min-height: calc(100vh - 72px);
        }

        .rating-page .section-inner {
            max-width: 860px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* ── HEADER ── */
        .rating-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .rating-header h1 {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 0.5rem;
        }

        .rating-header p {
            color: var(--text-secondary);
            font-size: 1rem;
        }

        /* ── PODIUM TOP 3 ── */
        .podium {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .podium-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        /* Порядок: 2-й слева, 1-й по центру, 3-й справа */
        .podium-second { order: 1; }
        .podium-first  { order: 2; }
        .podium-third  { order: 3; }

        /* ── Аватары ── */
        .podium-avatar {
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            border: 2px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--text-primary);
            flex-shrink: 0;
        }

        /* 1-е место — самый большой аватар */
        .podium-first .podium-avatar {
            width: 88px;
            height: 88px;
            font-size: 2rem;
            border-width: 3px;
            border-color: #fbbf24;
            box-shadow: 0 0 28px rgba(251,191,36,0.35);
        }

        /* 2-е и 3-е место */
        .podium-second .podium-avatar,
        .podium-third .podium-avatar {
            width: 68px;
            height: 68px;
            font-size: 1.5rem;
        }

        .podium-second .podium-avatar {
            border-color: #94a3b8;
            box-shadow: 0 0 16px rgba(148,163,184,0.2);
        }

        .podium-third .podium-avatar {
            border-color: #cd7f32;
            box-shadow: 0 0 16px rgba(180,83,9,0.2);
        }

        /* ── Имя ── */
        .podium-name {
            font-weight: 600;
            color: var(--text-primary);
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .podium-first .podium-name {
            font-size: 0.95rem;
            max-width: 120px;
        }

        .podium-second .podium-name,
        .podium-third .podium-name {
            font-size: 0.82rem;
            max-width: 100px;
        }

        /* ── XP ── */
        .podium-xp {
            color: var(--text-muted);
        }

        .podium-first .podium-xp {
            font-size: 0.85rem;
        }

        .podium-second .podium-xp,
        .podium-third .podium-xp {
            font-size: 0.75rem;
        }

        /* ── Постамент (блок снизу) ── */
        .podium-block {
            border-radius: 10px 10px 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .podium-first .podium-block {
            width: 130px;
            height: 100px;
            font-size: 2rem;
            background: linear-gradient(180deg, rgba(251,191,36,0.25), rgba(251,191,36,0.06));
            border: 1px solid rgba(251,191,36,0.4);
            color: #fbbf24;
        }

        .podium-second .podium-block {
            width: 110px;
            height: 75px;
            font-size: 1.6rem;
            background: linear-gradient(180deg, rgba(148,163,184,0.18), rgba(148,163,184,0.04));
            border: 1px solid rgba(148,163,184,0.25);
            color: #94a3b8;
        }

        .podium-third .podium-block {
            width: 110px;
            height: 56px;
            font-size: 1.6rem;
            background: linear-gradient(180deg, rgba(180,83,9,0.18), rgba(180,83,9,0.04));
            border: 1px solid rgba(180,83,9,0.25);
            color: #cd7f32;
        }

        /* ── TABLE ── */
        .rating-table-wrap {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
        }

        .rating-table-head {
            display: grid;
            grid-template-columns: 64px 1fr 140px;
            padding: 0.75rem 1.25rem;
            background: rgba(255,255,255,0.02);
            border-bottom: 1px solid var(--border-color);
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
        }

        .rating-table-head span:last-child {
            text-align: right;
        }

        .rating-row {
            display: grid;
            grid-template-columns: 64px 1fr 140px;
            align-items: center;
            padding: 0.875rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            transition: background 0.2s ease;
        }

        .rating-row:last-child { border-bottom: none; }

        .rating-row:hover { background: rgba(255,255,255,0.03); }

        .rating-row.is-me {
            background: rgba(99,102,241,0.07);
            border-color: rgba(99,102,241,0.12);
        }

        .rank-cell {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .rank-num {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-muted);
            width: 28px;
            text-align: right;
        }

        .rank-medal {
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 0.875rem;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-secondary);
            flex-shrink: 0;
        }

        .user-name {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .me-badge {
            display: inline-flex;
            align-items: center;
            font-size: 0.62rem;
            font-weight: 700;
            color: #818cf8;
            background: rgba(99,102,241,0.12);
            border: 1px solid rgba(99,102,241,0.2);
            padding: 0.1rem 0.45rem;
            border-radius: 4px;
            margin-left: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .xp-cell {
            text-align: right;
            font-size: 0.88rem;
            font-weight: 700;
            color: #818cf8;
        }

        /* ── PAGINATION ── */
        .tasks-pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .page-btn {
            min-width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: var(--bg-card);
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 500;
            font-family: inherit;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .page-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .page-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            box-shadow: 0 4px 15px var(--glow-primary);
        }

        .page-btn.disabled {
            opacity: 0.3;
            pointer-events: none;
        }

        /* ── EMPTY ── */
        .rating-empty {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--text-muted);
        }

        .rating-empty i {
            font-size: 2.5rem;
            opacity: 0.2;
            display: block;
            margin-bottom: 0.75rem;
        }

        @media (max-width: 640px) {
            .rating-header h1 { font-size: 1.6rem; }

            .podium { gap: 0.75rem; }

            .podium-first .podium-avatar  { width: 70px; height: 70px; font-size: 1.6rem; }
            .podium-second .podium-avatar,
            .podium-third .podium-avatar  { width: 54px; height: 54px; font-size: 1.2rem; }

            .podium-first .podium-block  { width: 100px; height: 80px; }
            .podium-second .podium-block { width: 86px;  height: 60px; }
            .podium-third .podium-block  { width: 86px;  height: 44px; }
        }
    </style>
@endsection

@section('content')
    <div class="rating-page">
        <div class="section-inner">

            {{-- Header --}}
            <div class="rating-header">
                <h1>🏆 <span class="gradient-text">Рейтинг</span> пользователей</h1>
                <p>Топ решателей SQL задач по набранным очкам</p>
            </div>

            @if($leaders->total() > 0)

                {{-- ═══ PODIUM TOP 3 (глобальный, из $topThree) ═══ --}}
                @if($topThree->count() >= 3)
                    @php
                        $first  = $topThree->get(0);
                        $second = $topThree->get(1);
                        $third  = $topThree->get(2);
                    @endphp
                    <div class="podium">

                        {{-- 2-е место — слева --}}
                        <div class="podium-item podium-second">
                            <div class="podium-avatar">
                                {{ mb_strtoupper(mb_substr($second->user->name ?? '?', 0, 1)) }}
                            </div>
                            <div class="podium-name">{{ $second->user->name ?? 'Неизвестно' }}</div>
                            <div class="podium-xp">{{ number_format($second->total_xp) }} XP</div>
                            <div class="podium-block">🥈</div>
                        </div>

                        {{-- 1-е место — по центру --}}
                        <div class="podium-item podium-first">
                            <div class="podium-avatar">
                                {{ mb_strtoupper(mb_substr($first->user->name ?? '?', 0, 1)) }}
                            </div>
                            <div class="podium-name">{{ $first->user->name ?? 'Неизвестно' }}</div>
                            <div class="podium-xp">{{ number_format($first->total_xp) }} XP</div>
                            <div class="podium-block">🥇</div>
                        </div>

                        {{-- 3-е место — справа --}}
                        <div class="podium-item podium-third">
                            <div class="podium-avatar">
                                {{ mb_strtoupper(mb_substr($third->user->name ?? '?', 0, 1)) }}
                            </div>
                            <div class="podium-name">{{ $third->user->name ?? 'Неизвестно' }}</div>
                            <div class="podium-xp">{{ number_format($third->total_xp) }} XP</div>
                            <div class="podium-block">🥉</div>
                        </div>

                    </div>
                @endif

                {{-- ═══ TABLE ═══ --}}
                <div class="rating-table-wrap">
                    <div class="rating-table-head">
                        <span>#</span>
                        <span>Пользователь</span>
                        <span style="text-align:right;">XP</span>
                    </div>

                    @foreach($leaders as $index => $leader)
                        @php
                            /* Глобальный ранг с учётом пагинации */
                            $rank  = ($leaders->currentPage() - 1) * $leaders->perPage() + $index + 1;
                            $isMe  = auth()->check() && auth()->id() === ($leader->user_id ?? null);
                            $medal = match(true) {
                                $rank === 1 => '🥇',
                                $rank === 2 => '🥈',
                                $rank === 3 => '🥉',
                                default     => '',
                            };
                            $name = $leader->user->name ?? 'Неизвестно';
                        @endphp
                        <div class="rating-row {{ $isMe ? 'is-me' : '' }}">

                            <div class="rank-cell">
                                <span class="rank-num">{{ $rank }}</span>
                                <span class="rank-medal">{{ $medal }}</span>
                            </div>

                            <div class="user-cell">
                                <div class="user-avatar">{{ mb_strtoupper(mb_substr($name, 0, 1)) }}</div>
                                <span class="user-name">
                                    {{ $name }}
                                    @if($isMe)<span class="me-badge">Вы</span>@endif
                                </span>
                            </div>

                            <div class="xp-cell">{{ number_format($leader->total_xp) }}</div>

                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                {{ $leaders->links('vendor.pagination.rating') }}

            @else
                <div class="rating-empty">
                    <i class="bi bi-trophy"></i>
                    <p>Рейтинг пока пуст. Будьте первым!</p>
                </div>
            @endif

        </div>
    </div>
@endsection
