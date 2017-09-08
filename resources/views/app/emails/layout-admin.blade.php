@extends('app.emails.master')

@section('greeting')
    Hi {{ config('brand.identity.initials')  }} Administrator
@endsection