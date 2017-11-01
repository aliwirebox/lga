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
                            <span>CANDIDATES</span> <br>
                            TAKE CONTROL OF YOUR <br>
                            JOB SEARCH AND LET THE IDEAL <br>
                            ROLE COME TO YOU
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="full-width-central">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <p class="red">
                        Your profile is completely anonymous and you can select which law firms and companies you
                        do not want to be matched with. We will never release your CV without your permission
                        and take your privacy seriously!
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="darker-grey">
        <div class="container">
            <div class="clearfix">
                <div class="text-center">
                    <h2>HOW IT WORKS - CANDIDATES</h2>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="work-step red">
                                
                                <h3>STEP 1</h3>
                                <p>
                                    <strong>Join in minutes</strong> &minus; Set your preferences, tell us a <br>
                                    little bit about experience and upload your CV
                                </p>
                            </div>
                            <div class="parallelogram red"></div>
                        </div>
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="work-step grey">
                                <h3>STEP 2</h3>
                                <p>
                                    Only companies who match your requirements can <br>
                                    request your CV. You are notified immediately and we will contact you <br>
                                    to arrange interviews
                                </p>
                            </div>
                            <div class="parallelogram grey"></div>
                        </div>
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="work-step dark-grey">
                                <h3>STEP 3</h3>
                                <p>
                                    <strong>Accept the ideal role</strong> &minus; We will be on hand throughout <br>
                                    the process to assist you with interviews and advice
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
                    <p>{{ config('brand.identity.fullname') }}&rsquo;s technology makes sure every role you are contacted about will be of interest and
                    we only contact you when the law firm or company has requested your CV.</p>
                </div>
                <div class="col-md-4 how-works-item text-center">
                    <i class="fa fa-users"></i>
                    <p>
                    We are not a recruitment agency. {{ config('brand.identity.fullname') }} is transparent, you will know about the salary and role
                    specifics when employers request your CV.
                    </p>
                </div>
                <div class="col-md-4 how-works-item text-center">
                    <i class="fa fa-check-circle-o"></i>
                    <p>
                        We believe finding the right role should be easy and stress free. You will never pay to use our platform.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="central-text-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>
                        Legal Asset is completely free!

                    </h2>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <p>
                                Apply passively for the ideal role, you do not have to contact multiple recruiters or look at  jobs boards. Although we cannot guarantee you will find a role through Legal Asset, we will do everything we can to help in your search for your next job.
                            </p>
                            <p>
                                <a href="{{url('register')}}" class="cta red">Sign Up Now <strong>></strong></a>
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
