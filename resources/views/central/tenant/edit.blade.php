@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Tenants') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('tenants.index') }}">{{ __('Tenants') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Update Tenant') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Update Tenant') }}</h4>
                </div>
                <form method="POST" action="{{ route('tenants.update', $id) }}">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="mt-4">

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}:</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="status" id="active"
                                        value="1" {{ ($status == 1)? "checked" : "" }}>
                                    <label class="custom-control-label" for="active">
                                        {{ __('Active') }}
                                    </label>
                                </div>
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="status" id="inactive"
                                        value="0" {{ ($status == 0)? "checked" : "" }}>
                                    <label class="custom-control-label" for="inactive">
                                        {{ __('Inactive') }}
                                    </label>
                                </div>
                                <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                        aria-hidden="true"></i>
                                    {{ __('You can disable or enable a tenant from here') }}.
                                    <br>
                                </small>
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