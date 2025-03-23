@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Plans') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div> --}}
    <div class="breadcrumb-item">{{ __('Plans') }}</div>
</div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit Plan') }}
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('plans.edit', [$plan_id]) }}"></i><span>{{ __('Edit') }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active"
                                href="{{ route('pricing_index', [$plan_id]) }}"><span>{{ __('Pricing') }}</span></a>
                        </li>
                    </ul>
                    <div class="user-ticket-divider"></div>
                    <div class="tab-content pt-3" id="myTabContent">
                        <a href="{{ route('pricing_create', [$plan_id]) }}"
                            class="btn btn-custom mb-2 float-right add_button">{{__('Add')}}</a>

                        @if (!count($prices))
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
                                        <th>{{ __('Term') }}</th>
                                        <th>{{ __('Periode') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prices as $price)
                                    <tr class="text-capitalize">
                                        <td>{{ __($price->term) }}</td>
                                        <td>{{ __($price->period) }}</td>
                                        <td>{{ __($price->currencies->prefix) }}{{ __($price->price) }} {{ __($price->currencies->currency) }}</td>
                                        <td class="justify-content-center form-inline">
                                            <a href="{{ route('pricing_edit', [$price->id, $price->plans->uuid]) }}"
                                                class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                    aria-hidden="true" title="{{ __('Edit') }}"></i></a>
                                            <form action="{{ route('pricing.destroy', [$price->id]) }}" method="POST">
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
                            <br>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection