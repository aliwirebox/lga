@extends('app.emails.layout-hirer')

@section('content')

    <p>Candidate {{ $candidate->reference }} has declined your CV Request for the following Vacancy/Saved Search:</p>

    <p>New candidates are always registering, please save your search to be kept informed of suitable candidates.</p>

    <p>We are happy to save your search, just let us know.</p>

    <p>We are on hand if you have any questions. You can email us at <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a> or call us on {{ config('brand.phones.placeholder')  }}.</p>

@endsection
