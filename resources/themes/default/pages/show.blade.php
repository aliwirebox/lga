@extends('quarx-frontend::layout.master')

@section('title', $page->title)
@section('seo_description', $page->seo_description)
@section('seo_keywords', $page->seo_keywords)
@section('bannerTitle')
@php 
    switch (true)
    {
        case stristr(strtolower($page->title), 'candidate faqs'):
            echo '<span>Candidate FAQs</span>';
            break;
        case stristr(strtolower($page->title), 'about'):
            echo '<span>About Us</span>';
            break;
        case stristr(strtolower($page->title), 'employers'):
            echo '<span>Hirer FAQs</span>';
            break;
    }
@endphp
@endsection

@section('content')

<div class="container">

    <h1 class="faq-title">{!! $page->title !!}</h1>
    <div class="page-content">{!! $page->entry !!}</div>

</div>

@endsection

@section('quarx')
    @edit('pages', $page->id)
@endsection
