@extends('app.master')

@section('title', 'Preferences')

@section('css')
    @parent

    <link href="{{asset('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
@stop

@section('content')
    <div class="row-fluid m-top-50">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xs-12">
                    <h4 class="display-inline">Create a Profile</h4>
                    <a href="{{ url('candidate-faqs')}}" class="pull-right"><strong>Questions&#63;</strong></a>
                </div>
            </div>

            <div class="row">
                <form action="{{ $submitUrl }}" method="POST">
                    {{csrf_field()}}
                    <div class="col-sm-8 m-top-20">
                        <div class="row">
                            <div class="col-xs-12">
                                @include('app.candidate.profile.partials.menu')

                                <div class="well-30">
                                    @include('partials.errors')

                                    <div class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-red">Preferred Salary</strong>

                                        <select class="form-control input-lg m-btm-4"
                                                name="minimum_salary">
                                            <option disabled selected>Select your minimum salary requirement</option>
                                            @foreach($salaries as $value => $label)
                                                <option value="{{ $value }}" {{ ($editing || old('minimum_salary') !== null || $candidate->minimum_salary !== 0) && old('minimum_salary', $candidate->minimum_salary) == $value ? 'selected="selected"' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <strong class="fs-12 text-muted text-red">Location</strong>
                                        <select class="form-control input-lg m-btm-4 custom-select-element"
                                                multiple
                                                name="locations[]"
                                                data-title="Select one or more locations you would like to work in">
                                            {!! getTreeOptions($locations, oldOrArray('locations', $selectedLocations)) !!}
                                        </select>
                                    </div>

                                   <div class="form-group">
                                        <strong class="fs-12 text-red">Would you be willing to travel abroad in your role?</strong>
                                        <div class="m-top-10">
                                            <input class="alt-radio" type="radio" id="travel_abroad1" value="1"
                                                   name="travel_abroad"
                                                    {!! (is_numeric(old('travel_abroad')) && old('travel_abroad') == 1) || (!is_numeric(old('travel_abroad')) && $candidate->travel_abroad) ? 'checked="checked"' : ''!!}>
                                            <label for="travel_abroad1"><span></span>Yes</label>

                                            <input class="alt-radio" type="radio" id="travel_abroad2" value="0"
                                                   name="travel_abroad"
                                                    {!! (is_numeric(old('travel_abroad')) && old('travel_abroad') == 0) || ( !is_numeric(old('travel_abroad')) && !$candidate->travel_abroad) ? 'checked="checked"' : ''!!}>
                                            <label for="travel_abroad2"><span></span>No</label>
                                        </div>
                                    </div>

                                    <div class="form-group relative">
                                       <div class="row">
                                           <div class="col-sm-8 col-md-4">
                                                <strong class="fs-12 text-red">When will you be available?</strong>
                                                <input name="available_date_display" type="text"
                                                       class="form-control datetimepicker m-top-10 border-grey"
                                                       data-field=".available_date"
                                                       value="{{old('available_date_display', $candidate->available_date_formatted)}}"
                                                       readonly="true"
                                                />

                                                <input type="hidden" name="available_date" class="available_date"
                                               value="{{old('available_date', $candidate->available_date)}}">
                                           </div>
                                       </div>
                                    </div>

                                    <div class="form-group relative">
                                        <strong class="fs-12 text-red">Would you accept a permanent and/or a contract role:</strong><br />
                                        <strong class="fs-12 text-dark-grey">Permanent?</strong>
                                        <input value="1" type="checkbox" id="seeking_permanent" name="seeking_permanent"{{ old('seeking_permanent', $candidate->seeking_permanent) == '1' ? 'checked="checked"' : '' }}/>
                                    
                                        <strong class="fs-12 text-dark-grey">Contract?</strong>
                                        <input value="1" type="checkbox" id="seeking_contract" name="seeking_contract" {{ old('seeking_contract', $candidate->seeking_contract) == '1' ? 'checked="checked"' : '' }}/>
                                    </div>

                                    <div class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-red">Select department or company type</strong>
                                        <select class="form-control input-lg m-btm-4 custom-select-element"
                                                multiple
                                                name="departments[]"
                                                data-title="Select one or more departments or company types you would like to work in">
                                            @foreach($trainingSeats as $index => $trainingSeat)
                                                <option {{ in_array($trainingSeat->id, old('departments', $selectedDepartments)) ? 'selected="selected"' : '' }} 
                                                    value="{{$trainingSeat->id}}"> 
                                                    {{$trainingSeat->name}}
                                                </option>
                                                @if ( $index == 0 || $index == 1)
                                                <option data-divider="true"></option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="type-of-firms-group" class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-red">Companies you do not want to be matched with</strong>

                                        <select id="tagPicker"
                                                name="law_firm_blacklist[]"
                                                data-title="Select one or more companies you'd like to blacklist from matches"
                                                class="form-control custom-select-element"
                                                multiple>
                                            @foreach(\App\Models\LawFirm::orderby('name','asc')->get() as $lawFirm)
                                                <option
                                                        {{ in_array($lawFirm->id, old('departments', $blacklistedLawFirms)) ? 'selected="selected"' : '' }}
                                                        value="{{$lawFirm->id}}">{{$lawFirm->name}}</option>
                                            @endforeach                                            
                                        </select>
                                    </div>
                                    @include('app.candidate.profile.partials.buttons')
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        var candidateCreatedAt = '{{ $candidate->created_at->format('Y-m-d H:i:s') }}';
        var typeOfFirmsOptionRoute = '{!! route('candidate.type-of-firm-option.data') !!}';
    </script>
    <script src="{{asset('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ elixir('js/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/candidate-preferences.js') }}" type="text/javascript"></script>
@endsection
