<?php

namespace App\Models\Central\Services;
use Carbon\Carbon;
use DB;
use Session;


use App\Models\User;
use App\Models\Tenant;
use App\Models\Central\Order;
use App\Models\Central\Service;
use App\Models\Central\Pricing;
use App\Models\Central\Invoice;
use App\Models\Central\InvoiceDetails;
use App\Models\Central\Services\PlanService;
use App\Models\Central\Services\AddPlanService;
use App\Models\Central\Services\DomainRegisterService;
use App\Helpers\Uuid;
use App\Helpers\Logger;
use App\Helpers\Random;

class OrderService
{
    /*
     * Calculation of price to be paid by a user for a plan
     */
    public function price($user, $plan, $pricing){

        $planService = new PlanService ();
        //Get the existing service or subscription of the current user
        $existService = Service::where('user_id', $user->id)->first();
        
        /*
         * The case were there is an active service exist for the current user
         */
        if ($existService && $existService->pricing_id !== $pricing->id){
            //Get the existing plan pricing
            $existPricing = Pricing::find($existService->pricing_id);
            //Get existing plan validity
            $validity = $planService->validity($existPricing);

            //Get existing plan expiry date
            $expiryDate = Carbon::parse($existService->expiry_date);
            $now = Carbon::now();

            /*
             * case were plan not expired
             */
            if ($expiryDate > $now){
                //Calculation of remaining validity
                $validityLeft = $expiryDate->diffInDays($now) + 1;
                //calculation of remaining balance
                $balance = (($existService->pricing->price) / ($validity)) * ($validityLeft);
                //Calculation of payable amount
                $actualPrice = ($pricing->price) - $balance;
            } else {
                $actualPrice = $pricing->price;
            }
        } else {

            /*
             * The case were there is no active service exist for the current user
             */
            $actualPrice = $pricing->price;
        }
        //Rounding the price to two decimal parts
        $price = round($actualPrice, 2);
        return $price;
    }

    /*
     * Order confirmation
     */
    public function confirmOrder($user, $plan, $pricing, $price, $txId, $paymentStatus, $gateway, $sub_domain){

        /*
         * service class that interact with the AddPlan model.
         * refer app/Services/Models/AddPlanService.php
         */
        $addPlanService = new AddPlanService();
        //Get the previous plan
        $existService = Service::where('user_id', $user->id)->latest()->first();
        //Get the latest order of the user
        $order = Order::where('user_id', $user->id)->latest()->first();

        /*
         * The case were there is no service exist for the user
         */
        if(!$existService){
            
            $order->status = "pending";
            $order->save();

            $isRenew = false;
            // $sub_domain = Session::get('sub_domain');
            // $sub_domain = "test6";
            Logger::info("sub_domain : $sub_domain");
            $domainRegisterService = new DomainRegisterService();
            $domainRegisterService->registerDomain($sub_domain);
            $tenant = Tenant::where('id', $sub_domain)->first();
            $description = "Plan name: $plan->name, Plan price: $pricing->price";

            //Adding Service details using addService() function in AddPlanService
            $service = $addPlanService->addService($plan, $pricing, $order, $user, $tenant);

            //Adding invoice using addInvoice() function in AddPlanService
            $invoice = $addPlanService->addInvoice($user, $pricing, $price, $order, $paymentStatus, $txId, $gateway, $isRenew);
        } else {
            
            /*
             * The case were there is service exist for the user
             */
            $isRenew = true;
            $service = $existService;

            /*
             * Make tenant active
             */
            $tenant = Tenant::where('tenant_id', $existService->tenant_id)->first();
            $tenant->status = true;
            $tenant->save();

            $order->status = "active";
            $order->save();
            
            /*
             * The case were existing plan is same to new plan (Update case)
             */
            if($existService->pricing_id == $pricing->id){
                
                $description = "Plan name: $plan->name, Plan price: $pricing->price";
                //Updating Service details using updateService() function in AddPlanService
                $addPlanService->updateService($service, $plan, $pricing, $user, $order);
                //Adding invoice using addInvoice() function in AddPlanService
                $invoice = $addPlanService->addInvoice($user, $pricing, $price, $order, $paymentStatus, $txId, $gateway, $isRenew);
            } else {
                /*
                 * The case were existing plan is not same to new plan (Upgrade case)
                 */
                $description = "Plan name: $plan->name, Plan price: $pricing->price";
                $amount = ($price)-($pricing->price);
                $description1 = "Plan name: $plan->name, plan upgraded from: ";

                //Adding upgrade service details using upgradeService() function in AddPlanService
                $addPlanService->upgradeService($service, $plan, $pricing, $user, $order, $price, $paymentStatus);
                //Adding invoice using addInvoice() function in AddPlanService
                $invoice = $addPlanService->addInvoice($user, $pricing, $price, $order, $paymentStatus, $txId, $gateway, $isRenew);
                //Adding invoice details using addInvoiceDetails() function in AddPlanService (There will be two invoices in theis case)
                $invoiceDetails = $addPlanService->addInvoiceDetails($invoice, $service, $description1, $amount, $pricing);

            }
        }

        //Adding invoice details using addInvoiceDetails() function in AddPlanService
        $invoiceDetails = $addPlanService->addInvoiceDetails($invoice, $service, $description, $pricing->price, $pricing);
    }

    /*
     * Changing subscription details during refund
     */
    public function refundOrder($invoice)
    {
        //Get the latest service activated for the user and update the status
        $service = Service::where('user_id', $invoice->user_id)
          ->latest()->first();

        $service->status_id = 5;
        $invoice->payment_status = "refunded";
        $invoice->refund_date = Carbon::now()->format('Y-m-d H:i:s');
        $invoice->save();
        $service->save();
    }

    /*
     * Adding order,invoice and service details in the case of trial order
     */
    public function trialOrderDetails($user, $plan, $pricing, $gateway, $paymentStatus, $txId, $isRenew, $description, $price)
    {
        $addPlanService = new AddPlanService();
        $sub_domain = Session::get('sub_domain');
        $domainRegisterService = new DomainRegisterService();
        $domainRegisterService->registerDomain($sub_domain);
        $tenant = Tenant::where('id', $sub_domain)->first();
        $tenant->status = true;
        $tenant->save();
        $addPlanService = new AddPlanService();
        $order = $addPlanService->addOrder($gateway, $user, $price, $pricing);
        $service = $addPlanService->addService($plan, $pricing, $order, $user, $tenant);
        $invoice = $addPlanService->addInvoice($user, $pricing, $price, $order, $paymentStatus, $txId, $gateway, $isRenew);
        $invoiceDetails = $addPlanService->addInvoiceDetails($invoice, $service, $description, $price, $pricing);
        
        return $order;
    }
  
}