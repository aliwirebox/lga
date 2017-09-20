@extends('app.emails.layout-user')

@section('content')
<p>
    A user tried to register as a hirer but can't find law firm "{{ $input['add_law_firm'] }}"
    and would like it to be added.
</p>
<p>
    User details:
</p>
<ul>
    <li>First name: {{ $input['first_name'] }}</li>
    <li>Last name: {{ $input['last_name'] }}</li>
    <li>Email Address: {{ $input['email'] }}</li>
    <li>Telephone: {{ $input['telephone'] }}</li>
</ul>
@endsection

