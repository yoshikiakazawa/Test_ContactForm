<style>
    .ui.pagination.menu {
    display: flex;
    justify-content: center;
    list-style-type: none;
    padding: 0;
}

.ui.pagination.menu .item {
    padding: 0.5em 1em;
    margin: 0 0.25em;
    color: rgba(0, 0, 0, 0.87);
    background: #fff;
    border: 1px solid rgba(34, 36, 38, 0.15);
    text-decoration: none;
    border-radius: 0.28571429rem;
    transition: background 0.1s ease, color 0.1s ease, box-shadow 0.1s ease, background-color 0.1s ease;
}

.ui.pagination.menu .active.item {
    background: #2185d0;
    color: #fff;
}

.ui.pagination.menu .disabled.item {
    pointer-events: none;
    cursor: default;
    opacity: 0.5;
}

.ui.pagination.menu .icon.item i.icon {
    vertical-align: middle;
}
</style>

@if ($paginator->hasPages())
    <div class="ui pagination menu" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="icon item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"> <i class="left chevron icon"></i> </a>
        @else
            <a class="icon item" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"> <i class="left chevron icon"></i> </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="icon item disabled" aria-disabled="true">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="item active" href="{{ $url }}" aria-current="page">{{ $page }}</a>
                    @else
                        <a class="item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="icon item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"> <i class="right chevron icon"></i> </a>
        @else
            <a class="icon item disabled" aria-disabled="true" aria-label="@lang('pagination.next')"> <i class="right chevron icon"></i> </a>
        @endif
    </div>
@endif
