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

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <strong class="fs-12 text-blue">Do you have a degree?</strong>
                                                <div class="m-top-10">
                                                    <input class="alt-radio" type="radio" id="has_degree1" value="1"
                                                           name="has_degree"
                                                            {!! (is_numeric(old('has_degree')) && old('has_degree') == 1) || (!is_numeric(old('has_degree')) && $candidate->has_degree) ? 'checked="checked"' : ''!!}>
                                                    <label for="has_degree1"><span></span>Yes</label>

                                                    <input class="alt-radio" type="radio" id="has_degree2" value="0"
                                                           name="has_degree"
                                                            {!! (is_numeric(old('has_degree')) && old('has_degree') == 0) || ( !is_numeric(old('has_degree')) && !$candidate->has_degree) ? 'checked="checked"' : ''!!}>
                                                    <label for="has_degree2"><span></span>No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group" id="degree-class-question">
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
                                        <strong class="fs-12 text-blue">Do you have an LPC?</strong>
                                        <div class="m-top-10">
                                            <input class="alt-radio" type="radio" id="has_lpc1" value="1"
                                                   name="has_lpc"
                                                    {!! (is_numeric(old('has_lpc')) && old('has_lpc') == 1) || (!is_numeric(old('has_lpc')) && $candidate->has_lpc) ? 'checked="checked"' : ''!!}>
                                            <label for="has_lpc1"><span></span>Yes</label>

                                            <input class="alt-radio" type="radio" id="has_lpc2" value="0"
                                                   name="has_lpc"
                                                    {!! (is_numeric(old('has_lpc')) && old('has_lpc') == 0) || ( !is_numeric(old('has_lpc')) && !$candidate->has_lpc) ? 'checked="checked"' : ''!!}>
                                            <label for="has_lpc2"><span></span>No</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <strong class="fs-12 text-blue">Do you have a right to work in the UK or international locations you have selected?</strong>
                                        <div class="m-top-10">
                                            <input class="alt-radio" type="radio" id="has_rtw1" value="1"
                                                   name="has_rtw"
                                                    {!! (is_numeric(old('has_rtw')) && old('has_rtw') == 1) || (!is_numeric(old('has_rtw')) && $candidate->has_rtw) ? 'checked="checked"' : ''!!}>
                                            <label for="has_rtw1"><span></span>Yes</label>

                                            <input class="alt-radio" type="radio" id="has_rtw2" value="0"
                                                   name="has_rtw"
                                                    {!! (is_numeric(old('has_rtw')) && old('has_rtw') == 0) || ( !is_numeric(old('has_rtw')) && !$candidate->has_rtw) ? 'checked="checked"' : ''!!}>
                                            <label for="has_rtw2"><span></span>No</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <strong class="fs-12 text-blue">Are you a member of the Institute of Paralegals?</strong>
                                        <div class="m-top-10">
                                            <input class="alt-radio" type="radio" id="member_institute_paralegals1" value="1"
                                                   name="member_institute_paralegals"
                                                    {!! (is_numeric(old('member_institute_paralegals')) && old('member_institute_paralegals') == 1) || (!is_numeric(old('member_institute_paralegals')) && $candidate->member_institute_paralegals) ? 'checked="checked"' : ''!!}>
                                            <label for="member_institute_paralegals1"><span></span>Yes</label>

                                            <input class="alt-radio" type="radio" id="member_institute_paralegals2" value="0"
                                                   name="member_institute_paralegals"
                                                    {!! (is_numeric(old('member_institute_paralegals')) && old('member_institute_paralegals') == 0) || ( !is_numeric(old('member_institute_paralegals')) && !$candidate->member_institute_paralegals) ? 'checked="checked"' : ''!!}>
                                            <label for="member_institute_paralegals2"><span></span>No</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <strong class="fs-12 text-blue">Are  you a member of CILEx?</strong>
                                        <div class="m-top-10">
                                            <input class="alt-radio" type="radio" id="member_of_cilex1" value="1"
                                                   name="member_of_cilex"
                                                    {!! (is_numeric(old('member_of_cilex')) && old('member_of_cilex') == 1) || (!is_numeric(old('member_of_cilex')) && $candidate->member_of_cilex) ? 'checked="checked"' : ''!!}>
                                            <label for="member_of_cilex1"><span></span>Yes</label>

                                            <input class="alt-radio" type="radio" id="member_of_cilex2" value="0"
                                                   name="member_of_cilex"
                                                    {!! (is_numeric(old('member_of_cilex')) && old('member_of_cilex') == 0) || ( !is_numeric(old('member_of_cilex')) && !$candidate->member_of_cilex) ? 'checked="checked"' : ''!!}>
                                            <label for="member_of_cilex2"><span></span>No</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <strong class="fs-12 text-muted text-blue">Years of Experience?</strong>
                                        <input type="text" id="years_experience" name="years_experience" class="form-control"
                                               value="{{ old('years_experience', $candidate->years_experience) }}">
                                    </div>
                                    <div class="form-group m-top-20">
                                        <strong class="fs-12 text-muted text-blue">Top Skills</strong>
                                        <select data-title="Type / Select your top skills (12 max)"
                                                name="top_skills[]"
                                                class="form-control input-lg m-btm-4 custom-select-element" multiple>
                                            @foreach (\App\Models\TrainingSeat::orderby('name','asc')->get() as $topSkill)
                                                <option value="{{ $topSkill->id }}"
                                                        {!! ((is_array(old('training_seats')) && in_array($topSkill->id, old('training_seats'))) || (!old('training_seats') && in_array($topSkill->id, $candidate->trainingSeats->lists('id')->toArray())) ? 'selected="selected"' : '') !!}
                                                >{{ $topSkill->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="current-firm-question">
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
