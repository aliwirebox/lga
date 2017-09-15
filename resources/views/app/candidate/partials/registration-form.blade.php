<form action="{{ route('candidate.register') }}" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <label>First Name*</label>
        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
    </div>
    <div class="form-group">
        <label>Last Name*</label>
        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
    </div>
    <div class="form-group">
        <label>Email (Personal)*</label>
        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
    </div>
    <div class="form-group">
        <label>Password (6 or more characters)*</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group m-top-25">
        <button name="register-candidate" class="cta red">Register Now</button>
    </div>
    @include('app.partials.registration-footer')
</form>
