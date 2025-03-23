<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    
    use HasFactory;

    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
