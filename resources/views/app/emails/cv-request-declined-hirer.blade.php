@extends('app.emails.layout-hirer')

@section('content')

    <p>Candidate {{ $candidate->reference }} has declined your CV Request for the following Vacancy/Saved Search:</p>

    <br>

    <p><strong>Saved Search:</strong> {{ empty($search->name) ? 'N/A' : $search->name }}</p>

    <p>
        <ul>
            <li><strong>Location:</strong> {{ $search->vacancyLocation->name }}</li>
            <li><strong>Department:</strong> {{ $search->vacancyDepartment->name }}</li>
            <li><strong>Salary:</strong> to {{ $search->vacancy_salary }}k</li>
            <li><strong>Additional Info:</strong> {{ empty($search->vacancy_additional_information) ? 'N/A' : $search->vacancy_additional_information }}</li>
        </ul>
    </p>

    <p>If you have any questions, please contact us by email at <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a> or call us on {{    config('brand.phones.mainspaced')  }}.</p>

    <br>

    <p>Kind regards</p>

@endsection
