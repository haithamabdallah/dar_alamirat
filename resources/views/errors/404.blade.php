@extends('errors.layout')

@section('code')
    404
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
