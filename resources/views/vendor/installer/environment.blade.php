@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.environment.title'))
@section('style')
<link href="{{ asset('installer/froiden-helper/helper.css') }}" rel="stylesheet" />
@endsection
@section('container')
<form method="post" action="{{ route('LaravelInstaller::environmentSave') }}" id="env-form">

    <div class="form-group center-align installer-title">Database Details</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Hostname:*</label>

        <div class="col-sm-10">
            <input type="text" name="hostname" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Username:*</label>
        <div class="col-sm-10">
            <input type="text" name="username" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Database:*</label>
        <div class="col-sm-10">
            <input type="text" name="database" class="form-control">
        </div>
    </div>

    <div class="form-group center-align installer-title">App Details
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">App Name:*</label>
        <div class="col-sm-10">
            <input type="text" name="appName" class="form-control">
        </div>
    </div>

    <div class="form-group center-align installer-title">SMTP Details
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">SMTP Host:*</label>
        <div class="col-sm-10">
            <input type="text" name="smtpHost" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">SMTP Port:*</label>
        <div class="col-sm-10">
            <input type="text" name="smtpPort" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">SMTP Username:*</label>
        <div class="col-sm-10">
            <input type="text" name="smtpUsername" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">SMTP Password:*</label>
        <div class="col-sm-10">
            <input type="password" name="smtpPassword" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">SMTP Encryption:*</label>
        <div class="col-sm-10">
            <select class="form-control selectric" id="smtpEncryption" name="smtpEncryption">
                <option value="">{{ __('None') }}</option>
                <option value="SSL">{{__('SSL')}}</option>
                <option value="TLS">{{__('TLS')}}</option>
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <div class="buttons">
            <button class="button" onclick="checkEnv();return false">
                {{ trans('installer_messages.next') }}
            </button>
        </div>
    </div>
</form>
<script>
    function checkEnv() {
        $.easyAjax({
            url: "{!! route('LaravelInstaller::environmentSave') !!}",
            type: "GET",
            data: $("#env-form").serialize(),
            container: "#env-form",
            messagePosition: "inline"
        });
    }
</script>
@stop
@section('scripts')
<script src="{{ asset('installer/js/jQuery-3.6.0.min.js') }}"></script>
<script src="{{ asset('installer/froiden-helper/helper.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection