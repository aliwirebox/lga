@extends('app.emails.layout-candidate')

@section('content')
    <p>Thank you for using {{  config('brand.identity.domain')  }}. We hope the site assisted you with your search for an {{ config('brand.identity.initials')  }} position.</p>
    
    <br />
    
    <p>We are always looking to improve our service and would appreciate any feedback you may have regarding the site. If you have any feedback, please email us at <a href="{{  config('brand.email.info')  }}">{{  config('brand.email.info')  }}</a>.</p>

    <br />

    <p><strong>Do you know of any Trainees or {{ config('brand.identity.fullname') }} who could benefit from registering with {{  config('brand.identity.domain')  }}?</strong></p>
    
    <br />

    <p>If so, then you may be interested in our referral scheme: refer a Candidate to {{ config('brand.web.domain') }} and if they are successfully placed through the site you will receive a referral fee of £500.</p>

    <br />

    <p>Kind regards</p>

@endsection
