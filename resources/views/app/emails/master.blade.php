<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <!-- This is a simple example template that you can edit to create your own custom templates -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- Facebook sharing information tags -->
        <meta property="og:title" content="*|MC:SUBJECT|*" />

        <title>{{ config('brand.identity.fullname') }}</title>
        <style>
            body {
                margin: 0px;
                font-family: Arial, Helvetica, sans-serif;
                background-color:#ecebe9;
                background-image: url( {{asset('img/email/bg.jpg')}} );
                background-repeat:repeat;
            }
            img  {
                border: 0px;
            }
            h1, h2, h3, h4, h5, h6, p {
                margin: 0px;
                padding: 0px;
            }

            .btn-success {
                color: #fff;
                background-color: #5cb85c;
                border-color: #4cae4c;
            }

            .btn-danger {
                color: #fff;
                background-color: #d9534f;
                border-color: #d43f3a;
            }

            .btn {
                margin-top: 5px;
                margin-bottom: 5px;
                display: inline-block;
                padding: 6px 12px;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.42857143;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                cursor: pointer;
                user-select: none;
                background-image: none;
                border: 1px solid transparent;
                border-radius: 4px;
                text-decoration:none;
            }
        </style>
        <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="#ecebe9" background="{{asset('img/email/bg.jpg')}}">
            <center>
                <div>
                    <!--code start-->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ecebe9" background="{{asset('img/email/bg.jpg')}}">
                        <tr>
                            <td align="center" valign="top">
                                <table width="640" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="left" valign="top" >
                                            <table width="640" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td align="left" valign="top"><a href="{{ url('/') }} "><img src="{{asset('img/email/banner.png')}}" alt="{{ config('brand.identity.fullname') }} - Professional. Discreet. Unique." style="display:block"/></a></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" height="20"><img src="{{asset('img/email/spacer.png')}}" width="20" height="20" style="display:block"/></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" bgcolor="#FFFFFF">
                                                        <table width="640" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td align="left" valign="top" height="30"><img src="{{asset('img/email/spacer.png')}}" width="30" height="30" style="display:block"/></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" valign="top">
                                                                    <table width="640" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr>
                                                                            <td align="left" valign="top" width="30"><img src="{{asset('img/email/spacer.png')}}" width="30" height="30" style="display:block"/></td>
                                                                            <td align="left" valign="top" width="580">
                                                                                <table width="580" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tr>
                                                                                        <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#424242">@yield('greeting')</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" valign="top" height="20"><img src="{{asset('img/email/spacer.png')}}" width="20" height="20" style="display:block"/></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#424242">@yield('content')</td>
                                                                                    </tr>
                                                                                    @yield('signature')
                                                                                    @yield('disclaimer')
                                                                                </table>
                                                                            </td>
                                                                            <td align="left" valign="top" width="30"><img src="{{asset('img/email/spacer.png')}}" width="30" height="30" style="display:block"/></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" valign="top" height="30"><img src="{{asset('img/email/spacer.png')}}" width="30" height="30" style="display:block"/></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" bgcolor="#FFFFFF">
                                                        <table width="640" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td align="left" valign="top">
                                                                    <table width="640" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr>
                                                                            <td align="left" valign="top" width="30"><img src="{{asset('img/email/spacer.png')}}" width="30" height="30" style="display:block"/></td>
                                                                            <td align="left" valign="top" width="580">
                                                                                <table width="580" border="0" cellspacing="0" cellpadding="0">
                                                                                    @include('app.emails.partials.support-signature')
                                                                                    @include('app.emails.partials.disclaimer')
                                                                                </table>
                                                                            </td>
                                                                            <td align="left" valign="top" width="30"><img src="{{asset('img/email/spacer.png')}}" width="30" height="30" style="display:block"/></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" valign="top" height="30"><img src="{{asset('img/email/spacer.png')}}" width="30" height="30" style="display:block"/></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--code end-->
                </div> 
            </center>
        </body>
</html>
