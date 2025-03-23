@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Gateway') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('gateways.index') }}">{{ __('Gateway') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Add Details') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Add Details') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('gateways.update', $id) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}:*</label>
                            <div class="col-sm-12 col-md-7">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror text-capitalize" name="name"
                                    value="{{ __($name) }}" autocomplete="name" autofocus readonly>
                                @error('name')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @foreach ($gatewayDetails as $details)
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __($details->display_name) }}:*</label>
                            <div class="col-sm-12 col-md-7">
                                <input id="details" type="{{ $details->type }}"
                                    class="form-control @error('details') is-invalid @enderror"
                                    name="details[{{ $details->id }}]"
                                    value="{{ $details->value == null ? "" : "$details->value" }}"
                                    autocomplete="details" autofocus>
                                @error("details.$details->id")
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @endforeach

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}:*</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="status" id="gatewayEnable"
                                        value="enable" {{ $status == true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="gatewayEnable">
                                        {{ __('Enable') }}
                                    </label>
                                </div>
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="status" id="gatewayDisable"
                                        value="disable" {{ $status == false ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="gatewayDisable">
                                        {{ __('Disable') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Test mode') }}:*</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="test_mode" id="testEnable"
                                        value="enable" {{ $test_mode == true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="testEnable">
                                        {{ __('Enable') }}
                                    </label>
                                </div>
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="test_mode" id="testDisable"
                                        value="disble" {{ $test_mode == false ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="testDisable">
                                        {{ __('Disable') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        @if (env('APP_ENV') != 'demo')
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
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
@endsection