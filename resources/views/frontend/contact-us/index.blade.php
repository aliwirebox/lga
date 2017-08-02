@extends('frontend.layout')

@section('title', 'Contact Us')
@section('seo_description', 'Contact us')
@section('seo_keywords', 'contact us')

@section('content')

    <!-- Start Main Content -->
    <div class="container-fluid">
        <div class="container m-top-50">
            <div class="col-md-3">
                <h1 class="fs-24 ucwords f-book" style="margin-top:0;">Use The Contact Us Form Opposite<br>
                    <span class="fs-23">Or Write To Us At:</span></h1>
                <ul class="list-items big-margin text-blue m-top-20">
                    <li><i class="nq-sprite nq-icon nq-pin blue"></i> NQ Recruitment Ltd<br>
                        Central Court<br>
                        25 Southampton Buildings<br>
                        London, WC2A 1AL
                    </li>
                    <li><i class="nq-sprite nq-icon nq-pointer blue"></i> <a class=""
                                                                             href="mailto:info@NQSolicitors.com"><strong>info@NQSolicitors
                                .com</strong></a></li>
                    <li><i class="nq-sprite nq-icon nq-phone blue"></i> <a class="" href="tel:02037099165"><strong>020 3709 9165</strong></a></li>
                    <li><i class="nq-sprite nq-icon nq-time blue"></i><strong> Mon - Fri (09:00 - 20:00)<br>Sat (10:00 -
                            17:00)</strong></li>
                </ul>
            </div>
            <div class="col-md-5">

                <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCHKMVjZdU71laDz65Abw74UGyYQS-4Wdg'></script>

                <div style='overflow:hidden;height:390px;width:100%;'>
                    <div id='gmap_canvas' style='height:440px;width:700px;'></div>
                    <div></div>
                    <div></div>
                    <style>#gmap_canvas img {
                            max-width: none !important;
                            background: none !important
                        }</style>
                </div>
                <script type='text/javascript'>function init_map() {
                        var myOptions = {
                            zoom: 15,
                            center: new google.maps.LatLng(51.51759167851225, -0.10931103331301983),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                        marker = new google.maps.Marker({
                            map: map,
                            position: new google.maps.LatLng(51.5171911, -0.11201470000003155)
                        });
                        infowindow = new google.maps.InfoWindow({content: '<strong>NQ Solicitors</strong>'});
                        google.maps.event.addListener(marker, 'click', function () {
                            infowindow.open(map, marker);
                        });
                        infowindow.open(map, marker);
                    }
                    google.maps.event.addDomListener(window, 'load', init_map);</script>

            </div>
            <div class="col-md-4">
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
