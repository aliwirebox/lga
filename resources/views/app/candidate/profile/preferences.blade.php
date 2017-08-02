@extends('app.master')

@section('title', 'Preferences')

@section('css')
    @parent

    <link href="{{asset('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
@stop

@section('content')
    <div class="row-fluid m-top-100">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xs-12">
                    <h4 class="display-inline"><i class="nq-sprite nq-static nq-user-blue"></i> Create a Profile</h4>
                    <a href="{{ url('candidate-faqs')}}" class="pull-right"><strong>FAQs</strong></a>
                </div>
            </div>

            <div class="row">
                <form action="{{ $submitUrl }}" method="POST">
                    {{csrf_field()}}
                    <div class="col-sm-12 m-top-20">
                        <div class="row">
                            <div class="col-xs-12">
                                @include('app.candidate.profile.partials.menu')

                                <div class="well-30">
                                    @include('partials.errors')

                                    <div class="form-group">
                                        <strong class="fs-12 text-muted text-blue">Location</strong>
                                        <select class="form-control input-lg m-btm-4 custom-select-element"
                                                multiple
                                                name="locations[]"
                                                data-title="Select one or more locations you would like to work in">
                                            @foreach($locations as $location)
                                                <option
                                                    {{ in_array($location->id, old('locations', $selectedLocations)) ? 'selected="selected"' : '' }}
                                                    value="{{$location->id}}"
                                                >
                                                    {{$location->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-blue">Minimum Salary</strong>

                                        <select class="form-control input-lg m-btm-4"
                                                name="minimum_salary">
                                            <option disabled selected>Select your minimum salary requirement</option>
                                            @foreach($salaries as $value => $label)
                                                <option value="{{ $value }}" {{ ($editing || old('minimum_salary') !== null || $candidate->minimum_salary !== 0) && old('minimum_salary', $candidate->minimum_salary) == $value ? 'selected="selected"' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-blue">Department</strong>
                                        <select class="form-control input-lg m-btm-4 custom-select-element"
                                                multiple
                                                name="departments[]"
                                                data-title="Select one or more departments you would like to work in">
                                            @foreach(\App\Models\TrainingSeat::orderby('name','asc')->get() as $trainingSeat)
                                                <option
                                                        {{ in_array($trainingSeat->id, old('departments', $selectedDepartments)) ? 'selected="selected"' : '' }}
                                                        value="{{$trainingSeat->id}}">{{$trainingSeat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="type-of-firms-group" style="display:none" class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-blue">Type of Firm</strong>

                                        <select id="tagPicker"
                                                name="type_of_firms[]"
                                                data-title="Select one or more types of firms you'd like to be matched with"
                                                class="form-control custom-select-element"
                                                multiple>
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
    <script type="text/javascript" charset="utf-8">
        var typeOfFirmsOptionRoute = '{!! route('candidate.type-of-firm-option.data') !!}';
    </script>
    <script src="{{asset('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ elixir('js/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/candidate-preferences.js') }}" type="text/javascript"></script>
@endsection
