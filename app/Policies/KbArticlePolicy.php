<?php

namespace App\Policies;

use App\Models\Tenant\KbArticle;
use App\Models\User;
use App\Models\Tenant\Permission;
use App\Models\Tenant\RolePermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class KbArticlePolicy
{
    public function view(User $user)
    {
      
        $permission = RolePermission::where( 'permission_id', 28 )->where('role_id', $user->role_id)->value('is_allowed');
 
        if ( $user->role == 'admin' || $permission == 1 ) {
          
            return true;
        } else {
         
            return false;
        }
        
    }
    public function create(User $user)
    {
      
        $permission = RolePermission::where( 'permission_id', 29 )->where('role_id', $user->role_id)->value('is_allowed');
 
        if ( $user->role == 'admin' || $permission == 1 ) {
          
            return true;
        } else {
         
            return false;
        }
        
    }
   
   
       public function update( User $user )
    {
           $permission =  RolePermission::where( 'permission_id', 33 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
           if ( $user->role == 'admin' || $permission == 1 ) {
               return true;
           } else {
               return false;
           }
   
       }
   
       public function delete( User $user )
    {
           $permission =  RolePermission::where( 'permission_id', 34 )->where( 'role_id', $user->role_id )->value( 'is_allowed' );
   
           if ( $user->role == 'admin' || $permission == 1 ) {
               return true;
           } else {
               return false;
           }
       }
}