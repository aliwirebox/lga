@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route('quarx.blogcategories.create') !!}">Add New</a>
        <a class="btn btn-warning pull-right raw-margin-right-8" href="{!! URL::to('quarx/rollback/blogcategories/'.$blogcategory->id) !!}">Rollback</a>
        <h1 class="page-header">Blog Categories</h1>
    </div>

    @include('blogcategories::blogcategories.breadcrumbs', ['location' => ['edit']])

    {!! Form::model($blogcategory, ['route' => ['quarx.blogcategories.update', $blogcategory->id], 'method' => 'patch', 'class' => 'edit']) !!}

        {!! FormMaker::fromObject($blogcategory, Quarx::moduleConfig('blogcategories', 'forms.blogcategories')) !!}

        <div class="form-group text-right">
            <a href="{!! URL::to('quarx/blogcategories') !!}" class="btn btn-default raw-left">Cancel</a>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

@endsection


