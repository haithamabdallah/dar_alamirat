<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Main Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav">
            @foreach(defaultCategory() as $category)
                @if($category->childes->isNotEmpty())
                    <li class="nav__item">
                        <a class="nav__link" href="{{route('category.products' , $category->id)}}">{{$category->name}}<i class="fas fa-chevron-right"></i></a>
                        <ul class="nav__sub">
                            @foreach($category->childes as $child)
                                <li class="nav__item">
                                    <a class="nav__link" href="{{route('category.products' , $category->id)}}">{{$child->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="nav__item">
                        <a class="nav__link" href="{{route('category.products' , $category->id)}}">{{$category->name}}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
