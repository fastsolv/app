@if (!$existPlan)
<div class="alert alert-warning demo-alert text-center" role="alert">
    <strong>{{ __('Note') }}: </strong>{{ __('Please subscribe to a plan') }}.<a
        href="{{ route('plan_details.index') }}" class="text-primary">
         {{ __('Click here') }}.</a>
</div>
@endif