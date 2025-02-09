@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="css/login.css">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card"> --}}

                <div class="dvnloginbox">
                    {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                    
                    <img src="Asset/login/dvnLogoWW.png" alt="WnW" class="dvnLogo">
                    <p class="dvnText">Login to your account</p>
                    <div class="dvnsocialLogin">
                        <a href="{{ route('redirect') }}"><img src="Asset/login/dvngoogle.png" alt="google" width="30px"></a>
                        <a href="{{ route('auth/facebook') }}"><img src="Asset/login/dvnfacebook.png" alt="fb" width="30px"></a>
                    </div>
                    <div class="dvnloginform">
                        <p >or use your email account</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="row mb-3">
                                {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                                <div class="col-md-6">
                                    <input id="email" type="email" class="dvnemail @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email or phone number">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}

                                <div class="col-md-6">
                                    <input id="password" type="password" class="dvnpassword @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password (8 characters)">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                {{-- <div class="col-md-6 offset-md-4"> --}}
                                    <div class="form-check">
                                        <input class="form-check-inputs" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                {{-- </div> --}}
                            </div>

                            <div class="row mb-0">
                                {{-- <div class="col-md-8 offset-md-4"> --}}
                                    <button type="submit" class="btn btn-primary dvnlogin">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    
                                {{-- </div> --}}
                            </div>
                            <p class="dvnNoAcc">Don't have an account ? <a href="register">Register here</a></p>
                        </form>
                    </div>
                </div>

                
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection
