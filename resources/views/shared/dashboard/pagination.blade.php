@if ($paginated->lastPage() > 1)
    <div class="d-md-flex align-paginated-center">
    <div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
        Showing {{ $paginated->firstItem() }} to {{ $paginated->lastItem() }} of {{ $paginated->total() }} entries
    </div>
    <ul class="pagination mb-0 justify-content-center">
        @if ($paginated->previousPageUrl())
            <li class="page-item"><a class="page-link" href="{{ $paginated->previousPageUrl() }}">Previous</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @endif

        @foreach (range(1, $paginated->lastPage()) as $pageNum)

            @if ($pageNum == 1  ||  $pageNum == $paginated->lastPage()  || $pageNum == $paginated->currentPage() || ( $pageNum >= $paginated->currentPage() - 2  && $pageNum <= $paginated->currentPage() + 2 ) /* || $pageNum % 20 == 0 */ )
                @if ($pageNum == $paginated->currentPage())
                    <li class="page-item active" aria-current="page"><span
                            class="page-link">{{ $pageNum }}</span>
                    </li>
                @else
                    @if (   $pageNum == $paginated->lastPage()   && $paginated->currentPage() > 3 && $paginated->currentPage() < $paginated->lastPage() - 3   )
                        ...
                    @endif
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginated->url($pageNum) }}">{{ $pageNum }}</a>
                    </li>
                    @if (($pageNum == 1  ||  $pageNum == $paginated->currentPage() -3 )&& $paginated->currentPage() > 3 && $paginated->currentPage() < $paginated->lastPage() - 3  )
                        ...
                    @endif
                @endif
            @endif

        @endforeach

        @if ($paginated->nextPageUrl())
            <li class="page-item"><a class="page-link" href="{{ $paginated->nextPageUrl() }}">Next</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Next</span></li>
        @endif
    </ul>
  </div>
@endif