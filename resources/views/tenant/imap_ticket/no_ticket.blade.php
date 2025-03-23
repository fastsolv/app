@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid p-3">
            <div class="col-md-12">
                {{ __('No ticket found') }}
            </div>
        </div>
    </main>
</div>
@endsection
