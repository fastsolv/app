@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Users') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('Users') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Edit User') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('Edit User') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>{{ __('First Name') }}*</label>
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name', $user->first_name) }}" autocomplete="first_name"
                                    autofocus>
                                @error('first_name')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('Last Name') }}*</label>
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name', $user->last_name) }}" autocomplete="last_name" autofocus>
                                @error('last_name')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>{{ __('E-Mail Address') }}*</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $user->email) }}" autocomplete="name" autofocus>
                                @error('email')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('Old password') }}*</label>
                                <input id="old_password" type="password"
                                    class="form-control @error('old_password') is-invalid @enderror" name="old_password"
                                    value="" autocomplete="old_password" autofocus
                                    placeholder="{{ __('Enter if you want to change') }}">
                                @error('old_password')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password" class="d-block">{{ __('New Password') }}*</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    value="" autocomplete="password" autofocus>
                                @error('password')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password2" class="d-block">{{ __('Confirm Password') }}*</label>
                                <input id="c_password" type="password"
                                    class="form-control @error('c_password') is-invalid @enderror" name="c_password"
                                    value="" autocomplete="name" autofocus>
                                @error('c_password')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status"
                                class="col-md-4 col-form-label text-md-right">{{ __('Status') }}:*</label>

                            <div class="col-md-6 ml-5">
                                @foreach ($statuses as $status)
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="status[$status->id]"
                                        id="{{ $status->id }}" value="{{ $status->name }}"
                                        {{ $status->id == $user->status_id ? 'checked' : '' }}>
                                    <label class="custom-control-label text-capitalize" for="{{ $status->id }}">
                                        {{ __($status->name) }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-divider">
                            {{ __('Contact Details') }}
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_1">{{ __('Address line 1') }}*</label>
                                <textarea class="form-control" id="address_1 @error('address_1') is-invalid @enderror"
                                    name="address_1" autocomplete="address_1"
                                    autofocus>{{ old('address_1', $user->address_1) }}</textarea>

                                @error('address_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="address_2">{{ __('Address line 2') }}</label>
                                <textarea class="form-control" id="address_2 @error('address_2') is-invalid @enderror"
                                    name="address_2" autocomplete="address_2"
                                    autofocus>{{ old('address_2', $user->address_2) }}</textarea>

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
                                    name="city" value="{{ old('city', $user->city) }}" autocomplete="city">

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
                                    value="{{ old('postal_code', $user->postal_code) }}" autocomplete="postal_code">

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

                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label>{{ __('Phone No') }}.</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone', $user->phone) }}" autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        @if (env('APP_ENV') != 'demo')
                        <div class="form-group m-2 row float-right">
                            <div>
                                <button type="submit" class="btn btn-custom">{{ __('Update') }}</button>
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
    var country_id = "{{$user->country_id}}";
    var state_id = "{{$user->state_id}}";
    var country_name = "{{$user->countries->name}}";
    var state_state = "{{$user->states->name}}";
    var country_api_url = '<?php echo url("/countries"); ?>';
    var state_api_url = '<?php echo url("/states"); ?>';
</script>
<script src="{{ asset('js/country-state.js') }}"></script>
@endsection