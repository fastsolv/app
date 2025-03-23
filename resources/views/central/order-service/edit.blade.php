@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Subscriptions') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('services.index') }}">{{ __('Subscriptions') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Update Subscription') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Update Subscription') }}</h4>
                </div>
                <form method="POST" action="{{ route('services.update', $uuid) }}">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="mt-4">

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}:*</label>
                            <div class="col-sm-12 col-md-6">
                                @foreach ($statuses as $status)
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="status[$status->id]"
                                        id="{{ $status->id }}" value="{{ $status->name }}"
                                        {{ $status->id == $status_id ? 'checked' : '' }}>
                                    <label class="custom-control-label text-capitalize" for="{{ $status->id }}">
                                        {{ __($status->name) }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Grace period') }}:*</label>
                            <div class="col-sm-12 col-md-6">
                               <input name="grace_period" type="text" class="form-control datetimepicker" value={{ $grace_period }}>
                            </div>
                        </div>
                    </div>

                    @if (env('APP_ENV') != 'demo')
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-custom">{{ __('Save changes') }}</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection