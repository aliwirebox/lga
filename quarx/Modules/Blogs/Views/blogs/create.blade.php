@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route('quarx.blogs.create') !!}">Add New</a>
        <h1 class="page-header">Blog Posts</h1>
    </div>

    @include('blogs::blogs.breadcrumbs', ['location' => ['create']])

    {!! Form::open(['route' => 'quarx.blogs.store', 'blogs' => true, 'id' => 'fileDetailsForm', 'class' => 'add']); !!}

        @include('blogs::blogs.partials.form')

        {!! FormMaker::fromTable('blogs', Quarx::moduleConfig('blogs', 'forms.blogs')) !!}

        <div class="form-group text-right">
            <a href="{!! URL::to('quarx/blogs') !!}" class="btn btn-default raw-left">Cancel</a>
            {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveFilesBtn']) !!}
        </div>

    {!! Form::close() !!}

@endsection
