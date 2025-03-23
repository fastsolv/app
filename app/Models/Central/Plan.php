<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Plan extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    
    use HasFactory, CentralConnection;

    protected $fillable = [
        'name', 'description', 'status', 'department_count', 
        'staffs_qty', 'user_qty', 'ticket_qty', 'display_order','require_payment'
    ];

}
