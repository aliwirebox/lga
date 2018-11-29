@extends('frontend.layout')

@section('title', 'Register')
@section('seo_description', 'Transparent, Efficient, Hassle free paralegal recruitment')
@section('seo_keywords', 'employers, companies, recruitment')
@section('bodyClasses', 'frontend-register')

@section('content')
    <section class="register">
        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <h1>
                            EXCELLENT TALENT <br>
                            AND JOBS AT YOUR <br>
                            FINGERTIPS
                        </h1>
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
                          <li>{{ config('brand.identity.fullname') }} is completely <span class="red">free</span> for candidates</li>
                            <li>It takes minutes to register</li>
                            <li>You are only contacted by employers who match your criteria</li>
                            <li>When an employer requests your CV you will be notified immediately with key information</li>
                            
                            <li>We will never release your CV without your permission and take your privacy seriously.</li>
                            <li>If you would like to know more please look at our <span class ="red"><a href="{{ url('candidate-faqs') }}">FAQs</a> </span></li>
                        </ul>
                        
                    </div>
                     <div id="employer-information" class="col-sm-6 register-content">
                        <h2>EMPLOYER INFORMATION</h2>
                        <p class="intro-para">
                            You can begin searching for pre-evaluated matching candidates for your legal roles within minutes.
                        </p> 
                        <ul>
                            <li>Register for free using your work email</li>
                            <li>Immediately begin searching for matching candidates</li>
                             <li>Save your search and get notified when new matching candidates register</li>
                            <li>We speak to all our candidates to ensure they are actively seeking work</li>
                            <li>We charge fixed fees in relation to the candidate salary.Take a look at our <a href="{{ url('pricing') }}">pricing page </a>to see our fees and the advantages of becoming a member</li>
                            <li>We will assist you throughout the recruitment process</li>
                            <li>Our consultants are motivated by customer service and not commission</li>
                            <li>Please let us know if you would like to post an ad. We will be happy to post this on our social media and through traditional recruitment channels</li>
                            <li>Take a look at our<span ="red"> <a href="{{ url('hirer-faqs') }}">FAQs</a></span> for more information or feel free to email or call us </li>
                            
                        </ul>
                        
                     </div>
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
    
    var toggleHirerTab = function(){
        var pageHash = window.location.hash;

        if (pageHash === '#hirer-tab') $('#hirer-tab').click();
    };
    
    var originalEmail = $('#email').val();
    var socialRegistration = {{ session()->has('socialRegister') ? 'true' : 'false' }};
            
    var hidePassword = function(){
        $('#password-container').hide();
        $('#password').attr('required', false);
        $('#password').attr('disabled', true);
    }
    
    var showPassword = function(){
        $('#password-container').show();
        $('#password').attr('required', true);
        $('#password').attr('disabled', false);
    }
    
    var checkPasswordRequired = function(){
        var currentEmail = $('#email').val();
        if(socialRegistration && currentEmail === originalEmail){
            hidePassword();
        }
        else{
            showPassword();
        }
    }

    $(document).ready(function(){
        $('#candidate-tab').on('click',function(){
            $('#candidate-information').show();
            $('#employer-information').hide();
        });
        $('#hirer-tab').on('click',function(){
            $('#candidate-information').hide();
            $('#employer-information').show();
        });
        $('#employer-information').hide();
        showForm();
        toggleHirerTab();

        $('#email').on('change keyup blur', function(){
            checkPasswordRequired();
         })
        checkPasswordRequired();

    });
    
</script>
<script src="{{ elixir('js/disable-registration-buttons.js') }}"></script>
@endsection
