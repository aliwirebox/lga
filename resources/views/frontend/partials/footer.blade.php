<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-2">
                <ul class="footer-nav">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">How it Works</a>
                        <ul class="dropdown-menu">
                            <li><a href="/how-it-works/candidate">Candidate</a></li>
                            <li><a href="/how-it-works/employer">Employer</a></li>
                        </ul>
                    </li>
                    <li><a href="{{url('blog')}}">Blogs</a></li>
                    <!--HIDEJOBS<li><a href="#">Jobs</a></li>-->
                    <li><a href="{{url('contact-us')}}">Contact</a></li>
                    <li><a href="{{ url('logout') }}">Logout</a></li>
                </ul>
            </div>
            <div class="col-sm-2">                                          
                <ul class="footer-social">
                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="linkedin"><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <a href="/schedule-meeting" class="btn btn-default">Schedule a call</a>
            </div>
        </div>
        <div class="row contact-area">
            <ul class="footer-address">
            @foreach (config('brand.address') as $addressLine) 
                <li>{{ $addressLine }}</li>
            @endforeach
                <li>{{ config('brand.identity.companyno') }}</li>
            </ul>
            <p><a href="mailto:{{env('BRAND_SUPPORT_EMAIL')}}">{{env('BRAND_SUPPORT_EMAIL')}}</a></p>
            <p class="copy">&copy; All rights reserved {{config('brand.identity.legalname')}} {{ Carbon\Carbon::now()->format('Y') }}
        </div>
    </div>
</footer>
