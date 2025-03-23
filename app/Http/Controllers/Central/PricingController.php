<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use App\Models\Central\Pricing;
use App\Models\Central\Plan;
use App\Models\Central\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use App\Helpers\Logger;

class PricingController extends Controller
{
    public function __construct()
    {
        /*
        make sure only logged in and verified user has access
        to this controller
         */
        $this->middleware(['auth', 'verified']);
    }
    
    public function pricing_index($plan_id)
    {
        $this->authorize('isAdmin', Authorize::class);
        $prices = Pricing::where('plan_id', $plan_id)->get();
        $params = [
            'prices' => $prices,
            'plan_id' => $plan_id,
        ];
        return view('central.pricing.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pricing_create($plan_id)
    {
        $this->authorize('isAdmin', Authorize::class);
        $plans = Plan::first();
        /*
         * Check wheather there is a valid billing address
         * if not, redirect to add billing address page
         */
        if(!$plans){
            return redirect()->route('plans.create')
                ->with('error', __("Add a plan first"));
        }

        $currency = Currency::first();
        /*
         * Check wheather there is a valid billing address
         * if not, redirect to add billing address page
         */
        if(!$currency){
            return redirect()->route('currency.create')
                ->with('error', __("Add a currency first"));
        }
        $plans = Plan::all();
        $currencies = Currency::all();
        $params = [
            'plans' => $plans,
            'currencies' => $currencies,
            'plan_id' => $plan_id
        ];
        return view('central.pricing.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin', Authorize::class);
        try {
            $validator = Validator::make($request->all(), [
                'plan_id' => 'required',
                'custom_monthly.*' => 'required',
                'custom_annually.*' => 'required',

            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
        
            if ($request->custom_monthly) {
                foreach ($request->custom_monthly as $currency_id => $currency) { 
                    $price = new Pricing ();
                    $price->plan_id = $request->plan_id;
                    $price->term = 1;
                    $price->period = 'Monthly';
                    $price->price = $currency;
                    $price->currency_id = $currency_id;
                    $price->save(); 
                }
            }
            
            if ($request->custom_annually) {
                foreach ($request->custom_annually as $currency_id => $currency) {
                    $price = new Pricing ();
                    $price->plan_id = $request->plan_id;
                    $price->term = 1;
                    $price->period = 'Yearly';
                    $price->price = $currency;
                    $price->currency_id = $currency_id ;
                    $price->save();
                }
            }
            
            return redirect()->route('pricing_index', $request->plan_id)
                ->with('success', __('Price added'));
         } catch (\Exception $e) {
              Logger::error($e->getMessage());
             return redirect()
              ->back()
             ->withInput()
             ->with('error', $e->getMessage());
          }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function pricing_edit(Request $request, $id, $plan_id)
    {
        
        $this->authorize('isAdmin', Authorize::class);
        $price = Pricing::find($id);
        $plans = Plan::all();
        $currencies = Currency::all();
        $params = [
            'price' => $price,
            'plans' => $plans,
            'currencies' => $currencies,
            'plan_id' => $plan_id
        ];
        return view('central.pricing.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin', Authorize::class);
        try {
            $validator = Validator::make($request->all(), [
                'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                // 'price_renews' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $price = Pricing::find($id);
            $price->update($request->all());
            return redirect()->route('pricing_index', $price->plan_id)
                ->with('success', __('Price Updated'));
         } catch (\Exception $e) {
              Logger::error($e->getMessage());
             return redirect()
              ->back()
             ->withInput()
             ->with('error', $e->getMessage());
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin', Authorize::class);
        $price = Pricing::find($id);
        $price->delete();
        return redirect()->back()
            ->with('success', __('Price deleted'));
    }
}
