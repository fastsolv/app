@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Invoices') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('invoices.index') }}">{{ __('Invoices') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Invoice Details') }}</div>
    </div>
</div>
@include('common.demo')
@include('common.admin')
@include('common.errors')
<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h3>{{ __('Invoice Details') }}</h3>
                        <div class="invoice-number">{{ __('Order') }} #{{ $invoice->orders->order_id }}</div>
                    </div>
                    <hr>
                    <div class="card card-invoice">
                        <div class="row  text-capitalize">
                            <div class="col-md-6">
                                <div class="card margin-0">
                                    <div class="card-body">
                                        <div class="form-group row margin-0">
                                            <label class="col-form-label text-md-right col-3">{{ __('Date') }}</label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2">{{ $invoice->created_at }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row margin-0">
                                            <label class="col-form-label text-md-right col-3">{{ __('Order') }}
                                                #</label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2">{{ $invoice->orders->order_id }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row margin-0">
                                            <label class="col-form-label text-md-right col-3">{{ __('Client') }}</label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2">{{ $user->first_name }} {{ $user->last_name }}<br>
                                                        {{ $user->address_1 }},<br>{{ $user->city }},
                                                        {{ $user->postal_code }},<br>{{ $user->states->name }},
                                                        {{ $user->countries->name }}<br></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row margin-0">
                                            <label
                                                class="col-form-label text-md-right col-3">{{ __('Payment Method') }}</label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2">{{ $invoice->gateway !== null ? $invoice->gateway : 'NA' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row margin-0">
                                            <label class="col-form-label text-md-right col-3">{{ __('Amount') }}</label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2">${{ $invoice->amount !== null ? number_format($invoice->amount, 2) : 'NA' }}
                                                        {{ $invoice->currency }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row margin-0">
                                            <label class="col-form-label text-md-right col-3">{{ __('Invoice') }}
                                                #</label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2">{{ $invoice->uuid !== null ? $invoice->uuid : 'NA' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row margin-0">
                                            <label
                                                class="col-form-label text-md-right col-3">{{ __('Transaction ID') }}</label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2">{{ $invoice->transaction_id !== null ? $invoice->transaction_id : 'NA' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">{{ __('Order Summary') }}</div>
                    <p class="section-lead">{{ __('Order details are listed here') }}.</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr class="text-center bg-custom-light">
                                <th data-width="40">#</th>
                                <th>{{ __('Plan') }}</th>
                                <th>{{ __('Billing cycle') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Paid amount') }}</th>
                                <th>{{ __('Payment status') }}</th>
                                <th>{{ __('Date') }}</th>
                                @if($invoice->refund_date)
                                <th>{{ __('Refund date') }}</th>
                                @endif
                            </tr>
                            <tr class="text-center">
                                <td>1</td>
                                <td class="text-capitalize">{{ __($plan->name) }}</td>
                                <td>{{ $validity }}</td>
                                <td>${{ number_format($pricing->price, 2) }} {{ $invoice->currency }}</td>
                                <td>${{ $invoice->amount !== null ? number_format($invoice->amount, 2) : 'NA' }} {{ $invoice->currency }}
                                </td>
                                <td class="text-capitalize">{{ __($invoice->payment_status) }}</td>
                                <td class="text-capitalize">{{ $invoice->created_at }}</td>
                                @if($invoice->refund_date)
                                <td>{{ $invoice->refund_date }}</td>
                                @endif
                            </tr>
                        </table>
                    </div>

                    @if ((env('APP_ENV') !== 'demo') && $invoice->payment_status == "paid")
                    <div class="text-md-right mt-4">
                        {{-- <div class="float-right ml-2">
                            <a class="btn btn-danger btn-icon icon-left" href=""><i
                                class="fas fa-times"></i> {{ __('Delete Order') }}</a>
                    </div> --}}
                    @if($invoice->transaction_id !== null)
                    <a class="btn btn-custom btn-icon icon-left float-right ml-1"
                        onclick="return confirm('Are you sure?')" href="{{ route('refund', $invoice->uuid) }}"><i
                            class="fas fa-times"></i> {{ __('Refund Order') }}</a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<br>


</div>
@endsection