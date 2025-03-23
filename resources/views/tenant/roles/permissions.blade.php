@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header Feedback">
    <h1>{{ __(' Update Permissions') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Update Permissions') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class=" col-12">
            @include('common.demo')
            @include('common.errors')
          
      

                <div class=" form-check form-switch  float-left">
    <input class="form-check-input"  role="switch" data-ix="toggle-switch" data-name="Toggle Switch" id="Toggle-Switch" name="Toggle-Switch" type="checkbox" onclick="toggle(this)">
    <label class="toggle-label w-form-label" for="Toggle-Switch"> {{__(' Select All')}}</label>
  
  </div>

 
            <form method="get" action="{{route('role_permission.detail',['role_id' => $role_id])}}">
                        @csrf
            <div class="card">
                <div class="card-header">
                
                    <small id='main'>
                   
                    <button type="submit" 
                            class="btn btn-custom  float-right add_button">{{__('Update')}}</button>
                    </small>
                </div>
                <div class="card-body">
                <form method="get" action="{{route('role_permission.detail',['role_id' => $role_id])}}">
                        @csrf
                        <div class=" row ">
                        @foreach ($permissions as $permission)
                     
                          <div class=" form-group col-lg-6 col-12">
                            <label
                                class="  col-form-label text-md-left col-4 col-md-3 col-lg-3 text-capitalize">{{str_replace("_", " ", __("$permission->model"))}}:</label>
                                <label  class=" col-form-label text-md-left col-3 col-md-3 col-lg-3 text-capitalize"> {{str_replace("_", " ", __("$permission->action"))}}</label>
                            <label class="col-sm-12  flex flex-row  col-lg-4 col-5 col-md-6">
                            <div class="row flex flex-row">
                                    <div class="custom-radio custom-control ml-3">
                                        <input class="custom-control-input enable " type="radio"
                                            name="is_allow[{{ $permission->id }}]" id="enable[{{ $permission->id }}]"
                                            value=1 {{ ($roles_permissions[$permission->id] == 1)? "checked" : "" }}>
                                        <label class="custom-control-label" for="enable[{{ $permission->id }}]">
                                            {{ __('Enable') }} 
                                        </label>
                                    </div>
                                    <div class="custom-radio custom-control ml-3">
                                        <input class="custom-control-input disable" type="radio"
                                            name="is_allow[{{ $permission->id }}]" id="disable[{{ $permission->id }}]"
                                            value=0 {{ ($roles_permissions[$permission->id]== 0)? "checked" : "" }}>
                                        <label class="custom-control-label" for="disable[{{ $permission->id }}]">
                                            {{ __('Disable') }}
                                        </label>
                                    </div>
                                </div>
                            </label>
                            </div>
                   
                        <br>
                        @endforeach
                        </div>
                        @if (env('APP_ENV') != 'demo')

                        <div class="form-group row mb-4">
                            <!-- <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label> -->
                            <div class="col-sm-12 col-lg-11 col-md-7 d-flex justify-content-center">
                                <button type="submit" class="btn btn-custom"> {{ __('Update') }}</button>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
            </fo>
        </div>
    </div>
</div>

<script>

document.getElementById("Toggle-Switch").addEventListener("click", toggle);

function toggle(source) {
    console.log(document.getElementById("Toggle-Switch").checked);
    if ( document.getElementById("Toggle-Switch").checked==true){
   
        checkboxes = document.getElementsByClassName('enable');

  for (var i = 0, n = checkboxes.length; i < n; i++) {
    checkboxes[i].checked = document.getElementById("Toggle-Switch").checked;
  }
}else{
   
        checkboxes = document.getElementsByClassName('disable');

  for (var i = 0, n = checkboxes.length; i < n; i++) {
    checkboxes[i].checked = document.getElementById("Toggle-Switch");
  }

  }

 
 
}

</script>
@endsection