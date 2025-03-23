<?php

namespace App\Policies;

use App\Models\Tenant\Faq;
use App\Models\User;
use App\Models\Tenant\Permission;
use App\Models\Tenant\RolePermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
{
    public function view(User $user)
    {

        $permission = RolePermission::where( 'permission_id', 31 )->where('role_id', $user->role_id)->value('is_allowed');
 
        if ( $user->role == 'admin' || $permission == 1 ) {
          
            return true;
        } else {
         
            return false;
        }
        

    }
    public function create( User $user )
    {
           $permission =  RolePermission::where( 'permission_id', 38 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
           if ( $user->role == 'admin' || $permission == 1 ) {
               return true;
           } else {
               return false;
           }
       }
   
       public function update( User $user )
    {
           $permission =  RolePermission::where( 'permission_id', 39 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
           if ( $user->role == 'admin' || $permission == 1 ) {
               return true;
           } else {
               return false;
           }
   
       }
   
       public function delete( User $user )
    {
           $permission =  RolePermission::where( 'permission_id', 40 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
           if ( $user->role == 'admin' || $permission == 1 ) {
               return true;
           } else {
               return false;
           }
       }

}