@extends('app.emails.layout-candidate')

@section('greetingTerm', 'Dear')

@section('content')

    <p>Welcome to {{  config('brand.identity.fullname')  }}.</p>

    <br />

    <p>
        Your profile is now active and anonymous to employers. You will only be found by employers if they match your requirements.
    </p>

    <br />

    <p>
        CV&rsquo;s can only be requested by employers based on your preferences. You can broaden or narrow your employment criteria in your dashboard.
    </p>

    <br />

    <p>
        Please feel free to drop us a call or email if you have any questions and we wish you the best of luck in finding your ideal role!
    </p>

@endsection
