@extends('app.emails.layout-candidate')

@section('content')
    <p>
        Your profile has been matched with a search run by {{ $search->lawFirm()->name }}, who have requested the release of your CV.
    </p>
    
    <br>
    
    <p>
        The vacancy details are as follows:
    </p>

    <ul>
        <li><strong>Location:</strong> {{ $search->vacancyLocation->name }}</li>
        <li><strong>Department:</strong> {{ $search->vacancyDepartment->name }}</li>
        <li><strong>Salary:</strong> to {{ $search->vacancy_salary }}k</li>
        <li><strong>Additional Info:</strong> {{ empty($search->vacancy_additional_information) ? 'N/A' : $search->vacancy_additional_information }}</li>
    </ul>

    <p>
        Please either authorise the release of your CV or decline the CV request:
    </p>
    <p>
        <a 
            class="btn btn-success" 
            href="{{ route('candidate.cv-requests-pending.email', ['id' => $search->id, 'status' => config('match.cv-pending')]) }}" 
            role="button" 
        >
            Release CV
        </a>
    </p>
    <p>
        <a 
            class="btn btn-danger" 
            href="{{ route('candidate.cv-requests-pending.email', ['id' => $search->id, 'status' => config('match.cv-rejected')]) }}" 
            role="button" 
        >
            Decline
        </a>
    </p>
    <p>
        Once you have authorised the release of your CV, {{ config('brand.web.domain') }} will send your CV to {{ $search->lawFirm()->name }} and 
        follow up within 72 hours to gain feedback.
    </p>

    <br>
    
    <p>
        If you have any questions, please call us on {{    config('brand.phones.mainspaced')  }} or email us at 
        <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a>.
    </p>
    
    <br>
    
    <p><strong>Do you know of any Trainees or {{ config('brand.identity.fullname') }} who could benefit from registering with {{  config('brand.identity.domain')  }}?</strong></p>

    <br>
    
    <p>
        If so, then you may be interested in our referral scheme: refer a Candidate to {{ config('brand.web.domain') }} and if they are successfully 
        placed through the site you will receive a referral fee/gift of £500.
    </p>

    <br>
    
    <p>Kind regards</p>

@endsection
