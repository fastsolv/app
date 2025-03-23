<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use App\Models\Tenant\ClientGroupEmailCampaign;
use App\Models\Tenant\Services\EmailCampaignService;
use Illuminate\Http\Request;
use App\Models\Tenant\EmailTemplate;
use App\Models\User;
use App\Models\Tenant\Department;
use App\Models\Tenant\ClientGroup;
use App\Services\Email;
use App\Jobs\EmailCampaignJob;
use App\Helpers\Logger;

class ClientGroupEmailCampaignController extends Controller
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
        $query = ClientGroupEmailCampaign::query();

        $email_campaigns = $campaignService->getCampaigns($request, $query)->paginate(10);

        $params = [
            'email_campaigns' => $email_campaigns,
            'request' => $request,
        ];
        return view('tenant.email_campaign.client_group.index', $params);

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
        $client_groups = ClientGroup::where('status', true)->get();
        $current_time = Carbon::now()->format('Y-m-d H:i');

        $params = [
            'email_templates' => $email_templates,
            'departments' => $departments,
            'client_groups' => $client_groups,
            'current_time' => $current_time,
            'user' => $user
        ];
        return view('tenant.email_campaign.client_group.create', $params);

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
                'client_group_id' => 'required',
                'department_id' => 'required',
                'template_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $campaign = new ClientGroupEmailCampaign;
            $campaign->client_group_id = $request->client_group_id;
            $campaignService = new EmailCampaignService();
            $email_campaign = $campaignService->addCampaign($request, $campaign);

            if ($request->send_now) {
                $client_group = ClientGroup::find($request->client_group_id);
                $user_ids = $client_group->clients()->pluck('user_id')->toArray();
                $type = "client_group";
                EmailCampaignJob::dispatch($user_ids, $email_campaign, $type)->onConnection('database');
            }

            return redirect()->route('client_group_campaign.index')
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
        $campaign = ClientGroupEmailCampaign::find($uuid);
        $user = User::find(auth()->id());
        $selected_department = $user->departments()->pluck('department_id')->toArray();
        $email_templates = EmailTemplate::where('system_template', false)->get();
        if ($user->role == 'staff') {
          $departments = Department::where('smtp_status', true)
            ->whereIn('id', $selected_department)->get();  
        } else {
            $departments = Department::where('smtp_status', true)->get();
        }
        $client_groups = ClientGroup::where('status', true)->get();

        $params = [
            'campaign' => $campaign,
            'email_templates' => $email_templates,
            'departments' => $departments,
            'client_groups' => $client_groups,
            'user' => $user
        ];
        return view('tenant.email_campaign.client_group.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant\ClientGroupEmailCampaign  $clientGroupEmailCampaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $this->authorize('isNotUser', Authorize::class);
        try {
            //Form validation
            $validator = Validator::make($request->all(), [
                'client_group_id' => 'required',
                'department_id' => 'required',
                'template_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $campaign = ClientGroupEmailCampaign::find($uuid);
            $updateArray = [];
            $updateArray['client_group_id'] = $request->client_group_id;
            $campaignService = new EmailCampaignService();
            $email_campaign = $campaignService->updateCampaign($request, $campaign, $updateArray);

            if ($request->send_now) {
                $client_group = ClientGroup::find($request->client_group_id);
                $user_ids = $client_group->clients()->pluck('user_id')->toArray();
                $type = "client_group";
                EmailCampaignJob::dispatch($user_ids, $email_campaign, $type)->onConnection('database');
            }

            return redirect()->route('client_group_campaign.index')
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
     * @param  \App\Models\Tenant\ClientGroupEmailCampaign  $clientGroupEmailCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->authorize('isNotUser', Authorize::class);
        $campaign = ClientGroupEmailCampaign::find($uuid);
        $campaign->delete();
        return redirect()->route('client_group_campaign.index')
            ->with('success', __('Email campaign deleted'));
    }
}
