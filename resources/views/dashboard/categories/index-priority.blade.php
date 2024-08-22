@extends('dashboard.layouts.app')
@section('meta')
    <meta charset="utf-8" />
    <title> {{ __('dashboard.categories') }} </title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.home') }}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('index.priority') }}">{{ __('dashboard.priorityables') }}</a></li>
                </ul>
                <h1 class="page-header mb-0">{{ __('dashboard.categories') }}</h1>
                @if (count($errors) > 0)
                    @foreach (json_decode($errors) as $key => $error)
                        <div class="alert alert-danger">
                            {{ $key . ' => ' . $error[0] }}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @include('dashboard.layouts.alerts')

        <!-- start card -->
        <div class="card border-0">
            <!-- content -->
            <div class="tab-content p-3">
                <!-- tab pane -->
                <div class="tab-pane fade show active" id="allTab">

                    <!-- BEGIN input-group -->
                    {{-- <div class="input-group mb-3">
                        <p class="btn btn-white dropdown-toggle"><span class="d-none d-md-inline">Filter By Product
                                Name</span></p>
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 start-0"
                                    style="z-index: 1;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="searchForProduct" onkeyup="searchProductName()"
                                    class="form-control px-35px bg-light" placeholder="Search order Number..." />
                            </div>
                        </div>
                    </div> --}}
                    <!-- END input-group -->

                    <!-- BEGIN table -->
                    <div class="row">
                        <table id="data-table-keytable" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th width="1%"></th>
                                    <th class="text-nowrap" width="5%">Type</th>
                                    <th class="text-nowrap" width="5%">Name</th>
                                    <th class="text-nowrap" width="5%">Image</th>
                                    <th class="text-nowrap" width="5%">Priority ( 10 , 20 , 30 , ... )</th>
                                    <th class="text-nowrap" width="5%">status</th>
                                    <th class="text-nowrap" width="5%">update</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($priorityables as $priorityable)
                                    <div data-id="{{ $priorityable->id }}" data-url="{{ route('index.priority.update' , $priorityable->id) }}">
                                        <tr class="odd gradeX">
                                            <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}</td>
                                            <td>{{ $priorityable->type }}</td>
                                            <td>{{ $priorityable->priorityable?->name ?? '---' }}</td>
                                            <td width="1%" class="with-img">
                                                @if ($priorityable->priorityable?->image)
                                                    <a href="{{ storage_asset($priorityable->priorityable?->image ?? '#') }}"
                                                        target="_blank">
                                                        <img src="{{ storage_asset($priorityable->priorityable?->image ?? '') }}"
                                                            class="rounded h-30px my-n1 mx-n1" />
                                                    </a>
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                            <td><input type="number" min='1' name="priority"
                                                    value="{{ $priorityable->priority ?? '' }}"  data-id="{{ $priorityable->id }}"/> </td>
                                            <td>
                                                <input type="checkbox" class="" name="status"
                                                    @if ($priorityable->status == true ) checked @endif  data-id="{{ $priorityable->id }}"/>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-id="{{ $priorityable->id }}" type="submit" > 
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                    {{ __('dashboard.save') }}  </button>
                                                <button class="btn btn-sm btn-success" data-id="{{ $priorityable->id }}" type="button" disabled  style="display: none"> 
                                                    Saved. </button>
                                                
                                            </td>
                                        </tr>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- ./table -->

                </div>
                <!-- ./tab pane -->
            </div>
            <!-- ./content -->
        </div>
        <!-- ./end card -->
    </div>
    <!-- END #content -->
@endsection

@section('scripts')
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('admin-panel/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.js') }}"></script>

    <script>
        function searchCategoryName() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchForCategory");
            filter = input.value.toUpperCase();
            table = document.getElementById("categoryTableList");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
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
    <script>
        $('div[data-id]').each(function(index , element) {
            let id = $(element).data('id');
            $(`button[data-id="${id}"][type="submit"]`).on('click', function() {
                console.log($(`input[name="status"][data-id="${id}"]`)[0].checked ? 1 : 0);

                axios.put($(element).data('url') , {
                    _token : '{{ csrf_token() }}',
                    priority : $(`input[name="priority"][data-id="${id}"]`).val(),
                    status : $(`input[name="status"][data-id="${id}"]`)[0].checked ? 1 : 0 ,
                }).then(function (response) {
                    console.log(response);
                    $(`button[data-id="${id}"][type="submit"]`).hide();
                    $(`button[data-id="${id}"][type="button"]`).show();
                    setTimeout(() => {
                        $(`button[data-id="${id}"][type="submit"]`).show();
                        $(`button[data-id="${id}"][type="button"]`).hide();
                    }, 1000 );
                }).catch(function (error) {
                    console.log(error);
                })

            })
        });
    </script>
@endsection
