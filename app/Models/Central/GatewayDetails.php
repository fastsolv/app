<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class GatewayDetails extends Model
{
    use HasFactory;
    use Encryptable;

    protected $encryptable = [
        'value'
    ];
    
    protected $fillable = [
        'name', 'display_name', 'status', 'description', 'value'
    ];
    public function gateways()
    {
        return $this->belongsTo(Gateway::class, 'gateway_id');
    }
}
