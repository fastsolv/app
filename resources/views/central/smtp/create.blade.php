@extends('central.layouts.new_user_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('SMTP Settings') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('SMTP Settings') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Update SMTP') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('smtp.store') }}">
                        @csrf
                        <div>
                        
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('SMTP Host') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="smtp_host" type="text"
                                        class="form-control @error('smtp_host') is-invalid @enderror" name="smtp_host"
                                        value="{{ old('smtp_host', $tenant->MAIL_HOST) }}" autocomplete="smtp_host" autofocus>
                                    @error('smtp_host')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                    <small id="emailHelp" class="form-text text-muted">eg: smtp.gmail.com</small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('SMTP Port') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="smtp_port" type="text"
                                        class="form-control @error('smtp_port') is-invalid @enderror" name="smtp_port"
                                        value="{{ old('smtp_port', $tenant->MAIL_PORT) }}" autocomplete="smtp_port" autofocus>
                                    @error('smtp_port')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                    <small id="emailHelp" class="form-text text-muted">eg: 465</small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('SMTP Email') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="smtp_email" type="text"
                                        class="form-control @error('smtp_email') is-invalid @enderror" name="smtp_email"
                                        value="{{ old('smtp_email', $tenant->MAIL_USERNAME) }}" autocomplete="smtp_email" autofocus>
                                    @error('smtp_email')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror   
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('SMTP Password') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="smtp_password" type="password"
                                        class="form-control @error('smtp_password') is-invalsmtp_portid @enderror"
                                        name="smtp_password" value="{{ old('smtp_password', $tenant->MAIL_PASSWORD) }}"
                                        autocomplete="smtp_password" autofocus>
                                    @error('smtp_password')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="smtp_encryption"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('SMTP Encryption') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control form-control selectric" id="smtp_encryption"
                                        name="smtp_encryption">
                                        <option value="">{{ __('None') }}</option>
                                        @if (old('smtp_encryption', $tenant->MAIL_ENCRYPTION) == 'SSL')
                                        <option selected value="SSL">{{__('SSL')}}</option>
                                        @else
                                        <option value="SSL">{{__('SSL')}}</option>
                                        @endif
                                        @if (old('smtp_encryption', $tenant->MAIL_ENCRYPTION) == 'TLS')
                                        <option selected value="TLS">{{__('TLS')}}</option>
                                        @else
                                        <option value="TLS">{{__('TLS')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Mail From Name') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="mail_from_name" type="text"
                                        class="form-control @error('mail_from_name') is-invalid @enderror" name="mail_from_name"
                                        value="{{ old('mail_from_name', $tenant->MAIL_FROM_NAME) }}" autocomplete="mail_from_name" autofocus>
                                    @error('mail_from_name')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if (env('APP_ENV') != 'demo')
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-custom"> {{ __('Update') }}</button>
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