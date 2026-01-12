@if ($paginator->hasPages())
    <div class="pagination-controls">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="pagination-btn" disabled>
                <i class="fas fa-chevron-left"></i>
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            
            // Show limited page numbers
            $start = max(1, $currentPage - 2);
            $end = min($lastPage, $currentPage + 2);
        @endphp

        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $currentPage)
                <button class="pagination-btn active">{{ $i }}</button>
            @else
                <a href="{{ $paginator->url($i) }}" class="pagination-btn">{{ $i }}</a>
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <button class="pagination-btn" disabled>
                <i class="fas fa-chevron-right"></i>
            </button>
        @endif
    </div>
@endif