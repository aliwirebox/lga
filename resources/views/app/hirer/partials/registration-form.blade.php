@section('css')
    @parent
    <link href="{{asset('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
@stop

<form action="{{ route('hirer.register') }}" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <label>Name*:</label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label class="block-label">E-mail*:</label>
        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
    </div>
    <div class="form-group">
        <label>Password*:</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group m-top-25">
        <button name="register-hirer" class="cta red">Sign Up</button>
    </div>
    @include('app.partials.registration-footer')
</form>

@section('js')
    @parent

    <script src="{{asset('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ elixir('js/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ elixir('js/hirer-registration-form.js') }}" type="text/javascript"></script>
@endsection
