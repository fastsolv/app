@extends('central.layouts.gateway')

@section('content')

<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-primary">
        <div>
            <div class="row text-center">
                <img src="/images/mollie_logo.png" alt="Mollie" class="display-mollie-img" /><br>
            </div>
        </div>
        <div>
            <div class="row text-center">
                <h3 class="panel-heading"> {{ __('Payment Details') }}</h3>
            </div>
        </div>
        <form role="form" action="{{ route('mollie.payment', $pricing->id) }}" method="post">
            @csrf
            <div class="panel-body">
                <div class="borderless">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                        {{ __('Plan name') }}
                        <span class="pull-right text-capitalize">{{ $plan->name }}</span>
                    </li>
                </div>
                <div class="borderless">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                        {{ __('Plan price') }}
                        <span class="pull-right">{{ $pricing->currencies->prefix }}{{ $price }}</span>
                    </li>
                </div>
                <div class="borderless">
                    <li class="list-group-item d-flex">
                        {{ __('Tax payable') }}
                        <span class="pull-right">{{ $pricing->currencies->prefix }}0.00</span>
                    </li>
                </div>
                <div class="borderless">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                        {{ __('Total') }}
                        <span class="pull-right">{{ $pricing->currencies->prefix }}{{ $price }}</span>
                    </li>
                </div>
                
                <input type="hidden" name="sub_domain" value="{{ $sub_domain }}" />
                
                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-light btn-lg btn-block bg-dark btn-mt" type="submit">{{ __('Pay Now') }}
                            ( {{ $pricing->currencies->prefix }}{{ $price }} )</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
</html>