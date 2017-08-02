@extends('quarx-frontend::layout.master')

@section('title', 'FAQs')
@section('seo_description', 'Nq Solicitors frequently asked questions')
@section('seo_keywords', 'frequently, asked, questions')

@section('content')

<div class="container">

    <h1>FAQs</h1>

    @foreach($faqs as $faq)
        <div class="faq m-top-30">
            <blockquote>Q: {!! $faq->question !!}</blockquote>
            <div class="well">
                <strong>Answer:</strong> {!! $faq->answer !!}
            </div>
            @edit('faqs', $faq->id)
        </div>
    @endforeach

</div>

@endsection

@section('quarx')
    @editBtn('faqs')
@endsection
