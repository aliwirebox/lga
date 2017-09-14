@extends('app.master')

@section('title', 'Dashboard')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        Live Vacancies 
                        <span 
                            class="dashboard-tip glyphicon glyphicon-question-sign" 
                            aria-hidden="true" 
                            data-toggle="tooltip" 
                            data-placement="auto" 
                            title="Live Vacancies displays a list of vacancies for which your CV has been sent and helps you to track your progress through the hiring process."
                        >
                        </span>
                    </h4>
                    <div class="m-top-20">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Firm</th>
                                        <th>Location</th>
                                        <th>Department</th>
                                        <th class="text-center">Salary</th>
                                        <th class="text-center">Additional Info</th>
                                        <th>Last Updated</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($liveVacancyList as $liveCandidate)
                                        <tr>
                                            <td>{{ $liveCandidate['match_hirer_law_firm_name'] }}</td>
                                            <td>{{ $liveCandidate['match_vacancy_location'] }}</td>
                                            <td>{{ $liveCandidate['match_vacancy_department'] }}</td>
                                            <td class="text-center">{{ $liveCandidate['match_vacancy_salary_text'] }}</td>
                                            <td class="text-center">{!! $liveCandidate['match_vacancy_additional_information_button'] !!}</td>
                                            <td>{{ $liveCandidate['match_updated_at_human'] }}</td>
                                            <td class="text-center cursor-text">{!! $liveCandidate['match_status_text'] !!}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">You currently have 0 Live Vacancies
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 m-top-30">
                    <h4>
                        CV Requests Pending
                        <span 
                            class="dashboard-tip glyphicon glyphicon-question-sign" 
                            aria-hidden="true" 
                            data-toggle="tooltip" 
                            data-placement="auto" 
                            title="CV Requests Pending displays a list of requests for your CV for which {{ config('brand.identity.domain') }} is yet to receive a response. Accepted requests will move into ‘Live Vacancies’ and Declined requests will be removed from your Dashboard."
                        >
                        </span>
                    </h4>
                    <div class="well-30 well-20 m-top-30">
                        <table class="table table-striped">
                            <tbody>
                                @forelse($cvPendingList as $cvCandidate)
                                    <tr>
                                        <td>
                                            <strong>{{ $cvCandidate['match_hirer_law_firm_name'] }}</strong>
                                            <br>{{ $cvCandidate['match_vacancy_location'] }}
                                            <br>{{ $cvCandidate['match_vacancy_department'] }}
                                            <br>{{ $cvCandidate['match_vacancy_salary_text'] }}
                                            <br>{{ $cvCandidate['match_updated_at_ddmmyyyy'] }}
                                        </td>
                                        <td>
                                            <div class="processing">
                                                <a data-endpoint="{{ $cvCandidate['match_search_endpoint'] }}"
                                                   data-status="{{ config('match.cv-pending') }}"
                                                   data-answer=".accepted-button"
                                                   class="cv-request-buttons btn btn-success btn-rounded btn-xs btn-block">Accept</a>
                                                <a data-endpoint="{{ $cvCandidate['match_search_endpoint'] }}"
                                                   data-status="{{ config('match.cv-rejected') }}"
                                                   data-answer=".declined-button"
                                                   class="cv-request-buttons btn btn-danger btn-rounded btn-xs btn-block">Decline</a>
                                                <span style="display:none" class="loading"></span>
                                                <span class="cursor-text">
                                                    <a style="display:none"
                                                       class="accepted-button btn btn-success btn-rounded btn-xs btn-block">Accepted</a>
                                                    <a style="display:none"
                                                       class="declined-button btn btn-danger btn-rounded btn-xs btn-block">Declined</a>
                                                    <a style="display:none"
                                                       class="error-button btn btn-danger btn-rounded btn-xs btn-block">Error</a>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">You currently have 0 CV Requests Pending
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6 m-top-30">
                    <h4>
                        Your Preferences
                        <span 
                            class="dashboard-tip glyphicon glyphicon-question-sign" 
                            aria-hidden="true" 
                            data-toggle="tooltip" 
                            data-placement="auto" 
                            title="You can edit your work Preferences at any time. If you are not experiencing many CV Requests, then you may wish to broaden your Preferences. Conversely, if you are receiving too many CV Requests for roles that you are not interested in, then you may wish to narrow your Preferences."
                        >
                        </span>
                    </h4>
                    <div class="well-30 well-20 m-top-30">
                        <a href="{{ route('candidate.profile.preferences') }}"
                           class="btn btn-dark btn-rounded btn-xs pull-right btn-pad-20">Edit</a>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="fs-10 text-muted">Preferred Location</span>
                                        <h3 class="nm fs-18">
                                            @if(count($candidate->preferedLocations) > 0)
                                                @foreach($candidate->preferedLocations as $key => $preferedLocations)
                                                    @if($key > 1)
                                                        <span class="badge badge-black items-modal"
                                                              data-title="Preferred Department"
                                                              data-template=".items-modal-template"
                                                              data-items="{{json_encode($candidate->preferedLocations->lists('name'))}}">+{{count($candidate->preferedLocations) - $key}}</span>
                                                        @break
                                                    @else
                                                        {{$preferedLocations->name}}{{count($candidate->preferedLocations) > $key ? ', ' : '' }}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fs-10 text-muted">Preferred Salary</span>
                                        <h3 class="nm fs-18">{{ $candidate->minimum_salary_text }}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fs-10 text-muted">Preferred Department</span>
                                        <h3 class="nm fs-18">
                                            @if(count($candidate->preferedDepartments) > 0)
                                                @foreach($candidate->preferedDepartments as $key => $preferedDepartments)
                                                    @if($key > 1)
                                                        <span class="badge badge-black items-modal"
                                                              data-title="Preferred Department"
                                                              data-template=".items-modal-template"
                                                              data-items="{{json_encode($candidate->preferedDepartments->lists('name'))}}">+{{count($candidate->preferedDepartments) - $key}}</span>
                                                        @break
                                                    @else
                                                        {{$preferedDepartments->name}}{{count($candidate->preferedDepartments) > $key ? ', ' : '' }}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fs-10 text-muted">Preferred Type of Firm</span>
                                        <h3 class="nm fs-18">
                                            @foreach($preferedLawFirmBandList as $key => $preferredLawFirmBand)
                                                @if($key > 1)
                                                    <span class="badge badge-black items-modal"
                                                          data-title="Preferred Type of Firm"
                                                          data-template=".items-modal-template"
                                                          data-items="{{json_encode($preferedLawFirmBandList->lists('name'))}}">
                                                        +{{count($preferedLawFirmBandList) - $key}}
                                                    </span>
                                                    @break
                                                @else
                                                    {{$preferredLawFirmBand->name}}{{count($preferedLawFirmBandList) > $key ? ', ' : '' }}
                                                @endif
                                            @endforeach
                                        </h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="introduction-modal" tabindex="1" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Welcome to your {{ config('brand.web.domain') }} dashboard!</h4>
            </div>
            <div class="modal-body">
                <ol>
                    <li>Open and close the left menu by clicking this button.</li>
                    <li>Live vacancies displays a list of vacancies for which your CV has been sent and helps you to track your progress through the hiring process.</li>
                    <li>CV Requests pending displays a list of requests for your CV for which we are yet to receive a response. Accepted requests will move into 'Live Vacancies' and Declined requests will be removed from your Dashboard.</li>
                    <li>You can edit your Preferences any time by clicking on the Edit button below or within My Profile &amp; Preferences. If you are not experiencing many CV Requests, then you may wish to broaden your Preferences. Conversely, if you are experiencing CV Requests for roles that you are not interested in, then you may wish to narrow your Preferences.</li> 
                </ol>  
            </div>
            <a href="#" data-dismiss="introduction-modal" class="close" aria-label="Close"></a>
            <a href="#" class="information">?</a>
        </div>
        <ul class="walkthrough">
            <li class="one">1</li>
            <li class="two">2</li>
            <li class="three">3</li>
            <li class="four">4</li>
        </ul> 
    </div>

    @include('app.candidate.partials.items-popup-modal')
    @include('app.candidate.partials.additional-information-popup-modal')
@endsection

@section('js')
    @parent
    <script src="{{ elixir('js/items-popup.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/candidate-cv-request-buttons.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/additional-information-popup.js') }}" type="text/javascript"></script>
@endsection
