@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header">
    <h1>{{ __('Tickets') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('get_tickets') }}">{{ __('Tickets') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Reply') }}</div>
    </div>
</div>

<div class="section-body">

    <div id="app1">
        <div class="row">
            <div class="col-12">
                @include('common.demo')
                @include('common.errors')


                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Make an Article') }}</h4>
                    </div>
                    <div class="card-body col-sm-12">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link "
                                        href="{{ route('ticket.reply', [$ticket->uuid]) }}">{{ __('Reply') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('ticket.modify', [$ticket->uuid]) }}">{{ __('Modify') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('ticket.note', [$ticket->uuid]) }}">{{ __('Private Notes') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('ticket.note', [$ticket->uuid]) }}">{{ __('Private Notes') }}</a>
                                </li>
                                @if (Auth::check() && Auth::user()->role != 'user')

                                <li class="nav-item">
                                    <a class="nav-link "
                                    href="{{ route('ticket.internal_note', [$ticket->uuid]) }}">{{ __('Internal Notes') }}</a>
                                </li>
                                @endif
                                @if($article)
                                <li class="nav-item">
                                    <a class="nav-link active"
                                        href="{{ route('ticket.make_article', [$ticket->uuid]) }}">{{ __('View Article') }}</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link active"
                                        href="{{ route('ticket.make_article', [$ticket->uuid]) }}">{{ __('Make an Article') }}</a>
                                </li>
                                @endif
                            </ul>
                           
                                    

                        </div>
                        <br>
                     
                        
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form action="/{{$ticket->uuid}}/make_article_edit/{{$article->uuid}}" method="post"
                                    >
                                    @csrf
                                    <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Article Category') }}:</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" id="category_id" name="category_id">
                                   
                                        @foreach($kb_category as $category)
                                        @if($article->category_id == $category->uuid) 
                                        <option value="{{$category->uuid}}" selected='selected'>{{__($category->name)}}</option>
                                         @else
                                        <option value="{{$category->uuid}}">{{__($category->name)}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Ticket name ') }}:</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" class="form-control" id="ticket_title" value="{{ old('name', $article->name) }}"
                                              name="ticket_name">
                                            </div>
                                        </div>
                                        @foreach ( $kb_article_translation as $kb_article_trans)           
                                        <div class="form-group row mb-4">
                                  <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Ticket Title ') }}{{ $kb_article_trans->language->language}}:</label>
                                     <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" id="custom[{{$kb_article_trans->language->id}}]" value="{{$kb_article_trans->title}}"
                                           name="custom[{{$kb_article_trans->language->id}}][ticket_title]">
                                            </div>
                                        </div>            
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Ticket Message ') }}{{$kb_article_trans->language->language}}:</label>
                                <div class="col-sm-12 col-md-7">
                                <textarea class="summernote @error('body') is-invalid @enderror" id="custom[{{$kb_article_trans->language->id}}]"
                                        rows="3" name="custom[{{$kb_article_trans->language->id}}][description]" autocomplete="description" autofocus> </p>{{  $kb_article_trans->description }} </p>
                                </textarea>
                                    @error('description')
                                    <div class="text-danger pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                                    @endforeach

                          

                                    <!-- Display invalid file extension error -->
                                    <div class="form-group col-6" v-if="display_error">
                                        <div class="alert alert-danger alert-dismissible text-center" >
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>@{{ error_message }}</strong>
                                        </div>
                                    </div>

                                

                                    <div class="form-group row mb-4">
                                    <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> </label>
                                        <button class="btn btn-custom"
                                            >{{ __('Update') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                   
                    </div>
                </div>
         
            </div>
        </div>
    </div>
</div>
<script>
    var api_url = '<?php echo url("/{$ticket->uuid}/ticket_reply"); ?>';
    var canned_api_url = '<?php echo url("/get_canned_responses_api"); ?>';
</script>
<script src="{{ asset('js/ticket-reply.js') }}"></script>
@endsection
