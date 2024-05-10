@extends('errors.layout')

@section('code')
    402
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
