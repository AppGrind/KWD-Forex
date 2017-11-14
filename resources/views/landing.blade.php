<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="KWD Forex" />
    <meta name="description" content="KWD Forex" />
    <meta name="keywords" content="Forex, Market, Training, Trading, Signals" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- SITE TITLE -->
    <title>KWD Forex</title>

    <!-- FAVICON -->
    <link rel="icon" href="../../public/images/favicon.ico">

    <!-- WEB FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    {{--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">--}}
    <!-- STYLESHEETS -->
    {!! Html::style('//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css') !!}
    {!! Html::style('/css/style.css') !!}
    {!! Html::style('/fonts/flaticon.css') !!}
    {!! Html::style('/css/responsive.css') !!}
    {!! Html::style('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') !!}
    <!-- JQUERY -->
    {!! Html::script('/js/jquery.min.js') !!}
    {!! Html::script('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') !!}
</head>

<body>

<!-- PRELOADER -->
<div id="preloader"><div class="preloader"><img src="{{ url('/images/logo/KWD-FOREX-LOGO.svg') }}" alt=""><p>Rise Above the Horizon</p></div></div>

<!-- MAIN NAV -->
<a id="main-nav" href="#sidr"><span class="flaticon-menu9"></span></a>
<div id="sidr" class="sidr">

    <!-- MAIN NAV LOGO -->
    <a href="/" id="menu-logo"></a>

    <!-- MAIN NAV LINKS -->
    <ul>
        <li><a href="#Home" ><span class="icons flaticon-house3"></span>Home</a>
        </li>
        <li><a href="#About" ><span class="icons flaticon-cursor7"></span>About us</a>
        </li>
        <li><a href="#Training" ><span class="icons flaticon-drawer1"></span>Training</a>
        </li>
        <li><a href="#Students" ><span class="icons flaticon-comment2"></span>Students</a>
        </li>
        <li><a href="#Pricing" ><span class="icons flaticon-tag10"></span>Pricing</a>
        </li>
        <li><a href="#Contact" ><span class="icons flaticon-small72"></span>Contact</a>
        </li>
        {{--<li><a href="#Register" ><span class="icons flaticon-pencil12"></span>Register</a>--}}
        {{--</li>--}}
        {{--<li><a href="#Login" ><span class="icons flaticon-lock11"></span>Login</a>--}}
        {{--</li>--}}
    </ul>
    <!-- END MAIN NAV LINKS -->
</div>
<!-- END MAIN NAV -->

<!-- PAGE LOGO -->
{{--<div class="wrap">--}}
    {{--<div id="logo">--}}
        {{--<a href="#"></a>--}}
    {{--</div>--}}
{{--</div>--}}
<!-- END PAGE LOGO -->

<!-- LANDING PAGE CONTENT -->
<div id="fullpage">
    <div class="wrap">
        <div class="box">
            @include('flash::message')
        </div>
    </div>
    <!-- RIGHT HAND & PHONE MOCK-UP IMAGES -->
    <div class="wrap">
        <div class="section-image">
            <!-- Home IMAGE --><img src="{{ url('images/background/home_thumb.jpg') }}" alt="Home">
            <!-- about IMAGE --><img src="{{ url('images/background/about-bg.jpg') }}" alt="About us">
            <!-- Training IMAGE --><img src="{{ url('images/background/training_thumb.png') }}" alt="Training">
            <!-- Students IMAGE --><img src="{{ url('images/background/students_thumb.png') }}" alt="Students">
            <!-- Pricing IMAGE --><img src="{{ url('images/background/pricing_thumb.png') }}" alt="Pricing">
            <!-- Contact IMAGE --><img src="{{ url('images/background/contact_thumb.png') }}" alt="Contact">
        </div>
        <div id="hand"></div>
    </div>
    <!-- END RIGHT HAND & PHONE MOCK-UP -->


    <!-- SECTION HOME -->

    <div class="section active" data-anchor="Home" id="section0">
        <div class="wrap">
            <div class="box">
                <!-- SECTION HOME CONTENT -->
                <h1><strong>KWD</strong> Forex</h1>
                <p>KWD Forex group offers beginners and advanced financial markets techniques. We mainly focus on swing trading which is the most effective and sustainable way of trading the currency market and also do intraday. KWDForex mentors will engage with clients every Sunday to share the upcoming weeks analysis and our mentors trade in line with the students to instill self belief.</p>
                <p><br><a href="#Contact" class="button">Contact us Today!</a></p>
            </div>
            
            <!-- END SECTION HOME CONTENT -->
        </div>
    </div>
    <!-- END SECTION HOME -->

    <!-- SECTION ABOUT -->
    <div class="section" data-anchor="About" id="section1">
        <div class="wrap">
            <div class="fp-tableCell students-content">
            <div class="box">
                <!-- SECTION ABOUT CONTENT -->



                    <!-- TABS CONTENT -->
                        <h2>About us</h2>


                        <!-- ABOUT US -->
                        <div class="slide" data-anchor="sandile-ndimande">


                            <img src="{{ url('images/background/500x500/sandile-ndimande.jpg') }}" alt="Sandile Ndimande">
                            <p>
                                Sandile Ndimande is a skilled technical trader at KWDForex. Born and raised in Durban, he completed his undergraduate diploma at Durban University of Technology in Information Technology (2013).
                                He furthered his studies and completed his Bachelors Degree in Information Technology (2014) there after he went to the University of Kwa-Zulu Natal to honor his Honours Degree in Information Systems (2015)
                                <a href="#sandile" rel="modal:open">...Read more.</a>
                            </p>
                            <p> <span class="client-name"> <strong>-Sandile Ndimande</strong></span></p>
                            <!-- TAB 1 -->
                        </div>

                        <div class="slide" data-anchor="sizwe-nene">


                            <img src="{{ url('images/background/500x500/sizwe-nene.jpg') }}" alt="Sizwe Nene">
                            <p>
                                Sizwe Nene is a Durban born, technical forex trader. A graduate in Electronic Engineering from Durban University of Technology. And has been employed from 2014 as an Instrument and Control Technician at Lignotech South Africa.
                                In 2016 he started learning forex, under his friends’ guidance and mentorship, which he later co-founded KWDForex group with.
                                <a href="#sizwe"  rel="modal:open">...Read more.</a>
                            </p>
                            <p> <span class="client-name"> <strong>-Sizwe Nene</strong></span></p>
                            <!-- TAB 1 -->
                        </div>

                        <div class="slide" data-anchor="mpumelelo-shezi">


                            <img src="{{ url('images/background/500x500/mpumelelo-shezi.jpg') }}" alt="Mpumelelo Shezi">
                            <p>
                                Mpumelelo Shezi is a Durban born who completes the KWDForex trio. A Mechanical Engineering graduate from The Durban University of Technology , spent about 15 months working at a brewery company called NCP Alcohols where I handled several engineering projects successfully.
                                The desire for the financial markets has always been there but at the time knowledge wasn't accessible until late 2015
                                <a href="#mpumelelo" rel="modal:open">...Read more.</a>
                            </p>
                            <p> <span class="client-name"> <strong>-Mpumelelo Shezi</strong></span></p>
                            <!-- TAB 1 -->
                        </div>
                        <!-- END SECTION ABOUT US -->

                    </div>
                    <!-- END TABS CONTENT -->
            </div>
        </div>
    </div>
    <!-- END SECTION ABOUT -->

    <!-- SECTION TRAINING -->
    <div class="section" data-anchor="Training" id="section2">
        <div class="wrap">
            <div class="box">
                <!-- SECTION TRAINING CONTENT -->
                <h2><strong>Amazing</strong> Training</h2>
                <p>At KWD Forex we offer beginners and advanced forex trading knowledge. We equip our mentees with the necessary education and tools to tackle the financial markets. Our mentors hold Sunday analysis sessions with students to share setups and possible moves for the coming week until the student is confident enough to trade on their own even so, the mentors are always there to assist the student should they have any queries.</p>
                <p><strong>3 Lessons consisting of the following:</strong></p>
                <ul class="features">
                    <li><span class="icon flaticon-target"></span> Introduction to forex</li>
                    <li><span class="icon flaticon-question3"></span> What is forex</li>
                    <li><span class="icon flaticon-arrow100"></span> How to trade forex</li>
                </ul>
                <ul class="features">
                    <li><span class="icon flaticon-genius"></span> Understanding Price action</li>
                    <li><span class="icon flaticon-wheel1"></span> Preparing setups</li>
                    <li><span class="icon flaticon-lock11"></span> Risk management</li>
                </ul>
                <p style="clear:both"><br>We aslo give you:</p>

                <ul class="features">
                    <li><span class="icon flaticon-check2"></span> Lifetime Mentorship</li>
                    <li><span class="icon flaticon-check2"></span> Weekly Analysis Shared</li>
                </ul>

                <!-- END SECTION TRAINING CONTENT -->
            </div>
        </div>
    </div>
    <!-- END SECTION TRAINING -->

    <!-- SECTION STUDENTS -->
    <div class="section" data-anchor="Students" id="section3">
        <div class="wrap">
            <div class="fp-tableCell students-content">
                <div class="box">
                    <!-- SECTION STUDENTS CONTENT -->
                    <h2><strong>Students</strong> feedbacks</h2>

                    <!-- STUDENTS FEEDBACK 1 -->
                    <div class="slide" data-anchor="slide1">
                        <p>Thanks bro, for the training my trading has improved and mentorships are life. <br> Keep up the good work.</p>
                        <p> <span class="client-name"> <strong> Smiso</strong></span> <span class="client-stars">
                        <span class="icon flaticon-little27"></span>
                                <span class="icon flaticon-little27"></span> <span class="icon flaticon-little27"></span> <span class="icon flaticon-little27"></span> <span class="icon flaticon-fivepointed"></span> </span>
                        </p>
                    </div>

                    {{--<!-- STUDENTS FEEDBACK 2 -->--}}
                    {{--<div class="slide" data-anchor="slide2">--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero dolores omnis illum, voluptates fugiat incidunt, consectetur aspernatur rerum. Consequatur obcaecati, facere iusto alias nostrum officiis modi eum perspiciatis.</p>--}}
                        {{--<p> <span class="client-name"> <strong> Andreas Bosch</strong> - CEO</span> <span class="client-stars">--}}
                        {{--<span class="icon flaticon-little27"></span> <span class="icon flaticon-little27"></span> <span class="icon flaticon-little27"></span> <span class="icon flaticon-little27"></span> <span class="icon flaticon-fivepointed"></span> </span>--}}
                        {{--</p>--}}
                    {{--</div>--}}

                    {{--<!-- STUDENTS FEEDBACK 3 -->--}}
                    {{--<div class="slide" data-anchor="slide3">--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero dolores omnis illum, voluptates fugiat incidunt, consectetur aspernatur rerum. Consequatur obcaecati, facere iusto alias nostrum officiis modi eum perspiciatis.</p>--}}
                        {{--<p> <span class="client-name"> <strong> Michael Speria</strong> - Manager</span> <span class="client-stars">--}}
                        {{--<span class="icon flaticon-little27"></span> <span class="icon flaticon-little27"></span> <span class="icon flaticon-little27"></span> <span class="icon flaticon-fivepointed"></span> <span class="icon flaticon-fivepointed"></span> </span>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                    <!-- END SECTION STUDENTS -->
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION STUDENTS -->

    <!-- SECTION PRICING -->
    <div class="section" data-anchor="Pricing" id="section4">
        <div class="wrap">
            <div class="box">
                <!-- SECTION PRICING CONTENT -->
                <h2><strong>Pricing</strong> Packages</h2>

                <!-- PRICING TABLE 1 -->
                <div class="price-table normal">
                    <h3 class="package">Beginners</h3>
                    <div class="price">
                        <span class="dollar">R</span> <span class="amount">4000.00</span> </div>
                    <ul class="specifications">
                        <li><span class="icon flaticon-circle10"></span>3 lessons (Introductory Topics)</li>
                        <li><span class="icon flaticon-circle10"></span>Lifetime Mentorship</li>
                        <li><span class="icon flaticon-circle10"></span>Group Shared Analysis</li>
                    </ul>
                    {{--<div class="pricing-button"><a href="#">Buy now</a>--}}
                    {{--</div>--}}
                </div>

                <!-- PRICING TABLE 2 -->
                <div class="price-table normal">
                    <h3 class="package active">Advanced</h3>
                    <div class="price">
                        <span class="offer">R6000.00</span> <span class="dollar">R</span> <span class="amount">4000.00</span> </div>

                    <ul class="specifications">
                        <li><span class="icon flaticon-circle10"></span>3 lessons (Advanced Topics)</li>
                        <li><span class="icon flaticon-circle10"></span>Lifetime Mentorship</li>
                        <li><span class="icon flaticon-circle10"></span>Group Shared Analysis</li>
                    </ul>
                    {{--<div class="pricing-button"><a href="#">Buy now</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION PRICING -->

    <!-- SECTION CONTACT -->
    <div class="section" data-anchor="Contact" id="section5">
        <div class="wrap">
            <div class="box">
                <!-- SECTION CONTACT CONTENT-->
                <h2><strong>Get</strong> in touch</h2>
                <ul class="features">
                    <li><a class="tooltip" href="#"><span class="icon flaticon-telephone1"></span> Call Us now<span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-telephone1"></span>+27 83 229-3912 <br>+27 81 780-1797 <br>+27 76 215-1365 </span></span></span></a> </li>
                    <li><a class="tooltip" href="#"><span class="icon flaticon-mail9"></span> Send Email<span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-mail9"></span> <br>info@kwdforex.com</span></span></span></a> </li>

                </ul>
                <ul class="features">
                    <li><span class="tooltip"><span class="icon flaticon-cursor7"></span>Official Website <span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-cursor7"></span>
                            <br> <a href="http://www.kwdforex.com" target="_blank">www.kwdforex.com</a>
                            </span>
                            </span>
                            </span>
                            </span>
                    </li>
                </ul>

                <!-- SECTION CONTACT FORM-->

                <form action="{{ url('/get-in-touch') }}" method="POST" role="form" id="contact-form">
                    {{ csrf_field() }}
                    <input type="text" placeholder="Name" name="name" id="Name" required>
                    <input type="email" placeholder="Email" name="email" id="Email" required>
                    <input type="text" placeholder="Phone" name="phone" id="Phone" required>
                    <input type="text" placeholder="Subject" name="subject" id="Subject" required>
                    <textarea placeholder="Message" name="bodymessage" id="Message" required></textarea>
                    <button type="submit" id="submit">Send</button>
                    <div id="success"></div>
                </form>
                <!-- END SECTION CONTACT -->
            </div>
        </div>
    </div>

    {{--<!-- SECTION REGISTER -->--}}
    {{-- <div class="section" data-anchor="Register" id="section6">
        <div class="wrap">
            <div class="box">
                <!-- SECTION DOWNLOAD CONTENT-->
                <h2><strong>Register</strong> to create an account</h2>

                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif

                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                </form>
                <!-- END SECTION DOWNLOAD -->
            </div>
        </div>
    </div>
    <!-- END SECTION REGISTER -->

    <!-- SECTION LOGIN -->
    <div class="section" data-anchor="Login" id="section7">
        <div class="wrap">
            <div class="box">
                <!-- SECTION LOGIN CONTENT-->
                <h2><strong>Login</strong> to Book a session</h2>

                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif

                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>


                    <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                    </div>
                </form>
                <!-- END SECTION LOGIN -->
            </div>
        </div>
    </div> --}}
    <!-- END SECTION LOGIN -->

</div>

<!-- SOCIAL ICONS -->
<div class="wrap">
    <div id="social-icons">
        <ul>
            <li><a href="https://www.facebook.com/kwdforex" target="_blank"><i class="flaticon-facebook6"></i></a> </li>
            <li><a href="https://www.instagram.com/kwdforex"  target="_blank"><i class="flaticon-social77"></i></a> </li>
            <li><a href="https://www.twitter.com/kwdforex" target="_blank"><i class="flaticon-social19"></i></a> </li>
        </ul>
    </div>
</div>
<!-- END SOCIAL ICONS -->
<!-- MODALS -->

<!-- The Modal -->
<div id="sandile" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h3>Sandile Ndimande</h3>
            <img src="{{ url('images/background/500x500/sandile-ndimande.jpg') }}" alt="Sandile Ndimande">
        </div>
        <div class="modal-body">
            <p>Sandile Ndimande is a skilled technical trader at KWDForex. Born and raised in Durban, he completed his undergraduate diploma at Durban University of Technology in Information Technology (2013). He furthered his studies and completed his Bachelors Degree in Information Technology (2014) there after he went to the University of Kwa-Zulu Natal to honor his Honours Degree in Information Systems (2015).
                While still studying, Sandile started his working career at eThekwini Municipality (2013) as an Applications Engineer. He left eThekwini Municipality after a solid two successful years and joined a corporate giant Derivco as a Lead Quality Analyst (2016). He is ISTQB (UK Standard) Certified, Agile Certified as well as IIST (US Standard) Certified.
                <br><br>He had discovered the forex market in 2014 but took time to learn and after months of studying and nurturing the skill of trading the forex market, he then implemented and tested. He began trading his self taught abilities in 2015 to which he has been consistently profitable. He there after began teaching friends and colleagues on how to trade forex profitably.
                In 2017 Sandile started a forex institution called KWDForex with his team. This organizations objective is to educate and mentor individuals with their technical skills and strategies on how to make profits consistently by trading the financial markets. </p>

        </div>
        <div class="modal-footer">
            <a href="#!" rel="modal:close" class="close">Close</a>
        </div>
    </div>

</div>
<!-- The Modal -->
<div id="mpumelelo" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h3>Mpumelelo Shezi</h3>
            <img src="{{ url('images/background/500x500/mpumelelo-shezi.jpg') }}" alt="Mpumelelo Shezi">
        </div>
        <div class="modal-body">
            <p>
                Mpumelelo Shezi is a Durban born who completes the KWDForex trio. A Mechanical Engineering graduate from The Durban University of Technology , spent about 15 months working at a brewery company called NCP Alcohols where I handled several engineering projects successfully.
                <br><br>The desire for the financial markets has always been there but at the time knowledge wasn't accessible until late 2015 when I began educating myself through YouTube videos and babypips school thereafter I went around seeking help from already established traders. After a series of blowing accounts,
                I began to see the light and made consistent profits. We spent a lot of time with Sandile Ndimande working tirelessly trying to improve our trading until we became consistent.   After sharing our strategy with close friends who also went on to make profit and be consistent , we then decided on forming KWD Forex along with Sizwe Nene and Sandile Ndimande.

            </p>

        </div>
        <div class="modal-footer">
            <a href="#!" rel="modal:close" class="close">Close</a>
        </div>
    </div>

</div>
<!-- The Modal -->
<div id="sizwe" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h3>Sizwe Nene</h3>
            <img src="{{ url('images/background/500x500/sizwe-nene.jpg') }}" alt="Sizwe Nene">
        </div>
        <div class="modal-body">
            <p>Sizwe Nene is a Durban born, technical forex trader. A graduate in Electronic Engineering from Durban University of Technology. And has been employed from 2014 as an Instrument and Control Technician at Lignotech South Africa. In 2016 he started learning forex, under his friends’ guidance and mentorship, which he later co-founded KWDForex group with.
                <br><br>His growth has been amicable from the time he started forex trading, trading supply and demand imbalances. And is devoted to assisting and mentoring people with the skill and make forex trading accessible and understandable to people.</p>

        </div>
        <div class="modal-footer">
            <a href="#!" rel="modal:close" class="close">Close</a>
        </div>
    </div>

</div>

<!-- END MODALS -->
<!-- SCRIPTS -->
{!! Html::script('/js/jquery.easings.min.js') !!}
{!! Html::script('/js/jquery.fullPage.js') !!}
{!! Html::script('/js/cbpFWTabs.js') !!}
{!! Html::script('/js/jquery.sidr.min.js') !!}
{!! Html::script('/js/jquery.slimscroll.min.js') !!}
{!! Html::script('/js/scripts.js') !!}
{!! Html::script('//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js') !!}
<!--<script type="text/javascript" src="js/video.js"></script> -->

<script>
$(document).ready(function(){
    $('#main-nav').sidr({
        side: 'left',
        speed: 450
    });
    setTimeout(openSidr, 1550);
    setTimeout(closeSidr, 2100);
});
$(function(){
    $('.modal-body').slimScroll({
        height: '300px',
        alwaysVisible: true,
        allowPageScroll: false
    });
});
function openSidr(){
    $.sidr('open', 'sidr', '');
}
function closeSidr(){
    $.sidr('close', 'sidr', '');
}
</script>
</body>

</html>
