@extends('app.emails.master')

@section('greeting')
    Hi {{ $user->first_name }},
@endsection

@section('content')

    <p>You can change your password at any time when logged into your account by clicking on ‘Change Password’ in the left hand menu.</p>

    <br>

    <p>If you require any assistance you can contact us by email at <a href="mailto:support@nqsolicitors.com">support@nqsolicitors.com</a> or call us on 020 3709 9165.</p>

    <br>

    <p>Kind regards</p>

@endsection
