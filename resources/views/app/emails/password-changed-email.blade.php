@extends('app.emails.master')

@section('greeting')
    Hi {{ $user->first_name }},
@endsection

@section('content')

    <p>You can change your password at any time when logged into your account by clicking on ‘Change Password’ in the left hand menu.</p>

    <br />

    <p>If you require any assistance you can contact us by email at <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a> or call us on <a href="tel:{{ config('brand.phones.main-formatted') }}">{{ config('brand.phones.mainspaced')  }}</a>.</p>

    <br />

    <p>Kind regards</p>

@endsection
