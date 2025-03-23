<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Auth;
use Exception;

use Illuminate\Console\Command;
use App\Helpers\Logger;
use App\Helpers\Uuid;
use App\Helpers\Random;
use App\Models\Tenant\CustomListEmailCampaign;
use App\Models\Tenant\ClientGroupEmailCampaign;
use App\Models\Tenant\ClientGroup;
use App\Models\User;
use App\Models\Tenant;
use App\Jobs\EmailCampaignJob;

class EmailCampaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email_campaign:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email campaigning';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tenants = Tenant::get();
        foreach ($tenants as $tenant) {
            Logger::info($tenant->id);
            $tenant->run(function () {
                Logger::info('Running Email campaign command');
                $client_group_campaigns = ClientGroupEmailCampaign::where('status', "pending")->get();
                $custom_list_campaigns = CustomListEmailCampaign::where('status', "pending")->get();
                foreach ($client_group_campaigns as $campaign) {;
                    try {
                        $now = Carbon::now()->format('Y-m-d H:i:s');
                        if ($campaign->send_at <= $now) {
                            $client_group = ClientGroup::find($campaign->client_group_id);
                            $user_ids = $client_group->clients()->pluck('user_id')->toArray();
                            Logger::info('Sending client group emil campaign');
                            $type = "client_group";

                            EmailCampaignJob::dispatch($user_ids, $campaign, $type)->onConnection('database');
                        }
                    } catch (Exception $e) {
                        Logger::info('Error processing client group email campaign');
                    }
                }

                foreach ($custom_list_campaigns as $campaign) {
                    try {
                        $now = Carbon::now()->format('Y-m-d H:i:s');
                        if ($campaign->send_at <= $now) {
                            $clients = array_map('intval', explode(",", $campaign->custom_user_list));
                            Logger::info('Sending custom list emil campaign');
                            $type = "custom_list";
                            EmailCampaignJob::dispatch($clients, $campaign, $type)->onConnection('database');
                        }
                    } catch (Exception $e) {
                        Logger::info('Error processing custom list email campaign');
                    }
                }
            });
        }
    }
}
