<?php

namespace App\Http\Controllers\Tenant;

use App\Helpers\Uuid;
use App\Http\Controllers\Controller;
use App\Models\Tenant\ActionPermission;
use App\Models\Tenant\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        /*
        make sure only logged in and verified user has access
        to this controller
        */
        $this->middleware(['auth', 'verified']);
    }
    public function index(Request $request)
    {
        // $this->authorize( 'isAdmin', Role::class );
        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $roles = Role::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $roles = Role::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {

            $roles = Role::all();
            $sort_order = 'decs';
        }
       
    $params = [
        'roles' => $roles,
         'sort_order' =>  $sort_order
    ];
    return view('tenant.roles.index', $params);

    }

  
    public function create()
    {
        $this->authorize( 'isAdmin', Role::class );

        return view('tenant.roles.create');
    }

   
    public function store(Request $request)
    {

        $this->authorize( 'isAdmin', Role::class );
        // $this->authorize( 'create', Role::class );
        // try {

            $validator = Validator::make($request->all(), [
                   'name' => 'required',
                   'description' => 'required ',
                   'status' => 'required',
                                     
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            } 
            /*
            Make an object for Role,
            Add a Role
            */
            $role = new Role();
            $role->uuid = Uuid::getUuid();
            $role->name = $request->name;
            $role->description = $request->description;
            $role->status =$request->status;
           
            $role->save();

            // $permissions = ActionPermission::all();

            // $params = [
            //     'role' => $role,
            //     // 'permissions' => $permissions
            // ];


            // return view('roles.permissions', $params);

            return redirect()->route('role_permission.show', [$role->uuid])
                ->with('success', __('Roles created'));

        // } catch (\Exception $e) {
          
        //     return redirect()
        //         ->back()
        //         ->withInput()
        //         ->with('error', __('Something went wrong'));
        // }
    }

    public function show($id)
    {
        //
    }

    public function edit($uuid)
    {
         // Get the Role
      
         $this->authorize( 'isAdmin', Role::class );
         $role = Role::find($uuid);
         return view('tenant.roles.edit', $role);
    }

 
    public function update(Request $request, $uuid)
    {
        $this->authorize( 'isAdmin', Role::class );
        try {
            $validator = Validator::make($request->all(), [
                   'name' => 'required',
                   'description' => 'required', 
                   'status' => 'required',                  
            ]);
            
   
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            // Update Role
            $role = Role::find( $uuid );
            $role->name = $request->name;
            $role->description = $request->description;
            $role->status = $request->status;
            $role->update();
           
            return redirect()->route('get_roles')
                ->with('success', __('Role updated'));
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    public function destroy($uuid)
    {
    $this->authorize( 'isAdmin', Role::class );
     // Delete Role
     $role = Role::find($uuid);
     $role->delete();
     return redirect()->route('get_roles')
         ->with('success', __('Role deleted'));
    }

    public function permissions()
   {
    $permissions = ActionPermission::all();
    $params = [
        // 'role' => $role,
         'permissions' => $permissions
    ];
   
    return view('tenant.roles.permissions', $params);
   }
}


