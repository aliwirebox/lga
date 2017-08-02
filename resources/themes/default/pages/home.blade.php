@extends('quarx-frontend::layout.master')

@section('content')

    @if (isset($page))
        {!! $page->entry !!}
    @else
        <div class="col-xs-12">
            <div class="row">
                <!-- Start Content -->
                <div class="col-md-7 hirer">
                    <h1 class="fs-50 f-light fc-black">WHERE LAW FIRMS FIND THE BEST TALENT</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                    <a class="btn btn-primary book-bold">About the Service</a>
                </div>
                <!-- Start Registration -->
                <div class="col-md-5">
                    <div class="form-tabs col-sm-m-top-30"> 
                        <ul class="nav nav-tabs" role="tablist"> 
                            <li role="presentation" class="active">
                                <a href="#candidate" id="candidate-tab" role="tab" data-toggle="tab" aria-controls="candidate" aria-expanded="true">Candidate <span class="hidden-xs">Registration</span> <i class="nq-sprite nq-icon nq-lg-user"></i></a>
                            </li> 
                            <li role="presentation">
                                <a href="#hirer" role="tab" id="hirer-tab" data-toggle="tab" aria-controls="hirer">Hirer <span class="hidden-xs">Registration</span> <i class="nq-sprite nq-icon nq-lg-hirer"></i></a>
                            </li> 
                        </ul> 
                        <div id="signupTabContent" class="tab-content"> 
                            <div role="tabpanel" class="tab-pane fade in active" id="candidate" aria-labelledby="candidate-tab"> 
                                <h4 class="tab-title">Start Building Your Profile</h4>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>First Name*</label>
                                        <input type="text" class="form-control" name="first_name">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name*</label>
                                        <input type="text" class="form-control" name="first_name">
                                        </div>
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="text" class="form-control" name="first_name">
                                        </div>
                                    <div class="form-group">
                                        <label>Password (6 or more characters)*</label>
                                        <input type="text" class="form-control" name="first_name">
                                    </div>
                                    <div class="form-group m-top-25">
                                        <button class="btn btn-primary btn-lg btn-block">Register Now</button>
                                    </div>
                                    <p class="footer-text"><span>By clicking Register Now, you agree to NQ Solicitors's</span><span>User Agreement, Privacy Policy, and Cookie Policy</span>
                                </form>
                            </div> 
                            <div role="tabpanel" class="tab-pane fade" id="hirer" aria-labelledby="hirer-tab"> 
                                <h4 class="tab-title">Start Searching For NQs</h4>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>First Name*</label>
                                        <input type="text" class="form-control" name="first_name">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name*</label>
                                        <input type="text" class="form-control" name="first_name">
                                        </div>
                                    <div class="form-group">
                                        <label>Company*</label>
                                        <input type="text" class="form-control" name="first_name">
                                        </div>
                                    <div class="form-group">
                                        <label class="block-label">Email* <span class="notice">Must be associated with company above.</span></label>
                                        <input type="text" class="form-control" name="first_name">
                                        </div>
                                    <div class="form-group">
                                        <label>Password (6 or more characters)*</label>
                                        <input type="text" class="form-control" name="first_name">
                                    </div>
                                    <div class="form-group m-top-25">
                                        <button class="btn btn-primary btn-lg btn-block">Register Now</button>
                                    </div>
                                    <p class="footer-text"><span>By clicking Register Now, you agree to NQ Solicitors's</span><span>User Agreement, Privacy Policy, and Cookie Policy</span>
                                </form>
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('quarx')
    @if (isset($page))
        @edit('pages', $page->id)
    @endif
@endsection
