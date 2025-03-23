@extends('central.layouts.new_user_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Confirm Order') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('available_plans.index') }}">{{ __('Pricing') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Checkout') }}</div>
    </div>
</div>
@include('common.demo')
@include('common.errors')
<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h3>{{ __('Confirm Order') }}</h3>
                    </div>
                    <hr>
                    <div class="row  text-capitalize">
                        <div class="col-md-6">
                            <address>
                                <strong>{{ __('Billed To') }}:</strong><br>
                                @if($address !== null)
                                {{ $address->name }}<br>
                                {{ $address->address_1 }}<br>
                                {{ $address->city }}, {{ $address->postal_code }}<br>
                                {{ $address->states->name ?? ''}}, {{ $address->countries->name ?? '' }}
                                @endif
                            </address>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <address>
                                <strong>{{ __('Shipped To') }}:</strong><br>
                                {{ $user->first_name }} {{ $user->last_name }}<br>
                                {{ $user->address_1 }}<br>
                                {{ $user->city }}, {{ $user->postal_code }}<br>
                                {{ $user->states->name ?? ''}}, {{ $user->countries->name ?? ''}}
                            </address>
                            <address>
                                <strong>{{ __('Order Date') }}:</strong><br>
                                {{ $order_date }}<br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">{{ __('Order Summary') }}</div>
                    <p class="section-lead">{{ __('Price is inclusive of taxes') }}.</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr>
                                <th data-width="40">#</th>
                                <th>{{ __('Plan') }}</th>
                                <th>{{ __('Periode') }}</th>
                                <th class="text-center">{{ __('Price') }}</th>
                                <th class="text-right">{{ __('Totals') }}</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td class="text-capitalize">{{ __($plan->name) }}</td>
                                <td class="text-capitalize">{{ __($pricing->term) }} {{ __($pricing->period) }}</td>
                                <td class="text-center">{{ $pricing->currencies->prefix }}{{ number_format($pricing->price, 2) }}</td>
                                <td class="text-right">{{ $pricing->currencies->prefix }}{{ number_format($pricing->price, 2) }}</td>
                            </tr>
                        </table>
                    </div>

                    <form method="POST" action="{{ route('processOrder', [$pricing->id])}}">
                        @csrf
                        <div class="row mt-2">
                            @if($pricing->price !== 0.00)
                            <div class="col-8">
                                <div class="section-title">{{ __('Payment Method') }}</div>
                                <p class="section-lead">{{ __('The payment method that we provide is to make it easier') }} <br>{{ __('for you to pay invoices') }}.</p>
                                <div class="ml-5">
                                    <div class="custom-radio custom-control pt-2">
                                        <input class="custom-control-input" type="radio" name="gateway" id="paypal"
                                            value="paypal" checked>
                                        <label class="custom-control-label" for="paypal">
                                            <img src="/images/paypal.svg" alt="PayPal" class="gateway-logo-1" />
                                        </label>
                                    </div>
                                    <div class="custom-radio custom-control pt-4">
                                        <input class="custom-control-input" type="radio" name="gateway" id="stripe"
                                            value="stripe">
                                        <label class="custom-control-label" for="stripe">
                                            <img src="/images/stripe.svg" alt="Stripe" class="gateway-logo-1" />
                                        </label>
                                    </div>
                                    <div class="custom-radio custom-control pt-4">
                                        <input class="custom-control-input" type="radio" name="gateway" id="mollie"
                                            value="mollie">
                                        <label class="custom-control-label" for="mollie">
                                            <img src="/images/mollie.svg" alt="Mollie" class="gateway-logo-1" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-right mt-4 pr-4">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">{{ __('Subtotal') }}</div>
                                    <div class="invoice-detail-value">{{ $pricing->currencies->prefix }}{{ number_format($pricing->price, 2) }}</div>
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">{{ __('Offer applied') }}</div>
                                    <div class="invoice-detail-value">{{ $pricing->currencies->prefix }}{{ number_format((($pricing->price)-($price)), 2) }}</div>
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">{{ __('Total') }}</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">{{ $pricing->currencies->prefix }}{{ number_format($price, 2) }}</div>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if (env('APP_ENV') != 'demo')
                        <div class="text-md-right mt-4">
                            <div class="float-left ml-5">
                                <button class="btn btn-custom btn-icon icon-left"><i class="fas fa-credit-card"></i>
                                    {{ __('Process Order') }}</button>
                            </div>

                            <a class="btn btn-danger btn-icon icon-left float-left ml-1"
                                href="{{ route('available_plans.index')}}"><i class="fas fa-times"></i> {{ __('Cancel') }}</a>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>


</div>
@endsection