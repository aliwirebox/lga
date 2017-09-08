@extends('app.master')

@section('title', 'Reset Password')

@section('content')
    
    <!-- Start Main Content -->
    <div class="container">
        <div class="col-md-8 col-md-offset-2 center-box-grey">
            <h1>Reset your password</h1>
            @include('partials.errors')
            <p class="p-360">Enter your new password below.</p>
            <div class="form-block">
                <i class="brand-sprite brand-mail brand-icon"></i>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">E-Mail Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button id="submit-password-reset" type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-refresh"></i>Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        
@endsection

