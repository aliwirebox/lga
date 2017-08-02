@extends('app.master')

@section('title', 'Dashboard')

@section('content')
     <div class="row-fluid m-top-100">
         <div class="col-lg-12">
             <div class="row">
                 <div class="col-sm-12">
                     <h4><i class="nq-sprite nq-static nq-user-blue"></i> Live Candidates</h4>
                     <div class="well-30 m-top-20">
                         <div class="table-responsive">
                             <table class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th>Candidate Ref</th>
                                         <th>Name</th>
                                         <th>Law Firm</th>
                                         <th>User Name</th>
                                         <th>Location</th>
                                         <th>Department</th>
                                         <th class="text-center">Salary</th>
                                         <th class="text-center">Status</th>
                                         <th>Last Updated</th>
                                         <th></th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @forelse($liveCandidateList as $liveCandidate)
                                         <tr>
                                             <td>{{ $liveCandidate['reference'] }}</td>
                                             <td>{{ $liveCandidate['full_name'] }}</td>
                                             <td>{{ $liveCandidate['match_hirer_law_firm_name'] }}</td>
                                             <td>{{ $liveCandidate['match_hirer_name'] }}</td>
                                             <td>{{ $liveCandidate['match_vacancy_location'] }}</td>
                                             <td>{{ $liveCandidate['match_vacancy_department'] }}</td>
                                             <td class="text-center">{{ $liveCandidate['match_vacancy_salary_text'] }}</td>
                                             <td class="text-center">{!! $liveCandidate['match_status_text'] !!}</td>
                                             <td>{{ $liveCandidate['match_updated_at_ddmmyyyy'] }}</td>
                                         </tr>
                                     @empty
                                         <tr>
                                             <td colspan="10" class="text-center">Currently there are 0 live candidates</td>
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
                     <h4><i class="nq-sprite nq-static nq-cv-blue"></i> CVs Processing</h4>
                     <div class="well-30 well-20 m-top-30">
                         <table class="table table-striped">
                             <tbody>
                                 @forelse($cvProcessingList as $candidate)
                                     <tr>
                                         <td>
                                             <strong class="text-blue">Candidate {{ $candidate['reference'] }}</strong>
                                             <br>{{ $candidate['full_name'] }}
                                             <br><strong class="text-blue">{{ $candidate['match_hirer_law_firm_name'] }}</strong>
                                             <br>{{ $candidate['match_hirer_name'] }}
                                             <br>{!! $candidate['match_hirer_email'] !!}
                                         </td>
                                         <td>
                                             <div class="processing"> 
                                                 <a data-candidate-id="{{ $candidate['id'] }}" data-endpoint="{{ $candidate['match_search_endpoint'] }}" data-status="{{ config('match.cv-sent') }}" data-answer=".accepted-button" class="cv-request-buttons btn btn-warning btn-rounded btn-xs btn-block">CV Sent</a>
                                                 <span style="display:none" class="loading"></span>
                                                 <a style="display:none" class="accepted-button btn btn-warning btn-rounded btn-xs btn-block">Moved to Live Candidates</a>
                                                 <a style="display:none" class="error-button btn btn-danger btn-rounded btn-xs btn-block">Error</a>
                                             </div>
                                         </td>
                                     </tr>
                                 @empty
                                     <tr>
                                         <td colspan="2" class="text-center">Currently there are 0 CV's to process.</td>
                                     </tr>
                                 @endforelse
                             </tbody>
                         </table>
                     </div>
                 </div>
                 <div class="col-sm-6 m-top-30">
                     <h4><i class="nq-sprite nq-static nq-user-blue"></i> CV Requests Pending</h4>
                     <div class="well-30 well-20 m-top-30">
                         <table class="table table-striped">
                             <tbody>
                                 @forelse($cvRequestList as $candidate)
                                     <tr>
                                         <td colspan="2" class="b-b-1">
                                             <i class="nq-sprite nq-search-red"></i> 
                                             <span class="text-red">{{ $candidate['match_search_name'] }}</span>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>
                                             {{ $candidate['match_hirer_law_firm_name'] }}<br>
                                             {{ $candidate['match_updated_at_ddmmyyyy'] }}</br>
                                             {{ $candidate['match_vacancy_location'] }}<br>
                                             {{ $candidate['match_vacancy_salary_text'] }}<br>
                                             {{ $candidate['match_vacancy_department'] }}
                                         </td>
                                         <td class="col-xs-6">
                                             <strong class="text-center text-blue">Candidate {{ $candidate['reference'] }}</strong><br>
                                             <strong class="text-center text-blue">{{ $candidate['full_name'] }}</strong>
                                             <div class="processing"> 
                                                <a data-candidate-id="{{ $candidate['id'] }}" data-endpoint="{{ $candidate['match_search_endpoint'] }}" data-status="{{ config('match.cv-pending') }}" data-answer=".accepted-button" class="cv-request-buttons btn btn-success btn-rounded btn-xs btn-block">Accept</a>
                                                <a data-candidate-id="{{ $candidate['id'] }}" data-endpoint="{{ $candidate['match_search_endpoint'] }}" data-status="{{ config('match.cv-rejected') }}" data-answer=".declined-button" class="cv-request-buttons btn btn-danger btn-rounded btn-xs btn-block">Decline</a>
                                                <span style="display:none" class="loading"></span>
                                                <a style="display:none" class="accepted-button btn btn-success btn-rounded btn-xs btn-block">Accepted</a>
                                                <a style="display:none" class="declined-button btn btn-danger btn-rounded btn-xs btn-block">Declined</a>
                                                <a style="display:none" class="error-button btn btn-danger btn-rounded btn-xs btn-block">Error</a>
                                             </div>
                                         </td>
                                     </tr>
                                 @empty
                                     <tr>
                                         <td colspan="2" class="text-center">Currently there are 0 CV requests</td>
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

@section('js')
    @parent

    <script src="{{ elixir('js/nq-admin-dashboard.js') }}" type="text/javascript"></script>
@endsection
