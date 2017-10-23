@extends('app.emails.master')

@section('greeting')
    @yield('greetingTerm') {{ $hirer->first_name }},
@endsection
