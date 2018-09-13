@if ($paginator->hasPages())
    <nav class="pagination is-centered" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="pagination-previous" title="This is the first page" disabled> @lang('pagination.previous') </a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous"> @lang('pagination.previous') </a>
        @endif

        {{-- Pagination Elements --}}
        <ul class="pagination-list">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="pagination-link is-current" aria-label="Page {{ $page }}" aria-current="page"> {{ $page }} </a></li>
                        @else
                            <li>
                                <a class="pagination-link" href="{{ $url }}" aria-label="Goto page {{ $page }}"> {{ $page }} </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}"> @lang('pagination.next') </a>
        @else
            <a class="pagination-next" disabled> @lang('pagination.next') </a>
        @endif
    </ul>
@endif
