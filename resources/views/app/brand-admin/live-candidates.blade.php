@extends('app.master')

@section('title', 'Acitive Candidates')

@section('content')
    <div class="row-fluid">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Acitive Candidates</h4>
                    <div class="well-20 m-top-20">
                        <div class="table-responsive ">
                            <table id="live-candidate-table" class="table table-striped m-top-20 b-top">
                                <thead>
                                    <tr>
                                        <th>Candidate No</th>
                                        <th>Name</th>
                                        <th>Company</th>
                                        <th>Employer Name</th>
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
    <div class="brand-popover" style="display:none">
        <strong>Update Match</strong>
        @foreach($statusOptions as $key)
            {!! getMatchUpdateButton($key) !!}
        @endforeach
        <span style="display:none" class="loading loading-white"></span>
        <a style="display:none" class="error-button btn btn-danger btn-rounded btn-xs btn-block">Error</a>
    </div>
    @include('app.candidate.partials.items-popup-modal')
    <script id="profile-template" type="text/x-handlebars-template">
        @include('app.brand-admin.partials.profile-popup')
    </script>
@endsection

@section('js')
    @parent
    <script type="text/javascript" charset="utf-8">
        var dataRoute = '{!! route('brand-admin.live-candidates.data') !!}';
    </script>
    <script src="{{ elixir('js/items-popup.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/candidate-profile-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/brand-admin-live-candidate-table.js') }}" type="text/javascript"></script>
@endsection
