@extends('errors.layout')

@section('code')
    429
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
