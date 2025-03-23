<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Logger;
use App\Models\User;
use App\Models\Central\Status;
use App\Models\Central\Services\UserService;

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
    
    /*
     * List all users
     */
    public function index(Request $request)
    {
        $this->authorize('isAdmin', Authorize::class);
        /*
         * service class that interact with the User model.
         * Refer app/Models/Central/Services/UserService.php
         */
        $userService = new UserService();
        //Get filtered users using function getFilteredElements() in UserService
        $users = $userService->getFilteredElements($request)->paginate(10);

        $params = [
            'users' => $users,
            'request' => $request,
        ];
        return view('central.users.index', $params);
    }

    /*
     * View user create page
     */
    public function create()
    {
        $this->authorize('isAdmin', Authorize::class);
        return view('central.users.create');
    }

    /*
     * Add a new user
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin', Authorize::class);
        try {
            //Form validation
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required | unique:App\Models\User,email',
                'password' => 'required|min:8',
                'c_password'=> 'required|same:password',
                'phone' => 'numeric | nullable',
                'address_1' => 'required',
                'city' => 'required | string | max:255',
                'postal_code' => 'required',
                'state' => 'required',
                'country' => 'required',                     
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            } 
            /*
             * service class that interact with the User model.
             * Add a user
             */
            $userService = new UserService();
            $userService->addUser($request);

            return redirect()->route('users.index')
                ->with('success', __('User created'));

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    /*
     * View update user details page
     */
    public function edit($id)
    {
        $this->authorize('isAdmin', Authorize::class);
        $user = User::find($id);
        $statuses = Status::all();
        $params = [
            'user' => $user,
            'statuses' => $statuses
        ];
        return view('central.users.edit', $params);
    }

    /*
     * Update a user
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin', Authorize::class);
        try {
            //Get the user
            $user = User::find($id);
            //Form validation
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required | unique:App\Models\User,email,'.$user->id,
                'phone' => 'nullable|numeric',
                'address_1' => 'required',
                'city' => 'required | string | max:255',
                'postal_code' => 'required',
                'state' => 'required',
                'country' => 'required',                  
            ]);
            
            $updateArray = [];
            // Update password
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
                $password = Hash::make($request->password);     
                }
            } else {
                $password = $user->password;
            }

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            //Get the current status of the user
            $status_id = Status::where('name', $request->status)->pluck('id');

            /*
             * service class that interact with the User model.
             * refer updateUser() function in app/Models/Central/Services/UserService
            */
            $userService = new UserService();
            //Update user by calling updateUser function in UserService
            $userService->updateUser($request, $user, $password, $status_id[0]);

            return redirect()->route('users.index')
                ->with('success', __('User updated'));
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    /*
     * Delete a user
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin', Authorize::class);
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', __('User deleted'));
    }
}
