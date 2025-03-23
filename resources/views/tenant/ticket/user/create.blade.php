
@extends( 
        ($theme =="white") ? 'tenant.layouts.white_user_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_user_theme':
    (($theme =="green") ? 'tenant.layouts.green_user_theme':
    (($theme =="black") ? 'tenant.layouts.black_user_theme':
    (($theme =="blue") ?'tenant.layouts.blue_user_theme' :   'tenant.layouts.yellow_user_theme'))))
    )

@section('content')

<div class="col-lg-10 offset-lg-1">
<div class="section-header">
    <h1><a href="{{ route('get_tickets') }}"><i class="fas fa-arrow-circle-left custom-back"></i></a>
        {{ __('Open Ticket') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('get_tickets') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Open ticket') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Open Ticket') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            @if(Auth::check())
                             @if($products)
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Product') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" id="product_id" name="product_id">
                                    <option value="">{{ __('None') }}</option>
                                        @foreach($products as $product)
                                        @if (old('product_id') == $product->uuid)
                                        <option  value="{{ $product->uuid}}">
                                            {{__($product->product_name)}}</option>
                                        @else
                                        <option value="{{$product->uuid}}">{{__($product->product_name)}}</option>
                                        @endif
                                        @endforeach
                                    </select>

                                    <!-- <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        {{ __('Here you need to select the department to wich the ticket should be assigned') }}.
                                        <br>
                                    </small> -->
                                </div>
                            </div>
                            @endif

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Department') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" id="department" name="department_id">
                                        @foreach($department as $department)
                                        @if (old('department_id') == $department->id)
                                        <option selected value="{{$department->id}}">
                                            {{__($department->name)}}</option>
                                        @else
                                        <option value="{{$department->id}}">{{__($department->name)}}</option>
                                        @endif
                                        @endforeach
                                    </select>

                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        {{ __('Here you need to select the department to wich the ticket should be assigned') }}.
                                        <br>
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Priority') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" id="urgency" name="ticket_urgency_id">
                                        @foreach($ticketUrgency as $urgency)
                                        @if (old('ticket_urgency_id') == $urgency->id)
                                        <option selected value="{{$urgency->id}}">{{__($urgency->name)}}</option>
                                        @else
                                        <option value="{{$urgency->id}}">{{__($urgency->name)}}</option>
                                        @endif
                                        @endforeach
                                    </select>

                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        {{ __('Here you need to select the priority of your ticket') }}.
                                        <br>
                                    </small>
                                </div>
                            </div>

                            <input type="hidden" name="opened_user_id" value="{{ $user_id }}" />

                            <input type="hidden" name="ticket_user_id" value="{{ $user_id }}" />
                            <input type="hidden" name="opened_user_id" value="{{ $user_id }}" />
                            <input type="hidden" name="opened_by" value="user" />
                            @endif
                            
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Subject') }}:</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ old('title') }}" autocomplete="title" autofocus>
                                    @error('title')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Description') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea id="ticket_message"
                                        class="summernote @error('message') is-invalid @enderror"
                                        name="message">{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('(Attach multiple files.)') }}:</label>
                            <div class="col-sm-12 col-md-7">
                                <input id="input-2" name="attachments[]" type="file" class="form-control file" multiple
                                    data-show-upload="true" data-show-caption="true">
                                @error('attachments.*')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                                <small class="text-success"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                    {{ __('The attachments must be a file of type: ')}}{{ $extension }}.
                                </small>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-custom">{{ __('Add') }}</button>
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