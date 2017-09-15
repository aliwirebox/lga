<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('seo_description')">
        <meta name="keywords" content="@yield('seo_keywords')">

        <title>{{ config('brand.identity.fullname') }} - @yield('title')</title>

        <!-- icons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/img/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/img/icons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/img/icons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/img/icons/manifest.json">
        <link rel="mask-icon" href="/img/icons/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="/img/icons/favicon.ico">
        <meta name="msapplication-config" content="/img/icons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
        
        <!-- facebook card -->
        <meta property="og:site_name" content="{{ config('brand.identity.fullname') }}" />
        <meta property="og:url" content="{{ \Request::url() }}" />
        <meta property="og:title" content="@yield('title')" />
        <meta property="og:description" content="@yield('seo_description')" />
        <meta property="og:image" content="{{ asset('img/social-card.jpg') }}" />

        <!-- twitter card -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="{{ config('brand.social.twitter.tag') }}">
        <meta name="twitter:title" content="@yield('title')">
        <meta name="twitter:description" content="@yield('seo_description')">
        <meta name="twitter:image:src" content="{{ asset('img/social-card.jpg') }}">

        @section('css')
            <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ elixir('css/main.css') }}">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        @show

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="{{asset('bower_components/html5shiv/dist/html5shiv.min.js')}}"></script>
            <script src="{{asset('bower_components/respond/dest/respond.min.js')}}"></script>
        <![endif]-->

    <!--[if lte IE 9]>
    <style type="text/css">
    .footer-telephone {
        display: none;
    }
    .footer-telephone-ie {
        display: block;
    }
    </style>
    <![endif]-->
    </head>
    <body>
        @yield('body')

        <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                            (i[r].q = i[r].q || []).push(arguments)
                        }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', '{{ config('google.analytics') }}', 'auto');
            ga('send', 'pageview');
        </script>

        @section('js')
            <script src="{{ elixir('js/main.scripts.js') }}" type="text/javascript"></script>
        @show

        <!-- IE9 placeholder-->
        <script>
        !function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e("object"==typeof module&&module.exports?require("jquery"):jQuery)}(function(e){function t(t){var a={},l=/^jQuery\d+$/;return e.each(t.attributes,function(e,t){t.specified&&!l.test(t.name)&&(a[t.name]=t.value)}),a}function a(t,a){var l=this,o=e(this);if(l.value===o.attr(c?"placeholder-x":"placeholder")&&o.hasClass(h.customClass))if(l.value="",o.removeClass(h.customClass),o.data("placeholder-password")){if(o=o.hide().nextAll('input[type="password"]:first').show().attr("id",o.removeAttr("id").data("placeholder-id")),t===!0)return o[0].value=a,a;o.focus()}else l==r()&&l.select()}function l(l){var r,o=this,d=e(this),s=o.id;if(!l||"blur"!==l.type||!d.hasClass(h.customClass))if(""===o.value){if("password"===o.type){if(!d.data("placeholder-textinput")){try{r=d.clone().prop({type:"text"})}catch(n){r=e("<input>").attr(e.extend(t(this),{type:"text"}))}r.removeAttr("name").data({"placeholder-enabled":!0,"placeholder-password":d,"placeholder-id":s}).bind("focus.placeholder",a),d.data({"placeholder-textinput":r,"placeholder-id":s}).before(r)}o.value="",d=d.removeAttr("id").hide().prevAll('input[type="text"]:first').attr("id",d.data("placeholder-id")).show()}else{var i=d.data("placeholder-password");i&&(i[0].value="",d.attr("id",d.data("placeholder-id")).show().nextAll('input[type="password"]:last').hide().removeAttr("id"))}d.addClass(h.customClass),d[0].value=d.attr(c?"placeholder-x":"placeholder")}else d.removeClass(h.customClass)}function r(){try{return document.activeElement}catch(e){}}var o,d,c=!1,s="[object OperaMini]"===Object.prototype.toString.call(window.operamini),n="placeholder"in document.createElement("input")&&!s&&!c,i="placeholder"in document.createElement("textarea")&&!s&&!c,u=e.valHooks,p=e.propHooks,h={};n&&i?(d=e.fn.placeholder=function(){return this},d.input=!0,d.textarea=!0):(d=e.fn.placeholder=function(t){var r={customClass:"placeholder"};return h=e.extend({},r,t),this.filter((n?"textarea":":input")+"["+(c?"placeholder-x":"placeholder")+"]").not("."+h.customClass).not(":radio, :checkbox, [type=hidden]").bind({"focus.placeholder":a,"blur.placeholder":l}).data("placeholder-enabled",!0).trigger("blur.placeholder")},d.input=n,d.textarea=i,o={get:function(t){var a=e(t),l=a.data("placeholder-password");return l?l[0].value:a.data("placeholder-enabled")&&a.hasClass(h.customClass)?"":t.value},set:function(t,o){var d,c,s=e(t);return""!==o&&(d=s.data("placeholder-textinput"),c=s.data("placeholder-password"),d?(a.call(d[0],!0,o)||(t.value=o),d[0].value=o):c&&(a.call(t,!0,o)||(c[0].value=o),t.value=o)),s.data("placeholder-enabled")?(""===o?(t.value=o,t!=r()&&l.call(t)):(s.hasClass(h.customClass)&&a.call(t),t.value=o),s):(t.value=o,s)}},n||(u.input=o,p.value=o),i||(u.textarea=o,p.value=o),e(function(){e(document).delegate("form","submit.placeholder",function(){var t=e("."+h.customClass,this).each(function(){a.call(this,!0,"")});setTimeout(function(){t.each(l)},10)})}),e(window).bind("beforeunload.placeholder",function(){var t=!0;try{"javascript:void(0)"===document.activeElement.toString()&&(t=!1)}catch(a){}t&&e("."+h.customClass).each(function(){this.value=""})}))}),$(function(){$("input, textarea").placeholder({customClass:"my-placeholder"})});
        </script>


        <script type="text/javascript" src="{{ asset('js/jquery.cookiebar.js') }} "></script>
        <script type="text/javascript">
            $(function() {
                $.cookieBar({ });
            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    </body>
</html>
