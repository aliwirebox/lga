<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
    </button>
</div>
<!-- Top Header -->
<header class="container-fluid bg-blue main-header">
    <div class="container">
        <div class="col-md-9 col-sm-8">
            <a href="{{ route('home') }}"><div class="nq-sprite top-logo"></div></a>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="login-box">
                @if(checkAuth())
                    <a href="{{ getUserHomeRoute() }}">
                        Go to Dashboard
                        <i class="nq-sprite nq-icon nq-user"></i>
                    </a>
                @else
                    <form action="{{ url('login')}}" method="POST">
                        {{csrf_field()}}
                        Sign in to your account
                        <i class="nq-sprite nq-icon nq-user"></i>
                        <div class="form-container">
                            <input type="text" class="form-control" name="email" placeholder="Email*">
                            <input type="password" class="form-control" name="password" placeholder="Password*">
                        </div>
                        <div class="form-controls">
                            <div class="section">
                                <input type="checkbox" name="remember" value="1"> Remember me?<br>
                                <a href="{{ url('password/reset')}}"><i class="nq-sprite nq-reset"></i> Forgot Password</a>
                            </div>
                            <div class="section">
                                <button name="login-button" type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</header>
<!-- Start Top Nav -->
<div class="container">
    <div class="col-sm-12">
         <nav class="navbar">
             <div class="collapse navbar-collapse" id="myNavbar">
                 <ul class="nav navbar-nav">
                     <li {{ (\Request::route() && \Request::route()->getName() == "home") ? 'class=active' : '' }}><a href="{{ route('home')}}">Home</a></li>
                     <li {{ (\Request::route() && \Request::path() == "about-us") ? 'class=active' : '' }}><a href="{{ url('about-us')}}">About Us</a></li>
                     <li {{ (\Request::route() && \Request::path() == "blog") ? 'class=active' : '' }}><a href="{{ url('blog')}}">Blog</a></li>
                     <li {{ (\Request::route() && \Request::path() == "candidate-faqs") ? 'class=active' : '' }}><a href="{{ url('candidate-faqs')}}">FAQs</a></li>
                     <li {{ (\Request::route() && \Request::route()->getName() == "contact-us") ? 'class=active' : '' }}><a href="{{ route('contact-us')}}">Contact Us</a></li>
                 </ul>
             </div>     
         </nav>
     </div>     
 </div>
