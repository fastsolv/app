@extends('central.layouts.gateway')

@section('content')
<div class="row text-center">
    <div class="col-sm-6 col-sm-offset-3">
        <br><br>
        <h2><i class="far fa-5x fa-check-circle text-success"></i></h2>
        <h1 class="bg-response">{{ __('Success') }}</h1>
        <h3>{{ __('Dear') }}, {{ Auth::user()->first_name }}</h3>
        @if ($order)
        <h3 class="payment-success">{{ __('Your order is successfuly placed') }}!</h3>
        <h4 class="payment-success">{{ __('order ID') }} : #{{ $order->order_id }}</h4>
        @else
        <h3 class="payment-success">{{ __('Your order is successfuly placed') }}!</h3>
        @endif
        <br><br>
        <a href="{{ url('/dashboard') }}" class="btn btn-lg btn-success">{{ __('Return Home') }}</a>
    </div>
</div>
@endsection

</html>