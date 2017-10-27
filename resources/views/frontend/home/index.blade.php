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
                                        Our talent matching software ensures candidates and companies find their ideal match
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
                <a class="left carousel-control" href="#home-carousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
  <a class="right carousel-control" href="#home-carousel" data-slide="next">
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
                            <iframe src="https://player.vimeo.com/video/{{ config('videos.home.vimeo_id') }}" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                            </iframe>
                        </div>
                        @endif
                    <div class="text-center">
                        <h2>
                            Our talent matching software ensures candidates and <br>
                            companies find their perfect match.
                        </h2>
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <p>
                                    Our talent matching software ensures candidates and companies find their perfect match. We charge a fixed £995 hiring fee and have a team of assistants to help throughout recruitment process.
                                </p>
                                <p>
                                    It takes 3 minutes to register as a candidate and less than a minute to begin searching for candidates as an employer.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="full-width-three-col">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>
                            How it works
                        </h2>
                        <div class="row">
                            <div class="col-sm-4 how-works-item">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <img src="{{asset('img/how-it-works-1.jpg')}}" class="img-responsive">
                                    </div>
                                </div>
                                <p>
                                    Candidates register and are asked a series of questions and set their preferences (it takes a few minutes)
                                </p>
                                <p>

                                    Employers register and  begin searching for the ideal candidate (it only takes a few minutes to see who matches your role)
                                </p>
                                <p>

                                    Candidates can be sure the company contacting them is of interest. Employers will know that candidates are pre-vetted and suitable for the role                                
                                </p>
                            </div>
                            <div class="col-sm-4 how-works-item">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <img src="{{asset('img/how-it-works-2.jpg')}}" class="img-responsive">
                                    </div>
                                </div>
                                <p>
                                    As soon as a search has been made and 
                                    matches are confirmed the employer can begin requesting CVs
                                </p>
                                <p>
                                    Our team of assistants will contact the candidate and arrange interviews if the candidates CV matches the employers requirements
                                </p>
                                <p>
                                    We will be on hand throughout the 
                                    recruitment process
                                </p>
                                <p>
                                    Employers are informed as soon as new matching candidates register
                                </p>
                            </div>
                            <div class="col-sm-4 how-works-item">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <img src="{{asset('img/how-it-works-3.jpg')}}" class="img-responsive">
                                    </div>
                                </div>
                                <p>
                                    We take the hassle out of recruitment fees
                                </p>
                                <p>
                                    It is £995 per hire regardless of the candidates salary
                                </p>
                                <p>
                                    Have the peace of mind of a 60 day guarantee
                                </p>
                                <p>
                                    If you would like multiple hires 
                                    please contact us
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
