@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header shadow-none">
    <h1>{{ __('Theme Settings ') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>

        <div class="breadcrumb-item">{{ __('Edit Theme Settings') }}</div>
    </div>
</div>

<div class="section-body">
   

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
              
                <div class="card-body text-capitalize">
                <form method="POST" action="{{ route('settings.update', 9) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PUT"> <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Theme') }}:*</label>
                            <div class="col-sm-12 col-md-7">
                           
                        <select class="form-control selectric " id="value" name="value">
                        
                          <option value="blue" @if($setting->value=='blue') selected='selected' @endif >{{__('Blue')}}</option>
                          <option value="green" @if($setting->value=='green') selected='selected' @endif >{{__('Green')}}</option>
                          <option value="red" @if($setting->value=='red') selected='selected' @endif >{{__('Red')}}</option>
                          <option value="black" @if($setting->value=='black') selected='selected' @endif >{{__('Black')}}</option>
                          <option value="white" @if($setting->value=='white') selected='selected' @endif >{{__('White')}}</option>
                          <option value="yellow" @if($setting->value=='yellow') selected='selected' @endif >{{__('yellow')}}</option>
                     
                        </select>

                              
                            </div>
                        </div>

                        @if (env('APP_ENV') != 'demo')
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-custom">{{ __('Update') }}</button>
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