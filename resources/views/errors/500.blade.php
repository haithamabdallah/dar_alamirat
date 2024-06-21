@extends('errors.layout')

@section('title')
500  
@endsection

@section('code')
    500
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
