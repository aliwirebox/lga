@if(session()->has('message'))
    <div class="col-md-12 col-lg-10 col-lg-offset-1" style="margin-top:10px">
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('message') }}
        </div>
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-dismissible alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
        <ul>
            <li>{!! session('success') !!}</li>
            
        </ul>
    </div>
@endif
