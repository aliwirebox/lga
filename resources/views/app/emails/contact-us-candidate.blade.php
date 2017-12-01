@extends('app.emails.layout-candidate')
@section('greetingTerm', 'Dear')

@section('content')

<p>Please contact us, we would like to discuss your current application.</p>

<br />

<p>You can email or call us on {{ config('brand.phones.placeholder') }}. <strong>Alternatively book a call back by</strong> <a href="{{ route('frontend.schedule-meeting') }}">clicking here.</a></p>

@endsection
