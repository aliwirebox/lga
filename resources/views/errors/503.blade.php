@extends('frontend.layout')

@section('title', '503')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="col-xs-12">
                <h4>Site Maintenance</h4>
            </div>
            <div class="row-fluid">
                <div class="col-sm-12 m-top-30">
                    <div class="col-xs-12">
                        <div class="well-30">
                            <p>
                                Sorry, but we are currently making essential 
                                updates to {{  config('brand.identity.domain')  }}. The site should 
                                be down for no more than an hour.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
