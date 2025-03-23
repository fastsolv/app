@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Currencies') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item"><a href="">{{ __('Currencies') }}</a></div>
        <div class="breadcrumb-item">{{ __('Add Currency') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Add Currency') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('currency.store') }}">
                        @csrf

                        <div>

                            <div class="form-group row mb-4">
                                <label for="address"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Currency') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="currency" type="text"
                                        class="form-control @error('currency') is-invalid @enderror" name="currency"
                                        value="{{ old('currency') }}" autocomplete="currency">
                                    @error('currency')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="prefix"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Prefix') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="prefix" type="text"
                                        class="form-control @error('prefix') is-invalid @enderror" name="prefix"
                                        value="{{ old('prefix') }}" autocomplete="prefix">
                                    @error('prefix')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if (env('APP_ENV') != 'demo')
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-custom"> {{ __('Add') }}</button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection