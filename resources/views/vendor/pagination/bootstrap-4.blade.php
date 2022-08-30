@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <form action="">
                        <input type="hidden" name="page" value="1">
                        <button type="submit" class="page-link" rel="next"
                            aria-label="@lang('pagination.next')">&lsaquo;&lsaquo;</button>
                    </form>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span
                            class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span
                                    class="page-link">{{ $page }}</span></li>
                        @elseif ($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() - 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($paginator->currentPage() == 1 && $page == $paginator->currentPage() + 2)
                            <li class="page-item"><a class="page-link"
                                    href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($paginator->currentPage() == $paginator->lastPage() && $page == $paginator->currentPage() - 2)
                            <li class="page-item"><a class="page-link"
                                    href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <form action="">
                        <input type="hidden" name="page" value="{{ $paginator->lastPage() }}">
                        <button type="submit" class="page-link position-relative" rel="next"
                            aria-label="@lang('pagination.next')">&rsaquo;&rsaquo;
                            <span class="badge badge-success position-absolute rounded-circle" style="bottom:-5px;">{{ $paginator->lastPage() }}</span>
                        </button>
                            

                    </form>
                    
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
