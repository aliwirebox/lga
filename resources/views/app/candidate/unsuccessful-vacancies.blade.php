@extends('app.master')

@section('title', 'Unsuccessful Jobs')

@section('content')
    <div class="row-fluid">
        <div class="col-md-12 col-lg-12">
            <div class="row-fluid">
                <div class="col-sm-12">
                    <h4>Unsuccessful Jobs</h4>
                    <div class="m-top-20">
                        <div class="table-responsive ">
                            <table id="unsuccessful-vacancy-table" class="table table-striped m-top-20 b-top">
                                <thead>
                                    <tr>
                                        <th>Salary</th>
                                        <th>Location</th>
                                        <th>Company</th>
                                        <th>Department</th>
                                        <th>Notes</th>
                                        <th></th>
                                        <th>Last Updated</th>
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
        var dataRoute = '{!! route('candidate.unsuccessful-vacancies.data') !!}';
    </script>
    <script src="{{ elixir('js/candidate-unsuccessful-vacancies-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/additional-information-popup.js') }}" type="text/javascript"></script>
@endsection
