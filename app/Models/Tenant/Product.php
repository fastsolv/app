<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    use HasFactory;
    protected $fillable = ['product_name','product_decription','status'];
    
    public function ticket(){
        
        return $this->hasMany(Ticket::class);
        }
}
