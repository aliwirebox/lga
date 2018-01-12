@extends('app.master')

@section('title', 'Dashboard')

@section('content')
    <div class="name-holder">
        <h1>Hi <span class="text-red">{{ $hirer->first_name }}</span></h1>
    </div>
    <div class="row-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        Your Searches &amp; Matches
                        <span
                                class="dashboard-tip glyphicon glyphicon-question-sign"
                                aria-hidden="true"
                                data-toggle="tooltip"
                                data-placement="auto"
                                title="Your recent saved searches are displayed in Your Searches &amp; Matches. Whenever candidates register that match your saved search, the Unseen column will display how many new matches there are."
                        >
                        </span>
                    </h4>
                    <div class="m-top-20">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Search</th>
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
                                            <td colspan="8" class="text-center">You currently have 0 searches. Run
                                                and save a <a href="{{ route('hirer.search.vacancydetails') }}">search</a></td>
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
                        Active Candidates
                        <span
                                class="dashboard-tip glyphicon glyphicon-question-sign"
                                aria-hidden="true"
                                data-toggle="tooltip"
                                data-placement="auto"
                                title="You will see candidates who are currently in the hiring process with you in the active candidates section. We will update their status so you are always informed."
                        >
                         </span>
                    </h4>
                    <div class="m-top-30">
                        <table class="table table-striped">
                            <tbody>
                                @forelse($liveCandidateList as $candidate)
                                    <tr>
                                        <td>
                                            <strong class="text-red">Candidate {{ $candidate['reference'] }}</strong>
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
                                        <td colspan="2" class="text-center">You currently have 0 Active Candidates</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6 m-top-30">
                    <h4>
                        CVs Requested
                        <span
                                class="dashboard-tip glyphicon glyphicon-question-sign"
                                aria-hidden="true"
                                data-toggle="tooltip"
                                data-placement="auto"
                                title="CVs that have been requested however we are yet to receive a reply for will be shown in the CVs Requested section. CVs that have been accepted will move the candidate to the Active Candidates section and declined CV requests will be removed from your dashboard."
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
                                            <strong class="text-center text-red">Candidate {{ $candidate['reference'] }}</strong><br>
                                            {!! $candidate['match_status_text'] !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">You currently have 0 CVs Requested</td>
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
