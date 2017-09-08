@extends('app.master')

@section('title', 'Hirer Edit Details')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4><i class="brand-sprite brand-static brand-user-blue"></i> Edit details</h4>
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

