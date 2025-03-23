@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )

@section('content')

<div class="section-header shadow-none">
    <h1>{{ __('Edit KB Category') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Edit KB Category') }}</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <!-- <div class="col-md-8"> -->
            <div class="card">
               
                <div class="card-body">
                    <form method="POST" action="{{ route('kb_category.update', $uuid) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group row mb-4">
                            <label for="name"
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}*</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $kb_category->name)}}" autocomplete="name" autofocus>
                                @error('name')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="icon"
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Icon') }}*</label>
                            <div class="col-sm-12 col-md-7">
                                <input id="icon" type="text" class="form-control @error('icon') is-invalid @enderror"
                                    name="icon" value="{{ old('icon', $kb_category->icon) }}" autocomplete="icon" autofocus>
                                @error('icon')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror

                                <small class="text-secondary"><i class="fa fa-exclamation-circle"
                                        aria-hidden="true"></i>
                                    {{ __('You have to add HTML code of fontawesome icons here') }}.<br>
                                    {{ __('Reference: ') }} <a href="https://fontawesome.com/"
                                        target="_blank" rel="noopener noreferrer">
                                        {{ __('fontawesome.com') }} </a>
                                </small>
                            </div>
                        </div>

                        @foreach ( $kb_category_translation as $kb_cat_trans )
                        <div class="form-group row mb-4">
                            <label for="name"
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ $kb_cat_trans->language->language }}*</label>
                            <div class="col-md-7">
                                <input id="custom[{{ $kb_cat_trans->language->id }}]" type="text" class="form-control @error('custom'.$kb_cat_trans->language->id.'.category') is-invalid @enderror"
                                    name="custom[{{ $kb_cat_trans->language->id }}][category]" value="{{ old('category_text', $kb_cat_trans->category_text)}}" autocomplete="name" autofocus>
                                @error('custom[{{ $kb_cat_trans->language->id }}]')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Description') }}:*</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote @error('custom.'.$kb_cat_trans->language->id.'.description') is-invalid @enderror"
                                    id="custom[{{ $kb_cat_trans->language->id }}]" rows="3" name="custom[{{ $kb_cat_trans->language->id }}][description]" value="{{ old('description',$kb_cat_trans->description) }}"
                                    autocomplete="description"
                                    autofocus>{{ old('description', $kb_cat_trans->description) }}</textarea>
                                @error('custom[{{ $kb_cat_trans->language->id }}]')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @endforeach

                        @if (env('APP_ENV') != 'demo')
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-custom">{{ __('Edit') }}</button>
                            </div>
                        </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- </main> -->
</div>
</div>
</div>
@endsection