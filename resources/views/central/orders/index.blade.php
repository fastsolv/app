@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Orders') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('orders.index') }}">{{ __('Orders') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('List of Orders') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.admin')
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('List of Orders') }}</h4>

                    <div class="search-bar float-right inline-block">
                        <form action="/orders" method="get">
                            <div class="input-group mb-2 ">
                                <input type="text" name="search" class="form-control search-bar-input"
                                    placeholder="Search" value="{{ request()->input('search') }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-custom search-bar-button"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
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
                                    <td class="text-right">${{ number_format($order->amount, 2) }} {{ $order->currency }}</td>
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
                        <br>
                        {{ $orders->appends($request->all())->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection