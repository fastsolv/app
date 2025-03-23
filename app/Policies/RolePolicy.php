<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\RolePermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /*
    For admin allow all action
     */
    public function isAdmin($user){
        if ($user->role == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function isNotAdmin($user){
        if ($user->role != 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function isStaff($user){
        if ($user->role == 'staff') {
            return true;
        } else {
            return false;
        }
    }

    public function isNotuser($user){
        if ($user->role != 'user') {
            return true;
        } else {
            return false;
        }
    }

   
    
}
