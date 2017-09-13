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
                        <h1 class="fs-50 f-light fc-black">OUR TALENT MATCHING SOFTWARE ENSURES CANDIDATES AND<br />
			COMPANIES FIND THEIR PERFECT MATCH.
			</h1>
                        <p>{{ config('brand.web.domain') }} is a unique and entirely discreet online matching platform that allows Trainee Solicitors and Newly Qualified Solicitors to take the next step in their legal career by matching them with private practice law firms who are looking to hire at {{ config('brand.identity.initials')  }} to 2 PQE.</p>
                        <p>Designed and developed by experienced legal recruitment consultants, {{ config('brand.web.domain') }} is NOT a jobs board, but a platform that allows junior Lawyers to be matched with {{ config('brand.identity.initials')  }} Solicitor jobs based on both their academic record and legal experience to date and, importantly, their specific work preferences.</p>
                        <p>{{ config('brand.web.domain') }} offers Candidates and Hirers the opportunity to take complete control of the recruitment process and the level of market ‘reach’ that cannot be achieved by traditional legal recruitment agencies.</p>
                        <p>The platform is free for Trainee Solicitors and {{ config('brand.identity.fullname') }} to use, and has been designed with Candidate anonymity as its top priority.</p>
                        <a class="btn btn-primary book-bold about-cta" href="{{ url('about-us') }}">About the Service</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
