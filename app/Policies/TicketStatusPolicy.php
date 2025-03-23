<?php

namespace App\Policies;

use App\Models\Tenant\Department;
use App\Models\Tenant\Tenant\TicketStatus;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Tenant\Permission;
use App\Models\Tenant\RolePermission;
use App\Models\User;

class TicketStatusPolicy
{
    use HandlesAuthorization;

    
    public function create( User $user )
 {

        $permission =  RolePermission::where( 'permission_id', 5 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }

    }

    public function viewAny( User $user )
 {
        //
    }

    public function view( User $user )
 {

        $permission =  RolePermission::where( 'permission_id', 7 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }

    }

    public function update( User $user )
 {

        $permission =  RolePermission::where( 'permission_id', 6 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

        if ( $user->role == 'admin' || $permission == 1 ) {
            return true;
        } else {
            return false;
        }

    }

    public function delete( User $user )
 {
        $permission =  RolePermission::where( 'permission_id', 8 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );

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
