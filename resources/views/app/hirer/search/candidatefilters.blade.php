@extends('app.master')

@section('css')
    @parent

    <link href="{{asset('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
@stop

@section('title', 'New Search - Vacancy Details')

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xs-12">
                    <h4><i class="nq-sprite nq-static nq-user-blue"></i> New Search</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 m-top-20">

                    @include('app.hirer.search.partials.menu')
                    <form action="{{$submitUrl}}" method="post">
                        {{csrf_field()}}
                        <div class="well-30">
                            @include('partials.errors')

                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-muted text-blue">UCAS Points</strong>
                                <a href="#" data-toggle="modal"
                                   data-target="#ucas-modal">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                </a>
                                <span class="red m-left-10 text-justify">Enter minimum UCAS points for A-Levels only. Do NOT include UCAS points for AS-Levels.</span>
                                <input type="text"
                                       value="{{ old('ucas_points', $search->min_ucas_points) }}"
                                       name="ucas_points"
                                       class="form-control input-lg m-top-10" placeholder="Enter minimum UCAS points for A-Levels">
                            </div>
                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-muted text-blue">Type of University Attended</strong>
                                <select data-title="Select one or more university types or ‘Any’"
                                        name="universities[]"
                                        class="form-control input-lg m-btm-4 custom-select-element" multiple>
                                    @foreach (\App\Models\UniversityBand::orderby('name','asc')->get() as $universityBand)
                                        <option value="{{ $universityBand->id }}"
                                                {{ isMultiSelected($universityBand->id, $search->universityBands, 'universities') ? 'selected="selected"' : '' }}>
                                            {{$universityBand->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-muted text-blue">Degree Class</strong>
                                <select name="degree_class"
                                        class="form-control input-lg m-btm-4">
                                    <option disabled selected>Select minimum degree class or ‘Any’</option>
                                    @foreach ($degreeClassList as $key => $value)
                                        <option value="{{$key}}"
                                                {{ old('degree_class', $search->min_degree_class) === $key ? 'selected="selected"' : '' }}
                                        >{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-muted text-blue">Type of Training Firm</strong>

                                <select id="tagPicker" data-title="Select type of training firm"
                                        name="training_law_firm_bands[]"
                                        class="form-control custom-select-element" multiple>
                                        <optgroup label="">
                                            @foreach($typeOfFirmOptionList['optionList'] as $option)
                                                <option value="{{$option['band']->id}}"
                                                        {{ isMultiSelected($option['band']->id, $search->trainingLawFirmBands, 'training_law_firm_bands') ? 'selected="selected"' : '' }}
                                                        data-children="{{$option['band']->children}}"
                                                >
                                                    {{$option['displayName']}}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <strong class="fs-12 text-blue">Client Secondment?</strong>
                                <p>Do you want your candidates to have undertaken a client secondment during their
                                    training?</p>
                                <div class="m-top-10">
                                    <input class="alt-radio" checked="checked" type="radio"
                                           value="0"
                                           {{ old('client_secondment', $search->taken_client_secondment) == '0' ? 'checked="checked"' : '' }}
                                           id="client_secondment_1" name="client_secondment">
                                    <label for="client_secondment_1"><span></span>Doesn’t Matter</label>
                                    <input class="alt-radio" type="radio" id="client_secondment_2"
                                           name="client_secondment"
                                           {{ old('client_secondment', $search->taken_client_secondment) == '1' ? 'checked="checked"' : '' }}
                                           value="1">
                                    <label for="client_secondment_2"><span></span>Yes</label>
                                </div>
                            </div>
                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-blue">Training Seats</strong>
                                <select data-title="Select ‘Any’ or one or more seats candidates should have undertaken / are due to undertake"
                                        name="training_seats[]"
                                        class="form-control input-lg m-btm-4 custom-select-element" multiple>
                                        <option value="" {{ $search->trainingSeats->count() == 0 && $editing ? 'selected="selected"' : '' }} >Any</option>
                                    @foreach (\App\Models\TrainingSeat::orderby('name','asc')->get() as $trainingSeat)
                                        <option value="{{ $trainingSeat->id }}"
                                                {{ isMultiSelected($trainingSeat->id, $search->trainingSeats, 'training_seats') ? 'selected="selected"' : '' }}
                                        >{{ $trainingSeat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-blue">Qualification Date Range</strong>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" name="qualified_date_from_show"
                                               class="form-control input-lg datetimepicker qualified_date_from"
                                               data-field=".qualified_date_from_hidden"
                                               placeholder="From"
                                               value="{{ old('qualified_date_from_show', $search->date_qualified_from ? $search->date_qualified_from->format('F Y') : '')}}"
                                               readonly='true'
                                        >

                                        <input type="hidden" class="qualified_date_from_hidden"
                                               name="qualified_date_from"
                                               value="{{old('qualified_date_from', $search->date_qualified_from ? $search->date_qualified_from->format('Y-m-d') : '')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="qualified_date_to_show"
                                               class="form-control input-lg datetimepicker qualified_date_to"
                                               data-field=".qualified_date_to_hidden"
                                               placeholder="To"
                                               value="{{old('qualified_date_to_show', $search->date_qualified_to ? $search->date_qualified_to->format('F Y') : '')}}"
                                               readonly='true'
                                        >

                                        <input type="hidden" class="qualified_date_to_hidden"
                                               name="qualified_date_to"
                                               value="{{old('qualified_date_to', $search->date_qualified_to ? $search->date_qualified_to->format('Y-m-d') : '')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-muted text-blue">Additional Languages</strong><br />
                                <span class="red">Only use this field if it is essential that Candidates speak this language fluently, as it will substantially reduce the number of Matches.</span>
                                <select data-title="Select one or more additional languages that candidates can speak fluently"
                                        name="languages[]"
                                        class="form-control input-lg m-btm-4 custom-select-element m-top-10" multiple>
                                    @foreach (\App\Models\Language::orderby('name','asc')->get() as $language)
                                        <option value="{{ $language->id }}"
                                                {{ isMultiSelected($language->id, $search->languages, 'languages') ? 'selected="selected"' : '' }}
                                        >{{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            @if (!$hirer->agreed_terms)
                                <p>
                                    <input value="1" type="checkbox" id="agreed_terms" name="agreed_terms"/>
                                    I confirm that by searching I have read and agree to NQ Recruitment Ltd's
                                    <a target="_blank" href="{{ asset('pdf/Hirer Terms & Conditions (Final).pdf') }}" style="color:#153661">
                                        <strong>terms and conditions</strong>
                                    </a>.
                                </p>
                            @endif
                            <div class="text-right m-top-20">
                                <a href="{{($editing ? route('hirer.search.vacancydetails.edit', $search->id) : route('hirer.search.vacancydetails'))}}"
                                   class="btn btn-grey fs-12 btn-lg">Previous</a>
                                <input type="submit" class="btn btn-primary fs-12 btn-lg" value="Run Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('app.partials.ucas-modal')

@endsection

@section('js')
    @parent

    <script>
        var searchDateFromString = '{{ $search->date_qualified_from ? $search->date_qualified_from->format('Y-m-d H:i:s') : date('Y-m-d H:i:s') }}';
    </script>
    <script src="{{asset('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ elixir('js/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/hirer-candidate-filters.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/ucas-points-popup.js') }}" type="text/javascript"></script>
@endsection
