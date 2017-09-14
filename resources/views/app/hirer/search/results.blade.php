@extends('app.master')

@section('title', 'New Search - Vacancy Details')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-md-12 col-lg-9">

            <h4>Search Results</h4>

            <div class="row">
                <div class="col-sm-12 m-top-20">
                    @include('app.hirer.search.partials.menu')
                    @include('app.hirer.partials.matches-table')
                </div>
            </div>

            <div class="pull-right edit-search-buttons m-top-20">
	            <a class="btn btn-dark-grey fs-12 btn-lg btn-padding-x-40"
                   href="{{route('hirer.search.candidatefilters.edit', $search->id)}}">Edit Search</a>
                @if(empty($search->name))
                    <a class="btn btn-primary fs-12 btn-lg btn-padding-x-40 m-left-10 save-modal-button"
                       data-id="{{$search->id}}">Save Search</a>
                @endif
            </div>
        </div>
        <div class="col-md-12 col-lg-3">
            <div class="candidate-filters">
                <strong class="text-blue fs-16">Candidate Filters</strong>
                <p>Listed in the following groups:</p>
                <hr>
                <ul class="list-unstyled">
                    <li>
                        <strong>Min UCAS Points</strong>
                        <span class="label label-red pull-right">{{ $search->min_ucas_points }}</span>
                    </li>

                    <li class="m-top-10">
                        <strong>Uni Attended</strong>
                        @if($search->universityBands->count() > 1)
                            <span class="badge label label-red pull-right items-modal"
                                  data-items="{{json_encode($search->universityBands->lists('name'))}}"
                                  data-template=".items-modal-template"
                                  data-title="Uni Attended">+{{ $search->universityBands->count() }}</span>
                        @elseif($search->universityBands->count() == 1)
                            <span class="label label-red pull-right">{{ $search->universityBands[0]->name }}</span>
                        @else
                            <span class="label label-red pull-right">Any</span>
                        @endif
                    </li>

                    <li class="m-top-10">
                        <strong>Degree Class</strong>
                        <span class="label label-red pull-right">{{ $search->min_degree_class_text }}</span>
                    </li>

                    <li class="m-top-10">
                        <strong>Training Firm</strong>
                        @if($search->trainingLawFirmBands->count() > 1)
                            <span class="badge label label-red pull-right items-modal"
                                  data-items="{{json_encode($search->trainingLawFirmBands->lists('name'))}}"
                                  data-template=".items-modal-template"
                                  data-title="Training Firm">+{{ $search->trainingLawFirmBands->count() }}</span>
                        @elseif($search->trainingLawFirmBands->count() == 1)
                            <span class="label label-red pull-right">{{ $search->trainingLawFirmBands[0]->name }}</span>
                        @else
                            <span class="label label-red pull-right">Any</span>
                        @endif
                    </li>

                    <li class="m-top-10">
                        <strong>Client Secondment</strong>
                        <span class="label label-red pull-right">{{ $search->taken_client_secondment_text }}</span>
                    </li>

                    <li class="m-top-10">
                        <strong>Training Seats</strong>
                        @if($search->trainingSeats->count() > 1)
                            <span class="badge label label-red pull-right items-modal"
                                  data-items="{{json_encode($search->trainingSeats->lists('name'))}}"
                                  data-template=".items-modal-template"
                                  data-title="Training Seats">+{{ $search->trainingSeats->count() }}</span>
                        @elseif($search->trainingSeats->count() == 1)
                            <span class="label label-red pull-right">{{ $search->trainingSeats[0]->name }}</span>
                        @else
                            <span class="label label-red pull-right">Any</span>
                        @endif
                    </li>

                    <li class="m-top-10">
                        <strong>Qualified From</strong> <span
                                class="label label-red pull-right">{{ formatSearchDate('F Y', $search->date_qualified_from) }}</span>
                    </li>

                    <li class="m-top-10">
                        <strong>Qualified to</strong> <span
                                class="label label-red pull-right">{{ formatSearchDate('F Y', $search->date_qualified_to) }}</span>
                    </li>

                    <li class="m-top-10">
                        <strong>Languages</strong>
                        @if($search->languages->count() > 1)
                            <span class="badge label label-red pull-right items-modal"
                                  data-items="{{json_encode($search->languages->lists('name'))}}"
                                  data-template=".items-modal-template"
                                  data-title="Languages">+{{ $search->languages->count() }}</span>
                        @elseif($search->languages->count() == 1)
                            <span class="label label-red pull-right">{{ $search->languages[0]->name }}</span>
                        @else
                            <span class="label label-red pull-right">Any</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="modal alt-modal save-modal" id="save_modal" tabindex="-1" role="dialog" style="display: none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="" data-dismiss="modal" class="close close-alt-modal" aria-label="Close"><i
                                class="brand-sprite"></i></a>
                    <h4 class="modal-title text-black">Name Your Search</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('hirer.search.save')}}" method="post">
                        {{csrf_field()}}
                        <input type="text" class="form-control input-lg name-input"
                               placeholder="Name your search for easy reference">
                        <span class="text-danger fs-12 pull-right"><span
                                    class="count">50</span> characters remaining</span>
                        <input type="submit" class="btn btn-block btn-success m-top-30" value="Save Search">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent

    <script type="text/javascript" charset="utf-8">
        var matchesRoute = '{!! $matchesRoute !!}';
        var requestCvRoute = '{!! $requestCvRoute !!}';
        var viewedMatchRoute = '{!! $viewedMatchRoute !!}';
    </script>
    <script src="{{ elixir('js/candidate-profile-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/hirer-matches-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/save-popup.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/items-popup.js') }}" type="text/javascript"></script>
@endsection
