@extends('dashboard.layouts.app')

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __('dashboard.products') }}</a>
                    </li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i>
                        Import Products From Excel File
                    </li>
                </ol>
            </div>
        </div>

        <form action="{{ route('product.import-excel.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body row">
                            <div class="text-center mt-4 col-12">
                                <a href="{{ route('product.export-excel-template') }}" class="btn btn-primary">
                                    <span class="indicator-label"> Download The Template That Must Be Used  </span>
                                </a>
                            </div>
                            <label class="form-label p-2"> Upload Excel File ( *.xlsx ) : </label>
                            <input class="form-control" name="excel" type="file" id="formFile" accept=".xlsx" />
                            <p class="text-danger  my-2"> To avoid errors => all fields in excel must be filled except (
                                product images , variant images ) </p>
                            @error('excel')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--begin::Actions-->
                            <div class="text-center mt-4 col-12">
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label"> Import </span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="my-5">
            @if (count($errors) > 0)
                @foreach ($errors->all() as $key => $errror)
                    <p class="text-danger"> {{ $errror }} </p>
                @endforeach
            @endif
        </div>
    </div>
    <!-- END #content -->
@endsection
