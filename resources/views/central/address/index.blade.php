@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Billing Address') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item">{{ __('Billing Address') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            @if ($address == null)
            <div class="card  bg-custom-light">
                <div class="hero align-items-center text-danger">
                    <div class="hero-inner text-center">
                        <h2>{{ __('No Billing Address Found') }}</h2>
                        <p class="lead">
                            {{ __('You can add a billing address with the below link') }}.
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('billing_address.create') }}" class="btn btn-outline-custom btn-lg btn-icon icon-left"><i
                                    class="fas fa-sign-in-alt"></i> {{ __('Add Billing Address') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('Billing Address') }}</h4>
                    <a href="{{ route('billing_address.create') }}" class="btn btn-icon btn-custom float-right inline-block"><i
                            class="far fa-edit"></i>{{ __('Update') }}</a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="frist_name">{{ __('Company name') }}</label>
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $address !== null ? $address->name : '' }}" required
                                autocomplete="name" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">{{ __('Phone no.') }}</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{ $address !== null ? $address->phone : '' }}" autocomplete="phone"
                                readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="address_1">{{ __('Address line 1') }}</label>
                            <textarea class="form-control" id="address_1" name="address_1" autocomplete="address_1"
                                autofocus readonly>{{ $address !== null ? $address->address_1 : '' }}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="address_2">{{ __('Address line 2') }}</label>
                            <textarea class="form-control" id="address_2" name="address_2" autocomplete="address_2"
                                autofocus readonly>{{ $address !== null ? $address->address_2 : '' }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label>{{ __('City') }}</label>
                            <input id="city" type="city" class="form-control @error('city') is-invalid @enderror"
                                name="city" value="{{ $address !== null ? $address->city : '' }}" required
                                autocomplete="city" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>{{ __('Postal/zip code') }}</label>
                            <input id="postal_code" type="text"
                                class="form-control @error('postal_code') is-invalid @enderror" name="postal_code"
                                value="{{ $address !== null ? $address->postal_code : '' }}" readonly
                                autocomplete="postal_code">
                        </div>
                    </div>

                    <div id="app1">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>{{ __('Country') }}</label>
                                <input type="hidden" ref="country_ref" id="country_ref_id" value="" name="country" />
                                <input id="country" type="text"
                                    class="form-control @error('country') is-invalid @enderror" name="country"
                                    value="{{ $address !== null ? $address->countries->name : '' }}" readonly
                                    autocomplete="country">
                            </div>
                            <div class="form-group col-6">
                                <label>{{ __('State') }}*</label>
                                <input id="state" type="text" class="form-control @error('state') is-invalid @enderror"
                                    name="state" value="{{ $address !== null ? $address->states->name : '' }}" readonly
                                    autocomplete="state">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection