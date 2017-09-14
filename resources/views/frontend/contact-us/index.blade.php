@extends('frontend.layout')

@section('title', 'Contact Us')
@section('seo_description', 'Contact us')
@section('seo_keywords', 'contact us')

@section('content')

    <!-- Start Main Content -->
    <div class="container-fluid">
        <div class="container m-top-50">
            <div class="col-md-6">
                <h1 class="fs-24 ucwords f-book" style="margin-top:0;">Use The Contact Us Form Opposite<br>
                    <span class="fs-23">Or Write To Us At:</span></h1>
                <ul class="list-items big-margin text-blue m-top-20">
                    <li><i class="brand-sprite brand-icon brand-pin blue"></i> {{ config('brand.identity.legalname') }}<br>
                        @foreach(config('brand.address') as $line)
                    {{ $line }}<br />
                @endforeach
                    </li>
                    <li><i class="brand-sprite brand-icon brand-pointer blue"></i> <a class=""
                                                                             href="mailto:{{  config('brand.email.info')  }}"><strong>{{  config('brand.email.info')  }}</strong></a></li>
                    <li><i class="brand-sprite brand-icon brand-phone blue"></i> <a class="" href="tel:{{ config('brand.phones.main') }}"><strong>{{  config('brand.phones.mainspaced')  }}</strong></a></li>
                    <li><i class="brand-sprite brand-icon brand-time blue"></i><strong> {{  config('brand.opening.string')  }}</strong></li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="right-form-block col-sm-m-top-30">

                    <div class="form-block-inner">
                        <h4 class="form-title">Contact Us Now</h4>
                        @include('partials.errors')
                        <form action="{{ route('frontend.contact-us')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>First Name*</label>
                                <input type="text" class="form-control" name="first_name">
                            </div>
                            <div class="form-group">
                                <label>Last Name*</label>
                                <input type="text" class="form-control" name="last_name">
                            </div>
                            <div class="form-group">
                                <label>Email*</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>How Can We Help*</label>
                                <textarea class="form-control" name="email_body"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
