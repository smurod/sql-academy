<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">{{ $title }}</h3></div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
            @foreach($items as $item)
                @if(!$loop->last)
                        <li class="breadcrumb-item">
                            <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                        </li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $item['label'] }}
                        </li>
                @endif
            @endforeach
            </ol>
        </div>
    </div>
</div>
