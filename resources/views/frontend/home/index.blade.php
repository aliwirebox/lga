@extends('frontend.layout')

@section('title', 'The Transparent, Simple, Paralegal employment platform')
@section('seo_description', 'Transparent, Efficient, Hassle free paralegal recruitment')
@section('seo_keywords', 'employers, companies, recruitment')
@section('bodyClasses', 'home')

@section('content')
        <div class="banner">
            <div class="carousel slide" data-interval="6000" data-ride="carousel" id="home-carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h2>
                                        <span>{{ config('brand.identity.fullname') }}</span> - The transparent, efficient and hassle free legal employment platform
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
                                        <span>We charge fixed fees</span> based on candidate salary with the support of experienced consultants
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
                                <a href="{{url('register/candidate')}}" class="cta red cta-spacer">I AM A CANDIDATE </a>
                                <a href="{{url('register/employer')}}" class="cta dark-grey">I AM AN EMPLOYER </a>
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
                        <div class="text-center">
                                    <h2>
                                        It takes minutes to register as a candidate and less than a minute to begin searching for candidates as an employer.
                                    </h2>
                        </div>
                    </div>
        </section>
        <section class="full-width-three-col how-it-works-landing">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>
                            How it works
                        </h2>
                        <div class="col-md-14 text-left">
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3 how-works-item">
                                <div class="how-works-inner">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 how-works-icon">
                                            <img src="{{asset('img/how-it-works-1.png')}}" class="img-responsive">
                                        </div>
                                    </div>
                                     <ul style="font-weight:700">
                                        <h4>Employers</h4>
                                       <li>Employers register and begin searching for candidates, employers are shown matching candidates within seconds</li>
                                        <br>
                                        <li>Employers can rest assured that candidates have been pre-vetted and will be suitable for their vacancy</li>
                                        <br>
                                        <h4>Candidates</h4>
                                        <li>Candidates can be sure the company contacting them is of interest</li>
                                        <br>
                                        <li>Candidates register and are asked a series of questions, set their preferences and employers they do not want to be matched with (it takes a few minutes) </li>
                                        <br>
                                        
                                        <br>


                                    </ul>
                                    
                                </div>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3 how-works-item">
                                <div class="how-works-inner">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 how-works-icon">
                                            <img src="{{asset('img/how-it-works-2.png')}}" class="img-responsive">
                                        </div>
                                    </div>
                                     <ul style="font-weight:700">
                                        <h4>Employers</h4>
                                       <li>Once an employer has conducted a search, CVs are requested and notifications are sent to the candidate</li>
                                        <br>
                                        <li>Employers are informed as soon as new matching candidates register</li>
                                        <br>
                                        <li>Our team of assistants will contact the candidate(s) and arrange interviews</li>
                                        <br>
                                        <li>We will be on hand throughout the recruitment process, arranging interviews and for any assistance</li>
                                        <br>
                                        <h4>Candidates</h4>
                                        <li>We will be on hand throughout the recruitment process, arranging interviews and for any assistance</li>
                                        <br>
                                        <li>Your profile is anonymous and is never shared without your consent</li>
                                        
                                    

                                    </ul>
                                    
                                </div>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3 how-works-item">
                                <div class="how-works-inner">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 how-works-icon">
                                            <img src="{{asset('img/how-it-works-3.png')}}" class="img-responsive">
                                        </div>
                                    </div>
                                    <ul style="font-weight:700">
                                       <h4>Employers</h4>
                                       <li>We take the hassle out of recruitment fees. We charge a fixed fee in relation to a candidate’s salary banding</li>
                                        <br>
                                        <li>Have the peace of mind of a 30-day guarantee if the candidate does not stay in your company</li>
                                        <br>
                                        <li>Legal Asset is efficient we aim to save your company significant time </li>
                                        <br>
                                        <li>We would be happy to hear from you if you are considering multiple hires</li>
                                        <br>
                                        <h4>Candidates</h4>
                                        <li>Legal Asset is completely free for candidates</li>
                                        <br>
                                        <li>Let the ideal role come to you!</li>
                                        <br>
                                        <li>We are motivated by customer service not commission</li>
                                        <br>
                                    </ul>
                                </div>
                                   

                                </div>
                            </div>
                        </div>
                        <p>
                            &nbsp;
                        </p>
                        @if ( config('videos.home') && strlen(config('videos.home.vimeo_id')) > 1 )
                        <div class="video-block max-width-50-pc-md-up margin-auto-horiz">
                            <iframe src="https://www.youtube.com/embed/pKHV7SkGNrM" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                            </iframe>
                        </div>
                        @endif 


                        <p>
                            &nbsp;
                        </p>


                        <p class="text-center">
                            <a href="{{url('register')}}" class="cta red">SIGN UP </a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        @include('frontend.partials.read-our-blog')
        <script src=" {{ elixir('js/sync-heights.js') }} " type="text/javascript" defer></script>
@endsection
