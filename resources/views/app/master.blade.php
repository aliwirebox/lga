@extends('master')

@section('css')
    @parent
    <link rel="stylesheet"
          href="{{asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
@endsection

@section('body')
    @if (getGuard() == 'candidates')
            @include('app.candidate.top-nav', ['candidate' => getCurrentUser()])
        @elseif (getGuard() == 'hirers')
            @include('app.hirer.top-nav', ['hirer' => getCurrentUser()])
        @elseif (getGuard() == 'brand_admins')
            @include('app.brand-admin.top-nav', ['brandAdmin' => getCurrentUser()])
        @else
            <div class="top-nav">
                <ul>
                    <li><a href="#"><i class="fa fa-gear"></i></a></li>
                    <li><a href="#"><i class="fa fa-user"></i></a></li>
                </ul>
            </div>
        @endif
    

    @include('app.sidebar')
    <div class="main-view">
        <div class="clearfix inner-wrapper">
            @include('app.navigation')
            @include('partials.success')
            @yield('content')
        </div>
    </div>
    @include('app.footer')
@endsection

@section('js')
    @parent
    <script src="{{asset('bower_components/moment/min/moment-with-locales.min.js')}}"
            charset="utf-8"></script>
    <script src="{{asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"
            charset="utf-8"></script>
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"
            charset="utf-8"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"
            charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('bower_components/handlebars/handlebars.min.js') }}"></script>
@endsection
