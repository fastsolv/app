@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header text-capitalize">
    <h1>{{ __('Email Campaign') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Email Campaign') }}</div>
    </div>
</div>

<div class="section-body  text-capitalize">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('Custom List Email Campaign') }}</h4>
                    <a href="{{ route('custom_list_campaign.create') }}"
                        class="btn btn-icon btn-custom float-right inline-block"><i
                            class="far fa-edit"></i>{{ __('Add') }}</a>
                </div>
                <div class="card-body">
                    <div class="search-bar inline-block">
                        <form action="/custom_list_campaign" method="get">
                            <div class="input-group mb-2">
                                <input type="text" name="search" class="form-control search-bar-input"
                                    placeholder="Search" value="{{ request()->input('search') }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-custom search-bar-button"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="float-right inline-block">
                        <p class="float-right"><span class="text-custom font-weight-bold">{{ __('Current server time') }}:</span>
                            {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</p>
                    </div>
                    <div class="table-responsive">
                        @if (!count($email_campaigns))
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>{{ __('No data found') }} !!</h2>
                            <p class="lead">
                                {{ __('Sorry we cant find any data, to get rid of this message, make at least 1 entry') }}.
                            </p>
                            <a href="{{ route('client_groups.create') }}"
                                class="btn btn-custom mt-4">{{ __('Create new One') }}</a>
                        </div>
                        @else
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th>{{ __('Email template') }}</th>
                                    <th>{{ __('Time') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($email_campaigns as $email_campaign)
                                <tr class="text-capitalize">
                                    <td>{{ $email_campaign->emailTemplates->name }}</td>
                                    <td>{{ $email_campaign->send_at }}</td>

                                    @if (($email_campaign->status) == "done")
                                    <td class="text-success text-capitalize">{{ __($email_campaign->status) }}</td>
                                    @else
                                    <td class="text-danger text-capitalize">{{ __($email_campaign->status) }}</td>
                                    @endif

                                    <td class="justify-content-center form-inline">
                                        @if($email_campaign->status != "done")
                                        <a href="{{ route('custom_list_campaign.edit', [$email_campaign->uuid]) }}"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="{{ __('Edit') }}"></i></a>
                                        @endif
                                        <form action="{{ route('custom_list_campaign.destroy', [$email_campaign->uuid]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm bg-transparent"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"
                                                    title="{{ __('Delete') }}"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        <br>
                        {{ $email_campaigns->appends($request->all())->links("pagination::bootstrap-4") }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection