@extends('frontend.layout')
@section('bodyClasses', 'error-404')
@section('title', '404')

@section('content')
    <div class="container confirmation-text">
                <h4>Page Not Found</h4>
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
@endsection
