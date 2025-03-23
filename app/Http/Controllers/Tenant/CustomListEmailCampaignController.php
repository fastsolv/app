<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\Models\Tenant\CustomListEmailCampaign;
use App\Models\Tenant\Services\EmailCampaignService;
use Illuminate\Http\Request;
use App\Models\Tenant\EmailTemplate;
use App\Models\User;
use App\Models\Tenant\Department;
use App\Services\Email;
use App\Jobs\EmailCampaignJob;
use App\Helpers\Logger;
use Illuminate\Support\Facades\Validator; 

class CustomListEmailCampaignController extends Controller
{
    public function __construct()
    {
        /*
        make sure only logged in and verified user has access
        to this controller
         */
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
        $this->authorize('isNotUser', Authorize::class);
        $campaignService = new EmailCampaignService();
        $query = CustomListEmailCampaign::query();

        $email_campaigns = $campaignService->getCampaigns($request, $query)->paginate(10);

        $params = [
            'email_campaigns' => $email_campaigns,
            'request' => $request,
        ];
        return view('tenant.email_campaign.custom_list.index', $params);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isNotUser', Authorize::class);
        $user = User::find(auth()->id());
        $selected_department = $user->departments()->pluck('department_id')->toArray();
        $email_templates = EmailTemplate::where('system_template', false)->get();
        if ($user->role == 'staff') {
            $departments = Department::where('smtp_status', true)
                ->whereIn('id', $selected_department)->get();  
        } else {
            $departments = Department::where('smtp_status', true)->get();
        }
        $clients = User::where('role', 'user')->get();
        $current_time = Carbon::now()->format('Y-m-d H:i');

        $params = [
            'clients' => $clients,
            'email_templates' => $email_templates,
            'departments' => $departments,
            'current_time' => $current_time,
            'user' => $user
        ];
        return view('tenant.email_campaign.custom_list.create', $params);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isNotUser', Authorize::class);
        try {
            //Form validation
            $validator = Validator::make($request->all(), [
                'client_ids' => 'required',
                'department_id' => 'required',
                'template_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $campaign = new CustomListEmailCampaign;
            $campaign->custom_user_list = $request->client_ids;
            $campaignService = new EmailCampaignService();
            $email_campaign = $campaignService->addCampaign($request, $campaign);

            if ($request->send_now) {
                $clients = array_map('intval', explode(",", $request->client_ids));
                $type = "custom_list";
                EmailCampaignJob::dispatch($clients, $email_campaign, $type)->onConnection('database');
            }

            return redirect()->route('custom_list_campaign.index')
                ->with('success', __('Email campaign added'));
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __($e->getMessage()));
        }
    }

    public function edit($uuid)
    {
        $this->authorize('isNotUser', Authorize::class);
        $campaign = CustomListEmailCampaign::find($uuid);
        $user = User::find(auth()->id());
        $selected_department = $user->departments()->pluck('department_id')->toArray();
        $email_templates = EmailTemplate::where('system_template', false)->get();
        if ($user->role == 'staff') {
          $departments = Department::where('smtp_status', true)
            ->whereIn('id', $selected_department)->get();  
        } else {
            $departments = Department::where('smtp_status', true)->get();
        }
        $clients = User::where('role', 'user')->get();
        $selected_clients = array_map('intval', explode(",", $campaign->custom_user_list));
        
        $params = [
            'campaign' => $campaign,
            'email_templates' => $email_templates,
            'departments' => $departments,
            'clients' => $clients,
            'selected_clients' => $selected_clients,
            'user' => $user,
            'clients' => $clients,
        ];
        return view('tenant.email_campaign.custom_list.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant\CustomListEmailCampaign  $CustomListEmailCampaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $this->authorize('isNotUser', Authorize::class);
        try {
            //Form validation
            $validator = Validator::make($request->all(), [
                'client_ids' => 'required',
                'department_id' => 'required',
                'template_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $campaign = CustomListEmailCampaign::find($uuid);
            $updateArray = [];
            $updateArray['custom_user_list'] = $request->client_ids;
            $campaignService = new EmailCampaignService();
            $email_campaign = $campaignService->updateCampaign($request, $campaign, $updateArray);

            if ($request->send_now) {
                $clients = array_map('intval', explode(",", $campaign->custom_user_list));
                $type = "custom_list";
                EmailCampaignJob::dispatch($clients, $email_campaign, $type)->onConnection('database');
            }

            return redirect()->route('custom_list_campaign.index')
                ->with('success', __('Email campaign updated'));
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __($e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant\CustomListEmailCampaign  $CustomListEmailCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->authorize('isNotUser', Authorize::class);
        $campaign = CustomListEmailCampaign::find($uuid);
        $campaign->delete();
        return redirect()->route('custom_list_campaign.index')
            ->with('success', __('Email campaign deleted'));
    }
}
