<?php

namespace App\Policies;

use App\Models\Tenant\Department;
use App\Models\Central\Service;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Tenant\Permission;
use App\Models\Tenant\RolePermission;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function viewAny( User $user )
    {
   
           $permission =  RolePermission::where( 'permission_id', 3 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
           if ( $user->role == 'admin' || $permission == 1 ) {
               return true;
           } else {
               return false;
           }
       }
   
       public function view( User $user )
    {
           //
       }
   
       public function create( User $user )
    {
           $permission =  RolePermission::where( 'permission_id', 1 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
           if ( $user->role == 'admin' || $permission == 1 ) {
               return true;
           } else {
               return false;
           }
       }
   
       public function update( User $user )
    {
           $permission =  RolePermission::where( 'permission_id', 2 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
           if ( $user->role == 'admin' || $permission == 1 ) {
               return true;
           } else {
               return false;
           }
   
       }
   
       public function delete( User $user )
    {
           $permission =  RolePermission::where( 'permission_id', 4 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
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
   