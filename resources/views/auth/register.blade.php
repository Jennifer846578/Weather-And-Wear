@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="css/login.css">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="dvnloginbox">


                {{-- <div class="card-header">{{ __('Register') }}</div> --}}
                <img src="Asset/login/dvnLogoWW.png" alt="WnW" class="dvnLogo">

                <p class="dvnText">Create New Account</p>
        
                <!-- composer require laravel/socialite -->
                 <div class="dvnsocialLogin">
                    <a href="{{ route('redirect') }}"><img src="Asset/login/dvngoogle.png" alt="google" width="30px"></a>
                    <a href="{{ route('auth/facebook') }}"><img src="Asset/login/dvnfacebook.png" alt="fb" width="30px"></a>
                 </div>
                 <p >or use your email account</p>
                <div class="dvnloginform">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            {{-- <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label> --}}

                            <div class="col-md-6">
                                <input placeholder="username" class="dvnusername" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label> --}}

                            <div class="col-md-6 genderclass">
                                <p>Gender</p>
                                <select name="gender" id="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>   
                            </div>
                        </div>

                        

                        <div class="row mb-3">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                            <div class="col-md-6">
                                <input id="email" placeholder="email" class="dvnemail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" placeholder="password (8 characters)" class="dvnpassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label> --}}

                            <div class="col-md-6">
                                <input id="password-confirm" placeholder="Password Confirmation" class="dvnpassword" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            {{-- <div class="col-md-6 offset-md-4"> --}}
                                <button type="submit" class="btn btn-primary dvnlogin ">
                                    {{ __('Register') }}
                                </button>
                            {{-- </div> --}}
                        </div>
                        <p class="dvnNoAcc">Login to your existing account <a href="login">Login here</a></p>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
