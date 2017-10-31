@extends('app.emails.layout-admin')

@section('content')
<p>
    A user tried to register as a employer but can't find company "{{ $failedRegistration->add_law_firm }}"
    and would like it to be added.
</p>
<p>
    User details:
</p>
<ul>
    <li>First name: {{ $failedRegistration->first_name }}</li>
    <li>Last name: {{ $failedRegistration->last_name }}</li>
    <li>Email Address: {{ $failedRegistration->email }}</li>
    <li>Telephone: {{ $failedRegistration->telephone }}</li>
</ul>
<p>
    <a 
        class="btn btn-success" 
        href="{{ route('brand-admin.failed-hirer-registration.approve', $failedRegistration) }}" 
        role="button" 
    >
        Add Company and Approve Registration
    </a>
</p>
@endsection

