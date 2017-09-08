@extends('app.emails.layout-hirer')

@section('content')

    <p>Thank you for registering with {{  config('brand.identity.domain')  }}. Please click on the button below to activate your Hirer account.</p>

    <br>

    <p><a href="{{ url("email/verify/{$hirer->email_token}") }}">Activate Account</a></p>

    <br>

    <p>Once you have activated your Hirer account you will be able to search and make CV Requests for Candidates that match your specific requirements.</p>

    <br>

    <p>If you have any questions, please contact us by email at <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a> or call us on {{    config('brand.phones.mainspaced')  }}.</p>

    <br>

    <p>Kind regards</p>

@endsection
