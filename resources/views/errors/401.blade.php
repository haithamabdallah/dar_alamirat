@extends('errors.layout')

@section('title')
    401  
@endsection

@section('code')
    401  
@endsection

@section('msg')
    <span  style="font-size: 24px !important ; background-color: white !important ; color: black !important ; padding: 10px !important;  border-radius: 10px !important"> ( Unauthorized , you may need to login first )</span>
@endsection


@section('message')
    {{ $exception->getMessage() }}
@endsection
