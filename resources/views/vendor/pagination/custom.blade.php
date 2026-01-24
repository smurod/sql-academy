@if ($paginator->hasPages())
    <ul class="pagination mt-40 flex-align gap-12 flex-wrap justify-content-center">
        {{-- Кнопка "Назад" --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link text-neutral-700 fw-semibold w-40 h-40 bg-main-25 rounded-circle border-neutral-30 flex-center p-0" style="opacity: 0.5; cursor: not-allowed;">
                    <i class="ph-bold ph-caret-left"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link text-neutral-700 fw-semibold w-40 h-40 bg-main-25 rounded-circle hover-bg-main-600 border-neutral-30 hover-border-main-600 hover-text-white flex-center p-0" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="ph-bold ph-caret-left"></i>
                </a>
            </li>
        @endif

        {{-- Номера страниц --}}
        @foreach ($elements as $element)
            {{-- "Три точки" разделитель --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link text-neutral-700 fw-semibold w-40 h-40 bg-main-25 rounded-circle border-neutral-30 flex-center p-0">{{ $element }}</span>
                </li>
            @endif

            {{-- Массив ссылок --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link text-white fw-semibold w-40 h-40 bg-main-600 rounded-circle border-main-600 flex-center p-0">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link text-neutral-700 fw-semibold w-40 h-40 bg-main-25 rounded-circle hover-bg-main-600 border-neutral-30 hover-border-main-600 hover-text-white flex-center p-0" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Кнопка "Вперёд" --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link text-neutral-700 fw-semibold w-40 h-40 bg-main-25 rounded-circle hover-bg-main-600 border-neutral-30 hover-border-main-600 hover-text-white flex-center p-0" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <i class="ph-bold ph-caret-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link text-neutral-700 fw-semibold w-40 h-40 bg-main-25 rounded-circle border-neutral-30 flex-center p-0" style="opacity: 0.5; cursor: not-allowed;">
                    <i class="ph-bold ph-caret-right"></i>
                </span>
            </li>
        @endif
    </ul>
@endif
