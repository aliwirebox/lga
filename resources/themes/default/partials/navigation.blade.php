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
            <div class="brand-sprite top-logo"></div>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="login-box">
                Sign in to your account
                <i class="brand-sprite brand-icon brand-user"></i>
                <div class="form-container">
                    <input type="text" class="form-control" name="username" placeholder="Username*">
                    <input type="password" class="form-control" name="password" placeholder="Password*">
                </div>
                <div class="form-controls">
                    <div class="section">
                        <input type="checkbox" name="remember" value="1"> Remember me?<br>
                        <a href=""><i class="brand-sprite brand-reset"></i> Forgot Password</a>
                    </div>
                    <div class="section">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </div>
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
                   <li><a href="{{ route('home') }}">Home</a></li>
                   <li><a href="{{ url('about-us') }}">About Us</a></li>
                   <li class="active"><a href="{{ url('blog') }}">Blog</a></li>
                   <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
                </ul>
            </div>     
        </nav>
    </div>     
</div>
