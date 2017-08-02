@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>{!! $blogcategory->id !!} - <span>{!! $blogcategory->updated_at !!}</span></h1>

</div>

@endsection

@section('quarx')
    @edit('blogcategories', $blogcategory->id)
@endsection
