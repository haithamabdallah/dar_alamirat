@php
    $sliders = $mainSliders;
    // dd($sliders->currentPage());
@endphp

@extends('dashboard.layouts.app')

@section('customcss')
    <link href="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"> Home </a></li>
                    <li class="breadcrumb-item"><a href="{{route('dashboard.slider.index')}}"> Sliders </a></li>
                </ul>
                <h1 class="page-header mb-0"> Sliders </h1>
            </div>
            <div class="ms-auto">
                <a href="{{route('dashboard.slider.create')}}" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> Create Slider </a>
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
                    <div class="input-group mb-3">
                        <p class="btn btn-white dropdown-toggle"><span class="d-none d-md-inline">Filter By Page Name</span></p>
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 start-0" style="z-index: 1;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="searchForPage"{{--  onkeyup="searchSlidersName()" --}} class="form-control px-35px bg-light" placeholder="Search For Page..." />
                            </div>
                        </div>
                    </div>
                    <!-- END input-group -->

                    <!-- table -->
                    <div class="table-responsive mb-3">
                        <table id="slidersTableList" class="table table-hover table-panel text-nowrap align-middle mb-0">
                            <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th class="text-nowrap" width="10%">Is Dark?</th>
                                <th class="text-nowrap" width="10%">Is Reversed?</th>
                                <th class="text-nowrap" width="10%">Title</th>
                                <th class="text-nowrap" width="10%">Subtitle</th>
                                <th class="text-nowrap" width="10%">Button Text</th>
                                <th class="text-nowrap" width="10%">Button Link</th>
                                <th class="text-nowrap" width="10%">Image</th>
                                <th class="text-nowrap" width="10%">Background Image</th>
                                <th class="text-nowrap" width="5%">status</th>
                                <th class="text-nowrap" width="10%">created At</th>
                                <th class="text-nowrap" width="5%">Edit</th>
                                <th class="text-nowrap" width="5%">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($sliders as $index => $slider)
                                <tr class="odd gradeX">
                                    <td width="1%" class="fw-bold text-dark">{{ $index + 1 }}</td>
                                    <td>
                                      <div class="form-check form-switch">
                                          <input 
                                              class="form-check-input {{ $slider->is_dark ? '1' : '0' }}"
                                              type="checkbox" {{ $slider->is_dark ? 'checked' : '' }} readonly disabled>
                                      </div>
                                  </td>
                                  <td>
                                    <div class="form-check form-switch">
                                        <input 
                                            class="form-check-input {{ $slider->is_reversed ? '1' : '0' }}"
                                            type="checkbox" {{ $slider->is_reversed ? 'checked' : '' }} readonly disabled>
                                    </div>
                                </td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->subtitle }}</td>
                                    <td>{{ $slider->button_text }}</td>
                                    <td><a href="{{ $slider->buttun_link }}" target="_blank" > Link </a></td>
                                    <td>
                                      <img src="{{ asset('storage/' . $slider->image) }}" alt="image" width="50px" height="50px">
                                    </td>
                                    <td>
                                      <img src="{{ asset('storage/' . $slider->background_image) }}" alt="background_image" width="50px" height="50px">
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input id="toggleStatusCheckbox{{ $slider->id }}"
                                                class="form-check-input toggle-status-checkbox {{ $slider->status ? '1' : '0' }}"
                                                type="checkbox" {{ $slider->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>{{ $slider->created_at->format('Y-m-d H:i') }}</td>
                                    <td nowrap="">
                                        <a href="{{route('dashboard.slider.edit' , $slider->id)}}" class="btn btn-sm btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                    </td>
                                    <td nowrap="">
                                      <form action="{{ route('dashboard.slider.destroy' , $slider->id) }}" method="POST">
                                        @csrf 
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> Delete</button>
                                      </form>
                                    </td>
                                </tr>
                                @empty
                                <p>No Sliders Found </p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- ./table -->

                      <!-- pagination -->
                      @include('shared.dashboard.pagination' , ['paginated' => $sliders])
                      <!-- ./pagination -->
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
    <script src="{{ asset('admin-panel/assets/plugins/switchery/dist/switchery.min.js') }}"></script>

    <script>
        $('#data-table-default').DataTable({
            responsive: true
        })

        var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-status'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#00acac'
            });
        });
    </script>

    <script>
        // function searchSlidersName() {
        //     // Declare variables
        //     var input, filter, table, tr, td, i, txtValue;
        //     input = document.getElementById("searchForPage");
        //     filter = input.value.toUpperCase();
        //     table = document.getElementById("slidersTableList");
        //     tr = table.getElementsByTagName("tr");

        //     // Loop through all table rows, and hide those who don't match the search query
        //     for (i = 0; i < tr.length; i++) {
        //         td = tr[i].getElementsByTagName("td")[1];
        //         if (td) {
        //             txtValue = td.textContent || td.innerText;
        //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //                 tr[i].style.display = "";
        //             } else {
        //                 tr[i].style.display = "none";
        //             }
        //         }
        //     }
        // }
    </script>
     <script>
        $(document).ready(function() {

            $('.toggle-status-checkbox').change(function() {
                var isActive = $(this).is(':checked');
                var modelId = $(this).attr('id').replace('toggleStatusCheckbox', '');

                $.ajax({
                    url: '{{ route("dashboard.slider.toggle-status") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        isActive: isActive,
                        modelId: modelId
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection