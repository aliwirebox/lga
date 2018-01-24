@extends('frontend.layout')

@section('title', 'Schedule Meeting')
@section('seo_description', 'Transparent, Efficient, Hassle free paralegal recruitment')
@section('seo_keywords', 'employers, companies, recruitment')

@section('content')
<!-- Calendly inline widget begin -->
<div class="calendly-inline-widget" data-url="https://calendly.com/legalasset"></div>
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
<!-- Calendly inline widget end -->
@endsection
