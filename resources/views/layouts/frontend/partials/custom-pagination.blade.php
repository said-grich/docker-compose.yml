<div class="d-flex justify-content-between align-items-center flex-wrap">
    <div class="d-flex flex-wrap py-2 mr-3">
        @if ($paginator->hasPages())
            <div class="flex items-end my-2">
                {{-- Previous Page Link --}}
                @if ( !$paginator->onFirstPage())
                    <a class="btn btn-icon btn-light-primary mr-2 my-1 cursor-pointer" wire:click="gotoPage(1)">
                        <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                    </a>
                    <a class="btn btn-icon btn-light-primary mr-2 my-1 cursor-pointer" wire:click="previousPage" rel="prev">
                        <i class="ki ki-bold-arrow-back icon-xs"></i>
                    </a>
                @else
                    <a class="btn btn-icon btn-light-primary mr-2 my-1 disabled">
                        <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                    </a>
                    <a class="btn btn-icon btn-light-primary mr-2 my-1 disabled">
                        <i class="ki ki-bold-arrow-back icon-xs"></i>
                    </a>
                @endif

                <!-- Pagination Elements -->
                @foreach ($elements as $element)
                    <!-- Array Of Links -->
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <!--  Use three dots when current page is greater than 3.  -->
                            @if ($paginator->currentPage() > 3 && $page === 2)
                                <a class="btn btn-icon border-0 mr-2 my-1 disabled">
                                    ...
                                </a>
                            @endif

                            <!--  Show active page two pages before and after it.  -->
                            @if ($page == $paginator->currentPage())
                                <span class="btn btn-icon border-0 btn-hover-primary active mr-2 my-1">{{ $page }}</span>
                            @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2)
                                <a class="btn btn-icon border-0 btn-hover-primary mr-2 my-1 cursor-pointer" wire:click="gotoPage({{$page}})">{{ $page }}</a>
                            @endif

                            <!--  Use three dots when current page is away from end.  -->
                            @if ($paginator->currentPage() < $paginator->lastPage() - 2  && $page === $paginator->lastPage() - 1)
                                <a class="btn btn-icon border-0 mr-2 my-1 disabled">
                                    ...
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                
                {{-- Next Page Link --}}
                @if($paginator->lastPage() - $paginator->currentPage() >= 1)
                    <a class="btn btn-icon btn-light-primary mr-2 my-1 cursor-pointer" wire:click="nextPage" rel="next">
                        <i class="ki ki-bold-arrow-next icon-xs"></i>
                    </a>
                    <a class="btn btn-icon btn-light-primary mr-2 my-1 cursor-pointer" wire:click="gotoPage({{ $paginator->lastPage() }})">
                        <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                    </a>
                @else
                    <a class="btn btn-icon btn-light-primary mr-2 my-1 disabled">
                        <i class="ki ki-bold-arrow-next icon-xs"></i>
                    </a>
                    <a class="btn btn-icon btn-light-primary mr-2 my-1 disabled">
                        <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                    </a>
                @endif
            </div>
        @endif
    </div>
    <div class="d-flex align-items-center py-3">
        <select wire:model="perPage" class="form-control text-primary font-weight-bold mr-4 border-0 bg-light-primary" style="width: 75px;">
            <option>2</option>
            <option>5</option>
            <option>10</option>
            <option>15</option>
            <option>25</option>
            <option>50</option>
        </select>
        <span class="text-muted">Showing {{$paginator->firstItem()}} to {{$paginator->lastItem()}} out of {{$paginator->total()}} items</span>
    </div>
</div>