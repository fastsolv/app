<?php

namespace App\Http\Controllers\central;

use App\Http\Controllers\Controller;
use App\Models\Central\Currency;
use App\Models\Central\Plan;
use App\Models\Central\Pricing;
use Illuminate\Http\Request;

class LandingIndexController extends Controller
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
        return view('central.home.landing_index', $params);
    
    }
    
}
