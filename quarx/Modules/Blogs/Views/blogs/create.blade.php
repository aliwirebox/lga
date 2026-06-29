@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route('quarx.blogs.create') !!}">Add New</a>
        <h1 class="page-header">Blog Posts</h1>
    </div>

    @include('blogs::blogs.breadcrumbs', ['location' => ['create']])

    <form method="POST" action="{{ route('quarx.blogs.store') }}" id="fileDetailsForm" class="add">
        {{ csrf_field() }}

        @include('blogs::blogs.partials.form')

        <!-- FormMaker::fromTable -->

        <div class="form-group text-right">
            <a href="{!! URL::to('quarx/blogs') !!}" class="btn btn-default raw-left">Cancel</a>
            <button type="submit" class="btn btn-primary" id="saveFilesBtn">Save</button>
        </div>

    </form>

@endsection
