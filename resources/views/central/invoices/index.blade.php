@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Invoices') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('invoices.index') }}">{{ __('Invoices') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('List of Invoices') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.admin')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('List of Invoices') }}</h4>

                    <div class="search-bar float-right inline-block">
                        <form action="/invoices" method="get">
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
                                        {{ __('Payment Status') }}
                                    </th>
                                    <th>
                                        {{ __('Status') }}
                                    </th>
                                    <th>
                                        {{ __('Invoice Date') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                <tr>
                                    <td><a href="{{ route('invoices.show', $invoice->uuid) }}">{{ $invoice->orders->order_id }}</a></td>
                                    <td class="text-capitalize">{{ $invoice->user->first_name }}</td>
                                    <td class="text-right">${{ number_format($invoice->amount, 2) }} {{ $invoice->currency }}</td>
                                    <td class="text-capitalize">{{ __($invoice->payment_status) }}</td>
                                    @if ($invoice->is_renew == true)
                                    <td>{{ __('Renew') }}</td>
                                    @else
                                    <td>{{ __('Normal') }}</td>
                                    @endif
                                    <td>{{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y g:i A') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $invoices->appends($request->all())->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection