@extends('app.emails.master')

@section('greeting')
    @yield('greetingTerm') {{ $user->first_name }}, 
@endsection
