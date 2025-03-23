@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )

@section('content')

<div class="section-header shadow-none">
    <h1>{{ __('Settings') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Settings') }}</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
              
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_settings',['name' => 'name' ,'order'=>$sort_order]) }}">{{ __('Name') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                        <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('get_settings',['name' => 'value' ,'order'=>$sort_order]) }}">{{ __('Value') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                     <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $setting)
                                    <tr>
                                        <td class="text-capitalize">{{ str_replace("_", " ", __($setting->name)) }}</td>
                                        <td>
                                        @if($setting->value != null)
                                            @if($setting->type == 'radio')
                                                @if (($setting->value) == '1')
                                                <span class="text-success-dark">{{ __('Enabled') }}</span>
                                                @elseif (($setting->value) == '0')
                                                <span class="text-danger">{{ __('Disabled') }}</span>
                                                @endif
                                            @elseif ($setting->type == 'attachment')
                                            <img src="/system_logo/{{ __($setting->value) }}" height="30px" width="180px" />
                                            @elseif ($setting->type == 'language')
                                            {{ $setting->language->language }}
                                            @else
                                            {!! Str::limit(strip_tags($setting->value), 60) !!}
                                            @endif
                                        @else
                                        <i class="text-secondary">{{ __('Null') }}</i>
                                        @endif
                                        </td>
                                        <td class="justify-content-center form-inline">
                                            <a href="{{ route('settings.edit', [$setting->id]) }}"
                                                class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                    aria-hidden="true" title="{{ __('Edit') }}"></i></a>
                                        </td>
                                    </tr>
                                 @endforeach
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection