@extends('central.layouts.gateway')

@section('content')

<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div>
            <div class="row text-center m-3">
                <h3 class="panel-heading">{{ __('Payment Details') }}</h3>
            </div>
        </div>
        <div class="panel-body">

            @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif

            <form role="form" action="{{ route('stripePayment', $pricing->id) }}" method="post" class="validation"
                data-cc-on-file="false" data-stripe-publishable-key="{{ $stripeKey->value}}" id="payment-form">
                @csrf

                <div class='form-row row'>
                    <div class='col-xs-12 form-group required'>
                        <label class='control-label'>{{ __('Name on Card') }}</label> <input class='form-control'
                            size='4' type='text'>
                    </div>
                </div>

                <div class='form-row row'>
                    <div class='col-xs-12 form-group card required'>
                        <label class='control-label'>{{ __('Card Number') }}</label> <input autocomplete='off'
                            class='form-control card-num' size='20' type='text'>
                    </div>
                </div>

                <div class='form-row row'>
                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                        <label class='control-label'>CVC</label>
                        <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4'
                            type='text' name="cvc">
                    </div>
                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                        <label class='control-label'>{{ __('Expiration Month') }}</label> <input
                            class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                    </div>
                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                        <label class='control-label'>{{ __('Expiration Year') }}</label> <input
                            class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                    </div>
                </div>

                <div class='form-row row'>
                    <div class='col-md-12 hide error form-group'>
                        <div class='alert-danger alert'>{{ __('Fix the errors before you begin') }}.</div>
                    </div>
                </div>

                <input type="hidden" name="sub_domain" value="{{ $sub_domain }}" />

                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-danger btn-lg btn-block" type="submit">{{ __('Pay Now') }}
                            ( {{ $pricing->currencies->prefix }}{{ $price }} )</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/stripe.js') }}"></script>

<script type="text/javascript">
    $(function () {
        var $form = $(".validation");
        $('form.validation').bind('submit', function (e) {
            var $form = $(".validation"),
                inputVal = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeHandleResponse);
            }

        });

        function stripeHandleResponse(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script>
@endsection

</html>