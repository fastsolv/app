@extends('central.layouts.gateway')

@section('content')
<div class="row text-center">
    <div class="col-sm-6 col-sm-offset-3">
        <br><br>
        <h2><i class="far fa-5x fa-times-circle text-danger"></i><h2>
        <h2 class="bg-response">{{ __('Failed') }}</h2>
        <h3>{{ __('Dear') }}, {{ Auth::user()->first_name }}</h3>
        <h3 class="payment-failed">{{ __('Oops, payment failed. something wrong') }}!</h3>
        <br><br>
        <a href="{{ url('/') }}" class="btn btn-danger">{{ __('Return home') }}</a>
    </div>
</div>
@endsection

</html>