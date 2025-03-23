<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Helpers\Logger;
use App\Models\Tenant\EmailTemplate;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $content;
    protected $user;
    protected $department;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $user, $department)
    {
        $this->content = $content;
        $this->user = $user;
        $this->department = $department;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content = $this->content;
        $user_name = $this->user->name;
        $department_name =  $this->department->name;
        $app_url = env('APP_URL');
        $value = array('{$user_name}', '{$department}', '{$app_url}');
        $actual_value = array($user_name, $department_name, $app_url);
        $body = $content->message;

        $message = str_replace($value, $actual_value, $body);
        // Logger::info($message);
        return $this->subject($content->subject)
            ->html($body);
    }
}
