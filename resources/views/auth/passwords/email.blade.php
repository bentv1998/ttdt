@extends('layouts.app')

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
                            <h3 class="opacity-40 font-weight-normal">{{ __('Reset Password') }}</h3>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form fv-plugins-bootstrap fv-plugins-framework"
                              action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="form-group fv-plugins-icon-container">
                                <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email"
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
                            <div class="form-group text-center mt-10">
                                <button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


