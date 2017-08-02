@extends('app.emails.layout-user')

@section('content')
<p>
    Please follow the link to 
    <a href='{{ url("email/verify/{$user->email_token}") }}'>
        verify your email address
    </a>
</p>
@endsection


