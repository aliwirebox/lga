@extends('app.emails.master')

@section('greeting')
    Hi {{ $candidate->referrer->first_name }},
@endsection

@section('content')
    <p>
        {{ $candidate->getFullName() }} has recently created a profile on {{ config('brand.web.domain') }} and has given your name as a referee.
    </p>

    <br>

    <p>
        Should {{ $candidate->first_name }} be successfully placed through {{  config('brand.identity.domain')  }}, you will receive a referral fee/gift of £500.
    </p>

    <br>

    <p>
        Referral fees are subject to our Terms & Conditions, which can be viewed at this <a href="{{ asset('pdf/Referral Scheme Terms (Final).pdf') }}">link</a>
    </p>

    <br>

    <p>
        If you have any questions, please contact us by email at <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a> 
        or call us on {{    config('brand.phones.mainspaced')  }}.
    </p>

    <br>

    <p>Kind regards</p>

@endsection
