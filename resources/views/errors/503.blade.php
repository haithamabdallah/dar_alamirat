@extends('errors.layout')

@section('code')
    503
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
