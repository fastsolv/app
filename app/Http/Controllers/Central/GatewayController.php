<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Central\Plan;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Central\Address;
use App\Models\Central\GatewayDetails;
use App\Models\Central\Gateway;
use App\Models\Central\Pricing;
use App\Models\Central\Service;
use App\Models\Central\Services\AddPlanService;
use App\Models\Central\Services\OrderService;
use App\Models\Central\Services\DomainRegisterService;
use Stripe;
use Session;
use Redirect;
use Srmklive\PayPal\Services\ExpressCheckout;
use Mollie\Laravel\Facades\Mollie;
use App\Helpers\Logger;

require '../vendor/autoload.php';
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class GatewayController extends Controller
{    
    /**
     * Process order page
     */
    public function processOrder(Request $request, $id, Gateway $gateway )
    {
        $this->authorize('isNotAdmin', Authorize::class);
        //Get the pricing
        $pricing = Pricing::find($id);
        //get plan
        $plan = Plan::find($pricing->plan_id);
        //Get the logged in user
        $user = User::find(auth()->id());
        
        /*
         * service class that interact with the Order model.
         * refer app/Models/Central/Services/OrderService.php
         */
        $orderService = new OrderService();
        //Get the price using price() function in OrderService
        $price = $orderService->price($user, $plan, $pricing);
        
        $service_exist = Service::where('user_id', $user->id)->first();
        /*
         * Trial order case
         */
        if ($price == 0.00){
            $gateway = null;
            $paymentStatus = 'paid';
            $txId = null;
            $isRenew = false;
            $description = "Plan name:$plan->name";
            //Add order details using trialOrderDetails() function in OrderService
            $order = $orderService->trialOrderDetails($user, $plan, $pricing, $gateway, $paymentStatus, $txId, $isRenew, $description, $price);
            $params = [
                'order' => $order,
            ];
            return view('central.gateway.success', $params);
        }else{

            if (!$service_exist) {
                $sub_domain = Session::get('sub_domain');
            } else {
                $tenant = Tenant::where('tenant_id', $service_exist->tenant_id)->first();
                $sub_domain = $tenant->id;
            }
            /*
             * Paid order case
             */
            $gatewayName = $request->gateway;
            /*
             * Check whether the selected gateway is activated or not
             * refer app/Policies/Central/GatewayPolicy.php
             */
            if (!$user->can('view', [$gateway, $gatewayName])) {
                return redirect()->back()
                ->with('error', __('This gateway is temporarily unavailable'));
            }

            /*
            * service class that interact with the Order model.
            * refer app/Models/Central/Services/AddPlanService.php
            */
            $addPlanService = new AddPlanService();

            $order = $addPlanService->addOrder($request->gateway, $user, $price, $pricing);
            Session::put('order', $order);

            //Stripe gateway case
            if ($request->gateway == 'stripe'){
                $stripeKey = GatewayDetails::where('name', 'stripe_key')->first();
                $params = [
                    'plan' => $plan,
                    'pricing' => $pricing,
                    'stripeKey' => $stripeKey,
                    'price' => $price,
                    'sub_domain' => $sub_domain
                ];
                return view('central.gateway.stripe', $params);
            } elseif($request->gateway == 'paypal'){
                //Paypal gateway case
                $paypal = GatewayDetails::where('name', 'paypal_email')->first();
                $gateway = Gateway::where('name', 'paypal')->first();
                $params = [
                    'user' => $user,
                    'plan' => $plan,
                    'pricing' => $pricing,
                    'paypal' => $paypal,
                    'gateway' => $gateway,
                    'price' => $price,
                    'order' => $order,
                    'sub_domain' => $sub_domain
                ];
                return view('central.gateway.paypal', $params);
            } elseif($request->gateway == 'mollie'){
                //Mollie gateway case
                $gateway = Gateway::where('name', 'paypal')->first();
                $params = [
                    'plan' => $plan,
                    'pricing' => $pricing,
                    'price' => $price,
                    'sub_domain' => $sub_domain
                ];
                return view('central.gateway.mollie', $params);
            }
        }
    }
  
    /**
     * Stripe payment API call
     */
    public function stripePayment(Request $request, $id)
    {
        $sub_domain = $request->sub_domain;
        /*
         * service class that interact with the Order model.
         * refer app/Models/Central/Services/OrderService.php
         */
        $orderService = new OrderService();
        //Get the user
        $user = User::find(auth()->id());
        $pricing = Pricing::find($id);
        //Get the requested plan
        $plan = Plan::find($pricing->plan_id);
        //Get the price using price() function in OrderService
        $price = $orderService->price($user, $plan, $pricing);
        //Get the billig address
        $billingAddress = Address::find($id=1);
        //Get the stripe key
        $stripeKey = GatewayDetails::where('name', 'stripe_secret')->first();
        //Calling API
        Stripe\Stripe::setApiKey($stripeKey->value);
        $customer = \Stripe\Customer::create(array(
            "name" => "$user->first_name $user->last_name",
            "source" => $request->stripeToken,
            "address[line1]" => $user->address_1,
            "address[postal_code]" => $user->postal_code,
            "address[city]" => $user->city,
            "address[state]" => $user->states->name,
            "address[country]" => $user->countries->name,
        ));
        $response = Stripe\Charge::create ([
                "customer" => $customer->id,
                "amount" => 100 * $price,
                "currency" => $pricing->currencies->currency,
                "description" => "Making test payment.",
                "shipping[name]"                   => $billingAddress->name,
                "shipping[address][line1]"          => $billingAddress->address_1,
                "shipping[address][postal_code]"    => $billingAddress->postal_code,
                "shipping[address][city]"           => $billingAddress->city,
                "shipping[address][state]"          => $billingAddress->states->name,
                "shipping[address][country]"        => $billingAddress->countries->name,
        ]);
        
        Session::flash('success', 'Payment has been successfully processed.');
        //Get the transaction id from response
        $txId = $response['id'];
        //Get the status from response
        if ($response['status'] == 'succeeded'){
            $paymentStatus = 'paid';
        } else {
            $paymentStatus = 'unpaid';
        }
        //Get the gateway name
        $gateway = Gateway::where('name', 'stripe')->first();
        //Add complete order details using confirmOrder() function in OrderService
        $orderService->confirmOrder($user, $plan, $pricing, $price, $txId, $paymentStatus, $gateway, $sub_domain);

        return redirect()->route('success');
    }

    /**
     * Mollie payment API call
     */
    public function molliePayment(Request $request, $id)
    {   
        $sub_domain = $request->sub_domain;
        /*
         * service class that interact with the Order model.
         * refer app/Models/Central/Services/OrderService.php
         */
        $orderService = new OrderService();
        //Get user
        $user = User::find(auth()->id());
        //Get the price
        $pricing = Pricing::find($id);
        //Get the requested plan
        $plan = Plan::find($pricing->plan_id);
        //Get the price
        $price = $orderService->price($user, $plan, $pricing);
        //Get the mollie key
        $mollie_key = GatewayDetails::where('name', 'mollie_key')->first();
        // dd($mollie_key->value);
        //Mollie API call

        try {

            Mollie::api()->setApiKey($mollie_key->value);
            $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $pricing->currencies->currency, // Type of currency you want to send
                'value' => sprintf("%.2f", $price), // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => 'Payment By codehunger', 
            'redirectUrl' => route('success'),
            'metadata' => [
                'user_id' => $user->id,
                'pricing_id' => $pricing->id,
                'sub_domain' => $sub_domain,
            ],
            // after the payment completion where you to redirect
            "webhookUrl" => route('webhooks.mollie'),    
            ]);
            $payment = Mollie::api()->payments()->get($payment->id);
            // redirect customer to Mollie checkout page
            Logger::info("Webhook url : $payment->webhookUrl");
            return redirect($payment->getCheckoutUrl(), 303);
        } catch (Exception $ex) {
            Logger::info("Mollie Payment failed");
            Logger::info($ex->getMessage());
            return redirect()
            ->route('cancel');
        }

    }

    /**
     * Paypal payment API call
     */
    public function payPalPayment(Request $request, $id)
    {
        //Get user
        $user = User::find(auth()->id());
        //Get the subdomain
        $sub_domain = $request->sub_domain;
        $gateway = Gateway::where('name', 'paypal')->first();
        /*
         * service class that interact with the Order model.
         * refer app/Models/Central/Services/OrderService.php
         */
        $orderService = new OrderService();
        //Get the price
        $pricing = Pricing::find($id);
        //Get the requested plan
        $plan = Plan::find($pricing->plan_id);
        //Get the price
        $price = $orderService->price($user, $plan, $pricing);
        // Creating an environment
        $paypal_client = GatewayDetails::where('name', 'paypal_client_id')->first();
        $paypal_secret = GatewayDetails::where('name', 'paypal_client_secret')->first();
        $clientId = $paypal_client->value;
        $clientSecret = $paypal_secret->value;

        if ($gateway->test_mode == 1) {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }
        else {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        }
        $client = new PayPalHttpClient($environment);

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
                            "intent" => "CAPTURE",
                            "purchase_units" => [[
                                "reference_id" => "1111",
                                'description' => $sub_domain,
                                'custom_id' => $pricing->id,
                                "amount" => [
                                    "value" => sprintf("%.2f", $price),
                                    "currency_code" => $pricing->currencies->currency
                                ]
                            ]],
                            "application_context" => [
                                "cancel_url" => route('cancel'),
                                "return_url" => route('getDone'),
                            ],
                        ];

        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);
            
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            return Redirect::to($response->result->links[1]->href);
        } catch (Exception $ex) {
            Logger::info("Paypal Payment failed");
            Logger::info($ex->getMessage());
            return redirect()
            ->route('cancel');
        }
    }

    /**
     * Paypal response
     * Gives the response of the payment
     */
    public function payPalResponse(Request $request)
    {
        $gateway = Gateway::where('name', 'paypal')->first();

        $user = User::find(auth()->id());

        $paypal_client = GatewayDetails::where('name', 'paypal_client_id')->first();
        $paypal_secret = GatewayDetails::where('name', 'paypal_client_secret')->first();
        $clientId = $paypal_client->value;
        $clientSecret = $paypal_secret->value;

        if ($gateway->test_mode == 1) {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }
        else {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        }
        $client = new PayPalHttpClient($environment);

        $request = new OrdersCaptureRequest($request->token);
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            $orderService = new OrderService();
            $price = $response->result->purchase_units[0]->payments->captures[0]->amount->value;
            Logger::info("Price : $price");
            $txId = $response->result->purchase_units[0]->payments->captures[0]->id;
            $pricing_id = $response->result->purchase_units[0]->custom_id;
            $pricing = Pricing::find($pricing_id);
            Logger::info("Pricing : $pricing");
            $plan = Plan::where('uuid', $pricing->plan_id)->first();
            Logger::info("plan : $plan");
            
            $sub_domain = $response->result->purchase_units[0]->description;

            $payment_status = $response->result->purchase_units[0]->payments->captures[0]->status;
            if ($payment_status == "COMPLETED"){
                $paymentStatus = 'paid';
                $orderService->confirmOrder($user, $plan, $pricing, $price, $txId, $paymentStatus, $gateway, $sub_domain);
            } elseif ($payment_status == "REFUNDED"){
                Logger::info("This is a refund");
            } else {
                $paymentStatus = 'unpaid';
                $orderService->confirmOrder($user, $plan, $pricing, $price, $txId, $paymentStatus, $gateway, $sub_domain);
            }
            // $result = array($response->result->purchase_units[0]->description, $response->result->purchase_units[0]->custom_id, $response->result->purchase_units[0]->payments->captures[0]->id, $response->result->purchase_units[0]->payments->captures[0]->status, $response->result->purchase_units[0]->payments->captures[0]->amount->currency_code, $response->result->purchase_units[0]->payments->captures[0]->amount->value);
            // If call returns body in response, y  ou can get the deserialized version from the result attribute of the response
            return redirect()->route('success');
        } catch (Exception $ex) {
            Logger::info("Paypal Payment failed");
            Logger::info($ex->getMessage());
            return redirect()
            ->route('cancel');
        }
    }

    /**
     * Mollie webhook function
     * Gives the response of the payment
     */
    public function handleMollieWebhookNotification(Request $request) {
        //Get the mollie key
        $mollie_key = GatewayDetails::where('name', 'mollie_key')->first();
        //Mollie API call
        Mollie::api()->setApiKey("$mollie_key->value");
        $payment = Mollie::api()->payments->get($request->id);
        $sub_domain = $payment->metadata->sub_domain;
        $user = User::where('id', $payment->metadata->user_id)->first();
        $orderService = new OrderService();
        $price = $payment->amount->value;
        $gateway = Gateway::where('name', 'mollie')->first();
        $txId = $payment->id;
        $pricing = Pricing::find($payment->metadata->pricing_id);
        $plan = Plan::where('uuid', $pricing->plan_id)->first();
        // echo '$payment';exit;
        if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks())
        {
            $paymentStatus = 'paid';
            Logger::info("Payment successful");
        } else {
            $paymentStatus = $payment->status;
            Logger::info("Payment status: $payment->status");
        }
        $orderService->confirmOrder($user, $plan, $pricing, $price, $txId, $paymentStatus, $gateway, $sub_domain);
    }

    /**
     * success message page
     */
    public function success()
    {
        $order = Session::get('order');
        $params = [
            'order' => $order,
        ];
        return view('central.gateway.success', $params);
    }

    /**
     * Failure message page
     */
    public function cancel()
    {
        return view('central.gateway.cancel');
    }

}