@extends('app.emails.layout-candidate')
@section('greetingTerm', 'Dear')
@section('content')
    <p>
        An employer is interested in your profile and has requested your CV. Employers can only request your CV if they match your requirements.</p>
    
    <br>
    
    <p>
    Employer details:    
    </p>

    <ul>
        <li>{{ $search->lawFirm()->name }}</li>
        <li>{{ $search->vacancyDepartment->name }}</li>
        <li>{{ $search->vacancy_salary }}k</li>
        <li>{{ $search->vacancyLocation->name }}</li>
    </ul>

    <p>
        To confirm release of your CV, <a href="{{ route('candidate.cv-requests-pending.email', ['id' => $search->id, 'status' => config('match.cv-pending')]) }}">Click here</a>
    </p>
    <p>
        If you have any questions regarding this position please call or email us. We will also be in touch within 24 hours to discuss this role with you.
    </p>

    <p>
        To book a call from us, <a href="{{ route('frontend.schedule-meeting') }}">click here</a>.
    </p>
    
@endsection
