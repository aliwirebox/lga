@extends('app.emails.layout-hirer')
@section('greetingTerm', 'Dear')
@section('content')

    <p>Welcome to {{  config('brand.identity.fullname')  }}.</p>

    <br />

    <p>You can now begin searching for candidates. Only active candidates who match your vacancy will be presented in search results.</p>

    <br />

    <p>Remember to save your search so you are kept informed of candidates who match your current vacancies. We can also run searches for you, just let us know.</p>

    <br />

    <p>When a candidate accepts your CV request, you will be notified by email. A {{ config('brand.identity.fullname') }} team member will be in touch shortly after this to assist with interviews and during the hiring process.</p>

    <br />

    <p>We are on hand if you have any questions. You can email us at <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a> or call us on {{ config('brand.phones.mainspaced')  }}.</p>

    <br />

    <p><strong>Alternatively book a call back by</strong> <a href="{{ route('frontend.schedule-meeting') }}">clicking here</a>.</p>

@endsection
