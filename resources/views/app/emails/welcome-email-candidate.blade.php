@extends('app.emails.layout-candidate')

@section('greetingTerm', 'Dear')

@section('content')

    <p>Welcome to {{  config('brand.identity.fullname')  }}.</p>

    <br />

    <p>You can now begin searching for candidates. Only active candidates who match your vacancy will be presented in search results.</p>

    <br />

    <p>Remember to save your search so you are kept informed of candidates who match your current vacancies. We can also run searches for you, just let us know.</p>

    <br/>

    <p>When a candidate accepts your CV request, you will be notified by email. A {{ config('brand.identity.fullname') }} team member will be in touch shortly after this to assist with interviews and during the hiring process.</p>

    <br />

    <p>We are on hand if you have any questions. You can email us at {{ config('brand.email.support') }} or call us on <a href=" {{ preg_replace('/^0/', '+44', config('brand.phones.main') ) }} ">{{ config('brand.phones.mainspaced') }}</a>.</p> 

    <br />

    <p><strong>Alternatively book a call back by</strong> <a href="{{ route('frontend.schedule-meeting') }}">clicking here</a>.</p>

    <br />

    <p>Please feel free to drop us a call or email if you have any questions and we wish you the best of luck in finding your ideal role!</p>

@endsection
