@extends('central.layouts.new_user_theme')

@section('content')

<div class="section-header">
  <h1>{{ __('Profile') }}</h1>
  <div class="section-header-breadcrumb">
    {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div>
  --}}
  <div class="breadcrumb-item">{{ __('Profile') }}</div>
</div>
</div>
<div class="section-body">

  @include('common.demo')
  @include('common.user')
  @include('common.errors')
  <div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-5">
      <div class="card profile-widget">
        <div class="profile-widget-header">
          <img alt="image" src="/images/avatar-1.png" class="rounded-circle profile-widget-picture">
        </div>
        <div class="profile-widget-description">
          <div class="profile-widget-name text-capitalize">{{ $user->first_name }} {{ $user->last_name }}
            @if($user->status_id == 1)
            <div class="text-success d-inline float-right mr-2">
              {{ __($user->statuses->name) }}
            </div>
            @else
            <div class="text-danger d-inline float-right mr-2">
              {{ __($user->statuses->name) }}
            </div>
            @endif
            <div>{{ $user->email }}</div>
          </div>
          <div><strong>{{ __('Address') }}:</strong></div>
          <div class="ml-2">
            <div>{{ $user->address_1 }}</div>
            <div>{{ $user->address_2 }}</div>
            <div>{{ $user->city }}, {{ $user->postal_code }}</div>
            <div>{{ $user->states->name ?? '' }}, {{ $user->countries->name ?? '' }}</div>
            <div><strong>{{ __('Contact') }}: {{ $user->phone }}</strong></div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h4>{{ __('Active plan') }}</h4>
        </div>
        <div class="card-body">
          @if ($service == null)
          <h5 class="card-title text-danger">{{ __('No active plans') }}</h5>
          @else
          <h5 class="text-capitalize">{{ __('Plan name') }}: {{ __($service->plans->name) }} {{ __('for') }}
            {{ __($service->pricing->term) }} {{ __($service->pricing->period) }}</h5>
          <p class="card-text">{{ __('Plan status') }}:
            @if ($service->statuses->name == 'active' && $service->orders->status == "active")
            <span class="text-capitalize text-success">{{ __($service->statuses->name) }}</span>
            @elseif ($service->statuses->name == 'active' && $service->orders->status !== "active")
            <span class="text-capitalize text-danger">{{ __("Order is not confirmed") }}</span>
            @else
            <span class="text-capitalize text-danger">{{ __("Inactive") }}</span>
            @endif
          </p>
          <p class="card-text">{{ __('Expiry date') }}:
            <span class="font-weight-bold">{{ \Carbon\Carbon::parse($service->expiry_date)->format('d-M-Y') }}</span>
          </p>
          @endif
        </div>
      </div>
    </div>
    <div class="col-12 col-md-12 col-lg-7 pt-lg-5-custom">
      <div class="card">
        <form method="POST" action="{{ route('profileUpdate') }}">
          @csrf
          <div class="card-header">
            <h4>{{ __('Edit Profile') }}</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6 col-12">
                <label>{{ __('First Name') }}*</label>
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                  name="first_name" value="{{ old('first_name', $user->first_name) }}" autocomplete="first_name"
                  autofocus>
                @error('first_name')
                <div class="text-danger pt-1">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-6 col-12">
                <label>{{ __('Last Name') }}*</label>
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                  name="last_name" value="{{ old('last_name', $user->last_name) }}" autocomplete="last_name" autofocus>
                @error('last_name')
                <div class="text-danger pt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6 col-12">
                <label>{{ __('Email') }}*</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email', $user->email) }}" autocomplete="name" autofocus readonly>
                @error('email')
                <div class="text-danger pt-1">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-6 col-12">
                <label>{{ __('Phone No.') }}</label><input id="phone" type="text"
                  class="form-control @error('phone') is-invalid @enderror" name="phone"
                  value="{{ old('phone', $user->phone) }}" autocomplete="email">

                @error('phone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6 col-12">
                <label>{{ __('Address line 1') }}*</label>
                <textarea class="form-control @error('address_1') is-invalid @enderror" id="address_1" name="address_1"
                  autocomplete="address_1" autofocus>{{ old('address_1', $user->address_1) }}</textarea>

                @error('address_1')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6 col-12">
                <label>{{ __('Address line 2') }}</label>
                <textarea class="form-control @error('address_2') is-invalid @enderror" id="address_2" name="address_2"
                  autocomplete="address_2" autofocus>{{ old('address_2', $user->address_2) }}</textarea>

                @error('address_2')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6 col-12">
                <label>{{ __('City') }}*</label>
                <input id="city" type="city" class="form-control @error('city') is-invalid @enderror" name="city"
                  value="{{ old('city', $user->city) }}" required autocomplete="city">

                @error('city')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6 col-12">
                <label>{{ __('Postal/zip code') }}*</label>
                <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror"
                  name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" required
                  autocomplete="postal_code">

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
                  <input type="hidden" class="form-control @error('country') is-invalid @enderror" ref="country_ref"
                    id="country_ref_id" value="" name="country" />
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
                  <input type="hidden" class="form-control @error('state') is-invalid @enderror" ref="state_ref"
                    id="state_ref_id" value="" name="state" />
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
              <div class="form-group col-md-12 col-12">
                <label>{{ __('Old password') }}*</label>
                <input id="old_password" type="password"
                  class="form-control @error('old_password') is-invalid @enderror" name="old_password" value=""
                  autocomplete="old_password" autofocus placeholder="{{ __('Enter if you want to change') }}">
                @error('old_password')
                <div class="text-danger pt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6 col-12">
                <label>{{ __('New password') }}*</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" value="" autocomplete="password" autofocus>
                @error('password')
                <div class="text-danger pt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6 col-12">
                <label>{{ __('Confirm password') }}*</label>
                <input id="c_password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="c_password" value="" autocomplete="c_password" autofocus>
                @error('c_password')
                <div class="text-danger pt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>

          </div>
          @if (env('APP_ENV') != 'demo')
          <div class="card-footer text-right">
            <button class="btn btn-custom">{{ __('Save Changes') }}</button>
          </div>
          @endif
        </form>
      </div>
    </div>

  </div>
</div>
<script>
  var country_id = "{{$user->country_id}}";
  var state_id = "{{$user->state_id}}";
  var country_name = "{{$user->countries->name ?? ''}}";
  var state_state = "{{$user->states->name ?? ''}}";
  var country_api_url = '<?php echo url("/api/countries"); ?>';
  var state_api_url = '<?php echo url("/api/states"); ?>';
</script>
<script src="{{ asset('js/country-state.js') }}"></script>
@endsection