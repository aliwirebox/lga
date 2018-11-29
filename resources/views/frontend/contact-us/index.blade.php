@extends('frontend.layout')
@section('title', 'Contact Us')
@section('seo_description', 'Contact us')
@section('seo_keywords', 'contact us')
@section('bodyClasses', 'contact')
@section('content')
<section class="contact">
    <div class="banner contact-banner">
        <div class="container">
            <div class="row">

                <div class="col-sm-8">
                    <h2>
                        LEGAL TALENT & JOBS <br>
                        AT YOUR FINGERTIPS. <br>
                        <span class="red">CONTACT US NOW</span>
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-sm-10 col-sm-offset-1 text-center">
                <p>
                    We welcome any queries you may have. Use the contact form below to get in touch. You can use live chat or arrange a call by clicking on the schedule a call button.
                </p>
            </div>

            <div class="col-sm-6 col-sm-offset-3">
                <div class="contact-column">
                    <i class="fa fa-clock-o"></i>
                    <h3>Opening Times</h3>
                    {{ config('brand.opening.string') }}
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-sm-10 col-sm-offset-1">
                @include('partials.errors')
                <form action="{{ route('frontend.contact-us')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name*</label>
                                <input type="text" class="form-control" name="first_name">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name <sup>*</sup> </label>
                                <input type="text" class="form-control" name="last_name">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Email*</label>
                        <input type="text" class="form-control" name="email">
                    </div>

                    <div class="form-group">
                        <label>Message <sup>*</sup> </label>
                        <textarea class="form-control" name="email_body"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg btn-block">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <div class="no-padding full-width-centered">
        <h3>
            Ring us on: <span><a href="tel:{{ config('brand.phones.main-formatted') }}">{{ config('brand.phones.mainspaced') }}</a></span> <br>
            {{ config('brand.opening.string') }} 
        </h3>
        <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
                <a href="/schedule-meeting" target="_blank" class="cta dark-grey m-top-25"><i class="fa fa-telephone"></i> Schedule a call</a>
            </div>
        </div>
    </div>
</section>

@endsection
