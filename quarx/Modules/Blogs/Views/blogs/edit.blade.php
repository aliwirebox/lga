@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route('quarx.blogs.create') !!}">Add New</a>
        <a class="btn btn-warning pull-right raw-margin-right-8" href="{!! URL::to('quarx/rollback/blogs/'.$blog->id) !!}">Rollback</a>
        <h1 class="page-header">Blog Posts</h1>
    </div>

    @include('blogs::blogs.breadcrumbs', ['location' => ['edit']])

    <form method="POST" action="{{ route('quarx.blogs.update', $blog->id) }}" class="edit">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PATCH">

        @include('blogs::blogs.partials.form')

        <!-- FormMaker::fromObject -->

        <div class="form-group text-right">
            <a href="{!! URL::to('quarx/blogs') !!}" class="btn btn-default raw-left">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>

@endsection

