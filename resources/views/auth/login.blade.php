@extends('layouts.auth')

@section('content')
<div class="page-login-main">
    <div class="brand hidden-md-up">
        <img class="brand-img" src="{{ asset('images/logo/KWD-FOREX-LOGO-black.png') }}" alt="{{ config('app.name') }}" style="height: 10rem">
        <br>
        <h3 class="brand-text font-size-20">Rise Above the Horizon</h3>
    </div>
    <h3 class="font-size-24">Log In</h3>
    <p>To access your account.</p>

    @include('errors.forms')
    <form method="POST" action="{{ route('login') }}" autocomplete="on">
        {{ csrf_field() }}
        <div class="form-group floating" data-plugin="formMaterial">
            <label class="floating-label" for="email">Email</label>
            <input type="email" class="form-control empty {{ $errors->has('email') ? 'has-danger' : '' }}" id="email" name="email" value="{{ old('email') }}">
        </div>
        <div class="form-group floating" data-plugin="formMaterial">
            <label class="floating-label" for="password">Password</label>
            <input type="password" class="form-control empty {{ $errors->has('password') ? 'has-danger' : '' }}" id="password" name="password">
        </div>
        <div class="form-group clearfix">
            <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                <input type="checkbox" id="remember" name="remember"  {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Remember me</label>
            </div>
            <a class="float-right" href="{{ url('password/reset') }}">Forgot password?</a>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Log in</button>
    </form>
    <p>Don't have an account? <a href="{{ url('register') }}"  class="animsition-link">Sign Up</a></p>
    <footer class="page-copyright">
        <br>
        <p>© 2017. All RIGHT RESERVED.</p>
        <div class="social">
            <a class="btn btn-icon btn-round social-twitter mx-5" href="javascript:void(0)">
                <i class="icon bd-twitter" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-facebook mx-5" href="javascript:void(0)">
                <i class="icon bd-facebook" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-google-plus mx-5" href="javascript:void(0)">
                <i class="icon bd-google-plus" aria-hidden="true"></i>
            </a>
        </div>
    </footer>
</div>
@endsection

@section('title')
    Login
@stop

@section('js')

@stop
@section('css')
    {!! Html::style("backend/assets/examples/css/pages/login-v2.css") !!}
@stop