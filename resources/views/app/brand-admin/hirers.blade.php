@extends('app.master')

@section('title', 'Employer Database')

@section('content')
    <div class="row-fluid">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Employer Database</h4>
                    <div class="m-top-20">
                        <div class="table-responsive ">
                            <table id="hirers-table" class="table table-striped m-top-20 b-top">
                                <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th>Email Verified</th>
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
        var dataRoute = '{!! route('brand-admin.hirers.data') !!}';
    </script>
    <script src="{{ elixir('js/brand-admin-hirer-table.js') }}" type="text/javascript"></script>
@endsection

