@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')

<div class="section-header">
    <h1>{{ __( 'Email Campaign') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('client_groups.index') }}">{{ __('Client Groups') }}</a>
        </div>
        <div class="breadcrumb-item">{{ __('Update Email Campaign') }}</div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Update Client Group Email Campaign') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('custom_list_campaign.update', $campaign->uuid) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">

                        <div>
                            <div class="form-group row mb-4" id="clients">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Select clients') }}:</label>
                                <div class="col-sm-12 col-md-7" v-if="clients">
                                    <input type="hidden" ref="client_ref" id="client_ref_id" value=""
                                        name="client_ids" />
                                    <select-clients multiple :options="clients" taggable push-clients
                                        v-model="selected_clients" :reduce="clients => clients.id" label="first_name"
                                        @input="chooseMe">
                                    </select-clients>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Select department') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" id="department" name="department_id">
                                        @foreach($departments as $department)
                                        @if (old('department_id', $campaign->department_id) == $department->id)
                                        <option selected value="{{ $department->id}}">
                                            {{__($department->name)}}</option>
                                        @else
                                        <option value="{{$department->id}}">{{__($department->name)}}</option>
                                        @endif
                                        @endforeach
                                    </select>

                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        {{ __('Here you need to select the department from which the email should be sent') }}.
                                        <br>
                                    </small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Select email template') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" id="template" name="template_id">
                                        @foreach($email_templates as $template)
                                        @if (old('template_id', $campaign->template_id) == $template->uuid)
                                        <option selected value="{{ $template->uuid}}">
                                            {{__($template->name)}}</option>
                                        @else
                                        <option value="{{$template->uuid}}">{{__($template->name)}}</option>
                                        @endif
                                        @endforeach
                                    </select>

                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        {{ __('Here you need to select the template of email thet should be sent') }}.
                                        <br>
                                    </small>
                                </div>
                            </div>

                            <div class="form-group row mb-4" id="status_change">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" id="status" name="status">
                                        <option value="pending"
                                            {{ old('status', $campaign->status) == 'pending' ? 'selected' : '' }}>
                                            {{ __('Pending') }}</option>
                                        <option value="done"
                                            {{ old('status', $campaign->status) == 'done' ? 'selected' : '' }}>{{ ('Done') }}
                                        </option>
                                        <option value="cancel"
                                            {{ old('status', $campaign->status) == 'cancel' ? 'selected' : '' }}>
                                            {{ ('Cancel') }}</option>
                                    </select>

                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        {{ __('Here you can change the status of the email campaign') }}.
                                    </small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="sendNow"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Send now') }}*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="checkbox" id="sendNow" name="send_now" onclick="myFunction()">
                                </div>
                            </div>
                            <div class="form-group row mb-4" id="send_at">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Current server time') }}:</label>

                                <div class="col-sm-12 col-md-7">
                                    <p>{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}<p>
                                </div>
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Time to send') }}:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input name="send_at" type="text" class="form-control datetimepicker"
                                        value={{ old('send_at', $campaign->send_at) }}>
                                </div>
                            </div>


                            @if (env('APP_ENV') != 'demo')
                            <div class="form-group row mb-4" id="add">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-custom"> {{ __('Update') }}</button>
                                </div>
                            </div>
                            <div class="form-group row mb-4" id="send" style="display:none">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-custom"> {{ __('Send') }}</button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function myFunction() {
  var checkBox = document.getElementById("sendNow");
  var text = document.getElementById("send_at");
  var add = document.getElementById("add");
  var send = document.getElementById("send");
  console.log(checkBox);
  if (checkBox.checked == true){
    text.style.display = "none";
    add.style.display = "none";
    status_change.style.display = "none";
    send.style.display = "";
  } else {
    text.style.display = "";
    add.style.display = "";
    status_change.style.display = "";
    send.style.display = "none";
  }
}
</script>
<script>
    var id = '<?php echo $campaign->uuid; ?>';
    var current_clients = '<?php echo json_encode($selected_clients); ?>';
</script>
<script src="{{ asset('js/clients.js') }}"></script>
@endsection