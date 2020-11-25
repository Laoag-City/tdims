@if ($paginator->hasPages())
    <nav class="pagination is-centered" style="margin-top: 5px;margin-bottom: 5px;">
        <ul class="pagination-list">
            @if ($paginator->onFirstPage())
                <li><a class="pagination-previous" disabled>&lsaquo;</a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous">&lsaquo;</a></li>
            @endif

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-link" disabled><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-link is-current"><span>{{ $page }}</span></li>
                        @else
                            <li><a class="pagination-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" class="pagination-next">&rsaquo;</a></li>
            @else
                <li><a class="pagination-next" disabled>&rsaquo;</a></li>
            @endif
        </ul>
    </nav>
@endif