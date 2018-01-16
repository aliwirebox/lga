@extends('app.master')

@section('css')
    @parent

    <link href="{{asset('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
@stop

@section('title', 'Search - Vacancy Details')

@section('content')

    <div class="row-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xs-12">
                    <h4>Search</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 m-top-20">

                    @include('app.hirer.search.partials.menu')
                    <form action="{{$submitUrl}}" method="post">
                        {{csrf_field()}}
                        <div>
                            @include('partials.errors')

                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-muted text-red">Does the candidate need a degree?</strong>
                                <div class="m-top-10">                                    
                                    <input class="alt-radio" type="radio" id="has_degree1" value="1"
                                           name="has_degree"
                                            {!! (is_numeric(old('has_degree')) && old('has_degree') == 1) || (!is_numeric(old('has_degree')) && $search->has_degree) ? 'checked="checked"' : ''!!}>
                                    <label for="has_degree1"><span></span>Yes</label>

                                    <input class="alt-radio" type="radio" id="has_degree2" value="0"
                                           name="has_degree"
                                            {!! (is_numeric(old('has_degree')) && old('has_degree') == 0) || ( !is_numeric(old('has_degree')) && !$search->has_degree) ? 'checked="checked"' : ''!!}>
                                    <label for="has_degree2"><span></span>No</label>
                                </div>                                
                            </div>
                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-red">Should the candidate have undertaken an LPC?</strong>
                                <div class="m-top-10">
                                    <input class="alt-radio" type="radio" id="has_lpc1" value="1"
                                           name="has_lpc"
                                            {!! (is_numeric(old('has_lpc')) && old('has_lpc') == 1) || (!is_numeric(old('has_lpc')) && $search->has_lpc) ? 'checked="checked"' : ''!!}>
                                    <label for="has_lpc1"><span></span>Yes</label>

                                    <input class="alt-radio" type="radio" id="has_lpc2" value="0"
                                           name="has_lpc"
                                            {!! (is_numeric(old('has_lpc')) && old('has_lpc') == 0) || ( !is_numeric(old('has_lpc')) && !$search->has_lpc) ? 'checked="checked"' : ''!!}>
                                    <label for="has_lpc2"><span></span>No</label>
                                </div>
                            </div>
                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-red">Would you prefer a candidate that is registered with the Institute of Paralegals?</strong>
                                <div class="m-top-10">
                                    <input class="alt-radio" type="radio" id="member_institute_paralegals1" value="1"
                                           name="member_institute_paralegals"
                                            {!! (is_numeric(old('member_institute_paralegals')) && old('member_institute_paralegals') == 1) || (!is_numeric(old('member_institute_paralegals')) && $search->member_institute_paralegals) ? 'checked="checked"' : ''!!}>
                                    <label for="member_institute_paralegals1"><span></span>Yes</label>

                                    <input class="alt-radio" type="radio" id="member_institute_paralegals2" value="0"
                                           name="member_institute_paralegals"
                                            {!! (is_numeric(old('member_institute_paralegals')) && old('member_institute_paralegals') == 0) || ( !is_numeric(old('member_institute_paralegals')) && !$search->member_institute_paralegals) ? 'checked="checked"' : ''!!}>
                                    <label for="member_institute_paralegals2"><span></span>No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <strong class="fs-12 text-red">Would you prefer a candidate that is a member of CILEx?</strong>
                                <div class="m-top-10">
                                    <input class="alt-radio" type="radio" id="member_of_cilex1" value="1"
                                           name="member_of_cilex"
                                            {!! (is_numeric(old('member_of_cilex')) && old('member_of_cilex') == 1) || (!is_numeric(old('member_of_cilex')) && $search->member_of_cilex) ? 'checked="checked"' : ''!!}>
                                    <label for="member_of_cilex1"><span></span>Yes</label>

                                    <input class="alt-radio" type="radio" id="member_of_cilex2" value="0"
                                           name="member_of_cilex"
                                            {!! (is_numeric(old('member_of_cilex')) && old('member_of_cilex') == 0) || ( !is_numeric(old('member_of_cilex')) && !$search->member_of_cilex) ? 'checked="checked"' : ''!!}>
                                    <label for="member_of_cilex2"><span></span>No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <strong class="fs-12 text-muted text-red">How many years’ experience should the candidate have?</strong>
                                <div class="row">
                                    <div class="col-sm-3">
                                    <input type="number" id="years_experience" min="1" name="years_experience" class="form-control border-grey"
                                       value="{{ old('years_experience', $search->years_experience) }}">
                                </div>
                                </div>
                            </div>
                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-muted text-red">Are there any specific skills you require?</strong>
                                <select data-title="Type / Select your essential skills (8 max)"
                                        name="training_seats[]"
                                        class="form-control input-lg m-btm-4 custom-select-element" multiple>
                                        <option value="" {{ $search->trainingSeats->count() == 0 && $editing ? 'selected="selected"' : '' }} >Any</option>
                                    @foreach (\App\Models\TrainingSeat::orderby('name','asc')->get() as $essentialSkill)
                                        <option value="{{ $essentialSkill->id }}"
                                                {!! ((is_array(old('training_seats')) && in_array($essentialSkill->id, old('training_seats'))) || (!old('training_seats') && in_array($essentialSkill->id, $search->trainingSeats->lists('id')->toArray())) ? 'selected="selected"' : '') !!}
                                        >{{ $essentialSkill->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group m-top-20">
                                <strong class="fs-12 text-muted text-red">Additional Languages</strong><br />
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
                            <div class="text-right m-top-20">
                                <a class="btn btn-grey fs-12 btn-lg" disabled="disabled">Previous</a>
                                <input type="submit" class="btn btn-primary fs-12 btn-lg" value="Next">
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
