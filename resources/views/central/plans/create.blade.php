@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Plans') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item"><a href="">{{ __('Plans') }}</a></div>
        <div class="breadcrumb-item">{{ __('Plans') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Add Plans') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('plans.store') }}">
                        @csrf

                        <div>
                            <div class="form-group row mb-4">
                                <label for="address"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>
                                    @error('name')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Description') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea id="description"
                                        class="form-control height-auto @error('description') is-invalid @enderror"
                                        value="{{ old('description') }}"
                                        name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Department Count') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="row">
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="departments"
                                                id="unlimited_departments" value="">
                                            <label class="custom-control-label" for="unlimited_departments">
                                                {{ __('Unlimited') }}
                                            </label>
                                        </div>
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="departments"
                                                id="limited_departments" value="1" checked>
                                            <label class="custom-control-label" for="limited_departments">
                                                <input type="text"
                                                    class="form-control @error('department_count') is-invalid @enderror"
                                                    name="department_count" value="{{ old('department_count') }}"
                                                    autocomplete="department_count" autofocus>
                                                @error('department_count')
                                                <div class="text-danger pt-1">{{ $message }}</div>
                                                @enderror
                                            </label>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Staff Count') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="row">
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="staff"
                                                id="unlimited_staff" value="">
                                            <label class="custom-control-label" for="unlimited_staff">
                                                {{ __('Unlimited') }}
                                            </label>
                                        </div>
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="staff"
                                                id="limited_staff" value="1" checked>
                                            <label class="custom-control-label" for="limited_staff">
                                                <input type="text"
                                                    class="form-control @error('staffs_qty') is-invalid @enderror"
                                                    name="staffs_qty" value="{{ old('staffs_qty') }}"
                                                    autocomplete="staffs_qty" autofocus>
                                            </label>
                                            @error('staffs_qty')
                                            <div class="text-danger pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Users Count') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="row">
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="users"
                                                id="unlimited_users" value="">
                                            <label class="custom-control-label" for="unlimited_users">
                                                {{ __('Unlimited') }}
                                            </label>
                                        </div>
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="users"
                                                id="limited_users" value="1" checked>
                                            <label class="custom-control-label" for="limited_users">
                                                <input type="text"
                                                    class="form-control @error('user_qty') is-invalid @enderror"
                                                    name="user_qty" value="{{ old('user_qty') }}"
                                                    autocomplete="user_qty" autofocus>
                                            </label>
                                            @error('user_qty')
                                            <div class="text-danger pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Tickets Count') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="row">
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="tickets"
                                                id="unlimited_tickets" value="">
                                            <label class="custom-control-label" for="unlimited_tickets">
                                                {{ __('Unlimited') }}
                                            </label>
                                        </div>
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="tickets"
                                                id="limited_tickets" value="1" checked>
                                            <label class="custom-control-label" for="limited_tickets">
                                                <input type="text"
                                                    class="form-control @error('ticket_qty') is-invalid @enderror"
                                                    name="ticket_qty" value="{{ old('ticket_qty') }}"
                                                    autocomplete="ticket_qty" autofocus>
                                            </label>
                                            @error('ticket_qty')
                                            <div class="text-danger pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Require Payment') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="row">
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="Requirepayment_website"
                                                id="unlimited_Requirepayment" value="1"
                                                >
                                            <label class="custom-control-label" for="unlimited_Requirepayment">
                                                {{ __('True') }}
                                            </label>
                                        </div>
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="Requirepayment_website"
                                                id="limited_Requirepayment" value="0"
                                               >
                                                <label class="custom-control-label" for="limited_Requirepayment">
                                                    {{ __('False') }}
                                                </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="address"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Display Order') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="display_order" type="text"
                                        class="form-control @error('display_order') is-invalid @enderror"
                                        name="display_order" value="{{ old('display_order') }}"
                                        autocomplete="display_order" autofocus>
                                    @error('display_order')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                    <small class="text-secondary"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        {{ __('You can enter a number that represents the display order of the plan to users') }}
                                    </small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="custom-radio custom-control">
                                        <input class="custom-control-input" type="radio" name="status" id="planEnable"
                                            value=1 checked>
                                        <label class="custom-control-label" for="planEnable">
                                            {{ __('Enable') }}
                                        </label>
                                    </div>
                                    <div class="custom-radio custom-control">
                                        <input class="custom-control-input" type="radio" name="status" id="planDisable"
                                            value=0>
                                        <label class="custom-control-label" for="planDisable">
                                            {{ __('Disable') }}
                                        </label>
                                    </div>
                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        {{ __('Enable to activate this plan') }}.
                                        <br>
                                    </small>
                                </div>
                            </div>

                            @if (env('APP_ENV') != 'demo')
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-custom"> {{ __('Add') }}</button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection