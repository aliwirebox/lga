@extends('app.emails.layout-hirer')

@section('greetingTerm', 'Dear')
@section('content')

    <p>Thank you for registering with {{  config('brand.identity.fullname')  }}. <a href="{{ url("email/verify/{$hirer->email_token}") }}">Click here to activate</a> your account and to be taken to your dashboard.</p>

    <p>You can email us at <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a> or call us on {{ config('brand.phones.placeholder') }} if you have any questions.</p>

@endsection
