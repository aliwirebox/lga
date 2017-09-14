@extends('app.master')

@section('title', 'Candidate Database')

@section('content')
    <div class="row-fluid">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Candidate Database</h4>
                    <div class="well-20 m-top-20">
                        <div class="table-responsive ">
                            <table id="candidates-table" class="table table-striped m-top-20 b-top">
                                <thead>
                                    <tr>
                                        <th>Candidate Ref</th>
                                        <th>Name</th>
                                        <th>Telephone</th>
                                        <th>Email</th>
                                        <th>Email Verified</th>
                                        <th>Live</th>
                                        <th>Joined</th>
                                        <th>Candidate CV</th>
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
@endsection

@section('js')
    @parent
    <script type="text/javascript" charset="utf-8">
        var dataRoute = '{!! route('brand-admin.candidates.data') !!}';
    </script>
    <script src="{{ elixir('js/brand-admin-candidate-table.js') }}" type="text/javascript"></script>
@endsection
