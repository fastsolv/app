<?php

namespace App\Mail\Central;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Helpers\Logger;

class PlanValidityReminder extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $expireIn;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $expireIn)
    {
        $this->user = $user;
        $this->expireIn = $expireIn;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('central.add_plan.mail.plan_validity_reminder')
                ->with([
                    'user' => $this->user,
                    'expireIn' => $this->expireIn,
                ]);
    }
}
