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
        <div class="breadcrumb-item">{{ __('Tickets') }}</div>
    </div>
</div>

<div class="section-body" id="app1">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">

                <div class="card-header">
                    <h4 class="inline-block">{{ __('List of Tickets') }}</h4>
                </div>
                <div class="card-body">
                    <!-- <form action="/ticket" method="get">
                        @csrf
                        <input type="hidden" name="action" value="modify_ticket" />
                        <div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="urgency">{{ __('Priority') }}</label>
                                    <select class="form-control selectric" id="urgency" name="ticket_urgency_id">
                                        <option value="0">{{ __('All') }}</option>
                                        @foreach($ticket_urgency as $urgency)
                                        @if (request()->input('ticket_urgency_id') == $urgency->id)
                                        <option selected value="{{$urgency->id}}">{{__($urgency->name)}}</option>
                                        @else
                                        <option value="{{$urgency->id}}">{{__($urgency->name)}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ticket_status">{{ __('Status') }}</label>
                                    <select class="form-control selectric" id="ticket_status" name="ticket_status_id">
                                        <option value="0">{{ __('All') }}</option>
                                        @foreach($ticket_statuses as $ticket_status)
                                        @if (request()->input('ticket_status_id') == $ticket_status->id)
                                        <option selected value="{{$ticket_status->id}}">{{__($ticket_status->title)}}
                                        </option>
                                        @else
                                        <option value="{{$ticket_status->id}}">{{__($ticket_status->title)}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="department">{{ __('Department') }}</label>
                                    <select class="form-control selectric" id="department" name="department_id">
                                        <option value="0">{{ __('None') }}</option>
                                        @foreach($department as $department)
                                        @if (request()->input('department_id') == $department->id)
                                        <option selected value="{{$department->id}}">{{__($department->name)}}</option>
                                        @else
                                        <option value="{{$department->id}}">{{__($department->name)}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                @if (Auth::check() && Auth::user()->role != 'user')
                                <div class="form-group col-md-6">
                                    <label for="assigned_to">{{ __('Assigned to') }}</label>
                                    <select class="form-control selectric" id="assigned_to" name="assigned_to">
                                        <option value="">{{ __('None') }}</option>
                                        @foreach($staffs as $staff)
                                        @if (request()->input('assigned_to') == $staff->id)
                                        <option selected value="{{$staff->id}}">{{$staff->name}}</option>
                                        @else
                                        <option value="{{$staff->id}}">{{$staff->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                <div class="form-group col-md-6" v-if="tags">
                                  <label for="department">{{ __('Tags') }}</label>
                                  <input type="hidden" ref="tag_ref" id="tag_ref_id" value="" name="tag_ids" />
                                  <ticket-tags multiple :options="tags" taggable push-tags v-model="selected_tags"
                                    :reduce="tags => tags.uuid" label="name" @input="chooseMe">
                                  </ticket-tags>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="search">{{ __('Search') }}</label>
                                    <input type="text" class="form-control" id="search"
                                        value="{{ request()->input('search') }}" name="search" placeholder="{{ __('Search with Ticket ID or Subject') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-2 row float-left">
                            <div>
                                <button type="submit" class="btn btn-custom"><i class="fas fa-search"></i>
                                    {{ __('Filter') }}</button>
                            </div>
                        </div>
                    </form> -->
                    <a  href="{{ route('get_tickets',['filter_search' => 'filter_search' ]) }}" class="form-group m-2 row float-left">
                            <div>
                                <button type="submit" class="btn btn-custom"><i class="fas fa-search"></i>
                                    {{ __(' Apply Filter') }}</button>
                            </div>
                        </a>

                    <div class="table-responsive pt-1">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active"
                                    href="{{ route('get_tickets') }}"></i><span>{{ __('All Tickets') }}</span></a>
                            </li>
                            @foreach ($statuses as $status)
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('tickets', [$status->id]) }}"><span>{{ __($status->title) }}</span></a>
                            </li>
                            @endforeach
                        </ul>
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
                        </div>
                        @else
                        <table class="table table-striped pt-3" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                   
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_tickets',['name' => 'tid' ,'order'=>$sort_order]) }}">{{ __('Ticket ID') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                    
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_tickets',['name' => 'opened_user_id' ,'order'=>$sort_order]) }}">{{ __('customer') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                   
                                
                                    
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_tickets',['name' => 'title' ,'order'=>$sort_order]) }}">{{ __('Subject') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                    
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_tickets',['name' => 'ticket_status_id' ,'order'=>$sort_order]) }}">{{ __('Status') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                 
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_tickets',['name' => 'ticket_urgency_id' ,'order'=>$sort_order]) }}">{{ __('Priority') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                             
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_tickets',['name' => 'department_id' ,'order'=>$sort_order]) }}">{{ __('Department') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                 
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_tickets',['name' => 'last_touched_at' ,'order'=>$sort_order]) }}">{{ __('Last action') }} 
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
                                    <td> <a class="font-weight-bold-custom"
                                            href="{{ route('ticket.reply', [$ticket->uuid]) }}">{{ Str::limit($ticket->title, 30) }}
                                        </a>
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
                                    <td>{{__($ticket->department->name)}}
                                    </td>
                                    <td>{{$ticket->last_touched_at->diffForHumans()}}
                                    </td>
                                    @if (env('APP_ENV') != 'demo')
                                    <td class="justify-content-center form-inline">
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
                                    <td>{{__($ticket->department->name)}}
                                    </td>
                                    <td>{{$ticket->last_touched_at->diffForHumans()}}
                                    </td>
                                    @if (env('APP_ENV') != 'demo')
                                    <td class="justify-content-center form-inline">
                                        @if (Auth::check() && Auth::user()->role == 'admin')
                                        <a href="{{ route('ticket.show', [$ticket->uuid]) }}"
                                            class="btn btn-sm bg-transparent"><i class="fas fa-eye text-primary"
                                                aria-hidden="true" title="{{ __('View') }}"></i></a>
                                        @endif
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
