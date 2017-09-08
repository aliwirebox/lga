        <!-- Start Footer -->
        <div class="clearfix"></div>
        <footer class="footer">
            <div class="container p-rel">
                <div class="col-md-9 col-sm-8">
                    <ul class="footer-items">
                        <li><i class="brand-sprite brand-icon brand-phone"></i> <a class="footer-telephone" href="tel:{{ config('brand.phones.mainspaced') }}"><strong>{{    config('brand.phones.mainspaced')  }}</strong></a><a class="footer-telephone-ie"><strong>{{    config('brand.phones.mainspaced')  }}</strong></a></li>
                        <li><i class="brand-sprite brand-icon brand-pointer"></i> <a class="footer-email" href="mailto:{{  config('brand.email.info')  }}"><strong>{{  config('brand.email.info')  }}</strong></a></li>
                        <li>
                            <i class="brand-sprite brand-icon brand-pin"></i> {{  config('brand.identity.legalname')  }}<br>
                            @foreach(config('brand.address') as $line)
                            {{ $line }}<br />
                            @endforeach
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-4 text-right col-sm-cen">
                    <a href="{{  config('brand.social.twitter.url')  }}" target="_blank" class="brand-sprite brand-social brand-twitter m-right-7 m-left-7"></a>
                    <a href="{{  config('brand.social.linkedin.url')  }}" target="_blank" class="brand-sprite brand-social brand-linkedin"></a>
                    <div class="footer-right-foot col-sm-cen">
                        <p>All rights reserved {{ Carbon\Carbon::now()->format('Y') }} {{  config('brand.identity.legalname')  }}</p>
                        <p>Company No. {{ config('brand.identity.companyno') }}</p>
                    </div>
                </div>
            </div>
        </footer>
