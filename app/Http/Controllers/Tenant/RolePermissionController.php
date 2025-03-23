<?php

namespace App\Http\Controllers\Tenant;

use App\Helpers\Uuid;
use App\Http\Controllers\Controller;
use App\Models\Tenant\ActionPermission;
use App\Models\Tenant\Role;
use App\Models\Tenant\RolePermission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index() {

    }

    public function create() {
        //
    }

    public function store( Request $request ) {
        //
    }

    public function show( $uuid ) {
        $permissions = ActionPermission::all();
        foreach ( $permissions as $permission ) {
            $roles_permissions[ $permission->id ] = RolePermission::where( 'role_id', $uuid )->where( 'permission_id', $permission->id )->value( 'is_allowed' );
        }
        $role = Role::find( $uuid );
        $role_permission = 1;
        $params = [
            'role_id' => $uuid,
            'role' => $role,
            'permissions' => $permissions,
            'role_permission'=>$role_permission,
            'roles_permissions'=>$roles_permissions,
            'selectall'=>0,
        
        ];

        // dd( $params );
        return view( 'tenant.roles.permissions', $params );
    }

    public function edit( $id ) {
        //
    }

    public function update( Request $request, $id ) {
        //
    }

    public function destroy( $id ) {
        //
    }

    public function rolePermission( $role_id,  Request $request ) {

        $role = Role::find( $role_id );

        if ( $request->is_allow ) {
            $roles_permissions = [];
            foreach ( $request->is_allow as $uuid => $value ) {
                $roles_permissions[ $uuid ] = RolePermission::where( 'role_id', $role_id )->where( 'permission_id', $uuid )->value( 'is_allowed' );
                $role_permissions = RolePermission::where( 'role_id', $role_id )->where( 'permission_id', $uuid )->get();
                if ( $role_permissions->all() ) {
                    $role_permission_id = $role_permissions[ 0 ]->uuid;
                    $role_permission = RolePermission::find( $role_permission_id );

                    $role_permission->is_allowed = $value;
                    $role_permission->update();
                } else {
                    $role_permission = new RolePermission();
                    $role_permission->uuid = Uuid::getUuid();
                    $role_permission->role_id = $role_id;
                    $role_permission->permission_id = $uuid;
                    $role_permission->is_allowed = $value;
                    $role_permission->save();
                }
            }
        }

        $permissions = ActionPermission::all();

        $params = [
            'role_id' => $role_id,
            'role' => $role,
            'permissions' => $permissions,
            'role_permission'=>$role_permission,
            'roles_permissions'=>$roles_permissions
        ];
    

        return redirect()->route( 'get_roles' )
        ->with( 'success', __( 'Role updated' ) );

    }

    function selectAll(  $role_id,  Request $request ){
       
        $permissions = ActionPermission::all();
        foreach ( $permissions as $permission ) {
            $roles_permissions[ $permission->id ] = RolePermission::where( 'role_id', $role_id )->where( 'permission_id', $permission->id )->value( 'is_allowed' );
        }
    
        $role = Role::find( $role_id);
        $roles = RolePermission::all();
        foreach($roles as $rol){
            if($request->permission_enable){
                $rol->is_allowed=1;
          $select_all=1;
            }else{
                $rol->is_allowed=0;
                $select_all=0;
            }
           
            $rol->save();
            $permission=1;
          
        }
     
        $params = [
            'role_id' =>$role_id,
            'role' => $role,
            'permissions' => $permissions,
            
          
            'selectall'=>$select_all,
        
        ];
        // dd( $params );
  return redirect()->route( 'get_roles',$params )
        ->with( 'success', __( 'Role updated' ) );
      
        
        // return redirect()->route( 'get_roles' ,$permission)
        // ->with( 'success', __( 'Role updated' ) );



    }
}


