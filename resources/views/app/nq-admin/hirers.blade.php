@extends('app.master')

@section('title', 'Hirer Database')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4><i class="nq-sprite nq-static nq-user-blue"></i> Hirer Database</h4>
                    <div class="well-20 m-top-20">
                        <div class="table-responsive ">
                            <table id="hirers-table" class="table table-striped m-top-20 b-top">
                                <thead>
                                    <tr>
                                        <th>Law Firm</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th>Email Verified</th>
                                        <th>Law Firm</th>
                                        <th>Joined</th>
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
@endsection

@section('js')
    @parent
    <script type="text/javascript" charset="utf-8">
        var dataRoute = '{!! route('nq-admin.hirers.data') !!}';
    </script>
    <script src="{{ elixir('js/nq-admin-hirer-table.js') }}" type="text/javascript"></script>
@endsection

