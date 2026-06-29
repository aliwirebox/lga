@extends('quarx-frontend::layout.master')

@section('title', 'Blog')
@section('seo_description', 'Latest blog articles from ' . config('brand.identity.fullname'))
@section('seo_keywords', 'blog, articles, solicitors')
@section('disclaimer')
    @theme('partials.blog-disclaimer')
@endsection
@section('content')
<div class="col-xs-12">
    <div class="row">
        <div class="col-md-9 col-sm-8">
            <div class="row blog-listings">
                @if ($blogs->count() > 0)
                    @foreach($blogs as $i=>$blog)
                        @if ($i % 3 == 0)
                            <div class="row-posts">
                        @endif
                        <div class="col-sm-6 col-md-4 listing">
                            <div class="panel">
                                <a href="{!! URL::to('blog/'.$blog->url) !!}">
                                    <img class="img-responsive" src="{{ asset('storage/'.$blog->image->location) }}">
                                </a>
                                <h4 class="heading"><a href="{!! URL::to('blog/'.$blog->url) !!}">{{ $blog->title }}</a></h4>
                                <p>{{ strip_tags(addExcerptBreaks($blog->entry)) }}</p>
                            </div>
                        </div>

                        @if ($i % 3 == 2 || $loop->last)
                            </div>
                        @endif
                        
                        @if( ($i+1) % 6 == 0) 
                            <div class="listing-clearfix"></div>
                        @endif
                        
                    @endforeach
                    <div class="clearfix"></div>
                    <div class="text-center">
                        {!! $blogs !!}
                    </div>
                @else
                    <div class="col-md-12">
                        <h3>No posts found.</h3>
                    </div>    
                @endif
            </div>
        </div>

        @theme('partials.blog-sidebar')

    </div>
</div>

@endsection

@section('quarx')
    @edit('blog')
@endsection
