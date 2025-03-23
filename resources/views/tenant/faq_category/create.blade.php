@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )

@section('content')

<div class="section-header shadow-none">
    <h1>{{ __('Add FAQ Category') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Add FAQ Category') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
               
                <div class="card-body">
                    <form method="POST" action="{{ route('faq_category.store') }}" enctype="multipart/form-data">
                        @csrf
                          <div>
                             <div class="form-group row mb-4">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}*</label>
                                   <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('uuid') }}" autocomplete="name" autofocus>
                                    @error('name')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @foreach ( $languages as $language)
                            <div class="form-group row mb-4">
                                <label for="address"
                                class="col-md-4 col-form-label text-md-right">{{ $language->language  }}*</label>
                               <div class="col-md-6">
                                <input id="custom[{{$language->id}}]" type="text"
                                    class="form-control @error('custom[{{$language->id}}]') is-invalid @enderror" name="custom[{{$language->id}}]"
                                    autofocus>
                                @error('custom[{{$language->id}}]')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                             </div>
                                @endforeach


                            <div class="form-group row mb-0">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-custom">{{ __('Submit') }}</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection