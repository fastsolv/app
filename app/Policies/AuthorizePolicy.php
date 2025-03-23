<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorizePolicy
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

    public function User($user){
        if ($user->role == 'user') {
            return true;
        } else {
            return false;
        }
    }

    public function isNotUser($user){
        if ($user->role != 'user') {
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

    public function isNotStaff($user){
        if ($user->role != 'staff') {
            return true;
        } else {
            return false;
        }
    }
}
