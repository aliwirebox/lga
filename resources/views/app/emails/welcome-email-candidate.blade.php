@extends('app.emails.layout-candidate')

@section('greetingTerm', 'Dear')

@section('content')

    <p>Welcome to {{  config('brand.identity.fullname')  }}</p>.

    <p>You can now begin searching for candidates. Only active candidates who match your vacancy will be presented in search results.</p>

    <p>Remember to save your search so you are kept informed of candidates who match your current vacancies. We can also run searches for you, just let us know.</p>

    <p>When a candidate accepts your CV request, you will be notified by email. A {{ config('brand.identity.fullname') }} team member will be in touch shortly after this to assist with interviews and during the hiring process.</p>

    <p>We are on hand if you have any questions. You can email us at {{ config('brand.email.support') }} or call us on {{ config('brand.phones.placeholder') }}.</p> 

    <p><strong>Alternatively book a call back by</strong> <a href="{{ route('frontend.schedule-meeting') }}">clicking here</a>.</p>

    <br>

    <p>If so, then you may be interested in our referral scheme: refer a Candidate to {{ config('brand.web.domain') }} and if they are successfully placed through the site you will receive a referral fee/gift of £500.</p>

    <br>

    <p>Kind regards</p>

@endsection
