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
use App\Models\Central\Service;
use App\Models\Central\Address;
use App\Models\Central\Services\OrderService;

class AddPlanController extends Controller
{
    public function __construct()
    {
        /*
        make sure only logged in and verified user has access
        to this controller
         */
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('isNotAdmin', Authorize::class);
        $plans = Plan::where('status', true)
            ->orderBy('display_order')->get();
        $currency = Currency::where('currency', $request->input('currency', 'USD'))->first();
        $selectedPeriod = $request->input('period', 'Monthly');
        $pricing = Pricing::join('plans', 'plans.uuid', '=', 'pricings.plan_id')
            ->where('currency_id', $currency->id)
            ->where('period', '=', $selectedPeriod)
            ->select('pricings.price', 'pricings.currency_id', 'plans.uuid', 'pricings.id', 'pricings.period')
            ->get();
        $currencies = Currency::all();
        $params = [
            'plans' => $plans,
            'pricing' => $pricing,
            'currencies' => $currencies,
            'selectedCurrency' => $currency->currency,
            'selectedPeriod' => $selectedPeriod
        ];
        
        return view('central.add_plan.index', $params);
    }

    public function show($uuid)
    {
        $this->authorize('isNotAdmin', Authorize::class);
        $user = User::find(auth()->id());
        $plan = Plan::find($uuid);
        $currency = Currency::where('currency', $user->currency)->first();
        if($currency) {
           $pricing = Pricing::where('plan_id', $uuid)
                ->where('currency_id', $currency->id)
                ->orderBy('price')->get(); 
        } else {
            $pricing = Pricing::where('plan_id', $uuid)->get(); 
        }
        
        $currencies = Currency::all();
        $params = [
            'plan' => $plan,
            'pricing' => $pricing,
            'currencies' => $currencies
        ];
        return view('central.add_plan.show', $params);
    }

    public function showCurrencyWise($uuid, $id)
    {
        $this->authorize('isNotAdmin', Authorize::class);
        $plan = Plan::find($uuid);
        $pricing = Pricing::where('plan_id', $uuid)
            ->where('currency_id', $id)
            ->orderBy('price')->get();
        $currencies = Currency::all();
        $selected_currency = Currency::find($id);
        $params = [
            'plan' => $plan,
            'pricing' => $pricing,
            'currencies' => $currencies,
            'selected_currency' => $selected_currency
        ];
        return view('central.add_plan.currency_plans', $params);
    }

    public function invoice($id)
    {
        $this->authorize('isNotAdmin', Authorize::class);
        //Get logged in user
        $user = User::find(auth()->id());
        $service = Service::where('user_id', $user->id)
            ->where('status_id', 1)->latest()->first();
        if (!$service) {
            if (!Session::get('sub_domain'))
            return redirect()
                ->route('domainSelect')
                ->with('error', __('Please choose a sub domain first'));
        }
        /*
         * Check whether the user already availed the trial offer
         * refer app/Policies/AddPlanPolicy.php
        */
        // if($id == 1){
        //     if (!$user->can('trial', AddPlan::class)) {
        //         return redirect()
        //         ->back()
        //         ->with('error', __('Your trial service ended'));
        //         exit;
        //     }
        // }


        //Get the plan
        $pricing = Pricing::find($id);
        $plan = Plan::find($pricing->plan_id);

        if ($service && $pricing->price == 0.00){
            return redirect()
                ->back()
                ->with('error', __('You cant use trial service anymore'));
        }
        //Get plan and corresponding properties

        /*
         * Get the payable price using the function price() in OrderService
         * refer app/Models/Central/Services/OrderService.php
        */
        $orderService = new OrderService();
        $price = $orderService->price($user, $plan, $pricing);

        /*
         * Check whether the user can downgrade the plan on the basis of price
         * refer app/Policies/AddPlanPolicy.php
        */
        if (!$user->can('downGrade', [AddPlan::class, $price])) {
            return redirect()
            ->back()
            ->with('error', __('Your cant downgrade your plan at this moment. Please contact support team'));
        }

        //Check whether there is a billing address
        $billingAddress = Address::find($id=1);
        if ($billingAddress){
           $address = $billingAddress; 
        } else{
            $address = null;
        }
        //Change the format of order_date
        $order_date = Carbon::now()->format('F d, Y');
        $params = [
            'plan' => $plan,
            'price' => $price,
            'pricing' => $pricing,
            'user' => $user,
            'address' => $address,
            'order_date' => $order_date
        ];

        //Put the price on session to use from other controllers
        Session::put('price', $price);

        /*
         * Check whether there is an active plan to show a messsage
         * refer app/Policies/AddPlanPolicy.php
        */
        if ($user->can('planExist', AddPlan::class)) {
            // Session::flash('error', 'You have an active plan. Continue only if you want to renew your plan. 
            // Note that if you renewed your plan, existing plan will be replaced.');
            return view('central.add_plan.invoice', $params);
        } else {
            return view('central.add_plan.invoice', $params);
        }
    }
}
