@extends('layouts.app')
@section('title', __('ttdt.sign_in'))
@section('content')
    <div class="login login-3 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"
             style="background-image: url({{ asset('media/bg/bg-6.jpg') }});">
            <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                <div class="login__container">
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img height="150px" src="{{ asset('assets/images/ttdt-white.png') }}">
                        </a>
                    </div>
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3 class="opacity-40 font-weight-normal">Sign In To TTDT</h3>
                        </div>
                        <form class="form fv-plugins-bootstrap fv-plugins-framework" class="form"
                              action="{{ route('login') }}" method="post" id="kt_login_signin_form">
                            @csrf
                            <div class="form-group fv-plugins-icon-container">
                                <input id="email" placeholder="Email" type="email"
                                       class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5 @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block" role="alert">
                                        {{ $message }}
                                    </div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group fv-plugins-icon-container">
                                <input placeholder="Password" id="password" type="password"
                                       class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5 @error('password') is-invalid @enderror"
                                       name="password"
                                       required autocomplete="current-password">

                                @error('password')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block" role="alert">
                                        {{ $message }}
                                    </div>
                                </div>
                                @enderror
                            </div>

                            <div
                                class="form-group d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
                                <label class="checkbox checkbox-outline checkbox-white text-white m-0 pr-3">
                                    <input type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                                    <span></span>
                                </label>
                                <a class="text-white font-weight-bold" href="{{ route('password.request') }}">Forgot
                                    Password?</a>
                            </div>

                            <div class="form-group text-center mt-10">
                                <button id="kt_login_signin_submit"
                                        class="btn btn-pill btn-primary opacity-90 px-15 py-3">Sign In
                                </button>
                            </div>

                            <div class="form-group text-center mt-10">
                                <span class="opacity-40 mr-4">
                                    Don't have an account yet?
                                </span>
                                <a href="{{ route('register') }}" id="kt_login_signup"
                                   class="text-white opacity-30 font-weight-normal">Sign Up</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
