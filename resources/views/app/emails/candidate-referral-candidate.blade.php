@extends('app.emails.master')

@section('greeting')
    Hi {{ $candidate->referrer->first_name }},
@endsection

@section('content')
    <p>
        {{ $candidate->getFullName() }} has recently created a profile on NQSolicitors.com and has given your name as a referee.
    </p>

    <br>

    <p>
        Should {{ $candidate->first_name }} be successfully placed through NQSolicitors.com, you will receive a referral fee/gift of £500.
    </p>

    <br>

    <p>
        Referral fees are subject to our Terms & Conditions, which can be viewed at this <a href="{{ asset('pdf/Referral Scheme Terms (Final).pdf') }}">link</a>
    </p>

    <br>

    <p>
        If you have any questions, please contact us by email at <a href="mailto:support@nqsolicitors.com">support@nqsolicitors.com</a> 
        or call us on 020 3709 9165.
    </p>

    <br>

    <p>Kind regards</p>

@endsection
