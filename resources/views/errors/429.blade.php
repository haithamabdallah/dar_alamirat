@extends('errors.layout')

@section('title')
429  
@endsection

@section('code')
    429
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
