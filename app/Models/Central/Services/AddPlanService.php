<?php

namespace App\Models\Central\Services;
use Carbon\Carbon;
use DB;

use App\Models\User;
use App\Models\Central\Order;
use App\Models\Central\Service;
use App\Models\Central\Invoice;
use App\Models\Central\InvoiceDetails;
use App\Models\Central\UpgradeService;
use App\Models\Central\Services\PlanService;
use App\Helpers\Uuid;
use App\Helpers\Logger;
use App\Helpers\Random;

class AddPlanService
{
    /*
     * Adding order details to order table
     */
    public function addOrder($gateway, $user, $price, $pricing)
    {
        //Create object for Order and save data
        $order = new Order();
        $order->uuid = Uuid::getUuid();
        $order->parent_order_id = $this->parentOrder($user);
        $order->user_id = $user->id;
        $order->amount = $price;
        $order->currency = $pricing->currencies->currency;
        if($gateway !== null){
            $order->gateway = $gateway;
        }
        if ($price == 0.00){
            $order->status = 'active';
        } else {
            $order->status = 'in-complete';
        }
        $order->save();
        $order_updated = Order::find($order->uuid);
        return $order_updated;
    }

    /*
     * Adding service details to service table
     */
    public function addService($plan, $pricing, $order, $user, $tenant)
    {
        $planService = new PlanService ();
        //Get the plan validity from plan property table by joining table
        $validity = $planService->validity($pricing);

        //Create object for Service and save data
        $service = new Service();
        $service->uuid = Uuid::getUuid();
        $service->user_id = $user->id;
        $service->order_id = $order->uuid;
        $service->plan_id = $plan->uuid;
        $service->pricing_id = $pricing->id;
        $service->tenant_id = $tenant->tenant_id;
        $service->status_id = 1;
        //if validity is not one time
        if (is_numeric($validity)){
            //Get expiry date of service
            $service->expiry_date = Carbon::now()->addDays($validity)->format('Y-m-d H:i:s');
            $expiryDate = Carbon::parse($service->expiry_date);
            //Get next invoice date
            $service->next_invoice_date = $expiryDate->subDays(7)->format('Y-m-d H:i:s');
        } else {
            $service->expiry_date = null;
            $service->next_invoice_date = null;
        }
        $service->save();
        return $service;
    }

    /*
     * If a plan is updated with same plan before expiry date 
     * Update the service
     */
    public function updateService($service, $plan, $pricing, $user, $order)
    {
        $planService = new PlanService ();
        //Get the plan validity
        $validity = $planService->validity($pricing);

        //Update the service
        $service->order_id = $order->uuid;
        $service->plan_id = $plan->uuid;
        $service->pricing_id = $pricing->id;
        $service->status_id = 1;
        if (is_numeric($validity)){
            /*
             * Extend validity of the current plan with updated validity
             * refer extendedValidity() function in AddPlanService (This service)
             */
            $this->extendedValidity($service, $validity);
        } else {
            $service->expiry_date = null;
            $service->next_invoice_date = null;
        }
        $service->grace_period = null;
        $service->save();
        return $service;
    }

    /*
     * If a plan is ugraded with other plan before expiry date 
     * Upgrade the service
     */
    public function upgradeService($service, $plan, $pricing, $user, $order, $price, $paymentStatus)
    {
        //Get old pricing
        $old_pricing = $service->pricing_id;
        //Get old plan id
        $old_plan = $service->plan_id;  
        //Get plan validity
        $planService = new PlanService ();
        //Get the plan validity
        $validity = $planService->validity($pricing);

        $service->order_id = $order->uuid;
        $service->plan_id = $plan->uuid;
        $service->pricing_id = $pricing->id;
        $service->status_id = 1;
        $grace_period = $service->grace_period;
        $expiry = Carbon::parse($service->expiry_date);
        $currentDay = Carbon::now()->format('Y-m-d');
        if (is_numeric($validity)){
            //Get expiry date
            if ($grace_period) {
                if (Carbon::parse($grace_period)->format('Y-m-d') >= $currentDay) {
                    $service->expiry_date = $expiry->addDays($validity)->format('Y-m-d H:i:s');
                } else {
                    $diff = $expiry->diffInDays(Carbon::parse($grace_period));
                    $validity = $validity-$diff;
                    $service->expiry_date = Carbon::now()->addDays($validity)->format('Y-m-d H:i:s');
                }
            } else {
               $service->expiry_date = Carbon::now()->addDays($validity)->format('Y-m-d H:i:s');
            }
            $expiryDate = Carbon::parse($service->expiry_date);
            //Get next invoice date
            $service->next_invoice_date = $expiryDate->subDays(7)->format('Y-m-d H:i:s');
        } else {
            $service->expiry_date = null;
            $service->next_invoice_date = null;
        }
        $service->grace_period = null;
        $service->save();

        /*
         * Save the upgrade plan details to upgrade services table
         * Refer upgradedServices() function in AddPlanService (This service)
         */
        $this->upgradedServices($service, $price, $old_plan, $old_pricing, $paymentStatus);
        return $service;
    }

    /*
     * Adding order invoice to invoices table
     */
    public function addInvoice($user, $pricing, $price, $order, $paymentStatus, $txId, $gateway, $isRenew)
    {
        $invoice = new Invoice();
        $invoice->uuid = Uuid::getUuid();
        $invoice->user_id = $user->id;
        $invoice->order_id = $order->uuid;
        $invoice->amount = $price;
        $invoice->currency = $pricing->currencies->currency;
        if ($pricing->price == 0.00){
            $invoice->payment_status = 'paid';
        } else {
            $invoice->payment_status = $paymentStatus;
        }
        if($gateway !== null){
            $invoice->gateway = $gateway->name;
            $invoice->test_mode = $gateway->test_mode;
        } else {
            $invoice->test_mode = false;
            $invoice->gateway = null;
        }
        $invoice->transaction_id = $txId;
        $invoice->due_date = Carbon::now()->format('Y-m-d H:i:s');
        $invoice->is_renew = $isRenew;
        $invoice->save();
        return $invoice;
    }

    /*
     * Adding order invoice details to invoices details table
     */
    public function addInvoiceDetails($invoice, $service, $description, $price, $pricing)
    {
        $invoiceDetails = new InvoiceDetails();
        $invoiceDetails->uuid = Uuid::getUuid();
        $invoiceDetails->invoice_id = $invoice->uuid;
        $invoiceDetails->service_id = $service->uuid;
        $invoiceDetails->amount = $price;
        $invoiceDetails->currency = $pricing->currencies->currency;
        $invoiceDetails->description = $description;
        $invoiceDetails->save();

        return $invoiceDetails;
    }

    /*
     * Adding plan upgrade details to upgrade services table
     */
    private function upgradedServices($service, $price, $old_plan_id, $old_pricing_id, $paymentStatus){
        $upgradeService = new UpgradeService();
        $upgradeService->uuid = Uuid::getUuid();
        $upgradeService->service_id  = $service->uuid;
        $upgradeService->user_id = $service->user_id;
        $upgradeService->order_id  = $service->order_id;
        $upgradeService->old_plan_id  = $old_plan_id;
        $upgradeService->old_pricing_id  = $old_pricing_id;
        $upgradeService->new_plan_id  = $service->plan_id;
        $upgradeService->new_pricing_id  = $service->pricing_id;
        $upgradeService->amount  = $price;
        $upgradeService->currency  = $service->pricing->currencies->currency;
        $upgradeService->payment_status  = $paymentStatus;
        $upgradeService->save();
    }

    /*
     * Calculation of extended validity in the case of plan update
     */
    private function extendedValidity($service, $validity){
        //Get expiry date of plan
        $expiryDate = Carbon::parse($service->expiry_date);
        //Get todays date
        $now = Carbon::now();
        Logger::info("now: $now");
        //case where previous plan is not expired and not a trial plan
        if ($expiryDate > $now && $service->pricing->price !== 0.00){
            //Get the validity remaining
            $validityLeft = $expiryDate->diffInDays($now);
            Logger::info("validityLeft: $validityLeft");
            //Add the validity left to the original validity of updated plan to get extendedValidity
            $service->expiry_date = $now->addDays(($validity + $validityLeft))->format('Y-m-d H:i:s');
            Logger::info("expiry_date: $service->expiry_date");
        } else {
            //case where previous plan is expired
            $grace_period = $service->grace_period;
            $expiry = Carbon::parse($service->expiry_date);
            Logger::info("grace: $grace_period");
            $currentDay = Carbon::now()->format('Y-m-d');
            if ($grace_period) {
                if (Carbon::parse($grace_period)->format('Y-m-d') >= $currentDay) {
                    $service->expiry_date = $expiry->addDays($validity)->format('Y-m-d H:i:s');
                } else {
                    $diff = $expiry->diffInDays(Carbon::parse($grace_period));
                    $validity = $validity-$diff;
                    $service->expiry_date = Carbon::now()->addDays($validity)->format('Y-m-d H:i:s');
                }
            } else {
               $service->expiry_date = Carbon::now()->addDays($validity)->format('Y-m-d H:i:s');
            }
        }
        $newExpiryDate = Carbon::parse($service->expiry_date);
        Logger::info("newExpiryDate: $newExpiryDate");
        //Get next invoice date
        $service->next_invoice_date = $newExpiryDate->subDays(7)->format('Y-m-d H:i:s');
    }

    private function parentOrder($user){
        $existService = Service::where('user_id', $user->id)
            ->latest()->first();
        if ($existService){
            $parentOrder = $existService->order_id;
        } else {
            $parentOrder = 0;
        }
        return $parentOrder;
    }
  
}