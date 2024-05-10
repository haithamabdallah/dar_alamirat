@extends('errors.layout')

@section('code')
    401
@endsection


@section('message')
    {{ $exception->getMessage() }}
@endsection
