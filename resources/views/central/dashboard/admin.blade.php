@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Dashboard') }}</h1>
</div>

@include('common.admin')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Income Statistics') }}</h4>
            </div>
            <div class="card-body">
                @foreach ($currencies as $currency)
                <div class="card income-card">
                    <div class="statistic-details mt-sm-4">
                        <div class="statistic-details-item">
                            <div class="detail-value">{{ $currency->prefix }}{{ number_format($totalIncome[$currency->id], 2) }}</div>
                            <div class="detail-name">{{ __('Total Income in') }} {{ $currency->currency }}</div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-primary"><i class="fas fa-square"></i></span>
                                {{ $totalIncome[$currency->id] !== 0 ? round($todayIncome[$currency->id]*100/$totalIncome[$currency->id], 2) : 0}}%</span>
                            <div class="detail-value">{{ $currency->prefix }}{{ number_format($todayIncome[$currency->id], 2) }}</div>
                            <div class="detail-name">{{ __('Todays Sales') }}</div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-success-dark"><i
                                        class="fas fa-square"></i></span>
                                {{ $totalIncome[$currency->id] !== 0 ? round($thisMonthIncome[$currency->id]*100/$totalIncome[$currency->id], 2) : 0 }}%</span>
                            <div class="detail-value">{{ $currency->prefix }}{{ number_format($thisMonthIncome[$currency->id], 2) }}</div>
                            <div class="detail-name">{{ __('This Months Sales') }}</div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-custom"><i class="fas fa-square"></i></span>
                                {{ $totalIncome[$currency->id] !== 0 ? round($thisYearIncome[$currency->id]*100/$totalIncome[$currency->id], 2) : 0 }}%</span>
                            <div class="detail-value">{{ $currency->prefix }}{{ number_format($thisYearIncome[$currency->id], 2) }}</div>
                            <div class="detail-name">{{ __('This Years Sales') }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div class="mb-3">
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            {{-- <a href="{{ route('ticket.index') }}"> --}}
            <div>
                <div class="custom-card-icon bg-card-dash-1">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Orders') }}</h4>
                    </div>
                    <div class="card-body">
                        {{ $orders_count }}
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            {{-- <a href="{{ route('tickets', 1) }}"> --}}
            <div>
                <div class="custom-card-icon bg-card-dash-2">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Paid Orders') }}</h4>
                    </div>
                    <div class="card-body">
                        {{ $paidOrders }}
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            {{-- <a href="{{ route('tickets', 6) }}"> --}}
            <div>
                <div class="custom-card-icon bg-card-dash-3">
                    <i class="fas fa-running"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Trial Orders') }}</h4>
                    </div>
                    <div class="card-body">
                        {{ $trialOrders }}
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div>
                <div class="custom-card-icon bg-warning">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Tenants') }}</h4>
                    </div>
                    <div class="card-body">
                        {{ $tenants }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h4 class="inline-block">{{ __('Latest Orders') }}</h4>
                <a href="{{ route('orders.index') }}" class="btn btn-icon btn-custom float-right inline-block"><i
                        class="far fa-edit"></i>{{ __('See All') }}</a>
            </div>
            <div class="card-body">

                <div class="table-responsive pt-1">
                    @if (!count($orders))
                    <div class="empty-state pt-3" data-height="400">
                        <div class="empty-state-icon bg-danger">
                            <i class="fas fa-question"></i>
                        </div>
                        <h2>{{ __('No orders found') }} !!</h2>
                        <p class="lead">
                            {{ __('Sorry we cant find any data, to get rid of this message, make at least 1 entry') }}.
                        </p>
                        <a href="" class="btn btn-custom mt-4">{{ __('Create new One') }}</a>
                    </div>
                    @else
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr class="text-center text-capitalize">
                                <th>{{ __('Order Id') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>
                                    {{ __('Gateway') }}
                                </th>
                                <th>
                                    {{ __('Status') }}
                                </th>
                                <th>
                                    {{ __('Date') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td class="text-capitalize">{{ __($order->order_id) }}</td>
                                <td class="text-capitalize"><a
                                        href="{{ route('users.edit', [$order->user_id]) }}">{{ $order->user->first_name }}</a>
                                </td>
                                <td class="text-right">${{ number_format($order->amount, 2) }} {{ $order->currency }}
                                </td>
                                <td class="text-capitalize">{{ $order->gateway }}</td>

                                <td class="text-center">
                                    @if ($order->status == 'pending')
                                    <form action="{{ route('orders.update', [$order->uuid]) }}" method="POST">
                                        @csrf
                                        <input name="_method" type="hidden" value="PUT">
                                        <button class="btn btn-success bg-success-dark btn-sm">
                                            {{ __('Accept') }}
                                        </button>
                                    </form>
                                    @elseif ($order->status == 'fresh')
                                    <span class="text-danger">{{ __('Fresh') }}</span>
                                    @else
                                    <span class="text-success-dark">{{ __('Accepted') }}</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection