<?php

namespace App\Models\Tenant\Services;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Tenant\ClientGroupEmailCampaign;
use App\Models\Tenant\ClientGroupEmailCampaignLog;
use App\Models\Tenant\CustomListEmailCampaignLog;
use App\Helpers\Uuid;
use Auth;
use App\Helpers\Logger;


class EmailCampaignService
{

    public function getCampaigns($request, $query)
    {
       //Query all users
       $query->orderBy('created_at', 'DESC');
       //Filter users by by search keywords
       if ($request->search) {
           $query = $query->where('name', 'like', '%' . $request->search . '%');
       }

       $email_campaigns = $query;
       return $email_campaigns;
    }

    public function addCampaign($request, $campaign)
    {
        $campaign->uuid = Uuid::getUuid();
        $campaign->template_id = $request->template_id;
        $campaign->department_id = $request->department_id;
        if($request->send_now) {
            $campaign->send_at = Carbon::now()->format('Y-m-d H:i:s');
            $campaign->status = "done";
        } else {
            $campaign->send_at = $request->send_at;
            $campaign->status = "pending";
        }
        $campaign->save();
        return $campaign;
    }

    public function updateCampaign($request, $campaign, $updateArray)
    {
        $updateArray['template_id'] = $request->template_id;
        $updateArray['department_id'] = $request->department_id;
        if($request->send_now) {
            $updateArray['send_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $updateArray['status'] = "done";
        } else {
            $updateArray['send_at'] = $request->send_at;
            $updateArray['status'] = $request->status;
        }
        $campaign->update($updateArray);
        return $campaign;
    }

    public function logs($type, $campaign_id, $user, $error){
        if ($type == "client_group") {
            $log = new ClientGroupEmailCampaignLog;
        } else {
            $log = new CustomListEmailCampaignLog;
        }
        $log->uuid = Uuid::getUuid();
        $log->user_id = $user->id;
        $log->campaign_id = $campaign_id;
        $log->send_at = Carbon::now()->format('Y-m-d H:i:s');
        if ($error) {
            $log->status = false;   
        } else {
            $log->status = true;
        }
        Logger::info("Email log created");
        $log->save();
    }
}
