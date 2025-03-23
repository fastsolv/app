
@extends( 
        ($theme =="white") ? 'tenant.layouts.white_user_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_user_theme':
    (($theme =="green") ? 'tenant.layouts.green_user_theme':
    (($theme =="black") ? 'tenant.layouts.black_user_theme':
    (($theme =="blue") ?'tenant.layouts.blue_user_theme' :   'tenant.layouts.yellow_user_theme'))))
    )

@section('content')

<div class="section-header">
  <h1><a href="{{ route('get_tickets') }}"><i class="fas fa-arrow-circle-left custom-back"></i></a>
        {{ __('Tickets') }}</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
    <div class="breadcrumb-item"><a href="{{ route('get_tickets') }}">{{ __('Tickets') }}</a>
    </div>
    <div class="breadcrumb-item">{{ __('Feedback') }}</div>
  </div>
</div>

<div class="section-body">

  <div>
    <div class="row">
      <div class="col-12">
        @include('common.demo')
        @include('common.errors')

        <div class="card">
          <div class="card-header">
            <h4>{{ __('Add Feedback') }}</h4>
          </div>
        
          <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('ticket.reply', [$ticket->uuid]) }}">{{ __('Reply') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('ticket.modify', [$ticket->uuid]) }}">{{ __('Modify') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link "
                  href="{{ route('ticket.note', [$ticket->uuid]) }}">{{ __('Private Notes') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"
                  href="{{ route('ticket.feedback', [$ticket->uuid]) }}">{{ __('Feedback') }}</a>
              </li>
              @if (Auth::check() && Auth::user()->role != 'user')
              <li class="nav-item">
                <a class="nav-link"
                  href="{{ route('ticket.internal_note', [$ticket->uuid]) }}">{{ __('Internal Notes') }}</a>
              </li>
              @endif
            </ul>
            <br>
            <h2>Feedback</h2>
            @if(!$ticket->feedback_text||$show_feedback)
            <div class="tab-content">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form action="/{{$ticket->uuid}}/ticket_feedback" method="post">
                  @csrf

                  <div class="form-group ">
                                               <input type="hidden" name="booking_id" value="">
                                                <div class="">
                                                   <div class="">
                                                    <div >
                                                      <input type="radio" id="star5" class="rate" name="rating" value="5"  @if($ticket->rating==5) checked @endif />
                                                      <label for="star5" title="text">5 stars  (<label for="">Excellent</label>)    ⭐  ⭐  ⭐  ⭐  ⭐</label>
                                                        </div>
                                                      <div>
                                                    
                                                      <input type="radio"  id="star4" class="rate" name="rating" value="4" @if($ticket->rating==4) checked @endif />
                                                      <label for="star4" title="text">4 stars (<label for="">Very Good</label>)    ⭐  ⭐  ⭐  ⭐</label>
                                                     
                                                      </div>
                                                      <div>
                                                     
                                                      <input type="radio" id="star3" class="rate" name="rating" value="3" @if($ticket->rating==3) checked @endif />
                                                      <label for="star3" title="text">3 stars       (<label for="">Good  Acceptable</label>)    ⭐  ⭐  ⭐</label>
                                              
                                                      </div>
                                                      <div>
                                                     
                                                      <input type="radio" id="star2" class="rate" name="rating" value="2"  @if($ticket->rating==2) checked @endif />>
                                                      <label for="star2" title="text">2 stars   (<label for="">Weak</label>) ⭐  ⭐</label>
                                                    
                                                      </div>
                                                      <div>
                                                     
                                                      <input type="radio" id="star1" class="rate" name="rating" value="1"  @if($ticket->rating==1) checked @endif />/>
                                                      <label for="star1" title="text">1 star     (<label for="">Unacceptable</label>)  ⭐  </label>
                                                 
                                                      </div>
                                                      
                                                   </div>
                                                </div>
                                             </div>


                  <div class="form-group row">
                    <div class="col-sm-12">
                      <textarea placeholder="{{ __('Enter your note here') }}" id="ticket_feedback"
                        class="summernote" name="feedback_text" autocomplete="feedback_text" autofocus>{{ old('feedback_text', $ticket->feedback_text) }} </textarea>
                      @error('feedback_text')
                      <div class="text-danger pt-1">{{ $message }}</div>
                      @enderror
                    </div>
                  </div >
                
                 
                  <div class="form-group">
                          <button type="submit" class="btn btn-custom">{{ __('Add Feedback') }}</button>
                </div>
                </form>

              </div>
            </div>
            @endif
         @if($ticket->feedback_text && !$show_feedback)
            <br>
            <div class="row col-12">
              <div class="col-2 col-md-1">
                <div class="row">
                  <div class="ticket-sender-picture img-shadow">
                    <img src="/images/avatar-1.png" alt="image" height="55px" class="rounded-circle center">
                  </div>
                </div>
              </div>
              <div class="col-10  col-md-10">
                <div class="ticket-content">
                  <div class="ticket-header ">
                    <div class="ticket-title ">
                      <h5>{{$user->name}}</h5>
                    </div>
                    <div class="ticket-info">
                      <div class="font-weight-600 inline-block text-capitalize">
                        {{$ticket->role}}</div>
                      <div class="bullet inline-block"></div>
                      <div class="text-primary font-weight-600 inline-block">
                        {{$ticket->updated_at->diffForHumans()}}
                    </div>
                        
                   
                    </div>

                    <p class="text-success font-weight-600 inline-block">
                        @if($ticket->rating)
                        {{$ticket->rating}} Star </p>
                        @for ($i =1 ; $i <= $ticket->rating; $i++)
                       
                        ⭐
                        @endfor  
                       
                        @endif
                  </div>
                  <div class="ticket-divider"></div>
                  <div class="ticket-description text-capitalize">
                    <p>{!!$ticket->feedback_text!!}.</p>
                    

                  
                    
                  </div>
                </div>
              </div>
		    <div class=" col-2 col-md-1  inline-block">
                      <a href="{{ route('feedback_edit', [$ticket->uuid]) }}"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="{{ __('Edit') }}"></i></a>
                       <div class="inline-block">
                        <form action="{{ route('feedback_delete', [$ticket->uuid]) }}" method="POST">

                          @csrf
                          @method('DELETE')
                          <button class="btn bg-transparent" onclick="return confirm('Are you sure?')">
                            <i class="fa fa-trash text-danger" aria-hidden="true" title="{{ __('Delete') }}"></i>
                          </button>
                        </form>
				    </div>
                      </div>
				  
				  <div class="ticket-divider"></div>
            </div>
         @endif
           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection