@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )

@section('content')

<div class="section-header shadow-none">
    <h1>{{ __(' Add Email Template') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('email_template.index') }}">{{ __('Email Templates') }}</a></div>
        <div class="breadcrumb-item">{{ __('Add Email Templates') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('email_template.store') }}">
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

                          
                            @foreach ( $languages as $language )
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Subject ') }}{{ $language->language}}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="custom[{{ $language->id }}]" type="text"
                                        class="form-control @error('custom.'.$language->id.'.subject') is-invalid @enderror" name="custom[{{ $language->id }}][subject]"
                                        value="{{ old('subject') }}" autocomplete="subject" autofocus>
                                    @error('custom[{{ $language->id }}]')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Message ') }}{{ $language->language}}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea id="custom[{{ $language->id }}]" class="summernote @error('custom.'.$language->id.'.message') is-invalid @enderror"
                                        value="{{ old('message') }}" name="custom[{{ $language->id }}][message]">{{ old('message') }}</textarea>
                                    @error('custom[{{ $language->id }}]')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endforeach

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
                                        {{ __('Enable to turn on this email') }}.
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