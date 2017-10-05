@extends('app.master')

@section('title', 'Login')

@section('content')
    <div class="row-fluid m-top-50">
        <div class="col-sm-8">
            <div class="col-xs-12">
                <h4>Sign in to your account</h4>
            </div>
            <div class="row-fluid">
                <div class="col-sm-12 m-top-30">
                    <div class="col-xs-12">
                        @include('partials.errors')
                        <div class="well-30">  
                            <form action="{{ url('login') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="login-box">
                                    <div class="form-group m-top-20">
                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email*" >
                                    </div>
                                    <div class="form-group m-top-20">
                                        <input type="password" class="form-control" name="password" placeholder="Password*">
                                    </div>
                                    <div class="form-group m-top-20">
                                        <input type="checkbox" name="remember" value="1"> Remember me?<br>
                                    </div>
                                    <div class="form-group m-top-20">
                                        <button type="submit" class="btn btn-primary">Sign In</button>
                                        <a href="{{ url('password/reset') }}"> Forgot Password</a>
                                    </div>
                                    <a href="{{ url('/auth/linkedin/candidate/login') }}" class="btn btn-default sign-in-linkedin" /></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
