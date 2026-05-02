@if ($paginator->hasPages())
    <div class="tasks-pagination">
        {{-- Кнопка "Назад" --}}
        @if ($paginator->onFirstPage())
            <button class="page-btn disabled" disabled>
                <i class="bi bi-chevron-left"></i>
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-btn" rel="prev">
                <i class="bi bi-chevron-left"></i>
            </a>
        @endif

        {{-- Номера страниц --}}
        @foreach ($elements as $element)
            {{-- Троеточие --}}
            @if (is_string($element))
                <span class="page-btn disabled">{{ $element }}</span>
            @endif

            {{-- Ссылки --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-btn active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Кнопка "Вперёд" --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-btn" rel="next">
                <i class="bi bi-chevron-right"></i>
            </a>
        @else
            <button class="page-btn disabled" disabled>
                <i class="bi bi-chevron-right"></i>
            </button>
        @endif
    </div>
@endif
