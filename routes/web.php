<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/lang/{locale}', function($locale){
    session()->put('locale', $locale);
    //dd($locale);
   // App::setlocale($locale);
    return redirect()->back();
});

Route::get('/', [App\Http\Controllers\Central\LandingIndexController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\Central\DashboardController::class, 'index'])->name('dashboard');
Route::resource('plans', App\Http\Controllers\Central\PlanController::class);
Route::resource('pricing', App\Http\Controllers\Central\PricingController::class);
Route::resource('currency', App\Http\Controllers\Central\CurrencyController::class);
Route::resource('billing_address', App\Http\Controllers\Central\AddressController::class);
Route::resource('available_plans', App\Http\Controllers\Central\AddPlanController::class);
Route::resource('plan_details', App\Http\Controllers\Central\HomeController::class);
Route::resource('orders', App\Http\Controllers\Central\OrderController::class);
Route::resource('services', App\Http\Controllers\Central\ServiceController::class);
Route::resource('invoices', App\Http\Controllers\Central\InvoiceController::class);
Route::resource('users', App\Http\Controllers\Central\UserController::class);
Route::resource('language', App\Http\Controllers\Central\LanguageController::class);
Route::resource('tenants', App\Http\Controllers\Central\TenantController::class);
Route::resource('smtp', App\Http\Controllers\Central\SmtpController::class);
Route::resource('admin_settings', App\Http\Controllers\Central\SettingController::class);
Route::resource('landing_index', App\Http\Controllers\Central\LandingIndexController::class);


Route::get('/pricing/pricing_index/{uuid}', [App\Http\Controllers\Central\PricingController::class, 'pricing_index'])->name('pricing_index');
Route::get('/pricing/pricing_create/{uuid}', [App\Http\Controllers\Central\PricingController::class, 'pricing_create'])->name('pricing_create');
Route::get('/pricing/pricing_edit/{id}/{uuid}', [App\Http\Controllers\Central\PricingController::class, 'pricing_edit'])->name('pricing_edit');

Route::get('available_plans/invoice/{id}', [App\Http\Controllers\Central\AddPlanController::class, 'invoice'])->name('invoice');
Route::get('/plan_details/{uuid}/{id}', [App\Http\Controllers\Central\HomeController::class, 'showCurrencyWise'])->name('showCurrencyWise');
Route::get('/landing_index/{uuid}/{id}', [App\Http\Controllers\Central\LandingIndexController::class, 'index'])->name('landing_index');

Route::get('/profile', [App\Http\Controllers\Central\ProfileController::class, 'index'])->name('profile');
Route::post('/profile/update', [App\Http\Controllers\Central\ProfileController::class, 'update'])->name('profileUpdate');
Route::get('minimalRegistration', [App\Http\Controllers\MinimalRegisterController::class, 'index'])->name('minimalLogin');
Route::get('register_minimal/{id}', [App\Http\Controllers\MinimalRegisterController::class, 'registerMinimal'])->name('register_minimal_user');
Route::post('register_minimal', [App\Http\Controllers\MinimalRegisterController::class, 'create'])->name('register_minimal');


Route::get('/privacy_policy', [App\Http\Controllers\Central\FooterController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/terms_of_use', [App\Http\Controllers\Central\FooterController::class, 'terms'])->name('terms');

Route::get('/select_domain', [App\Http\Controllers\Central\DomainRegisterController::class, 'domainSelect'])->name('domainSelect');
Route::post('/register_domain', [App\Http\Controllers\Central\DomainRegisterController::class, 'domainRegister'])->name('domainRegister');

Route::get('/states', [App\Http\Controllers\CountryStateController::class, 'state']);
Route::get('/countries', [App\Http\Controllers\CountryStateController::class, 'country']);

Route::resource('gateways', App\Http\Controllers\Central\GatewayDetailsController::class);

Route::post('{id}/process_order', [App\Http\Controllers\Central\GatewayController::class, 'processOrder'])->name('processOrder');
Route::get('success', [App\Http\Controllers\Central\GatewayController::class, 'success'])->name('success');
Route::get('cancel', [App\Http\Controllers\Central\GatewayController::class, 'cancel'])->name('cancel');

Route::post('{id}/stripe-payment-confirm', [App\Http\Controllers\Central\GatewayController::class, 'stripePayment'])->name('stripePayment');
Route::post('paypal_response', [App\Http\Controllers\Central\GatewayController::class, 'paypalResponse'])->name('paypalResponse');

Route::post('{id}/mollie-payment',[App\Http\Controllers\Central\GatewayController::Class,'molliePayment'])->name('mollie.payment');
Route::post('WebhookNotification',[App\Http\Controllers\Central\GatewayController::Class,'handleMollieWebhookNotification'])->name('webhooks.mollie');

Route::get('{uuid}/refund',[App\Http\Controllers\Central\RefundController::Class, 'refund'])->name('refund');

Route::post('{id}/paypal_payment', [App\Http\Controllers\Central\GatewayController::class, 'payPalPayment'])->name('paypal.payment');
Route::get('/paypal_done', [App\Http\Controllers\Central\GatewayController::class, 'payPalResponse'])->name('getDone');