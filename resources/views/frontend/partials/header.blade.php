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
        <div class="col-sm-2">
            <div class="logo">
                <img src="{{asset('img/logo.jpg')}}" class="img-responsive" />
            </div>
        </div>
        <div class="col-sm-8">
            <div class="col-sm-12">
         <nav class="navbar">
             <div class="collapse navbar-collapse" id="myNavbar">
                 <ul class="nav navbar-nav">
                     <li {{ (\Request::route() && \Request::route()->getName() == "home") ? 'class=active' : '' }}><a href="{{ route('home')}}">Home</a></li>
                     <li><a href="#">How it Works</a></li>
                     <li {{ (\Request::route() && \Request::path() == "blog") ? 'class=active' : '' }}><a href="#">Blog</a></li>
                     <li><a href="#">Jobs</a></li>
                     <li {{ (\Request::route() && \Request::route()->getName() == "contact-us") ? 'class=active' : '' }}><a href="#">Contact</a></li>
                     <li><a href="{{url('login')}}">Sign In</a></li>
                     <li><a class="cta red" href="{{url('register')}}">Sign Up</a></li>
                 </ul>
             </div>     
         </nav>
     </div>     
        </div>
        
    </div>
</header>
<!-- Start Top Nav -->
<div class="container">
    
 </div>
