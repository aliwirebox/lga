@extends('app.emails.layout-hirer')
@section('greetingTerm', 'Hi')

@section('content')

    <p>
        {{ $search->matches->count() }} {{ trans_choice('email.new-candidate', $search->matches->count()) }} {{ $search->name }}
    </p>

    <br>

    <p>
        {{ trans_choice('email.request-cv', $search->matches->count()) }}
        <a href="{{ route('hirer.search.results', $search->id) }}" target="_blank">
            {{ route('hirer.search.results', $search->id) }}
        </a>
    </p>

    <br>

    <p>Kind regards</p>

@endsection
