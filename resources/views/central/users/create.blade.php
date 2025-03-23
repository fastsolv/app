@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Users') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('Users') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Add User') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('Add User') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="frist_name">{{ __('First Name') }}*</label>
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
                                @error('first_name')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">{{ __('Last Name') }}*</label>
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" autocomplete="last_name" autofocus>
                                @error('last_name')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">{{ __('E-Mail Address') }}*</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autocomplete="name" autofocus>
                                @error('email')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">{{ __('Phone No') }}.</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" autocomplete="email">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password" class="d-block">{{ __('Password') }}*</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    value="{{ old('password') }}" autocomplete="name" autofocus>
                                @error('password')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password2" class="d-block">{{ __('Confirm Password') }}*</label>
                                <input id="c_password" type="password"
                                    class="form-control @error('c_password') is-invalid @enderror" name="c_password"
                                    value="{{ old('c_password') }}" autocomplete="name" autofocus>
                                @error('c_password')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-divider">
                            {{ __('Contact Details') }}
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_1">{{ __('Address line 1') }}*</label>
                                <textarea class="form-control @error('address_1') is-invalid @enderror" id="address_1"
                                    name="address_1" autocomplete="address_1"
                                    autofocus>{{ old('address_1') }}</textarea>

                                @error('address_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="address_2">{{ __('Address line 2') }}</label>
                                <textarea class="form-control @error('address_2') is-invalid @enderror" id="address_2"
                                    name="address_2" autocomplete="address_2"
                                    autofocus>{{ old('address_2') }}</textarea>

                                @error('address_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>{{ __('City') }}*</label>
                                <input id="city" type="city" class="form-control @error('city') is-invalid @enderror"
                                    name="city" value="{{ old('city') }}" autocomplete="city">

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
                                    value="{{ old('postal_code') }}" autocomplete="postal_code">

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
                                    <input type="hidden" class="form-control @error('country') is-invalid @enderror" ref="country_ref" id="country_ref_id" value=""
                                        name="country" />
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
                                    <input type="hidden" class="form-control @error('state') is-invalid @enderror" ref="state_ref" id="state_ref_id" value="" name="state" />
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

                        @if (env('APP_ENV') != 'demo')
                        <div class="form-group m-2 row float-right">
                            <div>
                                <button type="submit" class="btn btn-custom">{{ __('Add') }}</button>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
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