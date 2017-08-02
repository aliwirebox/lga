@extends('app.emails.layout-admin')

@section('content')
<p>
    <strong>First name: </strong>{{ $input["first_name"] }}<br><br>
    <strong>Last name: </strong>{{ $input["last_name"] }}<br><br>
    <strong>Email: </strong>{{ $input["email"] }}<br><br>
    <strong>Message: </strong>{{ $input["email_body"] }}<br>
</p>
@endsection
