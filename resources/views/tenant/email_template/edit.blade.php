@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )

@section('content')

<div class="section-header shadow-none">
    <h1>{{ __(' Edit Email Template') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('email_template.index') }}">{{ __('Email Templates') }}</a></div>
        <div class="breadcrumb-item">{{ __('Edit Email Template') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('email_template.update', $email->uuid) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">

                        {{-- <div>
                            <div class="form-group row mb-4">
                                <label for="address"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror text-capitalize" name="name"
                                        value="{{ old('name', str_replace("_", " ", __($email->name)))}}" autocomplete="name" autofocus
                                        {{ $email->system_template == true ? "readonly" : "" }}>
                                    @error('name')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}

                            @foreach( $email_trans as $email_tran)
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Subject ') }}{{ $email_tran->language->language}}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="custom[{{$email_tran->language->id}}]" type="text"
                                        class="form-control @error('custom.'.$email_tran->language->id.'.subject') is-invalid @enderror" name="custom[{{$email_tran->language->id}}][subject]"
                                        value="{{ old('subject', $email_tran->subject)}}" autocomplete="subject" autofocus>
                                    @error('custom[{{$email_tran->language->id}}] ')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Message ') }}{{ $email_tran->language->language}}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea id="custom[{{$email_tran->language->id}}]" class="summernote  @error('custom.'.$email_tran->language->id.'.message') is-invalid @enderror"
                                        name="custom[{{$email_tran->language->id}}][message]" autocomplete="message" autofocus>{{ old('message', $email_tran->message) }}
                                    </textarea>
                                    @error('custom[{{$email_tran->language->id}}]')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                    <strong class="text-success-dark"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        {{ __('Available merge fields') }}: {{ $email->merge_fields }}
                                    </strong>
                                </div>
                            </div>
                            @endforeach
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="custom-radio custom-control">
                                        <input class="custom-control-input" type="radio" name="status" id="planEnable"
                                            value=1 {{ old('status', $email->status) == 1 ? "checked" : "" }}>
                                        <label class="custom-control-label" for="planEnable">
                                            {{ __('Enable') }}
                                        </label>
                                    </div>
                                    <div class="custom-radio custom-control">
                                        <input class="custom-control-input" type="radio" name="status" id="planDisable"
                                            value=0 {{ old('status', $email->status) == 0 ? "checked" : "" }}>
                                        <label class="custom-control-label" for="planDisable">
                                            {{ __('Disable') }}
                                        </label>
                                    </div>
                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        {{ __('Enable to turn on this email') }}.
                                        <br>
                                    </small>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection