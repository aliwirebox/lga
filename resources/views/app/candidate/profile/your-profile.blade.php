@extends('app.master')

@section('css')
    @parent

    <link href="{{asset('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
@stop


@section('title', 'Your Profile')

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
                <div class="col-sm-12 m-top-20">
                    <div class="row">
                        <div class="col-xs-12">
                            <form method="post" action="{{ $submitUrl }}">
                                {{csrf_field()}}
                                @include('app.candidate.profile.partials.menu')

                                <div class="well-30">
                                    @include('partials.errors')

                                    <div class="form-group">
                                        <strong class="fs-12 text-blue">UCAS Points</strong>
                                        <a href="#" data-toggle="modal"
                                           data-target="#ucas-modal">
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                        </a>
                                        <span class="red m-left-10">Enter UCAS points for A-Levels only. Do NOT include UCAS points for AS-Levels.</span>
                                        <input name="ucas_points" type="number"
                                               value="{{ old('ucas_points', $candidate->ucas_points)}}"
                                               class="form-control input-lg m-btm-4 m-top-10"
                                               placeholder="Enter UCAS points using figures only">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <strong class="fs-12 text-blue">University Attended</strong>
                                                <select name="university"
                                                        class="form-control input-lg m-btm-4">
                                                    <option disabled selected>Type / Select university attended for your
                                                        undergraduate degree
                                                    </option>
                                                    @foreach (\App\Models\University::orderby('name','asc')->get() as $uni)
                                                        <option {!! (is_numeric(old('university')) && old('university') == $uni->id) || ($candidate->university && $candidate->university->id == $uni->id) ? 'selected="selected"' : ''!!} value="{{ $uni->id }}">{{ $uni->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <strong class="fs-12 text-blue">Degree Class</strong>
                                                <select name="degree_class"
                                                        class="form-control input-lg m-btm-4">
                                                    <option disabled selected>Select Degree Class</option>
                                                    @foreach ($degreeClassList as $key => $value)
                                                        <option {!!(is_numeric(old('degree_class')) && old('degree_class') == $key) || $candidate->degree_class == $key ? 'selected="select"' : ''!!} value="{{$key}}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <strong class="fs-12 text-blue">Training Firm</strong>
                                        <select name="training_law_firm"
                                                class="form-control input-lg m-btm-4">
                                            <option disabled selected>Type / Select the firm where you undertook / are
                                                undertaking your
                                                training contract
                                            </option>

                                            @foreach (\App\Models\LawFirm::all() as $lawFirm)
                                                <option {!! (is_numeric(old('training_law_firm')) && old('training_law_firm') == $lawFirm->id) || $candidate->trainingLawFirm && $candidate->trainingLawFirm->id == $lawFirm->id ? 'selected="selected"' : ''!!} value="{{ $lawFirm->id }}">{{ $lawFirm->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <strong class="fs-12 text-blue">Client Secondment</strong>
                                        <p class="no-margin">Did / Have you undertaken a client secondment during your
                                            training?</p>
                                        <span class="red m-left-10">If you are due to go on a client secondment during your training, but are yet to do so, then please answer ‘Yes’.</span>
                                        <div class="m-top-10">
                                            <input class="alt-radio" type="radio" id="c1" value="1"
                                                   name="client_secondment"
                                                    {!! (is_numeric(old('client_secondment')) && old('client_secondment') == 1) || (!is_numeric(old('client_secondment')) && $candidate->taken_client_secondment) ? 'checked="checked"' : ''!!}>
                                            <label for="c1"><span></span>Yes</label>

                                            <input class="alt-radio" type="radio" id="c2" value="0"
                                                   name="client_secondment"
                                                    {!! (is_numeric(old('client_secondment')) && old('client_secondment') == 0) || ( !is_numeric(old('client_secondment')) && !$candidate->taken_client_secondment) ? 'checked="checked"' : ''!!}>
                                            <label for="c2"><span></span>No</label>
                                        </div>
                                    </div>
                                    <div class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-blue">Training Seats</strong>
                                        <p>Which seats did / have you undertaken during your training?</p>
                                        <select data-title="Type / Select training seats undertaken / due to undertake (8 max)"
                                                name="training_seats[]"
                                                class="form-control input-lg m-btm-4 custom-select-element" multiple>
                                            @foreach (\App\Models\TrainingSeat::orderby('name','asc')->get() as $trainingSeat)
                                                <option value="{{ $trainingSeat->id }}"
                                                        {!! ((is_array(old('training_seats')) && in_array($trainingSeat->id, old('training_seats'))) || (!old('training_seats') && in_array($trainingSeat->id, $candidate->trainingSeats->lists('id')->toArray())) ? 'selected="selected"' : '') !!}
                                                >{{ $trainingSeat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group relative">
                                        <strong class="fs-12 text-blue">Date Qualified / Due to Qualify</strong>
                                        <span class="red m-left-10">If you are unsure as to which month you are due to qualify, please enter your best guess.</span>
                                        <input name="qualified_date_display" type="text"
                                               class="form-control datetimepicker m-top-10"
                                               data-field=".qualified_date"
                                               value="{{old('qualified_date_display', $candidate->date_qualified->format('F Y'))}}"
                                               readonly="true"
                                        />

                                        <input type="hidden" name="qualified_date" class="qualified_date"
                                               value="{{old('qualified_date', $candidate->date_qualified->format('Y-m-d'))}}">
                                    </div>
                                    <div class="form-group" id="working-with-question">
                                        <strong class="fs-12 text-blue">Are you still working with the firm you trained
                                            with?</strong>
                                        <span class="red m-left-10">If you are still employed by the firm you trained with, but currently on client secondment, please select ‘Yes’.</span>
                                        <div class="m-top-10">
                                            <input class="alt-radio" type="radio" id="c3" value="Yes"
                                                   {{ old('employed_by_training_firm', $isEmployedByTraingFirm) == 'Yes' ? 'checked="checked"' : '' }}
                                                   name="employed_by_training_firm">
                                            <label for="c3"><span></span>Yes</label>
                                            <input type="radio" id="c4" value="No"
                                                   {{ old('employed_by_training_firm', $isEmployedByTraingFirm) == 'No' ? 'checked="checked"' : '' }}
                                                   name="employed_by_training_firm" class="c4 alt-radio">
                                            <label for="c4"><span id="c4-sprites"></span>No</label>
                                            <input type="radio" id="c5"
                                                   value="Not Working"
                                                   {{ old('employed_by_training_firm', $isEmployedByTraingFirm) == 'Not Working' ? 'checked="checked"' : '' }}
                                                   name="employed_by_training_firm" class="alt-radio c5">
                                            <label for="c5"><span id="c5-sprites"></span>Not Working</label>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display:none" id="current-firm-question">
                                        <strong class="fs-12 text-blue">Current Firm</strong><span
                                                class="red m-left-10">If you are currently working outside of the legal profession or within an in house legal department, select either of these options from the top of the drop down menu.</span>
                                        <select name="current_law_firm" class="form-control input-lg m-btm-4 m-top-10">
                                            <option value="" disabled>Type or Select the name of your current firm
                                            </option>
                                            @foreach (\App\Models\LawFirm::withOptions()->get()->groupBy('is_option') as $group)
                                                <optgroup>
                                                    @foreach($group as $lawFirm)
                                                        <option value="{{ $lawFirm->id }}"
                                                                {!! (is_numeric(old('current_law_firm')) && old('current_law_firm') == $lawFirm->id) || $candidate->currentLawFirm && $candidate->currentLawFirm->id == $lawFirm->id ? 'selected="selected"' : '' !!}
                                                        >{{ $lawFirm->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <strong class="fs-12 text-blue">Has / Did your Training Firm offer you an {{ config('brand.identity.initials')  }}
                                            position?</strong>
                                        <span class="red m-left-10">If you are still training and your firm is yet to complete the {{ config('brand.identity.initials')  }} allocation process please select ‘N/A’.</span>
                                        <div class="m-top-10">
                                            <input class="alt-radio" type="radio" id="c6" value="1"
                                                   name="training_firm_position_offered"
                                                    {!! ((is_numeric(old('training_firm_position_offered')) && old('training_firm_position_offered') ==1) || $candidate->did_training_firm_offer_position==1 ?'checked="checked"' : '') !!}
                                            >
                                            <label for="c6"><span></span>Yes</label>
                                            <input class="alt-radio" type="radio" id="c7" value="0"
                                                   name="training_firm_position_offered"
                                                    {!! ((is_numeric(old('training_firm_position_offered')) && old('training_firm_position_offered') ==0) || !$candidate->did_training_firm_offer_position ?'checked="checked"' : '') !!}
                                            >
                                            <label for="c7"><span></span>No</label>
                                            <input class="alt-radio" type="radio" id="c8" value="2"
                                                   name="training_firm_position_offered"
                                                    {!! ((is_numeric(old('training_firm_position_offered')) && old('training_firm_position_offered') ==2) || $candidate->did_training_firm_offer_position==2 ?'checked="checked"' : '') !!}
                                            >
                                            <label for="c8"><span></span>N/A</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <strong class="fs-12 text-blue">Additional Languages</strong>
                                        <select data-title="Select additional languages that you can speak fluently"
                                                name="languages[]"
                                                class="form-control input-lg m-btm-4 custom-select-element" multiple>
                                            @foreach (\App\Models\Language::orderby('name','asc')->get() as $language)
                                                <option
                                                        {!! ((is_array(old('languages')) && in_array($language->id, old('languages'))) || (!old('languages') && in_array($language->id, $candidate->languages->lists('id')->toArray())) ? 'selected="selected"' : '') !!}
                                                        value="{{ $language->id }}">{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @include('app.candidate.profile.partials.buttons')
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('app.partials.ucas-modal')

@endsection

@section('js')
    @parent
    <script>
        var candidateCreatedAt = '{{ $candidate->created_at->format('Y-m-d H:i:s') }}';
    </script>
    <script src="{{asset('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ elixir('js/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/candidate-profile.js') }}" type="text/javascript"></script>
@endsection
