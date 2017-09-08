@extends('app.emails.layout-candidate')

@section('content')

    <p>Welcome to {{  config('brand.identity.domain')  }}. Your anonymous Candidate Profile is now active and can be found by Hirers that match your Preferences.</p>

    <br>

    <p>Your CV is NOT available to view online, however you will be able to authorise the release of your CV to specific Hirers when it has been requested.</p>

    <br>

    <p>When a Hirer requests your CV, a notification will be sent to the email address you used to register.</p>

    <br>

    <p>It is essential that you keep your Profile up to date to maximise the chance of being found by Hirers that match your Preferences. For example, if you have recently commenced a new training seat, it is important that this is reflected in your Profile.</p>

    <br>

    <p>The number of times you are matched with Hirers will depend, to a large extent, on how broad or narrow your Preferences are. You can change your Preferences at any time by logging in and clicking on ‘My Profile & Preferences’ in the left hand menu.</p>

    <br>

    <p>When you log in as an active Candidate you will be taken to your Dashboard, which provides a summary of recent activity relating to your CV Requests and Live Vacancies.</p>

    <br>

    <p>The blog section of our website will offer market updates and other useful information for Trainees and {{ config('brand.identity.fullname') }}. Please feel free to share these articles on social media and to follow us on
        <a href="{{  config('brand.social.linkedin.url')  }}" target="_blank">LinkedIn</a> and
        <a href="{{  config('brand.social.twitter.url')  }}" target="_blank">Twitter</a>.
    </p>

    <br><br>

    <p><strong>Do you know of any Trainees or {{ config('brand.identity.fullname') }} who could benefit from registering with {{  config('brand.identity.domain')  }}?</strong></p>

    <br>

    <p>If so, then you may be interested in our referral scheme: refer a Candidate to {{ config('brand.web.domain') }} and if they are successfully placed through the site you will receive a referral fee/gift of £500.</p>

    <br>

    <p>Kind regards</p>

@endsection
