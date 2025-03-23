<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $fillable = [ 'name','version','index_url','status','json_string'];
    protected $table = 'addons';

}
