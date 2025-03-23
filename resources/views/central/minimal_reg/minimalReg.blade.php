@extends('central.layouts.public_white')
{{-- 
@if (isset($RegisterCaptcha) && $RegisterCaptcha->value == "1")
@section('captcha')
{!! RecaptchaV3::initJs() !!}
@endsection
@endif --}}

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-custom">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('Minimal Register') }}</h4>
                    <a href="{{ route('login') }}"
                        class="btn btn-icon btn-outline-custom bg-transparent float-right inline-block">{{ __('Login') }}
                        <i class="fas fa-arrow-circle-right"></i></a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register_minimal') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="frist_name">{{ __('First Name') }}*</label>
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="last_name">{{ __('Last Name') }}*</label>
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}*</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password" class="d-block">{{ __('Password') }}*</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="password2" class="d-block">{{ __('Confirm Password') }}*</label>
                                <input id="password2" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                                    
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                <label class="custom-control-label" for="agree">{{ __('I agree with the terms and
                                    conditions') }}</label>
                            </div>
                        </div>
                        <div class="form-group"><input type="hidden" name="plan_id" value="{{ $plan_id }}"></div>

                        <div class="form-group">
                            {{-- {!! RecaptchaV3::field('register') !!} --}}
                            <input type="submit" class="btn btn-custom btn-lg btn-block" value="Register"/>
                        </div>
                       
                    </form>
                </div>
            </div>
            <div class="mt-5 text-muted text-center">
                {{ __('Already have an account?') }} <a href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection