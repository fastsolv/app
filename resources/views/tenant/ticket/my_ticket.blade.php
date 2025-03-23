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
        <div class="breadcrumb-item">{{ __('Tickets Opened By Me') }}</div>
    </div>
</div>

<div class="section-body" id="app1">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">

                <div class="card-header">
                    <h4 class="inline-block">{{ __('Tickets Opened By Me') }}</h4>
                </div>
                <div class="card-body">
                    <a  href="{{ route('my_ticket',['filter_search' => 'filter_search' ]) }}" class="form-group m-2 row float-left">
                            <div>
                                <button type="submit" class="btn btn-custom"><i class="fas fa-search"></i>
                                    {{ __(' Apply Filter') }}</button>
                            </div>
                        </a>

                    <div class="table-responsive pt-1">
                        <div class="user-ticket-divider"></div>
                        @if (!count($tickets))
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>{{ __('No tickets found') }} !!</h2>
                            <p class="lead">
                                {{ __('Sorry we cant find any data, to get rid of this message, make at least 1 entry') }}.
                            </p>
                            <a href="{{ route('ticket.create') }}"
                                class="btn btn-custom mt-4">{{ __('Create new One') }}</a>
                        </div>
                        @else
                        <table class="table table-striped pt-3" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('my_ticket',['name' => 'tid' ,'order'=>$sort_order]) }}">{{ __('Ticket ID') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                    
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('my_ticket',['name' => 'opened_user_id' ,'order'=>$sort_order]) }}">{{ __('customer') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                   
                                
                                    
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('my_ticket',['name' => 'title' ,'order'=>$sort_order]) }}">{{ __('Subject') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                    
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('my_ticket',['name' => 'ticket_status_id' ,'order'=>$sort_order]) }}">{{ __('Status') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                 
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('my_ticket',['name' => 'ticket_urgency_id' ,'order'=>$sort_order]) }}">{{ __('Priority') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                             
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('my_ticket',['name' => 'department_id' ,'order'=>$sort_order]) }}">{{ __('Department') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                 
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('my_ticket',['name' => 'last_touched_at' ,'order'=>$sort_order]) }}">{{ __('Last action') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)

                                @if ($ticket->ticketUnread )
                                <tr class="bg-table-custom font-weight-bold-custom">
                                    <td>#{{ ($ticket->tid) }}</td>
                                    <td>{{ ($ticket->openedUser->name) }}</td>
                                    <td><a class="font-weight-bold-custom"
                                            href="{{ route('ticket.reply', [$ticket->uuid]) }}">{{ Str::limit($ticket->title, 30) }}</a>
                                        @if (count($ticket->tags))
                                        <br>
                                        @foreach ($ticket->tags as $tag)
                                        <span class="tag-badge badgesize text-white"
                                            style="color: {{ $tag->text_color }} !important;background-color: {{ $tag->tag_color }} !important;">
                                            {{$tag->name}}</span>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td><span class="badge text-white"
                                            style="color: {{$ticket->ticketStatus->text_color}} !important;background-color: {{$ticket->ticketStatus->color}} !important;">{{ __($ticket->ticketStatus->title) }}</span>
                                    </td>
                                    <td>{{ __($ticket->ticketUrgency->name) }}
                                    </td>
                                    <td>{{ __($ticket->department->name) }}
                                    </td>
                                    <td>{{$ticket->last_touched_at->diffForHumans()}}
                                    </td>
                                    @if (env('APP_ENV') != 'demo')
                                    <td>
                                        <form action="{{ route('ticket.destroy', [$ticket->uuid]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn bg-transparent"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"
                                                    title="{{ __('Delete') }}"></i>
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @else
                                <tr>
                                    <td>#{{ ($ticket->tid) }}</td>
                                    <td>{{ ($ticket->openedUser->name) }}</td>
                                    <td><a
                                            href="{{ route('ticket.reply', [$ticket->uuid]) }}">{{ Str::limit($ticket->title, 30) }}</a>
                                        @if (count($ticket->tags))
                                        <br>
                                        @foreach ($ticket->tags as $tag)
                                        <span class="tag-badge badgesize text-white"
                                            style="color: {{ $tag->text_color }} !important;background-color: {{ $tag->tag_color }} !important;">
                                            {{$tag->name}}</span>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td><span class="badge text-white"
                                            style="color: {{$ticket->ticketStatus->text_color}} !important;background-color: {{$ticket->ticketStatus->color}} !important;">{{ __($ticket->ticketStatus->title) }}</span>
                                    </td>
                                    <td>{{ __($ticket->ticketUrgency->name) }}
                                    </td>
                                    <td>{{ __($ticket->department->name) }}
                                    </td>
                                    <td>{{$ticket->last_touched_at->diffForHumans()}}
                                    </td>
                                    @if (env('APP_ENV') != 'demo')
                                    <td>
                                        <form action="{{ route('ticket.destroy', [$ticket->uuid]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn bg-transparent"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"
                                                    title="{{ __('Delete') }}"></i>
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $tickets->appends($request->all())->links("pagination::bootstrap-4") }}

                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  var uuid = '';
  var current_tags = '';
</script>
<script src="{{ asset('js/ticket.js') }}"></script>
@endsection