@extends('errors.layout')

@section('code')
    419
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
