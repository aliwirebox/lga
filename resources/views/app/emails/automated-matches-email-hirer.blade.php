@extends('app.emails.layout-hirer')

@section('content')

    <p>
        {{ $search->matches->count() }} {{ trans_choice('email.new-candidate', $search->matches->count()) }} {{ $search->name }}
    </p>

    <br>

    <p>
        {{ trans_choice('email.request-cv', $search->matches->count()) }}
        <a href="{{ route('hirer.cv-requests') }}" target="_blank">
            {{ route('hirer.cv-requests') }}
        </a>
    </p>

    <br>

    <p>Kind regards</p>

@endsection
