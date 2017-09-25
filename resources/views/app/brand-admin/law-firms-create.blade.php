@extends('app.master')

@section('title', 'Create Law Firm')

@section('content')
    <div class="row-fluid">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        <i class="brand-sprite brand-static brand-user-blue"></i> 
                        Create Law Firm
                    </h4>
                    <div class="well-30 m-top-20">
                        @include('partials.errors')
                        <form action="{{ route('brand-admin.law-firms.store') }}" method="post">
                            @include('app.brand-admin.partials.law-firms-form-fields')
                            <div class="form-group m-top-25">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button class="btn btn-primary btn-lg btn-block">Create</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
