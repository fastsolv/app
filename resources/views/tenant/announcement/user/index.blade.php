

@extends( 
        ($theme =="white") ? 'tenant.layouts.public_white':
     ( ($theme =="red") ? 'tenant.layouts.public_red':
    (($theme =="green") ? 'tenant.layouts.public_green':
    (($theme =="black") ? 'tenant.layouts.public_black':
    (($theme =="blue") ?'tenant.layouts.public_blue':'tenant.layouts.public_yellow' ))))
    )

@section('content')

<div class="section-header col-12 col-md-10 offset-md-1">
    <h1>{{ __('Announcements') }}</h1>
</div>

<div class="section-body">
@foreach($announcements  as $announcement)
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card mb-n3">
                <div class="card-header">
                    <h4>{{  $announcement->title}}</h4>
                   
                </div>
                <div class="card-body px-4">
                <p class="announce-mt">{{ $announcement->announcement }}</p>
                    <p> <span> <i class=" fa fa-regular fa-calendar"></i></span><span> {{ $announcement->created_at->format('d-M-Y H:i D')}}</span> </p>
                </div>
            </div>
        </div>
       
    </div>
 @endforeach
    
</div>

@endsection
