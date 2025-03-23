@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header">
    <h1>{{ __('Users') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Users') }}</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('List of Users') }}</h4>
                    @if($show_add_button)
                    <small id='main'>
                        <a href="{{ route('user.create') }}"
                            class="btn btn-custom  float-right add_button">{{__('Add')}}</a>
                    </small>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (!count($users))
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>{{ __('No data found') }} !!</h2>
                            <p class="lead">
                                {{ __('Sorry we cant find any data, to get rid of this message, make at least 1 entry') }}.
                            </p>
                            <a href="{{ route('user.create') }}"
                                class="btn btn-custom mt-4">{{ __('Create new One') }}</a>
                        </div>
                        @else
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_users',['name' => 'name' ,'order'=>$sort_order]) }}">{{ __('Name') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                        <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_users',['name' => 'email' ,'order'=>$sort_order]) }}">{{ __('Email') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                    @if($show_edit_button || $show_delete_button)
                                    <th></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->email}} </td>
                                    @if($show_edit_button || $show_delete_button)
                                    <td class="justify-content-center form-inline">
                                    @if($show_edit_button)
                                        <a href="{{ route('user.edit', [$user->id]) }}"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="{{ __('Edit') }}"></i></a>@endif
                                                @if($show_delete_button)
                                        <form action="{{ route('user.destroy', [$user->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm bg-transparent"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"
                                                    title="{{ __('Delete') }}"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        <br>
                        {{ $users->appends($request->all())->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection