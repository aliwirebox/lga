@extends('app.master')

@section('title', 'Reset Password')

@section('content')
    
    <!-- Start Main Content -->
    <div class="container">
        <div class="col-md-8 col-md-offset-2 center-box-grey">
            <h1>Forgot Your Password?</h1>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @include('partials.errors')
            <p class="p-360">Enter your email address below and we'll send you instructions on how to change your password.</p>
            <div class="form-block">
                <i class="brand-sprite brand-mail brand-icon"></i>
                <form action="{{ url('password/email') }}" method="post">
                    {{ csrf_field() }}
                    <input name="email" type="email" class="form-control input-lg" placeholder="Email Address*">
                    <button class="btn btn-primary btn-lg btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
        
@endsection

