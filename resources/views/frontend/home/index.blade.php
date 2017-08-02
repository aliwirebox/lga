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
                    <div class="col-md-7 hirer">
                        <h1 class="fs-50 f-light fc-black">WHERE LAW FIRMS FIND THE BEST TALENT</h1>
                        <p>NQSolicitors.com is a unique and entirely discreet online matching platform that allows Trainee Solicitors and Newly Qualified Solicitors to take the next step in their legal career by matching them with private practice law firms who are looking to hire at NQ to 2 PQE.</p>
                        <p>Designed and developed by experienced legal recruitment consultants, NQSolicitors.com is NOT a jobs board, but a platform that allows junior Lawyers to be matched with NQ Solicitor jobs based on both their academic record and legal experience to date and, importantly, their specific work preferences.</p>
                        <p>NQSolicitors.com offers Candidates and Hirers the opportunity to take complete control of the recruitment process and the level of market ‘reach’ that cannot be achieved by traditional legal recruitment agencies.</p>
                        <p>The platform is free for Trainee Solicitors and NQ Solicitors to use, and has been designed with Candidate anonymity as its top priority.</p>
                        <a class="btn btn-primary book-bold about-cta" href="{{ url('about-us') }}">About the Service</a>
                    </div>
                    <!-- Start Registration -->
                    <div class="col-md-5">
                        <div class="form-tabs col-sm-m-top-30"> 
                            <ul class="nav nav-tabs" role="tablist"> 
                                <li role="presentation" class="active">
                                    <a href="#candidate" id="candidate-tab" role="tab" data-toggle="tab" aria-controls="candidate" aria-expanded="true">Candidate <span class="hidden-xs">Registration</span> <i class="nq-sprite nq-icon nq-lg-user"></i></a>
                                </li> 
                                <li role="presentation">
                                    <a href="#hirer" role="tab" id="hirer-tab" data-toggle="tab" aria-controls="hirer">Hirer <span class="hidden-xs">Registration</span> <i class="nq-sprite nq-icon nq-lg-hirer"></i></a>
                                </li> 
                            </ul> 
                            <div id="signupTabContent" class="tab-content"> 
                                <div role="tabpanel" class="tab-pane fade in active" id="candidate" aria-labelledby="candidate-tab"> 
                                    <h4 class="tab-title">Start Building Your Profile</h4>
                                    @include('app.candidate.partials.registration-form')
                                </div> 
                                <div role="tabpanel" class="tab-pane fade" id="hirer" aria-labelledby="hirer-tab"> 
                                    <h4 class="tab-title">Start Searching For NQs</h4>
                                    @include('app.hirer.partials.registration-form')
                                </div> 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@endsection
