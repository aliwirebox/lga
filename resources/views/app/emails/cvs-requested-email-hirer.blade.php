@extends('app.emails.layout-candidate')
@section('greetingTerm', 'Hi')
@section('content')
    <p>
        You have requested the following CVs:
    </p>

    <ul>
        <li>Candidate LA10001</li>
        <li>Candidate LA10002</li>
        <li>Candidate LA10023</li>
    </ul>

    <p>
        We will notify you by email as soon as a candidate accepts or declines your CV request. A {{ config('brand.identity.fullname') }} team member will be in touch shortly after the CVs have been sent to you for feedback and if suitable, arrange interviews.
    </p>

    <br />

    <p>
        You can save your search to be kept informed of any new candidates who match your requirements.
    </p>

    <br />

    <p>
        We are on hand if you have any questions. You can email us at <a href="mailto:{{config('brand.email.support') }}">{{ cpnfig('brand.email.support') }}</a> or call us on {{ config('brand.phones.placeholder') }}.
    </p>

    <br />
   
    <p>
        <strong>Alternatively book a call back by</strong> <a href="{{ route('frontend.schedule-meeting') }}">clicking here</a>.
    </p>

@endsection
