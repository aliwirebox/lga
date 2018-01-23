@extends('quarx-frontend::layout.master')

@section('title', $blog->title)
@section('seo_description', $blog->seo_description)
@section('seo_keywords', $blog->seo_keywords)

@section('content')

    <div class="col-xs-12">
        <div class="row">
            <div class="col-md-9 col-sm-8 m-top-50 blog-post">
                <div class="post-heading">
                    <h1 class="heading ts-24 text-red">
                        {{ $blog->title }}
                    </h1>
                    <div class="subheading">
                        {{ $blog->created_at->format('jS F Y') }}, {{ $blog->author }}
                    </div>
                </div>
                <div class="m-top-30">
                    <img class="img-responsive" src="{{asset('storage/'.$blog->image->location)}}"><br>
                    {!! $blog->entry !!}
                </div>
        
                @theme('partials.comments')
        
            </div>
        
            @theme('partials.blog-sidebar')
        
        </div>
    </div>

@endsection

@section('quarx')
    @edit('blog', $blog->id)
@endsection
