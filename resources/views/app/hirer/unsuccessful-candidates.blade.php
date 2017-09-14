@extends('app.master')

@section('title', 'Hirer - Unsuccessful Candidates')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        <i class="brand-sprite brand-static brand-user-blue"></i> 
                        Unsuccessful Candidates
                    </h4>
                    <div class="well-20 m-top-30">
                        <div class="table-responsive ">
                            <table id="candidates-table" class="table table-striped m-top-20 b-top">
                                <thead>
                                    <tr>
                                        <th>Candidate Ref</th>
                                        <th>Candidate Name</th>
                                        <th>Search Name</th>
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
        var dataRoute = '{!! route('hirer.unsuccessful-candidates.data') !!}';
    </script>
    <script src="{{ elixir('js/items-popup.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/candidate-profile-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/hirer-unsuccessful-candidate-table.js') }}" type="text/javascript"></script>
@endsection
