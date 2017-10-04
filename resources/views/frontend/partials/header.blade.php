<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
    </button>
</div>
<!-- Top Header -->
<header class="container-fluid main-header">
    <div class="container">
        <div class="col-sm-2 col-xs-6 col-sm-offset-0 col-xs-offset-3">
            <div class="logo">
                <a href="{{url('/')}}"><img src="{{asset('img/logo.png')}}" class="img-responsive" /></a>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="col-sm-12">
         <nav class="navbar">
             <div class="collapse navbar-collapse" id="myNavbar">
                 <ul class="nav navbar-nav">
                    <li {{ (\Request::route() && \Request::route()->getName() == "home") ? 'class=active' : '' }}><a href="{{ route('home')}}">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">How it Works<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/how-it-works/candidate">Candidate</a>
                            </li>
                            <li>
                                <a href="/how-it-works/employer">Employer</a>
                            </li>
                        </ul>
                    </li>
                    <li {{ (\Request::route() && \Request::path() == "blog") ? 'class=active' : '' }}><a href="/blog">Blog</a></li>
                    <!--HIDEJOBS<li><a href="#">Jobs</a></li>-->
                    <li {{ (\Request::route() && \Request::route()->getName() == "contact-us") ? 'class=active' : '' }}><a href="/contact-us">Contact</a></li>
                    @if (getGuard() == 'candidates')
                        <li><a class="cta red"  href="{{url('candidate/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    @elseif (getGuard() == 'hirers')
                        <li><a class="cta red"  href="{{url('hirer/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    @elseif (getGuard() == 'brand_admins')
                        <li><a class="cta red" href="{{url('brand-admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    @else
                         <li><a class="cta red" href="{{url('register')}}">Sign Up</a></li>
                    @endif                     
                                
                     
                 </ul>
             </div>     
         </nav>
     </div>     
        </div>
        @if(!getGuard())
            <a class="sign-in header-cta" href="{{url('login')}}"><i class="fa fa-lock"></i>  Sign In</a>
        @else
            <a class="logout header-cta" href="{{url('logout')}}"><i class="fa fa-sign-out"></i>  Logout</a>
        @endif
    </div>
</header>
<!-- Start Top Nav -->
<div class="container">
    
 </div>
