@extends('layouts.theme')

@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid p-3">
                @include('common.demo')
                @include('common.errors')
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('Hi boss!') }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
