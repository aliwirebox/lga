@extends('app.master')

@section('title', 'Your Searches & Matches')

@section('content')
    <div class="row-fluid">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Your Searches & Matches</h4>
                    <div class="well-20 m-top-20">
                        <div class="table-responsive">
                            <table id="saved-searches-table" class="table table-striped m-top-20 b-top">
                                <thead>
                                    <tr>
                                        <th>Search</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Salary</th>
                                        <th>Department</th>
                                        <th class="btn-column">Actions</th>
                                        <th>Unseen</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script type="text/javascript" charset="utf-8">
        var savedSearchesRoute = '{!! route('hirer.search.savedsearches.data') !!}';
        var newSearchRoute = '{!! route('hirer.search.vacancydetails') !!}';
    </script>
    <script src="{{ elixir('js/hirer-searches-table.js') }}" type="text/javascript"></script>
@endsection
