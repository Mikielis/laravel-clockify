
@isset($breadcrumb)
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ _('Home') }}</a></li>
            @foreach ($breadcrumb as $item)
                @isset($item['url'])
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $item['name'] }}</li>
                @endisset
            @endforeach
        </ol>
    </nav>
@endisset
