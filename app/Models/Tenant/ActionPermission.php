<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionPermission extends Model
{
    use HasFactory;
    protected $fillable = [
        'model', 'action'
    ];
}
