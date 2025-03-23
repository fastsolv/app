@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Pricing') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div> --}}
    <div class="breadcrumb-item"><a href="{{ route('pricing.index') }}">{{ __('Pricing') }}</a></div>
    <div class="breadcrumb-item">{{ __('Edit Pricing') }}</div>
</div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit Pricing') }}</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('plans.edit', [$plan_id]) }}"></i><span>{{ __('Edit') }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active"
                                href="{{ route('pricing_index', [$plan_id]) }}"><span>{{ __('Pricing') }}</span></a>
                        </li>
                    </ul>
                    <div class="user-ticket-divider"></div>
                    <div class="tab-content pt-3" id="myTabContent">
                        <form method="POST" action="{{ route('pricing.update', [$price->id]) }}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">
                            <div>
                                <div class="form-group row mb-4">
                                    <label for="address"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Price in ' ) }} {{ $price->period }} ({{ $price->currencies->currency }}):*</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="price" type="text"
                                            class="form-control @error('price') is-invalid @enderror" name="price"
                                            value="{{ old('price', $price->price) }}" autocomplete="price" autofocus>
                                        @error('price')
                                        <div class="text-danger pt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>                        
                                @if (env('APP_ENV') != 'demo')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-custom"> {{ __('Update') }}</button>
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
</div>
@endsection