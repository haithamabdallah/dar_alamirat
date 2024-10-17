@extends('dashboard.layouts.app')

@section('content')

<div id="content" class="app-content">
    you are authorized to work with : <br> {!! collect(auth('admin')->user()->permission_names)->count() > 0 ?  implode('<br> ', auth('admin')->user()->permission_names) .  ' only': 'nothing'  !!}
</div>
@endsection
