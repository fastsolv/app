@if (!$availableAddress)
<div class="alert alert-warning demo-alert text-center" role="alert">
    <strong>{{ __('Note') }}: </strong>{{ __('Billing address should be added') }}.<a
        href="{{ route('billing_address.create') }}" class="text-primary">
         {{ __('Click here to add') }}.</a>
</div>
@endif
@if (!$activeGateway)
<div class="alert alert-warning demo-alert text-center" role="alert">
    <strong>{{ __('Note') }}: </strong>{{ __('At least one gateway should be activated') }}.<a
        href="{{ route('gateways.index') }}" class="text-primary">
         {{ __('Click here to activate') }}.</a>
</div>
@endif