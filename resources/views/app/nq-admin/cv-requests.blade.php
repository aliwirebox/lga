@extends('app.master')

@section('title', 'CV Requests Pending')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4><i class="nq-sprite nq-static nq-user-blue"></i> CV Requests Pending</h4>
                    <div class="well-20 m-top-20">
                        <div class="table-responsive ">
                            <table id="cv-request-table" class="table table-striped m-top-20 b-top">
                                <thead>
                                    <tr>
                                        <th>Candidate Ref</th>
                                        <th>Name</th>
                                        <th>Telephone</th>
                                        <th>Email</th>
                                        <th>Law Firm</th>
                                        <th>Hirer Name</th>
                                        <th>Location</th>
                                        <th>Department</th>
                                        <th>Last Updated</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nq-popover" style="display:none">
        <strong>Update Match</strong>
        <a data-status="{{ config('match.cv-pending') }}" class="cv-request-buttons btn btn-success btn-rounded btn-xs btn-block">Accept</a>
        <a data-status="{{ config('match.cv-rejected') }}" class="cv-request-buttons btn btn-danger btn-rounded btn-xs btn-block">Decline</a>
        <span style="display:none" class="loading loading-white"></span>
        <a style="display:none" class="error-button btn btn-danger btn-rounded btn-xs btn-block">Error</a>
    </div>
    @include('app.candidate.partials.items-popup-modal')
    <script id="profile-template" type="text/x-handlebars-template">
        @include('app.nq-admin.partials.profile-popup')
    </script>
@endsection

@section('js')
    @parent
    <script type="text/javascript" charset="utf-8">
        var dataRoute = '{!! route('nq-admin.cv-requests.data') !!}';
    </script>
    <script src="{{ elixir('js/items-popup.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/candidate-profile-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/nq-admin-cv-request-table.js') }}" type="text/javascript"></script>
@endsection
