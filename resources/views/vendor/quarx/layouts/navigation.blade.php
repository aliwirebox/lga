@extends('quarx::layouts.master')

@section('navigation')

<div class="raw100 raw-left navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button class="navbar-toggle sidebar-menu-btn">
            <span class="fa fa-bars nav-open"></span>
            <span class="fa fa-close nav-close"></span>
        </button>
        <span class="navbar-brand"><span class="fa fa-book"></span> {{ config('brand.identity.initials')  }} Blog Admin Area</span>
        <p class="navbar-text navbar-left raw-m-hide">{{ getCurrentUser()->getFullName() }}</p>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
            <span class="fa fa-gear"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse navbar-right" id="mainNavbar">
    </div>
</div>

@stop
