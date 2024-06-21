@extends('errors.layout')

@section('title')
419  
@endsection

@section('code')
    419
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
