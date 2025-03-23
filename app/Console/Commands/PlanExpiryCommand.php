<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use DB;

use Illuminate\Console\Command;
use App\Helpers\Logger;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Central\Service;
use App\Helpers\Uuid;
use Illuminate\Support\Facades\Mail;
use App\Mail\Central\PlanExpired;
use App\Mail\Central\PlanValidityReminder;

class PlanExpiryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan_validity:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Logger::info("User name:");
        //Get all users
        $users = User::all();
        foreach ($users as $user){

            Logger::info("User name: $user->first_name");
            //get the latest subscription of user
            $service = Service::where('user_id', $user->id)->latest()->first();
            if($service !==null && $service->expiry_date !==null){
                $tenant = Tenant::where('tenant_id', $service->tenant_id )->first();
                //A subscription is present
                $expiryDate = Carbon::parse($service->expiry_date);
                $firstInvoiceDate = Carbon::parse($service->next_invoice_date)->format('Y-m-d');
                $secondInvoiceDate = Carbon::parse($service->expiry_date)->subDays(1)->format('Y-m-d');
                Logger::info("Expiry date: $expiryDate");
                $currentDate = Carbon::now()->format('Y-m-d H:i:s');
                $currentDay = Carbon::now()->format('Y-m-d');

                if ($expiryDate < $currentDate){

                    if ($service->grace_period && Carbon::parse($service->grace_period)->format('Y-m-d') >= $currentDay) {
                        Logger::info("Grace periode is active");
                    } else {
                        /**
                         * Service is expired,
                         * if should be notified send an email/sms.
                         */
                        Logger::info("Service Expired");
                        $service->status_id = 2;
                        $tenant->status = false;
                        $toEmail = $user->email;
                        Logger::info("Sending plan expired email to: $toEmail");
                        $mail = new PlanExpired($user);
                        Mail::to($toEmail)
                            ->queue($mail);

                        $service->save();
                        $tenant->save();
                    }

                } elseif($firstInvoiceDate == $currentDay) {
                    /**
                     * Service will expire in 7 days,
                     * if should be notified send an email/sms.
                     */
                    Logger::info("Plan will expire in 7 days");
                    $toEmail = $user->email; 
                    $expireIn = 7;
                    Logger::info("Sending plan validity reminder email to: $toEmail");
                    $mail = new PlanValidityReminder($user, $expireIn);
                    Mail::to($toEmail)
                        ->queue($mail);

                } elseif($secondInvoiceDate == $currentDay) {
                    /**
                     * Service will expire in tommorow,
                     * if should be notified send an email/sms.
                     */
                    Logger::info("Plan will expire in 1 day");
                    $toEmail = $user->email;
                    $expireIn = 1;
                    Logger::info("Sending plan validity reminder email to: $toEmail");
                    $mail = new PlanValidityReminder($user, $expireIn);
                    Mail::to($toEmail)
                        ->queue($mail);
                } else {
                    Logger::info("Plan not expired");
                }

            } elseif($service !==null && $service->expiry_date == null) {
                Logger::info("One time plan is active");
            } else {
                Logger::info("No service active");
            }
        }
    }
}
