<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpgradeService extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    
    use HasFactory;

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function plans()
    {
        return $this->belongsTo(Plan::class, 'new_plan_id', 'old_plan_id');
    }

    public function pricing()
    {
        return $this->belongsTo(Plan::class, 'new_pricing_id', 'old_pricing_id');
    }

    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
