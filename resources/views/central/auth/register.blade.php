@extends('central.layouts.public_white')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            {{-- <div class="login-brand">
                <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div> --}}

            <div class="card card-custom">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('Register') }}</h4>
                    <a href="{{ route('login') }}"
                        class="btn btn-icon btn-outline-custom bg-transparent float-right inline-block">{{ __('Login') }}
                        <i class="fas fa-arrow-circle-right"></i></a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
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
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-divider">
                            {{ __('Contact Details') }}
                        </div>

                        <div class="form-group">
                            <label for="address_1">{{ __('Address line 1') }}*</label>
                            <textarea class="form-control" id="address_1 @error('address_1') is-invalid @enderror"
                                name="address_1" autocomplete="address_1" autofocus
                                required>{{ old('address_1') }}</textarea>

                            @error('address_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address_2">{{ __('Address line 2') }}</label>
                            <textarea class="form-control @error('address_2') is-invalid @enderror" id="address_2"
                                name="address_2" autocomplete="address_2" autofocus>{{ old('address_2') }}</textarea>

                            @error('address_2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>{{ __('City') }}*</label>
                                <input id="city" type="city" class="form-control @error('city') is-invalid @enderror"
                                    name="city" value="{{ old('city') }}" required autocomplete="city">

                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>{{ __('Postal/zip code') }}*</label>
                                <input id="postal_code" type="text"
                                    class="form-control @error('postal_code') is-invalid @enderror" name="postal_code"
                                    value="{{ old('postal_code') }}" required autocomplete="postal_code">

                                @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div id="app1">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>{{ __('Country') }}*</label>
                                    <input type="hidden" class="form-control @error('country') is-invalid @enderror"
                                        ref="country_ref" id="country_ref_id" value="" name="country" />
                                    <v-select :options="options" @search="onSearch" v-model="selected_country"
                                        :reduce="country => country.id" @input="chooseMe" label="name">
                                    </v-select>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>{{ __('State') }}*</label>
                                    <input type="hidden" class="form-control @error('state') is-invalid @enderror"
                                        ref="state_ref" id="state_ref_id" value="" name="state" />
                                    <v-select :options="stateOptions" @search="onSearchState" v-model="selected_state"
                                        @input="chooseMeState" label="name" :reduce="state => state.id">
                                    </v-select>
                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- <div class="form-group col-6">
                                <label>{{ __('Currency') }}*</label>
                                <select class="form-control selectric" id="currency" name="currency">
                                    @foreach ($currencies as $currency)
                                    @if (old('currency') == $currency->id)
                                    <option selected value="{{ $currency->currency }}">
                                        {{ __($currency->currency) }}</option>
                                    @else
                                    <option value="{{ $currency->currency }}">{{ __($currency->currency) }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('currency')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror

                                <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                        aria-hidden="true"></i>
                                    {{ __('Here you need to select the currency.') }}.
                                    <br>
                                </small>
                            </div> --}}
                            <div class="form-group col-6">
                                <label for="phone">{{ __('Phone No.') }}</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" autocomplete="email">

                                @error('phone')
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

                        <div class="form-group">
                            <button type="submit" class="btn btn-custom btn-lg btn-block">
                                {{ __('Register') }}
                            </button>
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
<script>
    var country_id = null;
    var state_id = null;
    var country_name = null;
    var state_state = null;
    var country_api_url = '<?php echo url("/countries"); ?>';
    var state_api_url = '<?php echo url("/states"); ?>';
</script>
<script src="{{ asset('js/country-state.js') }}"></script>
@endsection