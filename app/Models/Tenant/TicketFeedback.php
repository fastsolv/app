<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketFeedback extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    
    use HasFactory;

    public function feedbackUser()
    {
        return $this->belongsTo(User::class, 'feedback_user_id');
    }
    public function feedbackTicket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_uuid');
    }
}
