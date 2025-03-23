<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Pricing extends Model
{
    
    use HasFactory, CentralConnection;

    protected $fillable = [
        'term', 'period', 'price', 'price_renews', 
        'currency'
    ];

    public function plans()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function currencies()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}