@extends('app.master')

@section('title', 'Hirer Change Password')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4><i class="nq-sprite nq-static nq-user-blue"></i> Change Password</h4>
                    <div class="well-30 m-top-20">
                        @if(session('changed'))
                            <div class="alert alert-success">
                                Your password has been successfully changed 
                            </div>
                        @else
                            @include('partials.errors')
                            @include('partials.changepassword-form')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

