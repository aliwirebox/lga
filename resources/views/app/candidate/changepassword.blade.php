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
                            <a data-toggle="modal" data-target="#removeModal" class="btn btn-danger btn-lg btn-padding-x-40 m-left-10">Request Account Deletion</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal alt-modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="loading collapse"></div>
                    <div class="remove-question">
                        Are you sure you want to delete your account?
                    </div>
                    <div class="remove-answer collapse">
                        We have received your request and will send you confirmation when your account has been removed.
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="remove-question">
                        <button type="button" class="btn btn-default " data-dismiss="modal">
                            Cancel
                        </button>
                        <button id="delete-account" type="button" class="btn btn-danger" id="confirm-removal-button">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            Confirm
                        </button>
                    </div>
                    <div class="remove-answer collapse">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
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
        
    </script>
    <script src="{{ elixir('js/candidate-manage-account.js') }}" type="text/javascript"></script>
@endsection
