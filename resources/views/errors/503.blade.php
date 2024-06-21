@extends('errors.layout')

@section('title')
503  
@endsection

@section('code')
    503
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
