@extends('master')

@section('body')

    @include('frontend.partials.header')

    @yield('content')

    @include('frontend.partials.footer')

@endsection
