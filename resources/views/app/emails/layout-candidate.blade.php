@extends('app.emails.master')

@section('greeting')
    @yield('greetingTerm') {{ $candidate->first_name }},
@endsection
