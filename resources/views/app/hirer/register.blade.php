@extends('app.master')

@section('title', 'Employer Registration')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Employer Registration</h4>
                    <div class="well-30 m-top-20">
                        @if(session('registered'))
                            <div class="alert alert-success">
                                Thank you for registering. We have 
                                sent you a validation email which 
                                will need to be opened before you 
                                can login.
                            </div>
                        @elseif(session('notAllowedDomain'))
                            <div class="alert alert-danger">
                                Sorry your email address is not on a authorised list for 
                                that company. Our support team have been made aware and will
                                contact you shortly to resolve the issue.
                            </div>
                        @else
                            @include('partials.errors')
                            @include('app.hirer.partials.registration-form')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
