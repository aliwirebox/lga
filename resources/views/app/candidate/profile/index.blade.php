@extends('app.master')

@section('title', 'My Profile')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xs-12">
                    <h4>My Profile & Preferences</h4>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-6 m-top-20">
                    <h4> Personal Details</h4>
                    <div>

                        <span class="fs-10 text-muted">Full Name</span>
                        <h3 class="nm fs-18">{{$user->first_name}} {{$user->last_name}}</h3>
                        <hr>
                        <span class="fs-10 text-muted">Email Address</span>
                        <h3 class="nm fs-18">{{$user->email}}</h3>
                        <hr>
                        <span class="fs-10 text-muted">Mobile Number</span>
                        <h3 class="nm fs-18">{{ formatTelephone($user->telephone) }}</h3>
                        <a class="well-btn btn-dark btn btn-xs" href="{{route('candidate.profile.details')}}"><strong>Edit</strong>
                            Personal Details</a>
                    </div>
                </div>
                <div class="col-sm-6 m-top-20">
                    <h4> CV</h4>
                    <div>
                        <div class="row">
                            <div class="col-xs-6 text-danger fs-12">
                                Discretion is our No.1
                                priority. Your CV will
                                NOT sit online and
                                will NOT be made
                                available to any
                                employers/companies
                                without your consent
                            </div>
                            <div class="col-xs-6 b-left">
                                <div class="files m-top-60">
                                    <div class="brand-sprite brand-files"></div>
                                    <strong>{{ $user->cv_name }}</strong><br>
                                    <span class="fs-10 text-muted">{{ humanFilesize($user->cv_size) }}</span>
                                </div>
                            </div>
                        </div>
                        <a class="well-btn btn-dark btn btn-xs"
                           href="{{route('candidate.profile.cv')}}"><strong>Change</strong> CV</a>
                    </div>
                </div>
            </div>
            <h4 class="m-top-30"> Profile & Preferences</h4>
            <table id="matches-table" class="table table-striped m-top-20 b-top dataTable no-footer">
                <tr class="active">
                    <td colspan="5">
                        <table class="table">
                            <tbody>
                                <tr class="cv-row">
                                    <td colspan="5">
                                        <div class="p-top-0">
                                            <span class="fs-16">Profile</span>
                                            <hr class="m-top-10">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <ul class="list-unstyled">
                                                        <li class="m-top-5">
                                                            <span class="text-green fs-12">Degree Class</span><br>
                                                            <strong>{{ $user->degree_class_text }}</strong>
                                                        </li>
                                                        <li class="m-top-5">
                                                            <span class="text-green fs-12">Do you have an LPC</span><br>
                                                            <strong>{{ $user->has_lpc ? 'Yes' : 'No' }}</strong>
                                                        </li>
                                                        <li class="m-top-5">
                                                            <span class="text-green fs-12">Right To Work In The UK</span><br>
                                                            <strong>{{ $user->has_rtw ? 'Yes' : 'No' }}</strong>
                                                        </li> 
                                                        <li class="m-top-5">
                                                            <span class="text-green fs-12">Member of the Institute of Paralegals</span><br>
                                                            <strong>{{ $user->member_institute_paralegals ? 'Yes' : 'No' }}</strong>
                                                        </li>
                                                         <li class="m-top-5">
                                                            <span class="text-green fs-12">Member of CILEx</span><br>
                                                            <strong>{{ $user->member_of_cilex ? 'Yes' : 'No' }}</strong>
                                                        </li>
                                                         <li class="m-top-5">
                                                            <span class="text-green fs-12">Years of Experience</span><br>
                                                            <strong>{{ $user->years_experience }}</strong>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <ul class="list-unstyled">                                                        
                                                         <li class="m-top-5">
                                                            <span class="text-green fs-12">Top Skills</span><br>
                                                            <strong>
                                                                @if(count($user->trainingSeats) > 0)
                                                                    @foreach($user->trainingSeats as $key => $trainingSeat)
                                                                        @if($key > 1)
                                                                            <span class="badge badge-black items-modal"
                                                                                  data-items="{{json_encode($user->trainingSeats->lists('name'))}}"
                                                                                  data-title="Current Skills"
                                                                                  data-template=".items-modal-template"
                                                                            >+{{count($user->trainingSeats) - $key}}</span>
                                                                            @break
                                                                        @else
                                                                            {{outputLabelText($trainingSeat->name, count($user->$trainingSeat), $key)}}
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </strong><br>
                                                        </li>
                                                        <li class="m-top-5">
                                                            <span class="text-green fs-12">Current Company</span><br>
                                                            <strong>{{$user->currentLawFirmTopBandName}}</strong>
                                                        </li>
                                                        <li class="m-top-5">
                                                            <span class="text-green fs-12">Additional Languages</span><br>
                                                            <strong>
                                                                @if(count($user->languages) > 0)
                                                                    @foreach($user->languages as $key => $language)
                                                                        @if($key > 1)
                                                                            <span class="badge badge-black items-modal"
                                                                                  data-items="{{json_encode($user->languages->lists('name'))}}"
                                                                                  data-template=".items-modal-template"
                                                                                  data-title="Languages">+{{count($user->languages) - $key}}</span>
                                                                            @break
                                                                        @else
                                                                            {{outputLabelText($language->name, count($user->languages), $key)}}
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </strong>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <a class="well-btn btn-light btn btn-xs"
                                               href="{{route('candidate.profile.your-profile')}}"><strong>Edit</strong>
                                                Profile</a>


                                            <div class="m-top-60">
                                                <span class="fs-16">Preferences</span>
                                            </div>
                                            <hr class="m-top-10">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <span class="text-green fs-12">Preferred Department(s)</span><br>
                                                            <strong>
                                                                @if(count($user->preferedDepartments) > 0)
                                                                    @foreach($user->preferedDepartments as $key => $preferredDepartments)
                                                                        @if($key > 1)
                                                                            <span class="badge badge-black items-modal"
                                                                                  data-title="Preferred Department(s)"
                                                                                  data-template=".items-modal-template"
                                                                                  data-items="{{json_encode($user->preferedDepartments->lists('name'))}}">+{{count($user->preferedDepartments) - $key}}</span>
                                                                            @break
                                                                        @else
                                                                            {{outputLabelText($preferredDepartments->name, count($user->preferedDepartments), $key)}}
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </strong>
                                                        </li>
                                                        <li>
                                                            <span class="text-green fs-12">Location(s)</span><br>
                                                            <strong>
                                                                @if(count($user->preferedLocations) > 0)
                                                                    @foreach($user->preferedLocations as $key => $preferredLocations)
                                                                        @if($key > 1)
                                                                            <span class="badge badge-black items-modal"
                                                                                  data-title="Location(s)"
                                                                                  data-template=".items-modal-template"
                                                                                  data-items="{{json_encode($user->preferedLocations->lists('name'))}}">+{{count($user->preferedLocations) - $key}}</span>
                                                                            @break
                                                                        @else
                                                                            {{outputLabelText($preferredLocations->name, count($user->preferedLocations), $key)}}
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </strong>
                                                        </li>
                                                        <li>
                                                            <span class="text-green fs-12">Preferred Salary</span><br>
                                                            <strong>{{ $user->minimum_salary_text }}</strong><br>
                                                        </li>
                                                        <li>
                                                            <span class="text-green fs-12">Companies you do not want to be matched with</span><br>
                                                            <div>
                                                                <strong>
                                                                    @foreach($blacklistedLawFirms as $key => $blacklistedLawFirm)
                                                                        @if($key > 1)
                                                                            <span class="badge badge-black items-modal"
                                                                                  data-title="Blacklisted Companies"
                                                                                  data-template=".items-modal-template"
                                                                                  data-items="{{json_encode($blacklistedLawFirms->lists('name'))}}">
                                                                                +{{count($blacklistedLawFirms) - $key}}
                                                                            </span>
                                                                            @break
                                                                        @else
                                                                            {{ outputLabelText($blacklistedLawFirm->name, count($blacklistedLawFirms), $key) }}
                                                                        @endif
                                                                    @endforeach
                                                                </strong>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <span class="text-green fs-12">When will you be available</span><br>
                                                            <strong>{{ $user->available_date_formatted }}</strong><br>
                                                        </li>
                                                        <li>
                                                            <span class="text-green fs-12">Willing to travel abroad</span><br>
                                                            <strong>{{ $user->travel_abroad ? 'Yes' : 'No'  }}</strong><br>
                                                        </li>
                                                        <li>
                                                            <label>Would you accept a permanent or a contract role:</label>
                                                            <span class="text-green fs-12">Seeking permanent positions</span><br>
                                                            <strong>{{ $user->seeking_permanent ? 'Yes' : 'No'  }}</strong><br>
                                                        </li> 
                                                        <li>
                                                            <span class="text-green fs-12">Seeking contract positions</span><br>
                                                            <strong>{{ $user->seeking_contract ? 'Yes' : 'No'  }}</strong><br>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a class="well-btn btn-light btn btn-xs"
                                               href="{{route('candidate.profile.preferences')}}"><strong>Edit</strong>
                                                Preferences</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @include('app.candidate.partials.items-popup-modal')
@endsection


@section('js')
    @parent

    <script src="{{ elixir('js/items-popup.js') }}" type="text/javascript"></script>
@endsection
