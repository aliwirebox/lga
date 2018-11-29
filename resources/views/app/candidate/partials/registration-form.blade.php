@include('partials.errors')
@include('partials.success')
{!! Form::model($user, ['route' => 'candidate.register','autocomplete'=> 'off']) !!}
    {{csrf_field()}}
        
    <div class="form-group">
        <label>First Name*</label>
        {!! Form::text('first_name',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>Last Name*</label>
        {!! Form::text('last_name',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>Email (Personal)*</label>
        {!! Form::text('email',null,['class' => 'form-control', 'id' => 'email']) !!}
    </div>
    <div class="form-group" id="password-container">
        <label>Password (6 or more characters)*</label>
        {!! Form::password('password',['class' => 'form-control', 'id' => 'password', '']) !!}
    </div>
    <div class="form-group m-top-25">
        <div class="g-recaptcha" data-sitekey="6Les330UAAAAAAK0VImrurQl-tMnRSwqzKqBCI0S"></div>
        <button name="register-candidate" class="cta red">SIGN UP</button>
        <p>
            <small>
                By clicking on Register Now you accept {{ config('brand.identity.fullname') }}&rsquo;s <a href="{{url('pdf/terms-and-conditions.pdf')}}">Terms &amp; Conditions</a>, <a href="{{url('pdf/privacy-policy.pdf')}}">Privacy</a> and <a href="{{url('pdf/cookie-policy.pdf')}}">Cookie</a> Policy.
            </small>
        </p>
    </div>
    <div class="form-group m-top-20">
        <a href="{{ url('/auth/linkedin/candidate/login') }}" class="btn btn-default sign-in-linkedin" /></a>
    </div>
    @include('app.partials.registration-footer')
{!! Form::close() !!}
