@extends('app.emails.master')

@section('greeting')
    Dear {{ $firstName }},
@endsection

@section('content')

<p>
    Thank you for using Legal Asset, we hope you found the service to 
    be useful.
</p>
<br />
<p>
    We welcome any feedback you may have, please email us back at 
    <a herf="mailto:{{ config('brand.email.support') }}">
        {{ config('brand.email.support') }}
    </a> with your comments.
</p>
<br />
<p>
    If you know anyone who may benefit from using Legal Asset please let 
    them know, it is our mission to help our candidates find the ideal role.
</p>
<br />
<p>
    All the best for the future from the {{ config('brand.identity.fullname') }} Team.
</p>

@endsection

