@extends('frontend.layout')

@section('title', 'Recruitment')
@section('seo_description', 'Where law firms find the best talent')
@section('seo_keywords', 'law, firms, solicitors, recruitment')

@section('content')
    
        <!-- Start Main Content -->
        <div class="container">
            <div class="col-xs-12">
                <div class="row">
                    <!-- Start Content -->
                    <div class="col-md-12 hirer">
                        <h1 class="fs-50 f-light fc-black">
                        YOU CAN BEGIN SEARCHING FOR PRE-EVALUATED MATCHING CANDIDATES FOR YOUR LEGAL ROLES WITHIN MINUTES.
                        </h1>
                        <p>
                        Your profile is completely anonymous and you can select which law firms and companies you
                        do not want to be matched with. We will never release your CV without your permission
                        and take your privacy seriously!
                        </p>
                        <ol>
                            <li>
                                <strong>Register</strong> &minus; it only takes a couple of minutes to find the ideal
                                candidate
                            </li>
                            <li>
                                <strong>Save Time</strong> &minus; Have the confidence in knowing candidates have matched
                                with you because they would be eager to work for you. You can save your search and will be
                                notified as soon as suitable candidates register.
                            </li>
                            <li>
                                <strong>Save Money</strong> &minus; We charge a fixed &pound;995 fee per hire regardless of the
                                candidate&rsquo;s salary. You also have a 30 day candidate guarantee.
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <p>{{ config('brand.identity.fullname') }}&rsquo;s technology makes sure every candidate that is matched with your role is actively
                        looking. We speak to all registrants to further understand their needs to save time.</p>
                    </div>
                    <div class="col-md-4">
                        <p>We are not a recruitment agency, our assistants are motivated by customer service and not by
                        commission.</p>
                        <p>As soon as you request a CV an email is sent to the candidate and we will call them to begin the
                        hiring process and will be on hand throughout.</p>
                    </div>
                    <div class="col-md-4">
                        <p>If you have a requirement for multiple hires please contact us.</p>
                        <p>Let us know if you are not on our list of employers and we will be happy to add you.</p>
                    </div>
                </div>
            </div>
            <p>It is time to disrupt legal recruitment. We feel we can bring technology and customer service together to
            provide transparency, save considerable time and money for our clients.</p>
            <p>Your testimonials help us to grow, if you feel we have provided a good service please get in touch so we can
            feature your comments on our site.</p>
        </div>
@endsection
