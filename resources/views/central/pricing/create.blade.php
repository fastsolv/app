@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Plans') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div> --}}
    <div class="breadcrumb-item"><a href="{{ route('pricing.index') }}">{{ __('Pricing') }}</a></div>
    <div class="breadcrumb-item">{{ __('Add Pricing') }}</div>
</div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Add Pricing') }}</h4>
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
                        <form method="POST" action="{{ route('pricing.store') }}">
                            @csrf

                            <div>
                                <input type="hidden" name="plan_id" value="{{ $plan_id }}" />

                                @foreach ( $currencies as $currency ) 
                                @foreach ($plans as $plan)
                                @if ($plan->uuid == $plan_id)                                    
                                <div class="card"> 
                                    @if ($plan->require_payment == 0)
                                    <div class="form-group row mb-4">
                                        <label for="address"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Enter price for monthly ') }}({{ $currency->currency }})*</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input id="custom_monthly[{{ $currency->id }}]" type="text"
                                                class="form-control @error('custom_monthly.'.$currency->id) is-invalid @enderror" name="custom_monthly[{{ $currency->id }}]"
                                                value="{{ old('price') }}" autocomplete="price" autofocus>
                                            @error('custom_monthly.'.$currency->id)
                                            <div class="text-danger pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row mb-4">
                                        <label for="address"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Enter price for monthly ') }}({{ $currency->currency }})*</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input id="custom_monthly[{{ $currency->id }}]" type="text"
                                                class="form-control @error('custom_monthly.'.$currency->id) is-invalid @enderror" name="custom_monthly[{{ $currency->id }}]"
                                                value="{{ old('price') }}" autocomplete="price" autofocus>
                                            @error('custom_monthly.'.$currency->id)
                                            <div class="text-danger pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row mb-4">
                                        <label for="address"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Enter price for anually ') }}({{ $currency->currency }}):*</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input id="custom_annually[{{ $currency->id }}]" type="text"
                                                class="form-control @error('custom_annually.'.$currency->id) is-invalid @enderror" name="custom_annually[{{ $currency->id }}]"
                                                 autocomplete="price" autofocus>
                                            @error('custom_annually.'.$currency->id)
                                            <div class="text-danger pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif
                                @endforeach
                                @endforeach
                                
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
</div>
@endsection