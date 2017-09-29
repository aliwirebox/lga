@extends('frontend.layout')

@section('title', 'Schedule Meeting')
@section('seo_description', 'Where law firms find the best talent')
@section('seo_keywords', 'law, firms, solicitors, recruitment')

@section('content')
<!-- Calendly inline widget begin -->
<div class="calendly-inline-widget" data-url="https://calendly.com/legalasset" style="min-width:320px;height:580px;"></div>
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
<!-- Calendly inline widget end -->
@endsection
