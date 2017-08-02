@extends('app.master')

@section('title', 'Your Details')

@section('content')

    <div class="row-fluid m-top-100">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xs-12">
                    <h4 class="display-inline"><i class="nq-sprite nq-static nq-user-blue"></i> Create a Profile </h4>
                    <a href="{{ url('candidate-faqs')}}" class="pull-right"><strong>FAQs</strong></a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 m-top-20">
                    <div class="row">
                        <div class="col-xs-12">
                            @include('app.candidate.profile.partials.menu')
                            <div class="well-30">
                                @include('partials.errors')
                                <form action="{{ $submitUrl }}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-blue">First Name*</strong>
                                        <input type="text" id="first_name" name="first_name" class="form-control"
                                               value="{{ old('first_name', $candidate->first_name) }}">
                                    </div>
                                    <div class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-blue">Last Name*</strong>
                                        <input type="text" id="last_name" name="last_name" class="form-control"
                                               value="{{ old('last_name', $candidate->last_name) }}">

                                    </div>
                                    <div class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-blue">Email (we recommend that you use a
                                            personal email address)*</strong>
                                        <input type="text" id="email" name="email" class="form-control"
                                               value="{{ old('email', $candidate->email) }}">

                                    </div>
                                    <div class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-blue">Telephone*</strong>
                                        <input type="text" id="telephone" name="telephone" class="form-control"
                                               value="{{ old('telephone', formatTelephone($candidate->telephone) ) }}">
                                        <p class="text-danger fs-12">
                                            <i>
                                                For the service to work optimally we need to be able to contact you by
                                                telephone,
                                                please enter an up to date telephone number.
                                            </i>
                                        </p>
                                    </div>
                                    @include('app.candidate.profile.partials.buttons')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
