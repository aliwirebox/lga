@extends('app.master')

@section('title', 'Failed Employer Registration')

@section('content')
    <div class="row-fluid">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        Failed Employer Registration
                    </h4>
                    <div class="well-30 m-top-20">
                        <div class="alert alert-success">
                            {{ $outcome }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
