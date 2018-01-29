@extends('master')
@section('bodyClasses', 'page-blog')

@section('body')

    @include('frontend.partials.header')
    <div class="banner blog-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <h2>
                        @yield('bannerTitle', '
                        <span>BLOGS/JOBS</span><br />
                        VISIT OUR BLOGS<br />
                        AND JOBS PAGE<br />
                        FOR RELEVANT<br />
                        NEWS AND ROLES
                        ')
                    </h2>
                </div>
            </div>
        </div>
    </div>
    @yield('disclaimer')
    <section class="blog">
    	<div class="container">

	        @yield('content')

    </div>
    </section>

    @include('frontend.partials.footer')
    <script type="text/javascript" defer src="{{ elixir('js/scroll-to-tagged-posts.js') }}"></script>
@endsection
