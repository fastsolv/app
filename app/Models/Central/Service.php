<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Service extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    
    use HasFactory, CentralConnection;

    protected $fillable = [
        'status_id', 'plan_id', 'expiry_date', 'next_invoice_date', 'notes'
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function plans()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function pricing()
    {
        return $this->belongsTo(Pricing::class, 'pricing_id');
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
