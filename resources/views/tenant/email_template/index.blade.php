@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )

@section('content')

<div class="section-header text-capitalize shadow-none">
    <h1>{{ __('Email Templates') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Email templates') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('System Templates') }}
                        </div>
                        <div class="card-body">

                            @if (!count($system_emails))
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon bg-danger">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <h2>{{ __('No data found') }} !!</h2>
                                    <p class="lead">
                                        {{ __('Sorry we cant find any data, to get rid of this message, make at least 1 entry') }}.
                                    </p>
                                </div>
                            </div>

                            @else
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr class="text-center text-capitalize">
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            @if($show_edit_button)
                                            <th></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($system_emails as $email)
                                        <tr class="text-capitalize">
                                            <td>{{ str_replace("_", " ", __($email->name))}}</td>

                                            @if (($email->status) == true)
                                            <td class="text-success">{{ __('enable') }}</td>
                                            @else
                                            <td class="text-danger">{{ __('desable') }}</td>
                                            @endif
                                            @if($show_edit_button)
                                            <td class="justify-content-center form-inline">
                                                <a href="{{ route('email_template.edit', [$email->uuid]) }}"
                                                    class="btn btn-sm bg-transparent"><i
                                                        class="far fa-edit text-primary" aria-hidden="true"
                                                        title="{{ __('Edit') }}"></i></a>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Custom Templates') }}
                            @if($show_add_button)
                                <small>
                                    <a href="{{ route('email_template.create') }}"
                                        class="btn btn-custom  float-right add_button">{{__('Add')}}</a>
                                </small>
                            @endif</h4>
                        </div>
                        <div class="card-body">

                            @if (!count($custom_emails))
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon bg-danger">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <h2>{{ __('No data found') }} !!</h2>
                                    <p class="lead">
                                        {{ __('Sorry we cant find any data, to get rid of this message, make at least 1 entry') }}.
                                    </p>
                                    <a href="{{ route('email_template.create') }}"
                                        class="btn btn-custom mt-4">{{ __('Create new One') }}</a>
                                </div>
                            </div>

                            @else
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr class="text-center text-capitalize">
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            @if($show_edit_button || $show_delete_button)
                                            <th></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($custom_emails as $email)
                                        <tr class="text-capitalize">
                                            <td>{{ str_replace("_", " ", __($email->name))}}</td>

                                            @if ($email->status == true)
                                            <td class="text-success">{{ __('enable') }}</td>
                                            @else
                                            <td class="text-danger">{{ __('desable') }}</td>
                                            @endif
                                            @if($show_edit_button || $show_delete_button)
                                            <td class="justify-content-center form-inline">
                                            @if($show_edit_button )
                                                <a href="{{ route('email_template.edit', [$email->uuid]) }}"
                                                    class="btn btn-sm bg-transparent"><i
                                                        class="far fa-edit text-primary" aria-hidden="true"
                                                        title="{{ __('Edit') }}"></i></a>@endif 
                                                        @if($show_delete_button)
                                                <form action="{{ route('email_template.destroy', [$email->uuid]) }}"
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
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection