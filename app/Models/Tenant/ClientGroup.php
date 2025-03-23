<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientGroup extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;

    use HasFactory;

    protected $fillable = ['name', 'description','status'];

    public function clients()
    {
        return $this->belongsToMany(\App\Models\User::class);
    }
}
