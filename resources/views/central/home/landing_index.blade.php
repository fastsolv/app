@extends('central.layouts.public_white')
@section('content')

<div id="response-div">
    <section class="py-5">
        <div class="pricing-header px-3 py-3 mb-4 pb-md-4 mx-auto text-center">
            <h1 class="">{{ __('Flexible') }}  <span class="text-color">{{ __('pricing') }} </span> {{ __('options') }} <span class="text-color">.</span></h1>
            <p class="lead">{{ __('Crafting personalized solutions, tailored to your needs') }} .<span
                    class="text-color">.</span>
            </p>
        </div>
        <div class="container">
            <div class="section-header">
                <h1>{{ __('Pricing') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">
                        <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">{{ $selectedCurrency }}
                        </button>
                        <div class="dropdown-menu">
                            @foreach ($currencies as $currency)
                            <a class="dropdown-item" href={{ route('landing_index.index', ['currency' => $currency->currency]) }}>{{ $currency->currency }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="breadcrumb-item">
                        <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">{{ $selectedPeriod }}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{ $selectedPeriod == 'Monthly' ? 'active' : '' }}" href="{{ route('landing_index.index', ['currency' => $selectedCurrency, 'period' => 'Monthly']) }}">Monthly</a>
                            <a class="dropdown-item {{ $selectedPeriod == 'Yearly' ? 'active' : '' }}" href="{{ route('landing_index.index', ['currency' => $selectedCurrency, 'period' => 'Yearly']) }}">Yearly</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-deck mb-3 text-center">
                <!-- Price Table_1 -->
                @foreach ($plans as $plan)
                    <div class="card pt-3 mb-4 shadow rounded-lg">
                        <div class='pricing'>
                            <div class="pricing-title">
                                {{ __($plan->name) }}
                            </div>
                            @if ($plan->require_payment != 0)                           
                                @foreach ($pricing as $price)
                                    @if ($price->uuid == $plan->uuid)
                                        <div class="pricing-title">
                                            {{ __($price->term) }} {{ __($price->period) }}
                                        </div>
                                        @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="card-body px-4 py-2">
                            @if ($plan->require_payment != 0)                           
                                @foreach ($pricing as $price)
                                    @if ($price->uuid == $plan->uuid)
                                        @if ($price->period == $selectedPeriod)
                                            <h1 class="card-title pricing-card-title color-black">{{ $price->price }} <small
                                                    class="text-muted">{{ $selectedCurrency }}</small>
                                            </h1>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                            <ul class="list-unstyled mt-3 mb-4 text-dark text-left table-l-height">  
                                <div class="borderless">
                                    <li >
                                        {{ __('No. of departments ') }}
                                        <span><strong>{{ $plan->department_count ? $plan->department_count : 'Unlimited' }}</strong></span>
                                    </li>
                                    <li>
                                        {{ __('No. of tickets ') }}
                                        <span><strong>{{ $plan->ticket_qty ? $plan->ticket_qty : 'Unlimited' }}</strong></span>
                                    </li>
                                    <li>
                                        {{ __('No. of staff ') }}
                                        <span><strong>{{ $plan->staffs_qty ? $plan->staffs_qty : 'Unlimited' }}</strong></span>
                                    </li>
                                    <li>
                                        {{ __('No. of users ') }}
                                        <span><strong>{{ $plan->user_qty ? $plan->user_qty : 'Unlimited' }}</strong></span>
                                    </li>
                                </div>
                            </ul>
                        </div>
                        @if (env('APP_ENV') != 'demo')
                        <div class="card-footer bg-transparent border-success text-center">
                            @foreach ($pricing as $price)
                                @if ($price->uuid == $plan->uuid)  
                                    @if ($plan->require_payment == 0)
                                        <a type="button" href="{{ route('register_minimal_user', ['id' => $price->id] ) }}"
                                            class="btn btn-custom btn-primary rounded-pill btn-lg btn-shadow">{{ __('Subscribe') }}</a>
                                    @else
                                        @if ($price->period == $selectedPeriod)
                                            <a href="{{ route('register', ['plan' => $price->id]) }}" class="btn btn-custom btn-primary rounded-pill btn-lg btn-shadow"
                                            role="button" aria-disabled="true">
                                            {{ __('Subscribe') }} </i>
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                @endforeach
            </div>    
        </div>
    </section>
    <!-- Section Second -->
    <section class="py-5">
        <div class="container">
            <!-- Cards First Row -->
            {{-- <h1 class="text-center mb-5">{{ __('All your website') }} 
                <span class="text-color">{{ __('Seo Reports') }} </span> {{ __('in one place') }} <span class="text-color">.</span>
            </h1> --}}
            <div class="row row-cols-1 row-cols-md-3">
                <div class="col-md-4 mb-4 seo-strip">
                    <div class="card h-100 shadow rounded-lg">
                        <div class="px-4 pt-3 seo-box-img">
                            <img src="images/web-monitoring.png" width="70" height="70" alt="" srcset="">
                        </div>
                        <div class="card-body card-body-landing">
                            <h5 class="card-title">{{ __("Sign up for free") }} </h5>
                            <p class="card-text">{{ __("Try our trial plan to see the ticketing system’s feature.It has a lot of features and you will love it!") }}<br>
                            {{ __("Email to tickets, Department wise tickets,Knowldge base, Articles, Articles to Ticket,Feedback system, Staff and Staff roles.")}} </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 seo-strip">
                    <div class="card h-100 shadow rounded-lg">
                        <div class="px-4 pt-3 seo-box-img">
                            <img src="images/ssl-certificate.png" width="70" height="70" alt="" srcset="">
                        </div>
                        <div class="card-body card-body-landing">
                            <h5 class="card-title">{{ __('Email to Tickets') }} </h5>
                            <p class="card-text">{{ __("Just send an email to an email id configured, and that will be converted to a ticket.") }}
                            {{ __("You have to add an email id and configure it’s IMAP details from the admin side.") }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 seo-strip">
                    <div class="card h-100 shadow rounded-lg">
                        <div class="px-4 pt-3 seo-box-img">
                            <img src="images/ping-monitoring.png" width="70" height="70" alt="" srcset="">
                        </div>
                        <div class="card-body card-body-landing">
                            <h5 class="card-title">{{ __('Web Tickets') }} </h5>
                            <p class="card-text">{{ __('Other than email tickets, the system support nor mal web tickets, Customer can sign up and open tickets, staffs can view and give reply') }} .</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Cards First Row -->

            <!-- Card Second Row -->
            <div class="row row-cols-1 row-cols-md-3">
                <div class="col-md-4 mb-4 seo-strip">
                    <div class="card h-100 shadow rounded-lg">
                        <div class="px-4 pt-3 seo-box-img">
                            <img src="images/port-monitoring.png" width="70" height="70" alt="" srcset="">
                        </div>
                        <div class="card-body card-body-landing">
                            <h5 class="card-title">{{ __('Department wise tickets') }} </h5>
                            <p class="card-text">{{ __('There are multiple departments and staffs can be assigned to departments.A staff assigned to a department can view tickets of the department andcan give reply based on his role.') }}
                                <br> {{ __('Also you can assign emails to departmnets, so that mail tickets also will work department wise') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 seo-strip">
                    <div class="card h-100 shadow rounded-lg">
                        <div class="px-4 pt-3 seo-box-img">
                            <img src="images/cron-job-monitoring.png" width="70" height="70" alt="" srcset="">
                        </div>
                        <div class="card-body card-body-landing">
                            <h5 class="card-title">{{ __('Staffs') }} </h5>
                            <p class="card-text">{{ __("Staffs can be assigned to departments, also a role can be assigned to each staffs.") }}
                                {{ __("Once a staff is logged in, he can view all the tickets of his departmnets and can give reply if he has the permission") }} .</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 seo-strip">
                    <div class="card h-100 shadow rounded-lg">
                        <div class="px-4 pt-3 seo-box-img">
                            <img src="images/keyword-monitoring.png" width="70" height="70" alt="" srcset="">
                        </div>
                        <div class="card-body card-body-landing">
                            <h5 class="card-title">{{ __('FAQ and Kbs') }} </h5>
                            <p class="card-text">{{ __("Admin can add FAQs, Kbs and Articles and they will be visible from the menu.") }} 
                                {{ __("They are multi language supported, so that language specific KB and FAQs can be added to the article") }} .</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Second Section -->
</div>
@endsection


@section('scripts')
<script>
    'use strict';
    var urlRegex = /^(https?:\/\/)?([a-zA-Z0-9]+\.)*[a-zA-Z0-9]+\.[a-zA-Z]{2,}([a-zA-Z0-9\-\._~:/\?#\[\]@!\$&'\(\)\*\+,;=]*)?$/;
$(document).ready(function() {
    $('#ajax-call-btn').click(function(e) {
        e.preventDefault();
        $('#response-div').html('');
        var url = $('#url').val();
        if (!/^https?:\/\//i.test(url)) {
            url = "https://" + url;
        }
        if (!urlRegex.test(url)) {
            $('#url-error').text('Please enter a valid URL').removeClass('d-none');
            return;
        } else {
            $('#url-error').text('').addClass('d-none');
        }
        $('#loader').removeClass('d-none');
        $('#submit-text').hide();
        $(this).prop('disabled', true);
        $.ajax({
            url: "/checkData",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "url": url,
            },
            success: function(response) {
                $('#response-div').html(response);
                $('#loader').addClass('d-none');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loader').hide();
                console.log('Error:', errorThrown);
                console.log('Status:', textStatus);
                console.log('Response:', jqXHR.responseText);
            },
            complete: function() {
                $('#ajax-call-btn').prop('disabled', false);
                $('#submit-text').show();
            }
        });
    });
});
</script>

@endsection
