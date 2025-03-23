@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header">
    <h1>{{ __( 'Client Groups') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('client_groups.index') }}">{{ __('Client Groups') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Add Client Group') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Add Client Group') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('client_groups.store') }}">
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


                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Description') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea id="description"
                                        class="summernote-simple @error('description') is-invalid @enderror"
                                        name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4" id="clients">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Select clients') }}:</label>
                                <div class="col-sm-12 col-md-7" v-if="clients">
                                    <input type="hidden" ref="client_ref" id="client_ref_id" value=""
                                        name="client_ids" />
                                    <select-clients multiple :options="clients" taggable push-clients
                                        v-model="selected_clients" :reduce="clients => clients.id" label="first_name"
                                        @input="chooseMe">
                                    </select-clients>
                                    @error('client_ids')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="custom-radio custom-control">
                                        <input class="custom-control-input" type="radio" name="status" id="groupEnable"
                                            value=1 checked>
                                        <label class="custom-control-label" for="groupEnable">
                                            {{ __('Enable') }}
                                        </label>
                                    </div>
                                    <div class="custom-radio custom-control">
                                        <input class="custom-control-input" type="radio" name="status" id="groupDesable"
                                            value=0>
                                        <label class="custom-control-label" for="groupDesable">
                                            {{ __('Disable') }}
                                        </label>
                                    </div>
                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        {{ __('Enable to activate this client group') }}.
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

<script>
    var id = null;
    var current_clients = null;
</script>
<script src="{{ asset('js/clients.js') }}"></script>
@endsection