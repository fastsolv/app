@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Billing Address') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item active"><a
                href="{{ route('billing_address.index') }}">{{ __('Billing Address') }}</a></div>
        <div class="breadcrumb-item">{{ __('Update Address') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('Update Billing Address') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('billing_address.store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="frist_name">{{ __('Company name') }}*</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $address !== null ? $address->name : '') }}"
                                    autocomplete="name">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">{{ __('Phone no.') }}</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone', $address !== null ? $address->phone : '') }}"
                                    autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_1">{{ __('Address line 1') }}*</label>
                                <textarea class="form-control @error('address_1') is-invalid @enderror" id="address_1"
                                    name="address_1"
                                    autocomplete="address_1">{{ old('address_1', $address !== null ? $address->address_1 : '') }}</textarea>

                                @error('address_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="address_2">{{ __('Address line 2') }}</label>
                                <textarea class="form-control @error('address_2') is-invalid @enderror" id="address_2"
                                    name="address_2"
                                    autocomplete="address_2">{{ old('address_2', $address !== null ? $address->address_2 : '') }}</textarea>

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
                                    name="city" value="{{ old('city', $address !== null ? $address->city : '') }}"
                                    required autocomplete="city">

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
                                    value="{{ old('postal_code', $address !== null ? $address->postal_code : '') }}"
                                    required autocomplete="postal_code">

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
                                    <small id="port_help1" class="form-text text-muted"><i
                                            class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        {{ __('Country should be outside india for non-INR transactions') }}
                                    </small>
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

                        <div class="form-group m-2 row float-right">
                            <div>
                                <button type="submit" class="btn btn-custom">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if($address !== null)
<script>
    var country_id = "{{ $address->country_id }}";
    var state_id = "{{ $address->state_id }}";
    var country_name = "{{ $address->countries->name }}";
    var state_state = "{{ $address->states->name }}";
    var country_api_url = '<?php echo url("/countries"); ?>';
    var state_api_url = '<?php echo url("/states"); ?>';
</script>
@else
<script>
    var country_id = null;
    var state_id = null;
    var country_name = null;
    var state_state = null;
    var country_api_url = '<?php echo url("/countries"); ?>';
    var state_api_url = '<?php echo url("/states"); ?>';
</script>
@endif
<script src="{{ asset('js/country-state.js') }}"></script>
@endsection