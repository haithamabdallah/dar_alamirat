@extends('errors.layout')

@section('title')
404  
@endsection

@section('code')
    404
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
