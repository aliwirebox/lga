@extends('frontend.layout')

@section('title', '403')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="col-xs-12">
                <h4>Access Forbidden</h4>
            </div>
            <div class="row-fluid">
                <div class="col-sm-12 m-top-30">
                    <div class="col-xs-12">
                        <div class="well-30">  
                            <p>
                                This page is not accessible with your
                                current credentials. 

                                <a href="{{ getUserHomeRoute() }}">
                                    Vist your dashboard
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


