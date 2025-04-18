<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\api\v1\CountryController;
use App\Http\Controllers\api\v1\AuthController;




Route::middleware([
    'tenant_api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/stripe-payment', [App\Http\Controllers\Central\GatewayController::class, 'handleGet'])->name('payment.gateway');
    Route::post('/stripe-payment-confirm', [App\Http\Controllers\Central\GatewayController::class, 'handlePost'])->name('stripe.payment');
});
