@extends('layouts.auth')


@section('content')
    <div class="page-login-main">
        <div class="brand hidden-md-up">
            <img class="brand-img" src="{{ asset('images/logo/KWD-FOREX-LOGO-black.png') }}" alt="{{ config('app.name') }}" style="height: 10rem">
            <br>
            <h3 class="brand-text font-size-20">Rise Above the Horizon</h3>
        </div>
        <h3 class="font-size-24">Reset Password.</h3>
        <p>Oops! Can't access your account?</p>
        @include('errors.forms')
        <form method="POST" action="{{ route('password.email') }}" autocomplete="off">
            {{ csrf_field() }}
            <div class="form-group floating" data-plugin="formMaterial">
                <label class="floating-label" for="email">Email</label>
                <input type="email" class="form-control empty {{ $errors->has('email') ? 'has-danger' : '' }}" value="{{ old('email') }}" id="email" name="email">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
        </form>
        @include('partials.auth-footer')
    </div>
@endsection


@section('title')
    Reset Password
@stop

@section('js')
    {!! Html::script("backend/global/vendor/typeahead-js/bloodhound.min.js") !!}
    {!! Html::script("backend/global/vendor/typeahead-js/typeahead.jquery.min.js") !!}
    {!! Html::script("backend/assets/js/typeahead-init.js") !!}
@stop
@section('css')
    {!! Html::style("backend/global/vendor/typeahead-js/typeahead.css") !!}
    {!! Html::style("backend/assets/examples/css/pages/login-v2.css") !!}
@stop