@extends('app.master')

@section('title', 'Acitive Candidates')

@section('content')
    @include('app.hirer.partials.candidate-table', ['tableTitle' => 'Acitive Candidates'])
@endsection

@section('js')
    @parent
    <script type="text/javascript" charset="utf-8">
        var dataRoute = '{!! route('hirer.live-candidates.data') !!}';
    </script>
    <script src="{{ elixir('js/items-popup.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/candidate-profile-table.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/hirer-live-candidate-table.js') }}" type="text/javascript"></script>
@endsection
