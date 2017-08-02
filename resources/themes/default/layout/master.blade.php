@extends('master')

@section('body')

    @include('frontend.partials.header')

    <div class="container">

        @yield('content')

    </div>

    @include('frontend.partials.footer')

@endsection
