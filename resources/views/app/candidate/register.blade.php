@extends('app.master')

@section('title', 'Candidate Registration')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-12">
            <div class="row-fluid">
                <div class="col-sm-12">
                    <h4>Candidate Registration</h4>
                    <div class="well-30 m-top-20">
                        @if(session('registered'))
                            <div class="alert alert-success">
                                Thank you for registering. We have 
                                sent you a validation email which 
                                will need to be opened before you 
                                can login.
                            </div>
                        @else
                            @include('app.candidate.partials.registration-form')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

