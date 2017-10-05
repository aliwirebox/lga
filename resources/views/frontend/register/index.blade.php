@extends('frontend.layout')

@section('title', 'Recruitment')
@section('seo_description', 'Transparent, Efficient, Hassle free paralegal recruitment')
@section('seo_keywords', 'employers, companies, recruitment')

@section('content')
    <section class="register">
        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>
                            excellent talent <br>
                            and jobs at your <br>
                            fingertips
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-tabs col-sm-m-top-30"> 
                            <ul class="nav nav-tabs" role="tablist"> 
                                <li role="presentation" class="active">
                                    <a href="#candidate" id="candidate-tab" role="tab" data-toggle="tab" aria-controls="candidate" aria-expanded="true">Candidate <span class="hidden-xs">Registration</span></a>
                                </li> 
                                <li role="presentation">
                                    <a href="#hirer" role="tab" id="hirer-tab" data-toggle="tab" aria-controls="hirer">Employer <span class="hidden-xs">Registration</span></a>
                                </li> 
                            </ul> 
                            <div id="signupTabContent" class="tab-content"> 
                                <div role="tabpanel" class="tab-pane fade in active" id="candidate" aria-labelledby="candidate-tab"> 
                                    <h4 class="tab-title">Start Building Your Profile</h4>
                                    @include('app.candidate.partials.registration-form')
                                </div> 
                                <div role="tabpanel" class="tab-pane fade" id="hirer" aria-labelledby="hirer-tab"> 
                                    <h4 class="tab-title">Talent pipelines for your real-time employment needs</h4>
                                    @include('app.hirer.partials.registration-form')
                                </div> 
                            </div> 
                        </div>
                    </div>
                    <div id="candidate-information" class="col-sm-6 register-content">
                        <h2>CANDIDATE INFORMATION</h2>
                        <p class="intro-para">
                            Your profile is completely anonymous and you can select which law firms and companies you do not want to be matched with.
                        </p> 
                        <p>
                            We will never release your CV without your permission and take your privacy seriously!
                        </p>
                        <p>
                            Registration takes 5 minutes and we will only contact you when there has been a match to your job preferences.
                        </p>
                        <p>
                            For more information <a href="/how-it-works/candidate">click here</a> 
                        </p>
                    </div>
                     <div id="employer-information" class="col-sm-6 register-content">
                        <h2>EMPLOYER INFORMATION</h2>
                        <p class="intro-para">
                            You can begin searching for pre-evaluated matching candidates for your legal roles within minutes.
                        </p> 
                        <p>
                            Register within a minute, confirm your account with your work email and begin searching.
                        </p>
                        <p>
                            Registration takes 5 minutes and we will only contact you when there has been a match to your job preferences.
                        </p>
                        <p>
                            For more information <a href="/how-it-works/employer">click here</a> 
                        </p>
                    </div>
                    <!-- End Registration -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@parent

<script>
    var showForm = function(){
        var pathname = window.location.pathname; 
        if(pathname.toLowerCase() === '/register/employer'){
            $('#hirer-tab').click();
        }
    };
    
    $(document).ready(function(){
        $('#candidate-tab').on('click',function(){
            console.log('click')
            $('#candidate-information').show();
            $('#employer-information').hide();
        });
        $('#hirer-tab').on('click',function(){
            $('#candidate-information').hide();
            $('#employer-information').show();
        });
         $('#employer-information').hide();
         showForm();
    });
    
</script>
@endsection
