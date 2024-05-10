@extends('errors.layout')

@section('code')
    500
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
