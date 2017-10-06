@extends('app.emails.layout-hirer')

@section('content')

    <p>Welcome to {{  config('brand.identity.domain')  }}. Your account is now active and you can begin searching for second year Trainees and {{ config('brand.identity.initials')  }} Solicitor Candidates.</p>

    <br>

    <p>Candidates will only appear in your search results when:</p>

    <ul>
        <li>their Profile matches your ‘Candidate Filters’; and,</li>
        <li>their Preferences match your ‘Vacancy Details’.</li>
    </ul>

    <br>

    <p>When you request a Candidate’s CV, {{ config('brand.web.domain') }} will contact the Candidate by email and invite them to either accept or decline the request for their CV.</p>

    <br>

    <p>After a CV Request has been accepted we will send you a copy of the Candidate’s CV to the email address you used to register. If a CV Request is declined, we will also notify you by email.</p>

    <br>

    <p>When you have run a successful search and would like to refer to it again, you can create a ‘Saved Search’. The Saved Search function will continue to search the database on your behalf, and will notify you of any new matches when suitable Candidates register with the site.</p>

    <br>

    <p>Upon logging in as a Hirer you will be taken to your Dashboard, which provides a summary of your ‘Acitive Candidates’, outstanding ‘CV Requests’ and your ‘Saved Searches & Matches’.</p>

    <br>

    <p>We want to ensure that you are matched with the most suitable Candidates on {{  config('brand.identity.domain')  }}. Therefore, if you have any questions regarding best practice when using the site, please contact a member of our team, who will be happy to talk you through the site’s features and the matching process.</p>

    <br>

    <p>Please contact us by email at <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a> or call us on {{    config('brand.phones.mainspaced')  }}.</p>

    <br>

    <p>Kind regards</p>

@endsection
