@extends('app.master')

@section('title', 'Your Account')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Your Account</h4>
                    <div class="well-30 m-top-20">
                        @if(session('changed'))
                            <div class="alert alert-success">
                                Your details has been successfully changed
                            </div>
                        @elseif(session('notAllowedDomain'))
                            <div class="alert alert-danger">
                                Sorry that email address is not on a authorised list for
                                your company.
                            </div>
                        @else
                            @include('partials.errors')
                        @endif
                        @include('app.hirer.partials.edit-details-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

