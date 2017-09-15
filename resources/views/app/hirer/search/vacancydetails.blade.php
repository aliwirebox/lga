@extends('app.master')

@section('css')
    @parent

    <link href="{{asset('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
@stop

@section('title', 'New Search - Your Vacancy')

@section('content')

    <div class="row-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xs-12">
                    <h4>New Search</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 m-top-20">
                    @include('app.hirer.search.partials.menu')

                    <form action="{{$submitUrl}}" method="post">
                        {{csrf_field()}}

                        <div class="well-30">
                            @include('partials.errors')

                            <div class="form-group">
                                <strong class="fs-12 text-muted text-blue">Location</strong>
                                <select name="location"
                                        class="form-control input-lg m-btm-4">
                                    <option disabled selected>Select a location for this vacancy</option>
                                    @foreach(\App\Models\Location::all() as $location)
                                        <option 
                                            value="{{$location->id}}" 
                                            {{ old('location', $search->vacancy_location_id) == $location->id ? 'selected="selected"' : '' }}
                                        >
                                        {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <strong class="fs-12 text-blue">When will you need candidates to be available from?</strong>
                                    <input name="available_date_display" type="text"
                                           class="form-control datetimepicker m-top-10"
                                           data-field=".available_date"
                                           value="{{old('available_date_display', $search->available_date ? $search->available_date->format('d F Y') : '')}}"
                                           readonly="true"
                                    />

                                    <input type="hidden" name="available_date" class="available_date"
                                           value="{{old('available_date', $search->available_date ? $search->available_date->format('Y-m-d') : '')}}">
                            </div>
                            
                            <div class="form-group">
                                 <strong class="fs-12 text-blue">Will your candidate have to travel abroad?</strong>
                                 <div class="m-top-10">
                                     <input class="alt-radio" type="radio" id="travel_abroad1" value="1"
                                            name="travel_abroad"
                                             {!! (is_numeric(old('travel_abroad')) && old('travel_abroad') == 1) || (!is_numeric(old('travel_abroad')) && $search->travel_abroad) ? 'checked="checked"' : ''!!}>
                                     <label for="travel_abroad1"><span></span>Yes</label>

                                     <input class="alt-radio" type="radio" id="travel_abroad2" value="0"
                                            name="travel_abroad"
                                             {!! (is_numeric(old('travel_abroad')) && old('travel_abroad') == 0) || ( !is_numeric(old('travel_abroad')) && !$search->travel_abroad) ? 'checked="checked"' : ''!!}>
                                     <label for="travel_abroad2"><span></span>No</label>
                                 </div>
                             </div>

                              <div class="form-group">
                                 <strong class="fs-12 text-blue">Contract or Permanent?</strong>
                                 <div class="m-top-10">
                                     <input class="alt-radio" type="radio" id="position_permanent1" value="1"
                                            name="position_permanent"
                                             {!! (is_numeric(old('position_permanent')) && old('position_permanent') == 1) || (!is_numeric(old('position_permanent')) && $search->position_permanent) ? 'checked="checked"' : ''!!}>
                                     <label for="position_permanent1"><span></span>Premanent</label>

                                     <input class="alt-radio" type="radio" id="position_permanent2" value="0"
                                            name="position_permanent"
                                             {!! (is_numeric(old('position_permanent')) && old('position_permanent') == 0) || ( !is_numeric(old('position_permanent')) && !$search->position_permanent) ? 'checked="checked"' : ''!!}>
                                     <label for="position_permanent2"><span></span>Contract</label>
                                 </div>
                             </div>

                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-muted text-blue">Salary</strong>
                                <select name="salary"
                                        class="form-control input-lg m-btm-4">
                                    <option disabled selected>Select maximum salary for this vacancy</option>
                                    @foreach($salaries as $value => $label)
                                        <option value="{{$value}}" {{ old('salary', $search->vacancy_salary) == $value ? 'selected="selected"' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-muted text-blue">Additional Information</strong>
                                    <textarea maxlength="300" id="additional_information"
                                              name="additional_information"
                                              class="form-control" rows="6"
                                              placeholder="Only enter information here if it is important to finding the best match e.g. exact office location. Information entered here will be presented to the Candidate when a CV is requested">{!! old('additional_information', (isset($search) && $search->vacancy_additional_information) ? $search->vacancy_additional_information : '') !!}</textarea>
                                <span class="pull-right text-danger">
                                    <span id="chars">300</span> characters remaining
                                </span>
                            </div>
                            
                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-muted text-blue">Department</strong>

                                <select name="departments"
                                        class="form-control input-lg m-btm-4">
                                    <option disabled selected>Select a department for this vacancy</option>
                                    @foreach(\App\Models\TrainingSeat::orderby('name','asc')->get() as $trainingSeat)
                                        <option
                                                {{ old('departments', $search->vacancy_department_id) == $trainingSeat->id ? 'selected="selected"' : '' }}
                                                value="{{$trainingSeat->id}}">{{$trainingSeat->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="clearfix"></div>
                            @if (!$hirer->agreed_terms)
                                <p>
                                    <input value="1" type="checkbox" id="agreed_terms" name="agreed_terms"/>
                                    I confirm that by searching I have read and agree to {{  config('brand.identity.legalname')  }}'s
                                    <a target="_blank" href="{{ asset('pdf/Hirer Terms & Conditions (Final).pdf') }}" style="color:#153661">
                                        <strong>terms and conditions</strong>
                                    </a>.
                                </p>
                            @endif
                            <div class="text-right m-top-20">
                                <a href="{{($editing ? route('hirer.search.candidatefilters.edit', $search->id) : route('hirer.search.candidatefilters'))}}"
                                   class="btn btn-grey fs-12 btn-lg">Previous</a>
                                <input type="submit" class="btn btn-primary fs-12 btn-lg" value="Run Search">
                            </div>

                            
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent

    <script src="{{asset('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ elixir('js/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/hirer-vacancy-details.js') }}" type="text/javascript"></script>
@endsection
