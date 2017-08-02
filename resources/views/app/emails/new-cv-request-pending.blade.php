@extends('app.emails.layout-admin')

@section('content')
<p>
    {{ $candidate->getFullName() }} has accepted a request from {{ $search->hirer->getFullName() }} at {{ $search->hirer->lawFirm->name }}.
</p>
@endsection

