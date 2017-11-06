@extends('frontend.layout')

@section('title', '404')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="col-xs-12">
                <h4>Page Not Found</h4>
            </div>
            <div class="row-fluid">
                <div class="col-sm-12 m-top-30">
                    <div class="col-xs-12">
                        <div class="well-30">
                            <p>
                                Sorry we can't find the page you are
                                looking for. Try <a href="/">visiting the home page</a>
                                @if(checkAuth())
                                    or
                                    <a href="{{ getUserHomeRoute() }}">
                                        go to your dashboard
                                        <i class="brand-sprite brand-icon brand-user"></i>
                                    </a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
