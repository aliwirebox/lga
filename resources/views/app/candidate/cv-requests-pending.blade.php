@extends('app.master')

@section('title', 'CV Requests Pending')

@section('content')
    <div class="row-fluid">
        <div class="col-md-12 col-lg-12">
            <div class="row-fluid">
                <div class="col-sm-12">
                    <h4>CV Requests Pending</h4>
                    <div class="m-top-20">
                        <div class="table-responsive ">
                            <table id="cv-requests-pending-table" class="table table-striped m-top-20 b-top">
                                 <thead>
                                    <tr>
                                        <th>Firm</th>
                                        <th>Location</th>
                                        <th>Department</th>
                                        <th>Salary</th>
                                        <th>Additional Info</th>
                                        <th>Date Requested</th>
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
        <strong>You Have A CV Request</strong>
        <a data-status="{{ config('match.cv-pending') }}" class="cv-request-buttons btn btn-success btn-rounded btn-xs btn-block">Accept</a>
        <a data-status="{{ config('match.cv-rejected') }}" class="cv-request-buttons btn btn-danger btn-rounded btn-xs btn-block">Decline</a>
        <span style="display:none" class="loading loading-white"></span>
        <a style="display:none" class="error-button btn btn-danger btn-rounded btn-xs btn-block">Error</a>
    </div>
    @include('app.candidate.partials.additional-information-popup-modal')
@endsection

@section('js')
    @parent
    <script type="text/javascript" charset="utf-8">
        var dataRoute = '{!! route('candidate.cv-requests-pending.data') !!}';
    </script>
    <script src="{{ elixir('js/candidate-profile-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/candidate-cv-requests-pending-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/additional-information-popup.js') }}" type="text/javascript"></script>
@endsection
