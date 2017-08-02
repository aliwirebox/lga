@extends('app.emails.layout-user')

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
    <li>First name: {{ $input['first_name'] }}</li>
    <li>Last name: {{ $input['last_name'] }}</li>
    <li>Email Address: {{ $input['email'] }}</li>
    <li>Telephone: {{ $input['telephone'] }}</li>
</ul>
@endsection
