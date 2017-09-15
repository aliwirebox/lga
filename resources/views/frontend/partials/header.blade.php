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
                     <li><a href="#">Jobs</a></li>
                     <li {{ (\Request::route() && \Request::route()->getName() == "contact-us") ? 'class=active' : '' }}><a href="/contact-us">Contact</a></li>
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
