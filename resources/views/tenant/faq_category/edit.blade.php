@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header shadow-none">
    <h1>{{ __('Edit FAQ Category') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Edit FAQ Category') }}</div>
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
                      <form method="POST" action="{{ route('faq_category.update', $uuid) }}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">
                              <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}*</label>
                                   <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $faq_category->name)}}"   autocomplete="name" autofocus>
                                    @error('name')
                                            <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @foreach ( $faq_category_translation as $faq_cat_trans)
                            <div class="form-group row mb-4">
                                <label for="address"
                                class="col-md-4 col-form-label text-md-right">{{ $faq_cat_trans->language->language }}*</label>
                               <div class="col-md-6">
                                <input id="custom[{{$faq_cat_trans->language->id}}]" type="text"
                                    class="form-control @error('custom[{{$faq_cat_trans->language->id}}]') is-invalid @enderror" name="custom[{{$faq_cat_trans->language->id}}]"
                                    autofocus value="{{ old('category',$faq_cat_trans->category_text)}}">
                                @error('custom[{{$faq_cat_trans->langauge_id}}]')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                                @endforeach

                              @if (env('APP_ENV') != 'demo')
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-custom">
                                        {{ __('Update') }}
                                    </button>
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
