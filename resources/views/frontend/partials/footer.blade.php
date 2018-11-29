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
                     <li><a href="{{url('pricing')}}">Pricing</a></li>
                    <li><a href="{{url('blog')}}">Blog / Jobs</a></li>
                    <li><a href="{{url('contact-us')}}">Contact</a></li>
                    <li><a href="{{ url('logout') }}">Logout</a></li>
                </ul>
            </div>
            <div class="col-sm-2">                                          
                <ul class="footer-social">
                    <li class="youtube"><a target="_blank" href="https://www.youtube.com/channel/UCMe-x1mOJIT4khFu8GzBaUw"><i class="fa fa-youtube"></i></a></li>
                    <p>
                    <li class="linkedin"><a target="_blank" href="https://www.facebook.com/Legal-Asset-352161615229165/"><i class="fa fa-facebook"></i></a></li>
                    <p>
                    <li class="twitter"><a target="_blank" href="https://twitter.com/LegalAsset"><i class="fa fa-twitter"></i></a></li>
                    <p>
                    <li class="linkedin"><a target="_blank" href="https://www.linkedin.com/company/11160109/"><i class="fa fa-linkedin-square"></i></a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <a href="/schedule-meeting" class="cta cta-footer"><i class="fa fa-telephone"></i> Schedule a call</a>
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
