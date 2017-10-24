<tr class="footer-signature-support">
    <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color: #424242;">
        <p style="font-size:13px;"><strong><span style="color: #c2000b">Support</span> <span>&#124;</span> <a href="{{ config('brand.social.calendly.url') }}" style="text-decoration: none"><span style="color: #6c5d54">Legal<span style="color: #c2000b">Asset</span></span></a></strong></p>
        <br />
        <p>
            <strong>T:</strong> {{    config('brand.phones.placeholder')  }}
            <span>&#124;</span>
            <strong>E:</strong> <a href="mailto:{{  config('brand.email.support')  }}">{{  config('brand.email.support')  }}</a>
        </p>
        <br />
        <p>
            <a href="{{ config('brand.web.domain') }}">{{ config('brand.web.domain') }}</a>
            <span>&#124;</span>
            <a href="{{ config('brand.social.twitter.url') }}">Twitter</a>
            <span>&#124;</span>
            <a href="{{ config('brand.social.linkedin.url') }}">LinkedIn</a>
            <span>&#124;</span>
            <a href="{{ config('brand.social.facebook.url') }}">Facebook</a>
        </p>
    </td>
</tr>
<tr>
    <td align="left" valign="top">
        <img style="padding-top: 15px;" src="{{ (Request::isSecure() == false) ? asset('img/email/logo_banner.jpg') : secure_asset('img/email/logo_banner.jpg') }}" /> 
    </td>
</tr>
