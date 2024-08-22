<div class="d-flex flex-wrap justify-content-center mx-auto row" style="width: 900px !important" >
    <nav>
        <ul class="pagination" style="display: flex !important ; justify-content: center ; align-items: center !important ; gap: 10px; width: 100%; flex-wrap: wrap !important ">

            @if ($items->currentPage() == 1)
                <li class="page-item disabled" aria-disabled="true"
                    aria-label="« السابق"><span class="page-link" aria-hidden="true">
                        ‹
                    </span></li>
            @else
                <li class="page-item"><a class="page-link"
                        href="{{ $items->previousPageUrl() }}" rel="previous"
                        aria-label="« السابق"> ‹ </a></li>
            @endif

            @foreach (range(1, $items->lastPage()) as $pageNum)

                @if ($pageNum == 1  ||  $pageNum == $items->lastPage()  || $pageNum == $items->currentPage() || ( $pageNum >= $items->currentPage() - 2  && $pageNum <= $items->currentPage() + 2 ) /* || $pageNum % 20 == 0 */ )
                    @if ($pageNum == $items->currentPage())
                        <li class="page-item active" aria-current="page"><span
                                class="page-link">{{ $pageNum }}</span>
                        </li>
                    @else
                        @if (   $pageNum == $items->lastPage()   && $items->currentPage() > 3 && $items->currentPage() < $items->lastPage() - 3   )
                            ...
                        @endif
                        <li class="page-item"><a class="page-link"
                                href="{{ $items->url($pageNum) }}">{{ $pageNum }}</a>
                        </li>
                        @if (($pageNum == 1  ||  $pageNum == $items->currentPage() -3 )&& $items->currentPage() > 3 && $items->currentPage() < $items->lastPage() - 3  )
                            ...
                        @endif
                    @endif
                @endif

            @endforeach

            @if ($items->currentPage() == $items->lastPage())
                <li class="page-item disabled" aria-disabled="true"
                    aria-label="التالي »"><span class="page-link" aria-hidden="true">
                        ›
                    </span></li>
            @else
                <li class="page-item"><a class="page-link"
                        href="{{ $items->nextPageUrl() }}" rel="next"
                        aria-label="التالي »"> › </a></li>
            @endif
        </ul>
    </nav>
</div>