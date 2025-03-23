<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CannedResponse extends Model
{
    use HasFactory;
    protected $primaryKey = 'uuid';
    public $incrementing = false;

    protected $fillable = ['name', 'body'];

}
