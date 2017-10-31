@extends('app.emails.layout-admin')

@section('content')
<p>
    A user tried to register as a hirer for {{ $lawFirm->name }} which allows
    the following domains:
</p>
<ul>
    @foreach($lawFirm->domains as $domain)
        <li>{{ $domain->name }}</li>
    @endforeach
</ul>
<p>
    With the following details:
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
        Add Domain and Approve Registration
    </a>
</p>
@endsection
