@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header shadow-none">
    <h1>{{ __('Edit FAQ') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Edit FAQ') }}</div>
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
                    <form method="POST" action="{{ route('faq.update', $faq->uuid) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group row mb-4">
                            <label for="smtp_encryption"
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Category') }}*</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric" id="category_id" name="category_id">
                                    @foreach($categories as $category)
                                    @if ($category->uuid == old('category_id', $faq->category_id))
                                    <option selected value="{{$category->uuid}}">
                                        {{__($category->name)}}</option>
                                    @else
                                    <option value="{{$category->uuid}}">{{__($category->name)}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                        aria-hidden="true"></i>
                                    {{ __("Select any FAQ category") }}.
                                    <br>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="address"
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}*</label>
                               <div class="col-sm-12 col-md-7">
                                <input id="custom" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                     autocomplete="name" autofocus value="{{ old('name',$faq->name )}}">
                                @error('name')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @foreach ( $faq_translation as $faq_trans )
                        <div class="form-group row mb-4">
                            <label for="question"
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Question for ') }}{{ $faq_trans->language->language }}*</label>
                            <div class="col-sm-12 col-md-7">
                                <input id="custom[{{$faq_trans->language->id}}]" type="text"
                                    class="form-control @error('custom.'.$faq_trans->language->id.'.question') is-invalid @enderror" name="custom[{{$faq_trans->language->id}}][question]"
                                    value="{{ old('question', $faq_trans->question) }}" autocomplete="question" autofocus>
                                @error('custom[{{$faq_trans->language->id}}]')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Answer for ') }}{{ $faq_trans->language->language }}:*</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote @error('custom.'.$faq_trans->language->id.'.answer') is-invalid @enderror" id="custom[{{$faq_trans->language->id}}]" rows="3"
                                    name="custom[{{$faq_trans->language->id}}][answer]" autocomplete="answer"
                                    autofocus>{{ old('answer', $faq_trans->answer) }}</textarea>
                                @error('custom[{{$faq_trans->language->id}}]')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @endforeach

                        @if (env('APP_ENV') != 'demo')
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-custom">{{ __('Update') }}</button>
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