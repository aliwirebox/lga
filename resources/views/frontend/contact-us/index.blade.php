@extends('frontend.layout')
@section('title', 'Contact Us')
@section('seo_description', 'Contact us')
@section('seo_keywords', 'contact us')
@section('content')
<section class="contact">
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2>
                        CONTRACT TALENT <br>
                        AT YOUR FINGERTIPS <br>
                        CONTACT US NOW
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero mollitia beatae sit rerum, tenetur est dolores eligendi aliquam ducimus architecto aperiam, facilis aliquid praesentium voluptas totam, earum? Consequuntur, minus, reprehenderit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi officia perspiciatis laborum obcaecati reprehenderit, consequuntur dolor dicta iste sequi eos inventore consectetur tenetur odio, suscipit eius ipsa, exercitationem non odit.
                </p>
            </div>
            <div class="col-sm-5 col-sm-offset-1">
                <div class="contact-column">
                    <i class="fa fa-clock-o"></i>
                    <h3>Opening Times</h3>
                    Monday - Friday: 09:00 - 18:30 <br>
                    Saturday 10:00 - 16:00
                </div>
            </div>
            <div class="col-sm-5">
                <div class="contact-column">
                    <i class="fa fa-envelope"></i>
                    <h3>Opening Times</h3>
                    Monday - Friday: 09:00 - 18:30 <br>
                    Saturday 10:00 - 16:00
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                @include('partials.errors')
                <form action="{{ route('frontend.contact-us')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name*</label>
                                <input type="text" class="form-control" name="first_name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name <sup>*</sup> </label>
                                <input type="text" class="form-control" name="last_name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email*</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Message <sup>*</sup> </label>
                        <textarea class="form-control" name="email_body"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg btn-block">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="full-width-centered">
        <h3>
            Ring us on: <span>0800 356 99 120</span> <br>
            Monday - Friday: 09:00 - 18:30  Saturday: 10:00 - 16:00 
        </h3>
    </div>
</section>

@endsection