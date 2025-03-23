@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Currencies') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div> --}}
    <div class="breadcrumb-item">{{ __('Currencies') }}</div>
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
                    <h4>{{ __('List of Currencies') }}
                        <a href="{{ route('currency.create') }}"
                            class="btn btn-custom  float-right add_button">{{__('Add')}}</a>
                </div>
                <div class="card-body">

                    @if (!count($currencies))
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
                                    <th>{{ __('Prefix') }}</th>
                                    <th>{{ __('Currency') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($currencies as $currency)
                                <tr class="text-capitalize">
                                    <td>{{ $currency->prefix }}</td>
                                    <td>{{ $currency->currency }}</td>

                                    <td class="justify-content-center form-inline">
                                        <a href="{{ route('currency.edit', [$currency->id]) }}"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="{{ __('Edit') }}"></i></a>
                                        <form action="{{ route('currency.destroy', [$currency->id]) }}" method="POST">
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
@endsection