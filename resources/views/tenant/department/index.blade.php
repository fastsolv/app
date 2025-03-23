@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )

@section('content')

<div class="section-header shadow-none">
    <h1>{{ __('Departments') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Departments') }}</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    @if($show_add_button)
                    <small id='main'>
                        <a href="{{ route('department.create') }}"
                            class="btn btn-custom  float-right add_button">{{__('Add')}}</a>
                    </small>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (!count($departments))
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>{{ __('No data found') }} !!</h2>
                            <p class="lead">
                                {{ __('Sorry we cant find any data, to get rid of this message, make at least 1 entry') }}.
                            </p>
                            <a href="{{ route('department.create') }}"
                                class="btn btn-custom mt-4">{{ __('Create new One') }}</a>
                        </div>
                        @else
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_departments',['name' => 'name' ,'order'=>$sort_order]) }}">{{ __('Name') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                        <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_departments',['name' => 'email' ,'order'=>$sort_order]) }}">{{ __('Email') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                   <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_departments',['name' => 'description' ,'order'=>$sort_order]) }}">{{ __('Description') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                    @if (($imap_enables->value) == '1')
                                    
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_departments',['imap_status' => 'name' ,'order'=>$sort_order]) }}">{{ __('IMAP status') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                   
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_departments',['smtp_status' => 'name' ,'order'=>$sort_order]) }}">{{ __('SMTP status') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                    
                                    @endif
                                    @if($show_edit_button || $show_delete_button)
                                    <th></th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                <tr>
                                    <td class="text-capitalize">{{$department->name}}</td>
                                    <td>{{$department->email}} </td>
                                     <td>{{ Str::limit($department->description, 30) }}</td>
                                    @if (($imap_enables->value) == '1')

                                    @if (($department->imap_status) == true)
                                    <td class="text-success">{{ __('Active') }}</td>
                                    @else
                                    <td class="text-danger">{{ __('Inactive') }}</td>
                                    @endif

                                    @if (($department->smtp_status) == true)
                                    <td class="text-success">{{ __('Active') }}</td>
                                    @else
                                    <td class="text-danger">{{ __('Inactive') }}</td>
                                    @endif

                                    @endif
                                    @if($show_edit_button || $show_delete_button)
                                    <td class="justify-content-center form-inline">
                                    @if($show_edit_button)
                                        <a href="{{ route('department.edit', [$department->id]) }}"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="{{ __('Edit') }}"></i></a>@endif
                                                @if($show_delete_button)
                                        <form action="{{ route('department.destroy', [$department->id]) }}"
                                            method="POST">
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
                        <br>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection