<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Role;
use App\Models\Tenant\Department;
use App\Models\Tenant\RolePermission;

class EmailTemplatePolicy
 {
    use HandlesAuthorization;

    public function view( User $user )
 {

        $permission =  RolePermission::where( 'permission_id', 23 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function create( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 21 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function update( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 22 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function delete( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 24 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

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
