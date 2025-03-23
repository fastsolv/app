@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header shadow-none">
    <h1>{{ __('Language Settings') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('get_settings') }}">{{ __('Settings') }}</a>
        </div>
        <div class="breadcrumb-item text-capitalize">{{ __('Add') }} {{ str_replace("_", " ", __("$setting->name")) }}</div>
    </div>
</div>

<div class="section-body">
   

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
              
                <div class="card-body text-capitalize">
                <form method="POST" action="{{ route('settings.update', 10) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PUT"> <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Language') }}:*</label>
                            <div class="col-sm-12 col-md-7">  
                        <select class="form-control selectric " id="language_id" name="language_id">
                            @foreach ( $languages as $language)
                            <option value="{{ $language->id }}" @if($setting->value == $language->id) selected='selected' @endif>{{ $language->language }}</option>
                            @endforeach
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