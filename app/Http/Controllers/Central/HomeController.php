<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;    

use Illuminate\Http\Request;
use App\Models\Central\Plan;
use App\Models\User;
use App\Models\Central\Pricing;
use App\Models\Central\Currency;
use App\Models\Central\Address;
use App\Models\Central\Services\OrderService;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $plans = Plan::where('status', true)
            ->orderBy('display_order')->get();
        $currency = Currency::where('currency', $request->input('currency', 'USD'))->first();
        $selectedPeriod = $request->input('period', 'Monthly');
        $pricing = Pricing::join('plans', 'plans.uuid', '=', 'pricings.plan_id')
            ->where('currency_id', $currency->id)
            ->where('period', $selectedPeriod)
            ->select('pricings.price', 'pricings.currency_id', 'plans.uuid', 'pricings.id', 'pricings.period')
            ->get();
        $currencies = Currency::all();
        
        $params = [
            'plans' => $plans,
            'pricing' => $pricing,
            'currencies' => $currencies,
            'selectedCurrency' => $currency->currency,
            'selectedPeriod' => $selectedPeriod,
        ];
        return view('central.home.index', $params);
    }

    public function show(Request $request, $uuid)
    {
        $plan = Plan::find($uuid);
        $currency = Currency::where('currency', 'USD')->first();
        $selectedPeriod = $request->input('period', 'Month');
        $pricing = Pricing::where('plan_id', $uuid)
            ->where('currency_id', $currency->id)
            ->where('period', $selectedPeriod)
            ->get();
        $currencies = Currency::all();
        $params = [
            'plan' => $plan,
            'pricing' => $pricing,
            'currencies' => $currencies,
            'selectedPeriod' => $selectedPeriod,
            'selectedCurrency' => $currency->currency,

        ];
        return view('central.home.show', $params);
    }

    public function showCurrencyWise($uuid, $id)
    {
        $plan = Plan::find($uuid);
        $pricing = Pricing::where('plan_id', $uuid)
            ->where('currency_id', $id)->get();
        $currencies = Currency::all();
        $selected_currency = Currency::find($id);
        $params = [
            'plan' => $plan,
            'pricing' => $pricing,
            'currencies' => $currencies,
            'selected_currency' => $selected_currency
        ];
        return view('central.home.currency_plans', $params);
    }
}
