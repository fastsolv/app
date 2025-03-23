<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Role;
use App\Models\Tenant\Department;
use App\Models\Tenant\RolePermission;

class ProductPolicy
 {
    use HandlesAuthorization;

    /*
    For admin allow all action
    */

    public function isAdmin( $user ) {
        if ( $user->role == 'admin' ) {
            return true;
        } else {
            return false;
        }
    }

    public function isNotAdmin( $user ) {
        if ( $user->role != 'admin' ) {
            return true;
        } else {
            return false;
        }
    }

    public function isStaff( $user ) {
        if ( $user->role == 'staff' ) {
            return true;
        } else {
            return false;
        }
    }

    public function isNotuser( $user ) {
        if ( $user->role != 'user' ) {
            return true;
        } else {
            return false;
        }
    }

    public function view( User $user )
 {

        $permission =  RolePermission::where( 'permission_id', 11 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }

    }

    public function create( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 9 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function update( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 10 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function delete( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 12 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

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
