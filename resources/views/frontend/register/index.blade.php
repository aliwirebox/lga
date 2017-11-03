@extends('frontend.layout')

@section('title', 'Recruitment')
@section('seo_description', 'Transparent, Efficient, Hassle free paralegal recruitment')
@section('seo_keywords', 'employers, companies, recruitment')
@section('bodyClasses', 'frontend-register')

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
                        <ul>
                            <li>It takes minutes to register</li>
                            <li>You are only contacted by employers who match your criteria</li>
                            <li>When an employer requests your CV you will be notified immediately with key information</li>
                            <li>Legal Asset is completely <span class="red">free</span></li>
                            <li>We will never release your CV without your permission and take your privacy seriously.</li>
                        </ul>
                    </div>
                     <div id="employer-information" class="col-sm-6 register-content">
                        <h2>EMPLOYER INFORMATION</h2>
                        <p class="intro-para">
                            You can begin searching for pre-evaluated matching candidates for your legal roles within minutes.
                        </p> 
                        <ul>
                            <li>Register within minutes using your work email</li>
                            <li>Confirm your account and find matching candidates immediately</li>
                            <li>Save your search and get notified when new matching candidates register</li>
                            <li>We speak to all our candidates to ensure they are actively seeking work</li>
                            <li>It is only &pound;995 to hire through Legal Asset regardless of the candidates salary and only when the candidate has been placed</li>
                            <li>We will assist you throughout the recruitment process</li>
                            <li>Our consultants are motivated by customer service and not commission</li>
                        </ul>
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
