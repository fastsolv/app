<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Logger;
use App\Models\User;
use App\Models\Tenant\ClientGroup;
use App\Models\Central\Service;
use App\Models\Tenant\RolePermission;
use Illuminate\Support\Facades\Hash;
use App\Models\Tenant\Services\UserService;

class UserController extends Controller
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
        /*
        Check weather the user has access to this function
        */
        $this->authorize('viewUser', User::class);
        $this->authorize('viewAny', User::class);
        $user = User::find(auth()->id());
        $show_add_button =$user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',13)->value('is_allowed'):1;
        $show_edit_button =$user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',14)->value('is_allowed'):1;
        $show_delete_button =$user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',16)->value('is_allowed'):1;
 
        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $users = User::where('role', 'user')->orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $users = User::where('role', 'user')->orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {

            $users = User::where('role', 'user')
            ->paginate(10);
            $sort_order = 'decs';
        }
       
        $params = [
            'users' => $users,
            'sort_order' => $sort_order,
            'request' => $request,
            'show_add_button' => $show_add_button,
            'show_edit_button' => $show_edit_button,
            'show_delete_button' => $show_delete_button,
          
        ];
        return view('tenant.users.index', $params);
    }

    public function create(Request $request)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('viewUser', User::class);
        $this->authorize('create', User::class);
        
        return view('tenant.users.create');
    }

    public function store(Request $request)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('viewUser', User::class);

        $this->authorize('create', User::class);
        try {

            $validator = Validator::make($request->all(), [
                   'name' => 'required',
                   'email' => 'required | unique:App\Models\Tenant\User,email',
                   'password' => 'required|min:8',
                   'c_password'=> 'required|same:password'                     
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            } 
            /*
            Make an object for user,
            Add a user
            */
            $user = new User();
            $user->first_name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'user';
            $user->user_type = 'user';
            // $user->phone_number = $request->phone_number;
            $user->save();

            return redirect()->route('get_users')
                ->with('success', __('User created'));

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    public function edit(Request $request, $id)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('viewUser', User::class);
        $this->authorize('update', User::class);

        // Get the user
        $user = User::find($id);
        return view('tenant.users.edit', $user);
    }

    public function update(Request $request, $id)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('viewUser', User::class);
        $this->authorize('update', User::class);
        
        try {
            $validator = Validator::make($request->all(), [
                   'name' => 'required',
                   'email' => 'required',                   
            ]);
            
            // Get the user
            $user = User::find($id);
            // Update password

            $updateArray = [];
            $check = $request->old_password;
            if (isset($check))
            {
                // If old password is incorrect
                if (!Hash::check($check, $user->password)){
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', __('Please check your password'));
                // If old password is correct
                } elseif (Hash::check($check, $user->password)) {

                    $validator = Validator::make($request->all(), [
                        'password' => 'required|min:8',
                        'c_password'=> 'required|same:password'                   
                ]);
                $updateArray['password'] = Hash::make($request->password);  
                    
                }
            }

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            // Update user
            $updateArray['first_name'] = $request->name;
            $updateArray['email'] = $request->email;  
            $updateArray['language_id'] = $request->language_id; 
      
            $user->update($updateArray);
            $user->departments()->sync($request->department);
            return redirect()->route('get_users')
                ->with('success', __('User updated'));
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    public function destroy($id)
    {
        
        $this->authorize('viewUser', User::class);
        $this->authorize('delete', User::class);

        // Delete user
        $user = User::find($id);
        $user->delete();
        return redirect()->route('get_users')
            ->with('success', __('User deleted'));
    }
}



