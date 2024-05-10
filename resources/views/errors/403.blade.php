@extends('errors.layout')

@section('code')
    403
@endsection

@section('message')
    {{ $exception->getMessage() }}
@endsection
