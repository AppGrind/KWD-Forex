@extends('layouts.auth')


@section('content')
    <div class="page-register-main">
        <div class="brand hidden-md-up">
            <img class="brand-img" src="{{ asset('images/logo/KWD-FOREX-LOGO-black.png') }}" alt="{{ config('app.name') }}" style="height: 10rem">
            <br>
            <h3 class="brand-text font-size-20">Rise Above the Horizon</h3>
        </div>
        <h3 class="font-size-24">Sign Up</h3>
        <p>To create an account with us.</p>

        @include('errors.forms')
        <form  method="POST" action="{{ route('register') }}" role="form" autocomplete="on">
            {{ csrf_field() }}
            <div class="form-group row floating" data-plugin="formMaterial">
                <div class="col-md-6">
                    <label class="floating-label" for="firstname">First Name</label>
                    <input type="text" class="form-control empty {{ $errors->has('firstname') ? 'has-danger' : '' }}" value="{{ old('firstname') }}" id="firstname" name="firstname">
                    @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="floating-label" for="lastname">Last Name</label>
                    <input type="text" class="form-control empty {{ $errors->has('lastname') ? 'has-danger' : '' }}" value="{{ old('lastname') }}" id="lastname" name="lastname">
                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group floating" data-plugin="formMaterial">
                <label class="floating-label" for="displayname">Display Name</label>
                <input type="text" class="form-control empty {{ $errors->has('displayname') ? 'has-danger' : '' }}" value="{{ old('displayname') }}" id="displayname" name="displayname" data-hint="This should be unique to you, like a username.">
                @if ($errors->has('displayname'))
                    <span class="help-block">
                            <strong>{{ $errors->first('displayname') }}</strong>
                        </span>
                @endif
                <div class="hint">This should be unique to you, like a username.</div>
            </div>
            <div class="form-group floating" data-plugin="formMaterial">
                <label class="floating-label" for="contactnumber">Contact Number</label>
                <input type="text" class="form-control empty {{ $errors->has('contactnumber') ? 'has-danger' : '' }}" value="{{ old('contactnumber') }}" id="contactnumber" name="contactnumber">
                @if ($errors->has('contactnumber'))
                    <span class="help-block">
                            <strong>{{ $errors->first('contacnumber') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group floating" data-plugin="formMaterial">
                <label class="floating-label" for="address">Address</label>
                <input type="text" class="form-control empty {{ $errors->has('address') ? 'has-danger' : '' }}" value="{{ old('address') }}" id="address" name="address">
                @if ($errors->has('address'))
                    <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group floating" data-plugin="formMaterial">
                <label class="floating-label" for="town">Town</label>
                <input type="text" class="form-control empty {{ $errors->has('town') ? 'has-danger' : '' }}" value="{{ old('town') }}" id="town" name="town">
                @if ($errors->has('town'))
                    <span class="help-block">
                            <strong>{{ $errors->first('town') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group floating row" data-plugin="formMaterial">
                <div class="col-md-7">
                    <label class="floating-label" for="province">Province</label>
                    <input type="text" class="form-control empty provinces typeahead  {{ $errors->has('province') ? 'has-danger' : '' }}" value="{{ old('province') }}" id="province" name="province">
                    @if ($errors->has('province'))
                        <span class="help-block">
                            <strong>{{ $errors->first('province') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-5">
                    <label class="floating-label" for="postalcode">Postal Code</label>
                    <input type="number" class="form-control empty postalcode {{ $errors->has('postalcode') ? 'has-danger' : '' }}" value="{{ old('postalcode') }}" id="postalcode" name="postalcode">
                    @if ($errors->has('postalcode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('postalcode') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group floating" data-plugin="formMaterial">
                <label class="floating-label" for="email">Email</label>
                <input type="email" class="form-control empty {{ $errors->has('email') ? 'has-danger' : '' }}" value="{{ old('email') }}" id="email" name="email">
                @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group floating" data-plugin="formMaterial">
                <label class="floating-label" for="password">Password</label>
                <input type="password" class="form-control empty {{ $errors->has('password') ? 'has-danger' : '' }}" id="password" name="password">
                @if ($errors->has('password'))
                    <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group floating" data-plugin="formMaterial">
                <label class="floating-label" for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control empty {{ $errors->has('confirm_password') ? 'has-danger' : '' }}" id="password_confirmation" name="password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group clearfix">
                <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                    <input type="checkbox" id="inputCheckbox" name="term">
                    <label for="inputCheckbox"></label>
                </div>
                <p class="ml-35">By clicking Sign Up, you agree to our <a href="#">Terms</a>.</p>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
        </form>
        <p>Have account already? Please go to <a href="{{ url('login') }}"  class="animsition-link">Log In</a></p>
        <footer class="page-copyright"><br>
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
    Register
@stop

@section('js')
    {!! Html::script("backend/global/vendor/typeahead-js/bloodhound.min.js") !!}
    {!! Html::script("backend/global/vendor/typeahead-js/typeahead.jquery.min.js") !!}
    {!! Html::script("backend/assets/js/typeahead-init.js") !!}
@stop
@section('css')
    {!! Html::style("backend/global/vendor/typeahead-js/typeahead.css") !!}
    {!! Html::style("backend/assets/examples/css/pages/register-v2.css") !!}
@stop