@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )

@section('content')

<div class="section-header  shadow-none">
    <h1>{{ __('Feedback') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Feedback') }}</div>
    </div>
</div>

<div class="section-body">

    @include('common.demo')
    @include('common.errors')
    <div class="row">
        

        <div class="col-12">
            <div class="card">
              
                <div class="card-body">
                    <div class="table-responsive">
                        @if (!count($tickets))
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>{{ __("No Feedback's found") }} !!</h2>
                            {{-- <p class="lead">
                                {{ __('Sorry we cant find any data, to get rid of this message, make at least 1 entry') }}.
                            </p> --}}
                        </div>
                        @else
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                <th class="col-lg-8">{{ __('Feedback') }} </th>
                                <th>{{ __('Rating') }} </th>
                               
                                        
                                    @if (env('APP_ENV') != 'demo')
                                   
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td>{!!$ticket->feedback_text!!}</td>
                                    <td> @if($ticket->rating)
                        {{$ticket->rating}} Star 
                        @for ($i =1 ; $i <= $ticket->rating; $i++)
                    
                        ⭐
      @endfor  
      @endif
                                       <p> <a href="{{ route('ticket.reply', [$ticket->uuid]) }}">
                                            
                                           
                                                <span class="text-primary"
                                                    >{{ Str::limit($ticket->title, 30) }}</span>
                                          
                                        </a>
                                        </p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $tickets->appends($request->all())->links("pagination::bootstrap-4") }}
                        @endif
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection