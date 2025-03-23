<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'status_id',
        'phone',
        'address_1',
        'address_2',
        'city',
        'postal_code',
        'state_id',
        'country_id',
        'currency'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status_id' );
    }

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id' );
    }

    public function states()
    {
        return $this->belongsTo(State::class, 'state_id' );
    }

    public function departments()
    {
        return $this->belongsToMany(\App\Models\Tenant\Department::class);
    }

    public function clientGroups()
    {
        return $this->belongsToMany(\App\Models\Tenant\ClientGroup::class);
    }
}
