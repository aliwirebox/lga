@include('partials.errors')
@include('partials.success')
<form method="POST" action="{{ route('candidate.register') }}" autocomplete="off">
    {{csrf_field()}}
        
    <div class="form-group">
        <label>First Name*</label>
        <input type="text" name="first_name" value="{{ old('first_name', isset($user) ? $user->first_name : '') }}" class="form-control">
    </div>
    <div class="form-group">
        <label>Last Name*</label>
        <input type="text" name="last_name" value="{{ old('last_name', isset($user) ? $user->last_name : '') }}" class="form-control">
    </div>
    <div class="form-group">
        <label>Email (Personal)*</label>
        <input type="text" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" class="form-control" id="email">
    </div>
    <div class="form-group" id="password-container">
        <label>Password (6 or more characters)*</label>
        <input type="password" name="password" class="form-control" id="password">
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
</form>
