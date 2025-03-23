<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $fillable = ['name','decription','status'];
    
    use HasFactory;
}
    