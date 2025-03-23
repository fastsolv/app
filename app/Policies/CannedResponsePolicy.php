<?php

namespace App\Policies;

use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Role;
use App\Models\Tenant\Department;
use App\Models\Tenant\RolePermission;
use App\Models\User;

class CannedResponsePolicy
 {
    use HandlesAuthorization;

    public function view( User $user )
 {

        $permission =  RolePermission::where( 'permission_id', 19 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function create( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 17 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function update( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 18 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function delete( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 20 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function restore( User $user, Department $department )
 {
        //
    }

    public function forceDelete( User $user, Department $department )
 {
        //
    }

}
