@extends('quarx-frontend::layout.master')

@section('title', $page->title)
@section('seo_description', $page->seo_description)
@section('seo_keywords', $page->seo_keywords)
@section('bannerTitle', '<span>' . $page->title . '</span>')

@section('content')

<div class="container">

    <h1 class="faq-title">{!! $page->title !!}</h1>
    <div class="page-content">{!! $page->entry !!}</div>

</div>

@endsection

@section('quarx')
    @edit('pages', $page->id)
@endsection
