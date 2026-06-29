@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route('quarx.blogcategories.create') !!}">Add New</a>
        <h1 class="page-header">Blog Categories</h1>
    </div>

    @include('blogcategories::blogcategories.breadcrumbs', ['location' => ['create']])

    <form method="POST" action="{{ route('quarx.blogcategories.store') }}" id="fileDetailsForm" class="add">
        {{ csrf_field() }}

        <!-- FormMaker::fromTable -->

        <div class="form-group text-right">
            <a href="{!! URL::to('quarx/blogcategories') !!}" class="btn btn-default raw-left">Cancel</a>
            <button type="submit" class="btn btn-primary" id="saveFilesBtn">Save</button>
        </div>

    </form>

@endsection
