@extends('app.emails.layout-candidate')

@section('content')
    <p>Thank you for registering with {{  config('brand.identity.domain')  }}. Please click on the link below to activate your account:</p>

    <br>

    <p><a href="{{ url("email/verify/{$candidate->email_token}") }}">Activate Account</a></p>

    <br>

    <p>Once you have activated your account you will be able to upload your CV, build your Profile, set your Preferences and Go Live.</p>

    <br>

    <p>If you have any questions, please contact us by email at <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a> or call us on {{    config('brand.phones.mainspaced')  }}.</p>

    <br><br>

    <p><strong>Do you know of any Trainees or {{ config('brand.identity.fullname') }} who could benefit from registering with {{  config('brand.identity.domain')  }}?</strong></p>

    <br>

    <p>If so, then you may be interested in our referral scheme: refer a Candidate to {{ config('brand.web.domain') }} and if they are successfully placed through the site you will receive a referral fee/gift of £500.</p>

    <br>

    <p>Kind regards</p>

@endsection
