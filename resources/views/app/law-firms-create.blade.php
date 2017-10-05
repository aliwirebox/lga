@extends('app.master')

@section('title', 'Create Company')

@section('content')
    <div class="row-fluid">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        <i class="brand-sprite brand-static brand-user-blue"></i> 
                        Create Company
                    </h4>
                    <div class="well-30 m-top-20">
                        <form action="{{ route('brand-admin.law-firms.store') }}" method="post">
                            {{csrf_field()}}
                            
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group m-top-25">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button name="change-password-candidate" class="btn btn-primary btn-lg btn-block">Create</button>
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
