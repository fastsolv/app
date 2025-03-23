@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header  shadow-none">
    <h1>{{ __(' Edit Announcement') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('get_announcement') }}">{{ __('Announcement') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Edit Announcement') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
               
                <div class="card-body">
                    <form method="POST" action="{{ route('announcement.update', $uuid) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        <div>
                            <div class="form-group row mb-4">
                                <label for="address"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __(' Title') }}*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ old('title', $title) }}" autocomplete="title" autofocus>
                                    @error('title')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                         
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Announcement') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea id="announcement" type="text"
                                        class="form-control summernote  form-control @error('announcement') is-invalid @enderror"
                                        name="announcement" autocomplete="announcement"
                                        autofocus>{{ old('announcement', $announcement) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                        <label  class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="lanaguage_code">{{ __('Language') }}:*</label>
                        <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric" id="language_code" name="language_code">
                          @foreach($languages as $language)
                          @if ($language->code == old('language_code', $language_code))
                                    <option selected value="{{$language->code}}">
                                        {{__($language->language)}}</option>
                                    @else
                          <option value="{{$language->code}}">{{__($language->language)}}</option>
                          @endif
                          @endforeach
                        </select>
                        </div>
                      </div>
                            
                            <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Is Published') }}:*</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="is_published" id="planEnable"
                                        value="1"
                                        {{old('is_published', $is_published) == "1" ? "checked" : "" }}>
                                    <label class="custom-control-label" for="planEnable">
                                        {{ __('Yes') }}
                                    </label>
                                </div>
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="is_published" id="planDisable"
                                        value="0"
                                        {{ old('is_published', $is_published) == "0" ? "checked" : "" }}>
                                    <label class="custom-control-label" for="planDisable">
                                        {{ __('No') }}
                                    </label>
                                </div>
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