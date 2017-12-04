@extends('app.emails.layout-candidate')
@section('greetingTerm', 'Hello')

@section('content')
    <p>Thank you for registering with {{  config('brand.identity.fullname')  }}. <a href="{{ url("email/verify/{$candidate->email_token}") }}">Click here to activate</a> your account and to be taken to your dashboard.</p>
    <br />
    <p>Please email us at <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a> or call us on {{    config('brand.phones.mainspaced')  }} if you have any questions.</p>

@endsection
