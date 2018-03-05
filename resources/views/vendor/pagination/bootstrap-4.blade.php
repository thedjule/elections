@if ($paginator->hasPages())
    <nav class="pagination is-small" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="pagination-previous p-l-10 p-r-10" disabled>&laquo; Previous</a>
        @else
            <a class="pagination-previous p-l-10 p-r-10" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="pagination-next p-l-10 p-r-10" href="{{ $paginator->nextPageUrl() }}" rel="next">Next Page &raquo;</a>
        @else
            <a class="pagination-next p-l-10 p-r-10" disabled>Next Page &raquo;</a>
        @endif

        <ul class="pagination-list">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><a class="pagination-link p-l-10 p-r-10">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="pagination-link is-current p-l-10 p-r-10">{{ $page }}</a></li>
                        @else
                            <li><a class="pagination-link p-l-10 p-r-10" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif
