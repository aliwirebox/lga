@extends('app.master')

@section('title', 'Dashboard')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        Saved Searches &amp; Matches
                        <span
                                class="dashboard-tip glyphicon glyphicon-question-sign"
                                aria-hidden="true"
                                data-toggle="tooltip"
                                data-placement="auto"
                                title="Saved Searches & Matches displays a list of your Saved Searches, which will continue to search the database for Matches on your behalf. New Matches, which you are yet to view, will be flagged up in the ‘Unseen’ column."
                        >
                        </span>
                    </h4>
                    <div class="m-top-20">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Search Name</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th class="text-center">Salary</th>
                                        <th>Department</th>
                                        <th class="btn-column text-center">Actions</th>
                                        <th>Unseen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($searchList as $search)
                                        <tr>
                                            <td>{{ $search->name }}</td>
                                            <td>{{ $search->hirer->getFullName() }}</td>
                                            <td>{{ $search->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $search->vacancyLocation->name }}</td>
                                            <td class="text-center">{{ $search->vacancy_salary_text }}</td>
                                            <td>{{ $search->vacancyDepartment->name }}</td>
                                            <td class="text-center"><a
                                                        href="{{ route('hirer.search.results', $search->id) }}"
                                                        class="btn btn-success btn-rounded btn-xs btn-block">View
                                                    Matches</a></td>
                                            <td class="text-center">{!! getUnviewedMatchesCount($search->unviewed_matches_count) !!} </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">You currently have 0 Saved Searches. Run
                                                and save a <a href="{{ route('hirer.search.vacancydetails') }}">New
                                                    Search</a></td>
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
                        Live Candidates
                        <span
                                class="dashboard-tip glyphicon glyphicon-question-sign"
                                aria-hidden="true"
                                data-toggle="tooltip"
                                data-placement="auto"
                                title="Live Candidates displays a list of Candidates whose CVs you have received via the site. This function helps you to track each Candidate’s progress through the hiring process."
                        >
                         </span>
                    </h4>
                    <div class="m-top-30">
                        <table class="table table-striped">
                            <tbody>
                                @forelse($liveCandidateList as $candidate)
                                    <tr>
                                        <td>
                                            <strong class="text-blue">Candidate {{ $candidate['reference'] }}</strong>
                                            <br>{{ $candidate['match_vacancy_department'] }}
                                            <br>{{ $candidate['match_vacancy_location'] }}
                                            <br>{{ $candidate['match_updated_at_ddmmyyyy'] }}
                                        </td>
                                        <td class="cursor-text">
                                            {!! $candidate['match_status_text'] !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">You currently have 0 Live Candidates</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6 m-top-30">
                    <h4>
                        CV Requests
                        <span
                                class="dashboard-tip glyphicon glyphicon-question-sign"
                                aria-hidden="true"
                                data-toggle="tooltip"
                                data-placement="auto"
                                title="CV Requests displays a list of Candidates whose CV you have requested and for which {{ config('brand.identity.domain') }} is yet to receive a response. Accepted requests will move into ‘Live Candidates’ and Declined requests will be removed from your Dashboard."
                        >
                        </span>
                    </h4>
                    <div class="m-top-30">
                        <table class="table table-striped">
                            <tbody>
                                @forelse($cvRequestedList as $candidate)
                                    <tr>
                                        <td colspan="2" class="b-b-1">
                                            <i class="brand-sprite brand-search-red"></i>
                                            <span class="text-red">{{ $candidate['match_search_name'] }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ $candidate['match_updated_at_ddmmyyyy'] }}</br>
                                            {{ $candidate['match_vacancy_location'] }}</br>
                                            {{ $candidate['match_vacancy_salary_text'] }}<br>
                                            {{ $candidate['match_vacancy_department'] }}
                                        </td>
                                        <td class="col-xs-6 cursor-text">
                                            <strong class="text-center text-blue">Candidate {{ $candidate['reference'] }}</strong><br>
                                            {!! $candidate['match_status_text'] !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">You currently have 0 CV Requests</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
