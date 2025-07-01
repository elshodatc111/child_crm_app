@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                </li>
            @endif
            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();
            @endphp
            <li class="page-item {{ $current == 1 ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
            </li>
            @if ($current > 3)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @elseif ($last >= 2)
                <li class="page-item {{ $current == 2 ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url(2) }}">2</a>
                </li>
            @endif
            @for ($i = $current - 1; $i <= $current + 1; $i++)
                @if ($i > 2 && $i < $last - 1)
                    <li class="page-item {{ $current == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor
            @if ($current < $last - 3)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
            @for ($i = $last - 1; $i <= $last; $i++)
                @if ($i > 1 && $i > $current + 1)
                    <li class="page-item {{ $current == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
