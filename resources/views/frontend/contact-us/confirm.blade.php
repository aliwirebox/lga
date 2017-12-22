@extends('frontend.layout')

@section('title', 'Contact Us')
@section('seo_description', 'Contact us')
@section('seo_keywords', 'contact us')

@section('content')
    
        <!-- Start Main Content -->
        <section class="central-text-block">
            <div class="container-fluid confirmation-text">
                <div class="container m-top-50">
                    <div class="col-md-12 text-center">
                        <p>Thank you for contacting us, we will aim to reply as soon as possible. </p>
                        <p>Alternatively you can call us during our opening hours on {{ config('brand.phones.mainspaced') }}.</p>
                    </div>
                </div>
            </div>
        </section>
@endsection
