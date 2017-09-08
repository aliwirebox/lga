@extends('app.master')

@section('title', 'Live Vacancies')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-md-12 col-lg-12">
            <div class="row-fluid">
                <div class="col-sm-12">
                    <h4><i class="brand-sprite brand-static brand-user-blue"></i> Live Vacancies</h4>
                    <div class="well-20 m-top-20">
                        <div class="table-responsive ">
                            <table id="live-vacancy-table" class="table table-striped m-top-20 b-top">
                                <thead>
                                    <tr>
                                        <th>Firm</th>
                                        <th>Location</th>
                                        <th>Department</th>
                                        <th>Salary</th>
                                        <th>Additional Info</th>
                                        <th>Last Updated</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('app.candidate.partials.additional-information-popup-modal')
@endsection

@section('js')
    @parent
    <script type="text/javascript" charset="utf-8">
        var dataRoute = '{!! route('candidate.live-vacancies.data') !!}';
    </script>
    <script src="{{ elixir('js/candidate-live-vacancies-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/additional-information-popup.js') }}" type="text/javascript"></script>
@endsection
