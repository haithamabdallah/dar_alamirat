@extends('errors.layout')

@section('title')
402  
@endsection

@section('code')
    402
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
