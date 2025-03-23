<?php

namespace App\Jobs;
use Carbon\Carbon;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Tenant\Department;
use App\Models\Tenant\EmailTemplate;
use App\Models\User;
use App\Models\Tenant\Services\EmailCampaignService;
use Illuminate\Support\Facades\Mail;
use App\Mail\CampaignMail;
use App\Helpers\Logger;

class EmailCampaignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_ids;
    protected $campaign;
    protected $type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_ids, $campaign, $type)
    {
        $this->user_ids = $user_ids;
        $this->campaign = $campaign;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Logger::info('Processing email campaign');
            $content = EmailTemplate::find($this->campaign->template_id);
            $department = Department::find($this->campaign->department_id);
            $users = User::whereIn('id', $this->user_ids)->get();
            
            $backup = Mail::getSwiftMailer();
            $security = ($department->smtp_encryption != '') ? $department->smtp_encryption : null;
            $transport = (new \Swift_SmtpTransport($department->smtp_host, $department->smtp_port, $security))
                ->setUsername($department->email)
                ->setPassword($department->smtp_password);
            $mailer = new \Swift_Mailer($transport);
            Mail::setSwiftMailer($mailer);

            Logger::info('Email campaign successfully processed');
            $this->campaign->status = "done";
            $this->campaign->send_at = Carbon::now()->format('Y-m-d H:i:s');
            $this->campaign->save();
        } catch (\Exception $error) {
            Logger::info('error processing email campaign');
            $this->campaign->status = "failed";
            $this->campaign->send_at = Carbon::now()->format('Y-m-d H:i:s');
            $this->campaign->save();
            return false;
        }

        $campaignService = new EmailCampaignService;
        foreach ($users as $user) {
            try {
                Logger::info('sending email to '.$user->email);
                $mail = new CampaignMail($content, $user, $department);
                $mail->from($department->email);
                Mail::to($user->email)
                    ->send($mail);
                 
                Logger::info('createing success log');
                $campaignService->logs($this->type, $this->campaign->uuid, $user, null);
                
            } catch (\Exception $error) {
                Logger::info('error sending email to '.$user->email);
                $campaignService->logs($this->type, $this->campaign->uuid, $user, $error);
            }
            
        }
        Mail::setSwiftMailer($backup); 
        
    }
}
