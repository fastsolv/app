@extends('central.layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Users') }}</h1>
    <div class="section-header-breadcrumb">
        {{-- <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></div> --}}
        <div class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('Users') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('List of Users') }}</div>
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
                    <h4 class="inline-block">{{ __('List of Users') }}</h4>
                    <a href="{{ route('users.create') }}" class="btn btn-icon btn-custom float-right inline-block"><i
                            class="far fa-edit"></i>{{ __('Add User') }}</a>
                </div>
                <div class="card-body">

                    <div class="search-bar">
                        <form action="/users" method="get">
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

                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="text-capitalize">{{ __($user->first_name) }} {{ __($user->last_name) }}
                                    </td>
                                    <td>{{ __($user->email) }}</td>
                                    <td class="text-capitalize">{{ __($user->statuses->name) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                                    <td class="justify-content-center form-inline">
                                        @if (env('APP_ENV') != 'demo')
                                        <a href="{{ route('users.edit', [$user->id]) }}"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="{{ __('Edit') }}"></i></a>
                                        <form action="{{ route('users.destroy', [$user->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm bg-transparent"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"
                                                    title="{{ __('Delete') }}"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $users->appends($request->all())->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection