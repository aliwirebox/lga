@extends('master')

@section('body')

    @include('frontend.partials.header')
    <div class="banner blog-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <h2>
                        <span>BLOGS/JOBS</span><br />
                        VISIT OUR BLOGS<br />
                        AND JOBS PAGE<br />
                        FOR RELEVANT<br />
                        NEWS AND ROLES
                    </h2>
                </div>
            </div>
        </div>
    </div>
	<section class="full-width-central">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <p class="red">
                        Our blog will feature jobs posted by employers and some excellent articles to keep you up to date and informed with developments in the legal world.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="blog">
    	<div class="container">

	        @yield('content')

	    </div>
    </section>

    @include('frontend.partials.footer')

@endsection
