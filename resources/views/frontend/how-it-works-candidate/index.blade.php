@extends('frontend.layout')

@section('title', 'Recruitment')
@section('seo_description', 'Where law firms find the best talent')
@section('seo_keywords', 'law, firms, solicitors, recruitment')

@section('content')
    
        <!-- Start Main Content -->
        <div class="container">
            <div class="col-xs-12">
                <div class="row">
                    <!-- Start Content -->
                    <div class="col-md-12 hirer">
                        <h1 class="fs-50 f-light fc-black">
                        TAKE CONTROL OF YOUR JOB SEARCH AND LET THE IDEAL ROLE COME TO YOU
                        </h1>
                        <p>
                        Your profile is completely anonymous and you can select which law firms and companies you
                        do not want to be matched with. We will never release your CV without your permission
                        and take your privacy seriously!
                        </p>
                        <ol>
                            <li>
                                <strong>Join in 3 minutes</strong> &minus; Set your preferences, tell us a little bit about
                                yourself and upload your CV
                            </li>
                            <li>
                                Only when a company matches your requirements can they request your CV. When they do we will
                                contact you to release your CV and arrange interviews
                            </li>
                            <li>
                                <strong>Accept the ideal role</strong> &minus; We will be on hand throughout the process to
                                assist you with interviews and advice
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p>{{ config('brand.identity.fullname') }}&rsquo;s technology makes sure every role you are contacted about will be of interest and
                    we only contact you when the law firm or company has requested your CV.</p>
                </div>
                <div class="col-md-4">
                    <p>
                    We are not a recruitment agency. We are completely transparent, you will know about the salary and role
                    specifics when the employer has requested your CV.
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>
                        {{ config('brand.identity.fullname') }} is completely free!
                    </h3>
                    <p>
                        We believe finding the right role should be easy and stress free. You will never pay to use
                        our platform.
                    </p>
                </div>
            </div>
            <p>Apply passively for the ideal role, you do not have to contact multiple recruiters or look at jobs boards.
            Although we cannot guarantee you will find a role through </p>
        </div>
@endsection
