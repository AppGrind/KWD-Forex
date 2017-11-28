<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <link rel="apple-touch-icon" href="{{ asset('backend/assets/images/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    <!-- Stylesheets -->
    {!! Html::style("backend/global/css/bootstrap.min.css") !!}
    {!! Html::style("backend/global/css/bootstrap-extend.min.css") !!}
    {!! Html::style("backend/assets/css/site.min.css") !!}
    <!-- Plugins -->
    {!! Html::style("backend/global/vendor/animsition/animsition.css") !!}
    {!! Html::style("backend/global/vendor/asscrollable/asScrollable.css") !!}
    {!! Html::style("backend/global/vendor/switchery/switchery.css") !!}
    {!! Html::style("backend/global/vendor/intro-js/introjs.css") !!}
    {!! Html::style("backend/global/vendor/slidepanel/slidePanel.css") !!}
    {!! Html::style("backend/global/vendor/flag-icon-css/flag-icon.css") !!}
    {!! Html::style("backend/global/vendor/waves/waves.css") !!}

<!-- Fonts -->
    {!! Html::style("backend/global/fonts/material-design/material-design.min.css") !!}
    {!! Html::style("backend/global/fonts/brand-icons/brand-icons.min.css") !!}
    {!! Html::style("http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic") !!}
    {!! Html::style("backend/assets/skins/kwd-gold.css") !!}
<!--[if lt IE 9]>
    {!! Html::script("backend/global/vendor/html5shiv/html5shiv.min.js") !!}
    <![endif]-->
    <!--[if lt IE 10]>
    {!! Html::script("backend/global/vendor/media-match/media.match.min.js") !!}
    {!! Html::script("backend/global/vendor/respond/respond.min.js") !!}
    <![endif]-->
    <!-- Scripts -->
    {!! Html::script("backend/global/vendor/breakpoints/breakpoints.js") !!}
    <script>
        Breakpoints();
    </script>

    @yield('css')
</head>
<body class="animsition page-login-v2 page-register-v2 layout-full page-dark">


<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->


<div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
        <div class="page-brand-info">
            <div class="brand">
                <img class="brand-img" src="{{ asset('images/logo/KWD-FOREX-LOGO.svg') }}" alt="...">
            </div>
            <h2 class="brand-text ml-80 font-size-40">Rise Above the Horizon</h2>
        </div>
        @yield('content')
    </div>
</div>

<!-- Core  -->
{!! Html::script("backend/global/vendor/babel-external-helpers/babel-external-helpers.js") !!}
{!! Html::script("backend/global/vendor/jquery/jquery.js") !!}
{!! Html::script("backend/global/vendor/tether/tether.js") !!}
{!! Html::script("backend/global/vendor/bootstrap/bootstrap.js") !!}
{!! Html::script("backend/global/vendor/animsition/animsition.js") !!}
{!! Html::script("backend/global/vendor/mousewheel/jquery.mousewheel.js") !!}
{!! Html::script("backend/global/vendor/asscrollbar/jquery-asScrollbar.js") !!}
{!! Html::script("backend/global/vendor/asscrollable/jquery-asScrollable.js") !!}
{!! Html::script("backend/global/vendor/ashoverscroll/jquery-asHoverScroll.js") !!}
{!! Html::script("backend/global/vendor/waves/waves.js") !!}
<!-- Plugins -->
{!! Html::script("backend/global/vendor/switchery/switchery.min.js") !!}
{!! Html::script("backend/global/vendor/intro-js/intro.js") !!}
{!! Html::script("backend/global/vendor/screenfull/screenfull.js") !!}
{!! Html::script("backend/global/vendor/slidepanel/jquery-slidePanel.js") !!}
{!! Html::script("backend/global/vendor/jquery-placeholder/jquery.placeholder.js") !!}

<!-- Scripts -->
{!! Html::script("backend/global/js/State.js") !!}
{!! Html::script("backend/global/js/Component.js") !!}
{!! Html::script("backend/global/js/Plugin.js") !!}
{!! Html::script("backend/global/js/Base.js") !!}
{!! Html::script("backend/global/js/Config.js") !!}
{!! Html::script("backend/assets/js/Section/Menubar.js") !!}
{!! Html::script("backend/assets/js/Section/GridMenu.js") !!}
{!! Html::script("backend/assets/js/Section/Sidebar.js") !!}
{!! Html::script("backend/assets/js/Section/PageAside.js") !!}
{!! Html::script("backend/assets/js/Plugin/menu.js") !!}
{!! Html::script("backend/global/js/config/colors.js") !!}
{!! Html::script("backend/assets/js/config/tour.js") !!}
<script>
    Config.set('assets', '../assets');
</script>
<!-- Page -->
{!! Html::script("backend/assets/js/Site.js") !!}
{!! Html::script("backend/global/js/Plugin/asscrollable.js") !!}
{!! Html::script("backend/global/js/Plugin/slidepanel.js") !!}
{!! Html::script("backend/global/js/Plugin/switchery.js") !!}
{!! Html::script("backend/global/js/Plugin/jquery-placeholder.js") !!}

{!! Html::script("backend/global/js/Plugin/material.js") !!}

@yield('js')

<script>
    $(document).ready(function() {
        $(".animsition").animsition({
            inClass: 'fade-in-down-sm',
            outClass: 'fade-out-down-sm',
            inDuration: 1500,
            outDuration: 800,
            linkElement: '.animsition-link',
            // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
            loading: true,
            loadingParentElement: 'body', //animsition wrapper element
            loadingClass: 'animsition-loading',
            loadingInner: 'Loading...', // e.g '<img src="loading.svg" />'
            timeout: false,
            timeoutCountdown: 5000,
            onLoadEvent: true,
            browser: [ 'animation-duration', '-webkit-animation-duration'],
            // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
            // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
            overlay : false,
            overlayClass : 'animsition-overlay-slide',
            overlayParentElement : 'body',
            transition: function(url){ window.location.href = url; }
        });
    });
</script>
</body>
</html>