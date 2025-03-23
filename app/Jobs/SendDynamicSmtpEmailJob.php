<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Tenant\Department;
use Illuminate\Support\Facades\Mail;

class SendDynamicSmtpEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $department_id;
    protected $mail;
    protected $ticket;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($department_id, $mail, $ticket)
    {
        $this->department_id = $department_id;
        $this->mail = $mail;
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $department = Department::find($this->department_id);
        $this->mail->from($department->email);
        $backup = Mail::getSwiftMailer();
        $security = ($department->smtp_encryption != '') ? $department->smtp_encryption : null;
        $transport = (new \Swift_SmtpTransport($department->smtp_host, $department->smtp_port, $security))
            ->setUsername($department->email)
            ->setPassword($department->smtp_password);
        $mailer = new \Swift_Mailer($transport);
        Mail::setSwiftMailer($mailer);
        Mail::to($this->ticket->from_email)
            ->send($this->mail);
        Mail::setSwiftMailer($backup);
    }
}
