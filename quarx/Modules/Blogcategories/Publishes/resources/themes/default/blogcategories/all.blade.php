@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>Blogcategory</h1>

    <div class="row">
        <div class="col-md-12">
            @foreach($blogcategories as $blogcategory)
                <a href="{!! URL::to('blogcategories/'.$blogcategory->id) !!}"><p>{!! $blogcategory->name !!} - <span>{!! $blogcategory->updated_at !!}</span></p></a>
            @endforeach

            {!! $blogcategories !!}
        </div>
    </div>

</div>

@endsection

@section('quarx')
    @edit('blogcategories')
@endsection