<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address_1',
        'address_2',
        'city',
        'postal_code',
        'state_id',
        'country_id',
    ];

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id' );
    }

    public function states()
    {
        return $this->belongsTo(State::class, 'state_id' );
    }
}
