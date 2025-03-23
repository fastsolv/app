<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    use HasFactory;
   
    protected $fillable = ['role_id','permission_id','is_allowed'];
}
