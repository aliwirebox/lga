@extends('app.master')

@section('title', 'Reset Password')

@section('content')
    
    <!-- Start Main Content -->
    <div class="container-fluid">
        <div class="col-md-6">
            <h4>Forgot Your Password?</h4>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @include('partials.errors')
            <p class="p-360">Enter your email address and we will send you instructions to reset your password.</p>
            <div class="form-block">
                <form action="{{ url('password/email') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-8">
                            <input name="email" type="email" class="form-control input-lg" placeholder="Email Address*">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 m-top-25">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        
@endsection

