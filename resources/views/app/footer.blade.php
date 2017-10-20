<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-2">
                <ul class="footer-nav">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">How it Works<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/how-it-works/candidate">Candidate</a></li>
                            <li><a href="/how-it-works/employer">Employer</a></li>
                        </ul>
                    </li>
                    <li><a href="{{url('blog')}}">Blogs</a></li>
<!--                    HIDEJOBS<li><a href="#">Jobs</a></li>-->
                    <li><a href="{{url('contact-us')}}">Contact</a></li>
                    <li><a href="{{ url('logout') }}">Logout</a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <ul class="footer-social">
                    <li class="linkedin"><a target="_blank" href="https://www.facebook.com/Legal-Asset-352161615229165/"><i class="fa fa-facebook"></i></a></li>
                    <li class="twitter"><a target="_blank" href="https://twitter.com/LegalAsset"><i class="fa fa-twitter"></i></a></li>
                    <li class="linkedin"><a target="_blank" href="https://www.linkedin.com/company/11160109/"><i class="fa fa-linkedin-square"></i></a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <a href="/schedule-meeting" class="btn btn-default">Schedule a call</a>
            </div>
        </div>
    </div>
</footer>