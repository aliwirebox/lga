@extends('app.master')

@section('title', 'Hirer - Live Candidates')

@section('content')
    <div class="row-fluid">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        Live Candidates
                    </h4>
                    <div class="well-20 m-top-30">
                        <div class="table-responsive ">
                            <table id="candidates-table" class="table table-striped m-top-20 b-top">
                                <thead>
                                    <tr>
                                        <th>Candidate No</th>
                                        <th>Candidate Name</th>
                                        <th>Search</th>
                                        <th>User</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Last Updated</th>
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
    @include('app.candidate.partials.items-popup-modal')
    <script id="profile-template" type="text/x-handlebars-template">
        @include('app.hirer.partials.profile-popup')
    </script>
@endsection

@section('js')
    @parent
    <script type="text/javascript" charset="utf-8">
        var dataRoute = '{!! route('hirer.live-candidates.data') !!}';
    </script>
    <script src="{{ elixir('js/items-popup.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/candidate-profile-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/hirer-live-candidate-table.js') }}" type="text/javascript"></script>
@endsection
