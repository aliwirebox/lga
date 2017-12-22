@extends('frontend.layout')

@section('title', 'Recruitment')
@section('seo_description', 'Transparent, Efficient, Hassle free paralegal recruitment')
@section('seo_keywords', 'employers, companies, recruitment')

@section('content')
    <section class="candidates">
        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <h2>
                            YOU CAN BEGIN SEARCHING FOR PRE-EVALUATED
                            MATCHING CANDIDATES FOR YOUR LEGAL ROLES WITHIN MINUTES.
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="darker-grey">
        <div class="container">
            <div class="clearfix">
                <div class="text-center">
                    <h2>HOW IT WORKS - EMPLOYERS</h2>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="work-step red">
                                <h3>Register</h3>
                                <p>
                                    It only takes a couple of minutes to find the <br>
                                    ideal candidate
                                </p>
                            </div>
                            <div class="parallelogram red"></div>
                        </div>
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="work-step grey">
                                <h3>Save Time</h3>
                                <p>
                                     Have the confidence in knowing candidates have matched with you because they would be eager to work for you. You can save
                                    your search and will be notified as soon as suitable <br>
                                    candidates register.
                                </p>
                            </div>
                            <div class="parallelogram grey"></div>
                        </div>
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="work-step dark-grey">
                                <h3>Save Money</h3>
                                <p>
                                    We charge a fixed &pound;995 fee per hire regardless of the candidate’s
                                    salary. You also have a 30 day candidate guarantee.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="full-width-three-col">
        <div class="container">
            <div class="row">
                <div class="col-md-4 how-works- text-center">
                    <i class="fa fa-upload"></i>
                    <p>{{ config('brand.identity.fullname') }}&rsquo;s technology makes sure candidates matched with your role are actively looking.</p>
                    <p>We speak to all our candidates to understand their needs and save time.</p>
                </div>
                <div class="col-md-4 how-works-item text-center">
                    <i class="fa fa-users"></i>
                    <p>
                        We are not a recruitment agency. Our assistants are motivated by customer service and not by commission.
                    </p>
                    <p>
                        As soon as you request a CV an email is sent immediately to the candidate. We will call them shortly after and will be on hand throughout the hiring journey.
                    </p>
                </div>
                <div class="col-md-4 how-works-item text-center">
                    <i class="fa fa-check-circle-o"></i>
                    <p>
                        If you have a requirement for multiple hires please contact us.
                    </p>
                    <p>
                        Let us know if you are not on our list of employers and we will be happy to add you.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="central-text-block no-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>
                        It is time to disrupt legal recruitment.
                    </h2>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <p>
                                 We feel we can bring technology and customer service together to provide transparency and save considerable time and money for our clients.
                            </p>
                            <p>
                                Your testimonials help us to grow, if you feel we have provided a good service please get in touch so we can feature your comments on our site.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="image-right-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <div class="text-wrapper">
                                <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pharetra volutpat turpis, eu dignissim odio vulputate ac. Pellentesque tincidunt mattis lacus vel bibendum. Maecenas porttitor lectus ut libero luctus, at volutpat tortor rhoncus. Nunc feugiat nisl et sodales consectetur. Ut venenatis tristique mattis. Suspendisse potenti. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla iaculis ultricies erat, vel ultricies nisl alique
                            </p>
                            <p>
                                <strong>Anita Fowler</strong><br>
                                ParaLegal
                            </p>
                            <p>
                                <a href="#" class="cta dark-grey">read our blog <strong>></strong></a>
                            </p>
                            </div>
                        </div>
                        <div class="col-sm-6 p-r-0">
                            <img src="{{asset('img/interview.jpg')}}" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
