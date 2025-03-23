@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Subscriptions') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('services.index') }}">{{ __('Subscriptions') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('List of Subscriptions') }}</div>
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
                    <h4 class="inline-block">{{ __('List of Subscriptions') }}</h4>

                    <div class="search-bar float-right inline-block">
                        <form action="/services" method="get">
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
                                    <th>
                                        {{ __('Service ID') }}
                                    </th>
                                    <th>{{ __('Order Id') }}</th>
                                    <th>{{ __('User Name') }}</th>
                                    <th>{{ __('Plan') }}</th>
                                    <th>{{ __('Period') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>
                                        {{ __('Expiry Date') }}
                                    </th>
                                    <th>
                                        {{ __('Next Invoice Date') }}
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service->service_id }}</td>
                                    <td>{{ $service->orders->order_id }}</td>
                                    <td>{{ $service->user->first_name }} {{ $service->user->last_name }}</td>
                                    <td class="text-capitalize"> {{ __($service->plans->name) }} </td>
                                    <td class="text-capitalize"> {{ __($service->pricing->term) }} {{ __($service->pricing->period) }}</td>
                                    <td class="text-capitalize {{ ($service->statuses->name == 'active') ? "text-success" : "text-danger" }}">
                                    {{ __($service->statuses->name) }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($service->expiry_date)->format('d/m/Y g:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($service->next_invoice_date)->format('d/m/Y') }}</td>
                                    <td><a  href="{{ route('services.edit', [$service->uuid]) }}"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="{{ __('Edit') }}"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $services->appends($request->all())->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection