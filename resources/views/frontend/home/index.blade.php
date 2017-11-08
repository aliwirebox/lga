@extends('frontend.layout')

@section('title', 'The Transparent, Simple, Paralegal employment platform')
@section('seo_description', 'Transparent, Efficient, Hassle free paralegal recruitment')
@section('seo_keywords', 'employers, companies, recruitment')

@section('content')
        <div class="banner">
            <div class="carousel slide" data-interval="6000" data-ride="carousel" id="home-carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h2>
                                        <span>Legal Asset</span> - The transparent, efficient and hassle free Paralegal employment platform
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h2>
                                        Our <span class="red">talent matching software</span> ensures candidates and companies find their ideal match
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h2>
                                        A <span>&pound;995 flat fee</span> regardless of candidate salary with the support of experienced consultants
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <p>
                                <a href="{{url('register/candidate')}}" class="cta red cta-spacer">I AM A CANDIDATE <strong>></strong></a>
                                <a href="{{url('register/employer')}}" class="cta dark-grey">I AM AN EMPLOYER <strong>></strong></a>
                            </p>
                        </div>
                    </div>
                </div>
                <a class="left arrow-cta" href="#home-carousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right arrow-cta" href="#home-carousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <section class="central-text-block">
            <div class="container">
                <div class="row">
                        @if ( config('videos.home') && strlen(config('videos.home.vimeo_id')) > 1 )
                        <div class="video-block text-center">
                            <iframe src="https://player.vimeo.com/video/{{ config('videos.home.vimeo_id') }}" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                            </iframe>
                        </div>
                        @endif
                    <div class="text-center">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <h2>
                                    It takes 3 minutes to register as a candidate and less than a minute to begin searching for candidates as an employer.
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="full-width-three-col how-it-works-landing">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>
                            <ins>How it works</ins>
                        </h2>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3 how-works-item">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <img src="{{asset('img/how-it-works-1.jpg')}}" class="img-responsive">
                                    </div>
                                </div>
                                <p>
                                    Candidates register and are asked a series of questions, set their preferences and companies they do not want to be matched with (it takes a few minutes)
                                </p>
                                <p>
                                    Employers register and begin searching for candidates, employers are shown matching candidates within seconds.
                                </p>
                                <p>
                                    Candidates can be sure the company contacting them is of interest. Employers will know that candidates are pre-vetted and suitable for their vacancy.
                                </p>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3 how-works-item">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <img src="{{asset('img/how-it-works-2.jpg')}}" class="img-responsive">
                                    </div>
                                </div>
                                <p>
                                    Once an employer has conducted a search, CVs are requested and notifications are sent directly to the candidate.
                                </p>
                                <p>
                                    Our team of assistants will contact the candidate(s) and arrange interviews.
                                </p>
                                <p>
                                    Employers are informed as soon as new matching candidates register.
                                </p>
                                <p>
                                    We will be on hand throughout the recruitment process, arranging interviews and for any assistance.
                                </p>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3 how-works-item">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <img src="{{asset('img/how-it-works-3.jpg')}}" class="img-responsive">
                                    </div>
                                </div>
                                <p>
                                    We take the hassle out of recruitment fees. It is &pound;995 per hire regardless of the candidate&rsquo;s salary.
                                </p>
                                <p>
                                    {{ config('brand.identity.fullname') }} is completely free for candidates and a fee is only payable on a successful placement.
                                </p>
                                <p>
                                    Have the peace of mind of a 30-day guarantee if the candidate does not stay in your company.
                                </p>
                                <p>
                                    If you would like multiple hires please contact us.
                                </p>

                            </div>
                        </div>
                        <p>
                            &nbsp;
                        </p>
                        <p class="text-center">
                            <a href="{{url('register')}}" class="cta red">SIGN UP NOW <strong>></strong></a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="image-right-block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-5 col-sm-offset-1">
                                <div class="text-wrapper">
                                    <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pharetra volutpat turpis, eu dignissim odio vulputate ac. Pellentesque tincidunt mattis lacus vel bibendum. Maecenas porttitor lectus ut libero luctus, at volutpat tortor rhoncus. Nunc feugiat nisl et sodales consectetur. Ut venenatis tristique mattis. Suspendisse potenti. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla iaculis ultricies erat, vel ultricies nisl alique
                                </p>
                                <p>
                                    <strong>Andrew Others</strong><br>
                                    ParaLegal
                                </p>
                                <p>
                                    <a href="#" class="cta dark-grey">read our blog <strong>></strong></a>
                                </p>
                                </div>
                            </div>
                            <div class="col-sm-6 p-r-0">
                                <img src="{{asset('img/handshake.jpg')}}" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
