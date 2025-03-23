@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Gateway') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('gateways.index') }}">{{ __('Gateway') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Available Gateways') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.admin')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('Available Gateways') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th>{{ __('Gateway') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gateways as $gateway)
                                <tr class="gateway-table">


                                    <td class="text-center">
                                        @if ($gateway->name == 'paypal')
                                        <img src="/images/paypal.svg" alt="PayPal" class="gateway-logo" />
                                        @elseif ($gateway->name == 'stripe')
                                        <img src="/images/stripe.svg" alt="Stripe" class="gateway-logo" />
                                        @elseif ($gateway->name == 'mollie')
                                        <img src="/images/mollie.svg" alt="Mollie" class="gateway-logo" />
                                    </td>
                                    @endif

                                    <td class="text-center">
                                        @if ($gateway->status == true)
                                        <i class="fa fa-check fa-2x text-success-dark" title="{{ __('Active') }}"></i>
                                        @else
                                        <i class="fa fa-times fa-2x text-danger" title="{{ __('Inactive') }}"></i>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('gateways.edit', [$gateway->id]) }}">
                                            {{ __('View and Edit') }}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection