@extends('errors.layout')

@section('title')
403  
@endsection

@section('code')
    403
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
