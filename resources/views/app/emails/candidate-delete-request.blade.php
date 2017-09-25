@extends('app.emails.layout-admin')

@section('content')
<p>
    {{ $candidate->getFullName() }} has requested to be deleted.
</p>
<ul>
    <li><strong>Ref:</strong> {{ $candidate->reference }}</li>
    <li><strong>Email:</strong> {{ $candidate->email }}</li>
    <li><strong>Telephone:</strong> {{ $candidate->telephone }}</li>
</ul>
@endsection
