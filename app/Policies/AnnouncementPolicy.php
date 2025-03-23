<?php

namespace App\Policies;

use App\Models\Announcement;
use App\Models\Tenant\RolePermission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
{
   

    public function create( User $user )
    {
           $permission =  RolePermission::where( 'permission_id', 44 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
           if ( $user->role == 'admin' || $permission == 1 ) {
               return true;
           } else {
               return false;
           }
       }
   
       public function update( User $user )
    {
           $permission =  RolePermission::where( 'permission_id', 45 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
           if ( $user->role == 'admin' || $permission == 1 ) {
               return true;
           } else {
               return false;
           }
   
       }
   
       public function delete( User $user )
    {
           $permission =  RolePermission::where( 'permission_id', 46 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
           if ( $user->role == 'admin' || $permission == 1 ) {
               return true;
           } else {
               return false;
           }
       }
}