@extends('dashboard.layouts.app')

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('dashboard.home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('product.index')}}">{{__('dashboard.products')}}</a></li>
                </ul>
                <h1 class="page-header mb-0">{{__('dashboard.products') . ' - '  .__('dashboard.table')}}</h1>
            </div>
            <div class="ms-auto">
                <a href="{{route('product.create')}}" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> Add Product</a>
            </div>
        </div>

        @include('dashboard.layouts.alerts')

        <!-- start card -->
        <div class="card border-0">
            <!-- tab content -->
            <div class="tab-content p-3">
                <!-- tap panel -->
                <div class="tab-pane fade show active" id="allTab">
                    <!-- BEGIN input-group -->
                    <div class="input-group mb-3">
                        <p class="btn btn-white dropdown-toggle"><span class="d-none d-md-inline">Filter By Product Name</span></p>
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 start-0" style="z-index: 1;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="searchForProduct" onkeyup="searchProductName()" class="form-control px-35px bg-light" placeholder="Search order Number..." />
                            </div>
                        </div>
                    </div>
                    <!-- END input-group -->

                    <!-- BEGIN table -->
                    <div class="table-responsive mb-3">
                        <table id="productsTableList" class="table table-hover table-panel text-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="pt-0 pb-2" width="1%"></th>
                                    <th class="pt-0 pb-2" width="1%">Image</th>
                                    <th class="pt-0 pb-2" width="20%">Title</th>
                                    <th class="pt-0 pb-2" width="20%">Price</th>
                                    <th class="pt-0 pb-2" width="15%">Quantity</th>
                                    <th class="pt-0 pb-2" width="10%">category</th>
                                    <th class="pt-0 pb-2" width="10">brand</th>
                                    <th class="pt-0 pb-2" width="5%">Edit</th>
                                    <th class="pt-0 pb-2" width="5%">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td class="w-10px align-middle">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{$product->id}}">
                                            <label class="form-check-label" for="product1"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="w-30px h-30px bg-light d-flex align-items-center justify-content-center">
                                                <img alt="" class="mw-100 mh-100" src="{{ $product->thumbnail }}" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('product.show' , $product->id)}}" class="text-dark text-decoration-none">{{$product->title}}</a>
                                    </td>
                                    <td>
                                        <ul>
                                        @foreach($product->variants as $variant)
                                            <li>{{$variant->variant_name}} - {{$variant->price_with_discount}}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td class="align-middle">{{$product->inventory->sum('quantity')}} in stock for {{$product->variants->count()}} variants</td>
                                    <td class="align-middle">category</td>
                                    <td class="align-middle">brand</td>
                                    <td nowrap="">
                                        @adminCan('categories.edit')
                                        <a href="{{route('product.edit' , $product->id)}}" class="btn btn-sm btn-primary"> <i class="fa-regular fa-pen-to-square"></i> {{__('dashboard.product.edit')}}</a>
                                        @endadminCan
                                    </td>
                                    <td nowrap="">
                                        @adminCan('categories.delete')
                                        <form id="deleteForm{{$product->id}}" action="{{ route('product.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn delete-btn btn-danger" data-id="{{$product->id}}"> <i class="fa-solid fa-trash-can"></i> {{__('dashboard.product.delete')}}</a>
                                        </form>
                                        @endadminCan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END table -->

                    <!-- pagination -->
                    <div class="d-md-flex align-items-center">
                        <div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
                            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
                        </div>
                        <ul class="pagination mb-0 justify-content-center">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </ul>
                    </div>
                    <!-- ./pagination -->
                </div>
                <!-- ./tap panel -->
            </div>
            <!-- ./tab content -->
        </div>
        <!-- ./End Card -->
    </div>
    <!-- END #content -->

@endsection

@section('scripts')

    <script>
        function searchProductName() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchForProduct");
            filter = input.value.toUpperCase();
            table = document.getElementById("productsTableList");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

@endsection
