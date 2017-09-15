@extends('app.master')

@section('title', 'Candidate Change Password')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-12">
            <h4>Change Password</h4>
            <div class="row">
                <div class="col-sm-8">
                    <div class="m-top-20">
                        @if(session('changed'))
                            <div class="alert alert-success">
                                Your password has been successfully changed
                            </div>
                        @else
                            @include('partials.errors')
                            @include('partials.changepassword-form')
                        @endif
                    </div>
                </div>
            </div>
            <div class="row m-top-50">
                <div class="col-sm-12">
                    <h4><i class="brand-sprite brand-static brand-user-blue"></i> Delete Account</h4>
                    <div class="well-30 m-top-20">
                        <p>
                            If you no longer require our services please 
                            <a id="delete-account" class="btn btn-danger fs-12 btn-lg btn-padding-x-40 m-left-10">Request Account Deletion</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script type="text/javascript" charset="utf-8">
        var route = '{!! route('candidate.delete.request') !!}';

        $(document).ready(function(){
            $('#delete-account').click(function (e) {
                if(confirm("Are you sure you want to delete your account")) {
                    $.ajax({
                        method: 'POST',
                        url: route
                    }).complete(function(){
                        alert('thanks');
                    });
                }
            });
        });
    </script>
@endsection
