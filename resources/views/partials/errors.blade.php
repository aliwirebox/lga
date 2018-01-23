@if (isset($warnings) && (count($warnings) > 0))
    <div class="alert alert-dismissible alert-warning">
        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
        <ul>
            @foreach ($warnings->all() as $warning)
                <li>{{ $warning }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('warning'))
    <div class="alert alert-dismissible alert-warning">
        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
        <ul>
                <li>{!! session('warning') !!}</li>
            
        </ul>
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-dismissible alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-dismissible alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
        <ul>
                <li>{!! session('error') !!}</li>
            
        </ul>
    </div>
@endif
