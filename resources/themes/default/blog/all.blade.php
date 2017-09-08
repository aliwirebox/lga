@extends('quarx-frontend::layout.master')

@section('title', 'Blog')
@section('seo_description', 'Latest blog articles from ' . config('brand.identity.fullname'))
@section('seo_keywords', 'blog, articles, solicitors')

@section('content')
<div class="col-xs-12">
    <div class="row">
        <div class="col-md-9 col-sm-8 m-top-50">
            <div class="row blog-listings">
                {{--*/ $count = count($blogs) /*--}}
                {{--*/ $currentrow = 1 /*--}}
                @if ($count > 0)
                    @foreach($blogs as $i=>$blog)
                        @if ($i % 3 == 0)
                            <div class="row-posts">
                        @endif
                        <div class="col-sm-6 col-md-4 listing">
                            <img class="img-responsive" src="{{ asset('storage/'.$blog->image->location) }}">
                            <div class="pad-30-well">
                                <h4 class="heading">{{ $blog->title }}</h4>
                                <i class="subheading">{{ $blog->created_at->format('jS F Y') }}, {{ $blog->author }}</i>
                                <hr>
                                <p>{{ str_limit(strip_tags($blog->entry)) }}</p>
                                <a href="{!! URL::to('blog/'.$blog->url) !!}" class="btn btn-primary">Read More</a>
                            </div>

                        </div>

                         @if ($currentrow % 2 == 0 && $i % 3 == 0)
                            <div class="listing-clearfix"></div>
                        @elseif ($currentrow % 2 != 0 && $i % 2 == 1)
                            <div class="listing-clearfix"></div>
                        @endif
                        
                        @if( ($i+1) % 6 == 0) 
                            <div class="listing-clearfix"></div>
                        @endif
                        
                        @if ($i % 3 == 2 || $i == $count-1)
                            </div>
                            {{--*/ $currentrow++ /*--}}
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
