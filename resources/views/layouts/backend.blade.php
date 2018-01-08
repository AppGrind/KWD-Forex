<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <link rel="apple-touch-icon" href="{{ asset('backend/assets/images/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    <!-- Stylesheets -->
    {!! Html::style("backend/global/css/bootstrap.min.css") !!}
    {!! Html::style("backend/global/css/bootstrap-extend.min.css") !!}
    {!! Html::style("backend/assets/css/site.css") !!}
    <!-- Plugins -->
    {!! Html::style("backend/global/vendor/animsition/animsition.css") !!}
    {!! Html::style("backend/global/vendor/asscrollable/asScrollable.css") !!}
    {!! Html::style("backend/global/vendor/switchery/switchery.css") !!}
    {!! Html::style("backend/global/vendor/intro-js/introjs.css") !!}
    {!! Html::style("backend/global/vendor/slidepanel/slidePanel.css") !!}
    {!! Html::style("backend/global/vendor/flag-icon-css/flag-icon.css") !!}
    {!! Html::style("backend/global/vendor/waves/waves.css") !!}
    {!! Html::style("backend/global/vendor/chartist/chartist.css") !!}
    {!! Html::style("backend/global/vendor/jvectormap/jquery-jvectormap.css") !!}

    {!! Html::style("backend/global/vendor/toastr/toastr.css") !!}
    {!! Html::style("backend/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css") !!}

    {!! Html::style("backend/assets/examples/css/dashboard/v1.css") !!}
<!-- Fonts -->
    {!! Html::style("backend/global/fonts/material-design/material-design.min.css") !!}
    {!! Html::style("backend/assets/skins/kwd-gold.css") !!}
    {!! Html::style("backend/global/fonts/brand-icons/brand-icons.min.css") !!}
    {!! Html::style("https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css") !!}

    @yield('css')
    <style>
        a.dropdown-item{width: auto; text-decoration: none !important;}
        button.dropdown-item{width: 77%;}
    </style>
    {!! Html::style("http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic") !!}
<!--[if lt IE 9]>
    {!! Html::script("backend/global/vendor/html5shiv/html5shiv.min.js") !!}
    <![endif]-->
    <!--[if lt IE 10]>
    {!! Html::script("backend/global/vendor/media-match/media.match.min.js") !!}
    {!! Html::script("backend/global/vendor/respond/respond.min.js") !!}
    <![endif]-->
    <!-- Scripts -->
    {!! Html::script("backend/global/vendor/breakpoints/breakpoints.js") !!}
    {!! Html::script("https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js") !!}
    <script>
        Breakpoints();
    </script>
</head>
<body class="animsition dashboard page-user">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
@include('layouts._navbar')
@include('layouts._menubar')
<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">@yield('title')</h1>
        @yield('breadcrumb')
        <div class="page-header-actions">
            @yield('actions')
        </div>
    </div>
    <div class="page-content container-fluid">
        @yield('content')
    </div>
</div>
<!-- End Page -->
<!-- Footer -->
<footer class="site-footer">
    <div class="site-footer-legal">© 2017 <a
                href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
    <div class="site-footer-right">
        Crafted with <i class="red-600 icon md-favorite"></i> by <a href="http://themeforest.net/user/amazingSurge">amazingSurge</a>
    </div>
</footer>
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
{!! Html::script("backend/global/vendor/chartist/chartist.min.js") !!}
{{--{!! Html::script("backend/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js") !!}--}}
{!! Html::script("backend/global/vendor/jvectormap/jquery-jvectormap.min.js") !!}
{{--{!! Html::script("backend/global/vendor/jvectormap/maps/jquery-jvectormap-world-mill-en.js") !!}--}}
{!! Html::script("backend/global/vendor/matchheight/jquery.matchHeight-min.js") !!}
{!! Html::script("backend/global/vendor/peity/jquery.peity.min.js") !!}
{!! Html::script("backend/global/vendor/toastr/toastr.js") !!}

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
@yield('js')
@yield('deleteJS')
<!-- Page -->
{!! Html::script("backend/assets/js/Site.js") !!}
{!! Html::script("backend/global/js/Plugin/asscrollable.js") !!}
{!! Html::script("backend/global/js/Plugin/slidepanel.js") !!}
{!! Html::script("backend/global/js/Plugin/switchery.js") !!}
{!! Html::script("backend/global/js/Plugin/matchheight.js") !!}
{!! Html::script("backend/global/js/Plugin/jvectormap.js") !!}
{!! Html::script("backend/global/js/Plugin/peity.js") !!}
{!! Html::script("backend/assets/examples/js/dashboard/v1.js") !!}
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-full-width",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "slideDown",
        "hideMethod": "slideUp"
    }
</script>
@include('flash::message')
</body>
</html>