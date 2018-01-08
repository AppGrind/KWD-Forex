<html class="no-js js-menubar" lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    <title>You're not verified| {{ config('app.name') }}</title>
    <link rel="apple-touch-icon" href="../../assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">
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
    {!! Html::style("backend/assets/examples/css/pages/forgot-password.css") !!}
    <!-- Fonts -->
    {!! Html::style("backend/global/fonts/material-design/material-design.min.css") !!}
    {!! Html::style("backend/global/fonts/brand-icons/brand-icons.min.css") !!}
    {!! Html::style("http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic") !!}
    <!--[if lt IE 9]>
    {!! Html::script("backend/global/vendor/html5shiv/html5shiv.min.js") !!}
    <![endif]-->
    <!--[if lt IE 10]>
    {!! Html::script("backend/global/vendor/media-match/media.match.min.js") !!}
    {!! Html::script("backend/global/vendor/respond/respond.min.js") !!}
    <![endif]-->
{!! Html::style("backend/global/vendor/toastr/toastr.css") !!}
    <!-- Scripts -->
    {!! Html::script("backend/global/vendor/breakpoints/breakpoints.js") !!}
    <script>
        Breakpoints();
    </script>
</head>
<body class="animsition page-forgot-password layout-full" style="animation-duration: 800ms; opacity: 1;">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Page -->
<div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
        <h2>Your account is not verified</h2>
        <p>Input the verification code that was sent you. <br>Please check your mailbox!</p>
        <form method="post" role="form" autocomplete="off" action="{{ route('verify.account') }}">
            {{ csrf_field() }}
            <div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="text" class="form-control empty" id="code" name="code">
                <label class="floating-label" for="inputEmail">Verification Code</label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block waves-effect waves-classic">Verify Account</button>
            </div>
        </form>

        @include('partials.auth-footer')

    </div>
</div>
<!-- End Page -->
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
    Config.set('assets', '../../assets');
</script>
<!-- Page -->
{!! Html::script("backend/assets/js/Site.js") !!}
{!! Html::script("backend/global/js/Plugin/asscrollable.js") !!}
{!! Html::script("backend/global/js/Plugin/slidepanel.js") !!}
{!! Html::script("backend/global/js/Plugin/switchery.js") !!}
{!! Html::script("backend/global/js/Plugin/material.js") !!}
<script>
    (function(document, window, $) {
        'use strict';
        var Site = window.Site;
        $(document).ready(function() {
            Site.run();
        });
    })(document, window, jQuery);

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

</body></html>