<?php

namespace App\Models\Central\Services;
use Carbon\Carbon;

use App\Models\Central\Plan;
use App\Models\Central\Pricing;
use App\Models\User;
use App\Helpers\Uuid;

class PlanService
{
    /** 
     * Get dashboard contents
    */ 
    public function addPlan($request)
    {
        $plan = new Plan ();
        $plan->uuid = Uuid::getUuid();
        $plan->name= $request->name;
        $plan->description = $request->description;
        if ($request->departments){
            $plan->department_count = $request->department_count;
        }
        if ($request->staff){
            $plan->staffs_qty = $request->staffs_qty;
        }
        if ($request->users){
            $plan->user_qty = $request->user_qty;
        }
        if ($request->tickets){
            $plan->ticket_qty = $request->ticket_qty;
        }
        if ($request->Requirepayment_website) {
            $plan->require_payment  = $request->Requirepayment_website == true ? 1 : 0;
        }
        $plan->display_order = $request->display_order;
        $plan->status = $request->status;
        $plan->save();    
    }

    public function updatePlan($request, $plan) {
        $updateArray = [];
        $updateArray['name'] = $request->name;
        $updateArray['description'] = $request->description;
        if ($request->departments){
            $updateArray['department_count'] = $request->department_count;
        }
        if ($request->staff){
            $updateArray['staffs_qty'] = $request->staffs_qty;
        }
        if ($request->users){
            $updateArray['user_qty'] = $request->user_qty;
        }
        if ($request->tickets){
            $updateArray['ticket_qty'] = $request->ticket_qty;
        }
        $updateArray['require_payment'] = $request->Requirepayment_website == true ? 1 : 0;
        $updateArray['status'] = $request->status;
        $updateArray['display_order'] = $request->display_order;
        $plan->update($updateArray);   
    }


    public function validity($pricing) {
        if ($pricing->period == "Monthly") {
            $validity = $pricing->term * 30;
        } elseif ($pricing->period == "Yearly"){
            $validity = $pricing->term * 365;
        } else {
            $validity = 0; 
        }
        return $validity;
    }

    public function displayValidity($pricing) {
        // if ($pricing->period == "Daily") {
            // $validity = "$pricing->term Day(s)";
        // } elseif ($pricing->period == "Weekly"){
        //     $validity = "$pricing->term Week(s)";
        // } elseif ($pricing->period == "Monthly"){
        //     $validity = "$pricing->term Month(s)";
        // } elseif ($pricing->period == "Yearly"){
        //     $validity = "$pricing->term Years";
        // }
        $validity = $pricing->term." ".$pricing->period;
        return $validity;
    }
}