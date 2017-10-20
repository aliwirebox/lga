@extends('app.master')

@section('title', 'CVs Requested')

@section('content')
    @include('app.hirer.partials.candidate-table', ['tableTitle' => 'CVs Requested'])
@endsection

@section('js')
    @parent
    <script type="text/javascript" charset="utf-8">
        var dataRoute = '{!! route('hirer.cv-requests.data') !!}';
    </script>
    <script src="{{ elixir('js/items-popup.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/candidate-profile-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/hirer-cv-requests-table.js') }}" type="text/javascript"></script>
@endsection
