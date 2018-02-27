@extends('frontend.layout')

@section('title', 'How it Works Candidate')
@section('seo_description', 'Transparent, Efficient, Hassle free paralegal recruitment')
@section('seo_keywords', 'employers, companies, recruitment')
@section('bodyClasses', 'how-works-candidate')

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
    <section class="full-width-central half-padding">
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
                                    Only companies who match your requirements can
                                    request your CV. You are notified immediately and we will contact you
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
                <div class="col-md-4 how-works-item text-center">
                    <i class="fa fa-upload"></i>
                    <p>{{ config('brand.identity.fullname') }}&rsquo;s technology makes sure every role you are contacted about will be of interest and
                    we only contact you when the law firm or company has requested your CV.</p>
                </div>
                <div class="col-md-4 how-works-item text-center">
                    <i class="fa fa-users"></i>
                    <p>
                    We are not a traditional recruitment agency. {{ config('brand.identity.fullname') }} is transparent, you will know about the salary and role
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
                        {{ config('brand.identity.fullname') }} is completely free!

                    </h2>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <p>
                                Apply passively for the ideal role, you do not have to contact multiple recruiters or look at  jobs boards. Although we cannot guarantee you will find a role through {{ config('brand.identity.fullname') }}, we will do everything we can to help in your search for your next job.
                            </p>
                            <p>
                                <a href="{{url('register')}}" class="cta red uppercase">Sign Up Now </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.read-our-blog')
@endsection
