@extends('app.master')

@section('title', 'Search - Vacancy Details')

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
                    <a class="btn btn-grey fs-12 btn-lg btn-padding-x-40 m-left-10 save-modal-button"
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
                        <strong>Department</strong>
                        <span class="label label-red pull-right">{{ $search->vacancyDepartment->name }}</span>
                    </li>

                    <li>
                        <strong>Location</strong>
                        <span class="label label-red pull-right">{{ $search->vacancyLocation->name }}</span>
                    </li>

                    <li>
                        <strong>Tenure</strong>
                        <span class="label label-red pull-right">{{ $search->position_permanent ? 'Permanent' : 'Contract' }}</span>
                    </li>

                    <li>
                        <strong>Travel Abroad</strong>
                        <span class="label label-red pull-right">{{ $search->travel_abroad ? 'Yes' : 'No'  }}</span>
                    </li>

                    <li>
                        <strong>Degree Required</strong>
                        <span class="label label-red pull-right">{{ $search->has_degree ? 'Yes' : 'No' }}</span>
                    </li>

                    <li>
                        <strong>LPC Required</strong>
                        <span class="label label-red pull-right">{{ $search->has_lpc ? 'Yes' : 'No'  }}</span>
                    </li>

                    <li>
                        <strong>Institute of Paralegals</strong>
                        <span class="label label-red pull-right">{{ $search->member_institute_paralegals ? 'Yes' : 'No'  }}</span>
                    </li>

                    <li>
                        <strong>CILEx</strong>
                        <span class="label label-red pull-right">{{ $search->member_of_cilex ? 'Yes' : 'No'  }}</span>
                    </li>

                    <li>
                        <strong>Minimum Experience</strong>
                        <span class="label label-red pull-right">{{ $search->years_experience }}</span>
                    </li>

                    <li>
                        <strong>Available From</strong>
                        <span class="label label-red pull-right">{{ $search->available_date->format('d/m/Y') }}</span>
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
