@extends('central.layouts.public_white')

@section('content')

<div class="section-header">
    <h1>{{ __('Pricing') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('available_plans.index') }}">{{ __('Pricing') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Available Plans') }}</div>
        <div class="breadcrumb-item">
            <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">{{ $selectedCurrency }}
            </button>
            <div class="dropdown-menu">
                @foreach ($currencies as $currency)
                <a class="dropdown-item" href={{ route('available_plans.index', ['currency' => $currency->currency]) }}>{{ $currency->currency }}</a>
                @endforeach
            </div>
        </div>
        <div class="breadcrumb-item">
            <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">{{ $selectedPeriod }}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item {{ $selectedPeriod == 'Monthly' ? 'active' : '' }}" href="{{ route('available_plans.index', ['currency' => $selectedCurrency, 'period' => 'Monthly']) }}">Monthly</a>
                <a class="dropdown-item {{ $selectedPeriod == 'Yearly' ? 'active' : '' }}" href="{{ route('available_plans.index', ['currency' => $selectedCurrency, 'period' => 'Yearly']) }}">Yearly</a>
            </div>
        </div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card-deck mb-3 text-center card-align">
                @foreach ($plans as $plan)
                <div class="card m-1 box-shadow price-width-320" >
                    <div class='pricing'>
                        <div class="pricing-title">
                            {{ __($plan->name) }}
                        </div>
                        @if ($plan->require_payment != 0)                           
                            @foreach ($pricing as $price)
                                @if ($price->uuid == $plan->uuid)
                                    <div class="pricing-title">
                                        {{ __($price->term) }} {{ __($price->period) }}
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="card-body">
                        @if ($plan->require_payment != 0)                           
                        @foreach ($pricing as $price)
                            @if ($price->uuid == $plan->uuid)
                                @if ($price->period == $selectedPeriod)
                                    <h1 class="card-title pricing-card-title color-black">{{ $price->price }} <small
                                            class="text-muted">{{ $selectedCurrency }}</small>
                                    </h1>
                                @endif
                            @endif
                        @endforeach
                        @endif

                        <div class="borderless">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                {{ __('No. of departments') }}
                                <span class="badge badge-purple badge-pill">{{ $plan->department_count ? $plan->department_count : 'Unlimited' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                {{ __('No. of tickets') }}
                                <span class="badge badge-purple badge-pill">{{ $plan->ticket_qty ? $plan->ticket_qty : 'Unlimited' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                {{ __('No. of staff') }}
                                <span class="badge badge-purple badge-pill">{{ $plan->staffs_qty ? $plan->staffs_qty : 'Unlimited' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                {{ __('No. of users') }}
                                <span class="badge badge-purple badge-pill">{{ $plan->user_qty ? $plan->user_qty : 'Unlimited' }}</span>
                            </li>
                        </div>

                    </div>
                    @if (env('APP_ENV') != 'demo')
                    @foreach ($pricing as $price)
                        @if ($price->uuid == $plan->uuid)  
                            @if ($price->period == $selectedPeriod)                      
                            <div class="card-footer bg-transparent border-success text-center">
                                <a href="{{ route('invoice', $price->id) }}" class="btn btn-custom btn-block pricing-button-new" role="button"
                                    aria-disabled="true">
                                    {{ __('Subscribe') }} <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            @endif
                        @endif
                    @endforeach
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        </main>
    </div>
</div>
@endsection