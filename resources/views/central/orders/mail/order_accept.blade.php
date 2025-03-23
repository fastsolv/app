<div>
    <b>{{ __('Hello :name', ['name' => $order->user->first_name]) }},</b><br/>
    {{ __('Your paln is activated.') }}

    <br/>
    {{ __('To use our service, please login with your details at :app_url',['app_url' => env('APP_URL')]) }}

    <br/>
    <br/>
    {{ __('Regards') }}
    <br/>
    <br/>
    {{ __(':admin', ['admin' => env('MAIL_FROM_NAME')]) }}
</div>