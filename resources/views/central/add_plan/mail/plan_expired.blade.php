<div>
    <b>{{ __('Hello :name', ['name' => $user->first_name]) }},</b><br/>
    {{ __('Your plan is expired') }}

    <br/>
    {{ __('To renew the plan, please login with your details at :app_url',['app_url' => env('APP_URL')]) }}

    <br/>
    <br/>
    {{ __('Regards') }}
    <br/>
    <br/>
    {{ __(':admin', ['admin' => env('MAIL_FROM_NAME')]) }}
</div>