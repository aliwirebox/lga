@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route('quarx.blogcategories.create') !!}">Add New</a>
        <h1 class="page-header">Blog Categories</h1>
    </div>

    @include('blogcategories::blogcategories.breadcrumbs', ['location' => ['create']])

    {!! Form::open(['route' => 'quarx.blogcategories.store', 'blogcategories' => true, 'id' => 'fileDetailsForm', 'class' => 'add']) !!}

        {!! FormMaker::fromTable('blog_categories', Quarx::moduleConfig('blogcategories', 'forms.blogcategories')) !!}

        <div class="form-group text-right">
            <a href="{!! URL::to('quarx/blogcategories') !!}" class="btn btn-default raw-left">Cancel</a>
            {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveFilesBtn']) !!}
        </div>

    {!! Form::close() !!}

@endsection
