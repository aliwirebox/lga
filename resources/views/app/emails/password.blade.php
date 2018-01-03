@extends('app.emails.layout-user')
@section('greetingTerm', 'Hi')

@section('content')

<p>You have requested a password reset. <strong>To reset your password</strong> <a href="{{ url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">click here</a>.</p>

<br />

<p>You can email us at {{ config('brand.email.support') }} or call us on <a href="{{ preg_replace('/^0/', '+44', config('brand.phones.main') ) }}"> {{ config('brand.phones.mainspaced') }} </a> if you have any questions.</p>

@endsection
