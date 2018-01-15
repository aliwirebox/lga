@section('css')
    @parent
    <link href="{{asset('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
@stop

<form action="{{ route('hirer.register') }}" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <label>First Name*</label>
        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
    </div>
    <div class="form-group">
        <label>Last Name*</label>
        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
    </div>
    <div id="select-company" class="form-group">
        <label>Company*</label>
        <div class="row">
            <div class="col-md-6">
                <select name="law_firm_id" class="form-control company-select">
                    <option value=""></option>
                    @foreach($lawFirmList as $lawFirm) 
                        <option 
                            {{ old('law_firm_id') == $lawFirm->id ? 'selected="selected"' : '' }}
                            value="{{ $lawFirm->id }}"
                        >{{ $lawFirm->name }}</option>
                    @endForeach
                </select>
            </div>
            <div class="col-md-6">
                <button id="toggle-company" class="btn btn-default">Can't find company?</button>
            </div>
        </div>
    </div>
    <div id="add-company" class="form-group collapse">
        <label>Add Company*</label>
        <input type="text" class="form-control" name="add_law_firm" value="{{ old('unknown_company') }}">
    </div>
    <div class="form-group">
        <label class="block-label">Email* <span class="notice">Must be associated with company above.</span></label>
        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
    </div>
    <div class="form-group">
        <label class="block-label">Telephone*</label>
        <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}">
    </div>
    <div class="form-group">
        <label>Password (6 or more characters)*</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group m-top-25">
        <button name="register-hirer" class="cta red">Sign Up</button>
        <p>
            <small>
                By clicking on Register Now you accept {{ config('brand.identity.fullname') }}&rsquo;s <a href="{{url('files/terms-and-conditions.pdf')}}">Terms &amp; Conditions</a>, <a href="{{url('files/privacy-policy.pdf')}}">Privacy</a> and <a href="{{url('files/cookie-policy.pdf')}}">Cookie</a> Policy.
            </small>
        </p>
    </div>
    @include('app.partials.registration-footer')
</form>

@section('js')
    @parent
    <script src="{{asset('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ elixir('js/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/hirer-registration-form.js') }}" type="text/javascript"></script>
@endsection
