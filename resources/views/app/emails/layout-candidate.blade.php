@extends('app.emails.master')

@section('greeting')
    Hi {{ $candidate->first_name }},
@endsection
