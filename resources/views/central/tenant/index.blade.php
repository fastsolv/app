@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Tenants') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('tenants.index') }}">{{ __('Tenants') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('List of Tenants') }}</div>
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
                    <h4 class="inline-block">{{ __('List of Tenants') }}</h4>

                    <div class="search-bar float-right inline-block">
                        <form action="/tenants" method="get">
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
                                    <th>{{ __('Tenant Id') }}</th>
                                    <th>{{ __('Subdomain') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>
                                        {{ __('Status') }}
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenants as $tenant)
                                <tr>
                                    <td class="text-capitalize">{{ __($tenant->tenant_id) }}</td>
                                    <td><a href="{{ $protocol }}{{ $tenant->id }}.{{ $central }}" target="_blank">{{ $tenant->id }}.{{ $central }}</a></td>
                                    <td class="text-capitalize">{{ $user[$tenant->id] }}</td>

                                    <td class="text-center">
                                        @if ($tenant->status == true)
                                        <span class="text-success-dark">{{ __('Active') }}</span>
                                        @else
                                        <span class="text-danger">{{ __('Innactive') }}</span>
                                        @endif
                                    </td>
                                    <td class="justify-content-center form-inline">
                                        <a href="{{ route('tenants.edit', [$tenant->id]) }}"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="{{ __('Edit') }}"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $tenants->appends($request->all())->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
