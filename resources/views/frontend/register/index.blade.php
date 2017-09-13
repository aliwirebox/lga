@extends('frontend.layout')

@section('title', 'Recruitment')
@section('seo_description', 'Where law firms find the best talent')
@section('seo_keywords', 'law, firms, solicitors, recruitment')

@section('content')
    
        <!-- Start Main Content -->
        <div class="container">
            <div class="col-xs-12">
                <div class="row">
                    <!-- Start Registration -->
                    <div class="col-md-5">
                        <div class="form-tabs col-sm-m-top-30"> 
                            <ul class="nav nav-tabs" role="tablist"> 
                                <li role="presentation" class="active">
                                    <a href="#candidate" id="candidate-tab" role="tab" data-toggle="tab" aria-controls="candidate" aria-expanded="true">Candidate <span class="hidden-xs">Registration</span> <i class="brand-sprite brand-icon brand-lg-user"></i></a>
                                </li> 
                                <li role="presentation">
                                    <a href="#hirer" role="tab" id="hirer-tab" data-toggle="tab" aria-controls="hirer">Hirer <span class="hidden-xs">Registration</span> <i class="brand-sprite brand-icon brand-lg-hirer"></i></a>
                                </li> 
                            </ul> 
                            <div id="signupTabContent" class="tab-content"> 
                                <div role="tabpanel" class="tab-pane fade in active" id="candidate" aria-labelledby="candidate-tab"> 
                                    <h4 class="tab-title">Start Building Your Profile</h4>
                                    @include('app.candidate.partials.registration-form')
                                </div> 
                                <div role="tabpanel" class="tab-pane fade" id="hirer" aria-labelledby="hirer-tab"> 
                                    <h4 class="tab-title">Talent pipelines for your real-time hiring needs</h4>
                                    @include('app.hirer.partials.registration-form')
                                </div> 
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h1>EMPLOYER INFORMATION</h1>
                        <h2>YOU CAN BEGIN SEARCHING FOR PRE-EVALUATED MATCHING CANDIDATES FOR YOUR LEGAL ROLES WITHIN MINUTES.</h2>
                        <p>Register within a minute, confirm your account with your work email and begin searching.</p>
                        <p>For more information <a href="{{ url('#') }}">click here</a></p>
                    </div>
                    <!-- End Registration -->
                </div>
            </div>
        </div>
@endsection
