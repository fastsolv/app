<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketNote extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    
    use HasFactory;

    public function noteUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'note_user_id');
    }
}
