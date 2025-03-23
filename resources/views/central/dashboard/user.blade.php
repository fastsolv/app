@extends('central.layouts.new_user_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Dashboard') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item custom-style"><a
                href="{{ $protocol }}{{ $tenant->id }}.{{ $central }}" target="_blank">{{ $tenant->id }}.{{ $central }}</a>
        </div>
    </div>
</div>

<div class="section-body">
    @include('common.demo')
    @include('common.errors')
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                {{-- <a href="{{ route('ticket.index') }}"> --}}
                <div>
                    <div class="custom-card-icon bg-card-dash-1">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Tickets') }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $result['ticket_count'] }}
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                {{-- <a href="{{ route('tickets', 1) }}"> --}}
                <div>
                    <div class="custom-card-icon bg-card-dash-2">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Web Tickets') }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $result['web_ticket_count'] }}
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                {{-- <a href="{{ route('tickets', 6) }}"> --}}
                <div>
                    <div class="custom-card-icon bg-card-dash-3">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Email Tickets') }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $result['imap_ticket_count'] }}
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                {{-- <a href="{{ route('ticket.index') }}"> --}}
                <div>
                    <div class="custom-card-icon bg-card-dash-1">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Users') }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $result['users_count'] }}
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                {{-- <a href="{{ route('tickets', 1) }}"> --}}
                <div>
                    <div class="custom-card-icon bg-card-dash-2">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Staff') }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $result['staff_count'] }}
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                {{-- <a href="{{ route('tickets', 6) }}"> --}}
                <div>
                    <div class="custom-card-icon bg-card-dash-3">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Departments') }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $result['department_count'] }}
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row col-12">
        <div class="col-12 col-md-7">

            @if ($service)
            @if ($service->status_id == "1" && $service->orders->status == "active")
            <div class="card  bg-success-dark">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2>{{ __("You have activated") }} {{ $service->plans->name }} {{ __('subscription for') }} {{ $service->pricing->term }} {{ __($service->pricing->period) }}.</h2>
                        <p class="lead">
                            {{ __("Your plan will expire on") }}
                            {{ \Carbon\Carbon::parse($service->expiry_date)->format('d-M-Y') }}.
                        </p>
                    </div>
                </div>
            </div>
            @elseif ($service->status_id == "1" && $service->orders->status !== "active")
            <div class="card  bg-danger">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2>{{ __("Your order is not confirmed") }}.</h2>
                        <p class="lead">
                            {{ __("Your order for") }} {{ __($service->plans->name) }}
                            {{ __('subscription is not confirmed. Please wait sometimes or contact support') }}.
                        </p>
                    </div>
                </div>
            </div>
            @else
            <div class="card  bg-danger">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2>{{ __("Your plan is expired") }}.</h2>
                        <p class="lead">
                            {{ __('Please subscribe to a plan to use our service') }}.<a
                                href="{{ route('plan_details.index') }}" class="btn bg-transparent text-primary">
                                {{ __('Click here') }}.</a>
                        </p>
                    </div>
                </div>
            </div>
            @endif
            @else
            <div class="card  bg-danger">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2>{{ __('You have no subscriptions yet') }}</h2>
                        <p class="lead">
                            {{ __('Please subscribe to a plan to use our service') }}.<a
                                href="{{ route('plan_details.index') }}" class="btn bg-transparent text-primary">
                                {{ __('Click here') }}.</a>
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-12 col-md-5">

            @if ($tenant->MAIL_HOST && $tenant->MAIL_USERNAME)
            <div class="card  bg-success-dark">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2>{{ __('SMTP details updated') }}.</h2>
                        <p class="lead"><a href="{{ route('smtp.create') }}" class="btn bg-white text-success-dark">
                                {{ __('Update') }}</a>
                        </p>
                    </div>
                </div>
            </div>
            @else
            <div class="card  bg-danger">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2>{{ __('Update your SMTP details') }}.</h2>
                        <p class="lead"><a href="{{ route('smtp.create') }}" class="btn bg-white text-danger">
                                {{ __('Update') }}</a>
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
