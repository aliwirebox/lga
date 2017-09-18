@extends('app.master')

@section('title', 'Law Firm Database')

@section('content')
    <div class="row-fluid">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Law Firms Database</h4>
                    <div class="well-20 m-top-20">
                        <div class="table-responsive ">
                            <table id="law-firms-table" class="table table-striped m-top-20 b-top">
                                <thead>
                                    <tr>
                                        <th>Name</th>
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
        var dataRoute = '{!! route('brand-admin.law-firms.data') !!}';
    </script>
    <script src="{{ elixir('js/brand-admin-law-firm-table.js') }}" type="text/javascript"></script>
@endsection
