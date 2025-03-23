@extends('central.layouts.new_user_theme')

@section('content')
<div class="section-header col-md-10 offset-md-1">
    <h1>{{ __('Subdomain Set Up') }}</h1>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-md-10 offset-md-1 mb-4">
            @include('common.demo')
            @include('common.errors')
            <div class="hero align-items-center bg-custom text-white">
                <div class="hero-inner text-center">
                    <h2>{{ __('Please choose your subdomain') }}</h2>
                    <p class="lead">{{ __('You have successfully registered with our system. Next, you can register your subdomain from here') }}.</p>

                    <div class="mt-4">
                        <form method="POST" action="{{ route('domainRegister') }}">
                            @csrf
                            <div class="form-group row mb-4">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-7">
                                            <input id="sub_domain" type="text"
                                                class="form-control @error('sub_domain') is-invalid @enderror"
                                                name="sub_domain" value="{{ old('sub_domain') }}"
                                                autocomplete="sub_domain" placeholder="Choose your subdomain">
                                            @error('sub_domain')
                                            <div class="text-danger pt-1 font-800">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-5">
                                            <input id="domain" type="text" name="domain" class="form-control"
                                                value=".{{ $central }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-outline-white"><i
                                            class="fas fa-sign-in-alt"></i> {{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
