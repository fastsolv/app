@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header">
    <h1>{{ __('Profile') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Profile') }}</div>
    </div>
</div>
<div class="section-body">
    <h2 class="section-title">{{ __('Hi') }}, {{ $first_name }}!</h2>
    <p class="section-lead">
        {{ __('Change information about yourself on this page') }}.
    </p>

    @include('common.demo')
    @include('common.errors')
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-4">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                    <img alt="image" src="/images/avatar-1.png" class="rounded-circle profile-widget-picture">
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name text-capitalize">{{ $first_name }} {{ $last_name }}</div>
                    <div class="text-custom d-inline mr-2 text-capitalize">
                        {{ __($role) }}
                    </div>
                    <div>
                        <div>{{ $email }}</div>
                        @if (Auth::check() && Auth::user()->role == 'staff')
                        <div><b>{{ __('Departments:') }}</b></div>

                        @foreach($departments as $department)
                        @if (in_array($department->id, $selected_department))
                        <div class="ml-3">
                            <div>
                                - {{__($department->name)}}<br>
                            </div>
                        </div>
                        @endif
                        @endforeach

                        @if (empty($selected_department))
                        <div class="ml-3">- {{__('No departments')}}</div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-8 pt-lg-5-custom">
            <div class="card">
                <form method="POST" action="{{ route('profileUpdate') }}">
                    @csrf
                    <div class="card-header">
                        <h4>{{ __('Edit Profile') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>{{ __('First Name') }}*</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    name="first_name" value="{{ old('first_name', $first_name) }}" autocomplete="first_name" autofocus>
                                @error('first_name')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>{{ __('Last Name') }}*</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name" value="{{ old('last_name', $last_name) }}" autocomplete="last_name" autofocus>
                                @error('last_name')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>{{ __('Email') }}*</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $email) }}" autocomplete="name" autofocus
                                    {{ ( $role == 'admin' ) ? '' : 'readonly' }}>
                                @error('email')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>{{ __('Old Password') }}*</label>
                                <input id="old_password" type="password"
                                    class="form-control @error('old_password') is-invalid @enderror" name="old_password"
                                    value="" autocomplete="old_password" autofocus
                                    placeholder="{{__('Enter if you want to change')}}">
                                @error('old_password')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>{{ __('New password') }}*</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    value="" autocomplete="password" autofocus>
                                @error('password')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label>{{ __('Confirm password') }}*</label>
                                <input id="c_password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="c_password"
                                    value="" autocomplete="c_password" autofocus>
                                @error('c_password')
                                <div class="text-danger pt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    @if (env('APP_ENV') != 'demo')
                    <div class="card-footer text-right">
                        <button class="btn btn-custom">{{ __('Update') }}</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>

    </div>
</div>
@endsection