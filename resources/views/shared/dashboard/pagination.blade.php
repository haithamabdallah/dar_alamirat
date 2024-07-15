@if ($paginated->lastPage() > 1)
    <div class="d-md-flex align-items-center">
    <div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
        Showing {{ $paginated->firstItem() }} to {{ $paginated->lastItem() }} of {{ $paginated->total() }} entries
    </div>
    <ul class="pagination mb-0 justify-content-center">
        @if ($paginated->previousPageUrl())
            <li class="page-item"><a class="page-link" href="{{ $paginated->previousPageUrl() }}">Previous</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @endif

        @for ($i = 1; $i <= $paginated->lastPage(); $i++)
            <li class="page-item {{ $paginated->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginated->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($paginated->nextPageUrl())
            <li class="page-item"><a class="page-link" href="{{ $paginated->nextPageUrl() }}">Next</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Next</span></li>
        @endif
    </ul>
  </div>
@endif