@extends('app.master')

@section('title', 'Review & Go Live')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xs-12">
                    <h4 class="display-inline"><i class="brand-sprite brand-static brand-user-blue"></i> Create a Profile</h4>
                    <a href="{{ url('candidate-faqs')}}" class="pull-right"><strong>FAQs</strong></a>
                </div>
            </div>

            <div class="row">
                <form action="{{route('candidate.register.review')}}" method="post">
                    {{csrf_field()}}
                    <div class="col-sm-12 m-top-20">
                        @include('app.candidate.profile.partials.menu')
                    </div>

                    <div class="col-sm-12">
                        @include('partials.errors')

                        <div class="row">
                            <div class="col-sm-6 m-top-30">
                                <h4><i class="brand-sprite brand-static brand-user-blue"></i> Your Details</h4>
                                <div class="well-30">
                                    <span class="fs-10 text-muted">Full Name</span>
                                    <h3 class="nm fs-18">{{ $candidate->getFullName() }}</h3>
                                    <hr>
                                    <span class="fs-10 text-muted">Email Address</span>
                                    <h3 class="nm fs-18">{{ $candidate->email }}</h3>
                                    <hr>
                                    <span class="fs-10 text-muted">Mobile Number</span>
                                    <h3 class="nm fs-18">{{ formatTelephone($candidate->telephone) }}</h3>
                                    <a class="well-btn btn-dark btn btn-xs"
                                       href="{{route('candidate.register.details')}}"><strong>Edit</strong> Personal
                                        Details</a>
                                </div>
                            </div>
                            <div class="col-sm-6 m-top-30">
                                <h4><i class="brand-sprite brand-static brand-user-blue"></i> CV</h4>
                                <div class="well-30">
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
                                                <strong>{{ $candidate->cv_name }}</strong><br>
                                                <span class="fs-10 text-muted">{{ humanFilesize($candidate->cv_size) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="well-btn btn-dark btn btn-xs" href="{{route('candidate.register.cv')}}">Change
                                        CV</a>
                                </div>
                            </div>
                            <div class="col-sm-6 m-top-30">
                                <h4><i class="brand-sprite brand-static brand-user-blue"></i> Profile</h4>
                                <div class="well-30">
                                    <span class="fs-10 text-muted">UCAS Points</span>
                                    <h3 class="nm fs-18">{{ $candidate->ucas_points or "0" }} UCAS points</h3>
                                    <hr>
                                    <span class="fs-10 text-muted">University Education</span>
                                    <h3 class="nm fs-18">University of {{ $candidate->university->name }}
                                        - {{ $candidate->degree_class_text }} Class </h3>
                                    <hr>
                                    <span class="fs-10 text-muted"> Training Firm</span>
                                    <h3 class="nm fs-18">
                                        {{ $candidate->trainingLawFirm->topBand->name }}
                                    </h3>
                                    <hr>
                                    <span class="fs-10 text-muted"> Client Secondment</span>
                                    <h3 class="nm fs-18">
                                        {{ boolToText($candidate->taken_client_secondment)  }}
                                    </h3>
                                    <hr>
                                    <span class="fs-10 text-muted"> Training Seats</span>
                                    <h3 class="nm fs-18">
                                        <ul class="list-unstyled">
                                            @foreach($candidate->trainingSeats as $trainingSeat)
                                                <li class="pull-left p-5">
                                                    <span class="tab-title label label-danger p-5 parent pull-left">{{$trainingSeat->name}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="clearfix"></div>
                                    </h3>
                                    <hr>
                                    <span class="fs-10 text-muted">Date of Qualification</span>
                                    <h3 class="nm fs-18">{{ (isset($candidate->date_qualified)  ? date('F Y', strtotime($candidate->date_qualified))  : "")}}</h3>
                                    <hr>
                                    <span class="fs-10 text-muted"> Additional Languages</span>
                                    <h3 class="nm fs-18">
                                        <ul class="list-unstyled">
                                            @foreach($candidate->languages as $languages)
                                                <li class="pull-left p-5">
                                                    <span class="tab-title label label-danger p-5 parent pull-left">{{$languages->name}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="clearfix"></div>
                                    </h3>
                                    <hr>
                                    <span class="fs-10 text-muted"> Current firm</span>
                                    <h3 class="nm fs-18">
                                        {{ $candidate->currentLawFirmTopBandName }}
                                    </h3>
                                    <hr>
                                    <span class="fs-10 text-muted"> Has/did your Training Firm offer you an {{ config('brand.identity.initials')  }} position?</span>
                                    <h3 class="nm fs-18">
                                        {{ getCandidateOfferedBrandPositionByTrainingFirmText($candidate) }}
                                    </h3>
                                    <a class="well-btn btn-dark btn btn-xs"
                                       href="{{route('candidate.register.your-profile')}}">Edit Profile</a>
                                </div>
                            </div>

                            <div class="col-sm-6 m-top-30">
                                <h4><i class="brand-sprite brand-static brand-user-blue"></i> Preferences</h4>
                                <div class="well-30">
                                    <span class="fs-10 text-muted">Preferred Location</span>
                                    <h3 class="nm fs-18">
                                        <ul class="list-unstyled">
                                            @foreach($candidate->preferedLocations  as $preferedLocation)
                                                <li class="pull-left p-5">
                                                    <span class="tab-title label label-danger p-5 parent pull-left">{{$preferedLocation->name}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="clearfix"></div>
                                    </h3>
                                    <hr>
                                    <span class="fs-10 text-muted">Minimum Salary Requirement</span>
                                    <h3 class="nm fs-18">{{ $candidate->minimum_salary_text }}</h3>
                                    <hr>
                                    <span class="fs-10 text-muted">Preferred Department</span>
                                    <h3 class="nm fs-18">
                                        <ul class="list-unstyled">
                                            @foreach($candidate->preferedDepartments as $preferedDepartments)
                                                <li class="pull-left p-5">
                                                    <span class="tab-title label label-danger p-5 parent pull-left">{{$preferedDepartments->name}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="clearfix"></div>
                                    </h3>
                                    <hr>
                                    <span class="fs-10 text-muted">Preferred Type of Firm</span>
                                    <h3 class="nm fs-18">
                                        <ul class="list-unstyled">
                                            @foreach($candidate->preferedLawFirmBands()->childless()->get() as $preferedLawFirmBand)
                                                <li class="pull-left p-5">
                                                    <span 
                                                        class="tab-title label label-danger p-5 parent pull-left 
                                                            @if($preferedLawFirmBand->parent_id) label-outline @endif"
                                                    >
                                                        {{ removeTopRankedFor($preferedLawFirmBand->name) }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="clearfix"></div>
                                    </h3>
                                    <br>
                                    <a class="well-btn btn-dark btn btn-xs"
                                       href="{{route('candidate.register.preferences')}}">Edit Preferences</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-xs-12 m-top-30">
                                <h4><i class="brand-sprite brand-static brand-referral"></i> Candidate Referral</h4>
                                <div class="well-30 well-dark m-top-30 fs-13">

                                    <strong>If you have been referred to {{ config('brand.web.domain') }} by either a friend, who has previously
                                    registered with the site, or an Approved Referee, please enter their email address below.</strong>
                                    If you are successfully placed in either a contract or permanent position through {{  config('brand.identity.domain')  }},
                                    the Referee will receive up to £500 of vouchers to spend either online or in store at Harrods.
                                    <strong>For more information,</strong>
                                    <a target="_blank" href="{{ asset('pdf/Referral Scheme Terms (Final).pdf') }}"><strong>click here</strong></a>.
                                    <div class="m-top-10">
                                        <input type="text" class="form-control" name="refer">
                                    </div>
                                </div>
                                <div class="well-20 m-top-30 m-btm-30">
                                    <div class="row-fluid">
                                        <div class="col-sm-9 fs-12" style="color:#3c3c3c;font-weight:bold;">
                                            I confirm that the information above is correct, and I have read and agree to {{  config('brand.identity.legalname')  }}'s <a target="_blank" href="{{ asset('pdf/Candidate Terms & Conditions (Final).pdf') }}" style="color:#153661"><strong>Candidate Terms and Conditions</strong></a>.
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <input value="yes" class="alt-radio" type="radio" id="c1" name="terms"/>
                                            <label for="c1"><span></span>Yes</label>
                                            <input class="alt-radio" checked="checked" type="radio" id="c2" name="terms"
                                                   value="no"/>
                                            <label for="c2"><span></span>No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right m-btm-30">
                                    <a href="{{route('candidate.register.cv')}}"
                                       class="btn btn-grey fs-12 btn-lg">Previous</a>
                                    <input type="submit" class="btn btn-primary fs-12 btn-lg" value="Go Live">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
