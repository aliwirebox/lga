@extends('app.emails.layout-hirer')

@section('content')

    <p>Thank you for registering with NQSolicitors.com. Please click on the button below to activate your Hirer account.</p>

    <br>

    <p><a href="{{ url("email/verify/{$hirer->email_token}") }}">Activate Account</a></p>

    <br>

    <p>Once you have activated your Hirer account you will be able to search and make CV Requests for Candidates that match your specific requirements.</p>

    <br>

    <p>If you have any questions, please contact us by email at <a href="mailto:support@nqsolicitors.com">support@nqsolicitors.com</a> or call us on 020 3709 9165.</p>

    <br>

    <p>Kind regards</p>

@endsection
