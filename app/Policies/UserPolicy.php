<?php

namespace App\Policies;

use App\Models\Tenant\RolePermission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 15 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }

    }

    public function viewUser( $user )
 {
        if (  $user->role == 'admin' || $user->role == 'staff' ) {
            return true;
        } else {
            return false;
        }
    }

    public function viewStaff( $user )
 {
        if ( $user->role == 'admin' ) {
            return true;
        } else {
            return false;
        }
    }

    public function create( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 13 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }

    }

    public function update( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 14 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }

    }

    public function delete( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 16 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }

    }

    public function restore( User $user )
 {
        //
    }

    public function forceDelete( User $user )
 {
        //
    }
}
