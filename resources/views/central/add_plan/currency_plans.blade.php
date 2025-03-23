@extends('central.layouts.new_user_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Pricing') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('add_plan.index') }}">{{ __('Pricing') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Available Plans') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="btn-group">
                <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">{{ $selected_currency->currency }}
                </button>
                <div class="dropdown-menu">
                    @foreach ($currencies as $currency)
                    <a class="dropdown-item" href="/add_plans/{{ $plan->uuid }}/{{ $currency->id }}">{{ $currency->currency }}</a>
                    @endforeach
                </div>
            </div>
            <div class="card-deck mb-3 text-center card-align">

                @foreach ($pricing as $price)
                <div class="card m-1 box-shadow price-width-320">
                    <div class='pricing'>
                        <div class="pricing-title">
                            {{ __($price->term) }} {{ __($price->period) }}
                        </div>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title color-black">{{ $price->price }} <small
                                class="text-muted">{{ $selected_currency->currency }}</small>
                        </h1>
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
                    <div class="card-footer bg-transparent border-success text-center">
                        <a href="{{ route('invoice', $price->id) }}" class="btn btn-custom btn-block pricing-button-new" role="button"
                            aria-disabled="true">
                            {{ __('Subscribe') }} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        </main>
    </div>
</div>
@endsection