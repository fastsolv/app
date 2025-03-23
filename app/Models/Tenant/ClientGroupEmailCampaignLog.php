<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientGroupEmailCampaignLog extends Model
{

    protected $primaryKey = 'uuid';
    public $incrementing = false;

    use HasFactory;

    public function users()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function campaigns()
    {
        return $this->belongsTo(ClientGroupEmailCampaign::class, 'campaign_id');
    }
}
