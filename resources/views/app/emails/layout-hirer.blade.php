@extends('app.emails.master')

@section('greeting')
    Dear {{ $hirer->first_name }},
@endsection
