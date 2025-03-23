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
            @include('common.admin')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('List of Plans') }}
                     <a href="{{ route('plans.create') }}"
                            class="btn btn-custom  float-right add_button">{{__('Add')}}</a>
                </div>
                <div class="card-body">

                    @if (!count($plans))
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plans as $plan)
                                <tr class="text-capitalize">
                                    <td>{{ str_replace("_", " ", __($plan->name))}}</td>

                                    @if (($plan->status) == true)
                                    <td class="text-success">{{ __('enable') }}</td>
                                    @else
                                    <td class="text-danger">{{ __('desable') }}</td>
                                    @endif
                                    <td class="justify-content-center form-inline">
                                        <a href="{{ route('plans.edit', [$plan->uuid]) }}"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="{{ __('Edit') }}"></i></a>
                                        <form action="{{ route('plans.destroy', [$plan->uuid]) }}" method="POST">
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