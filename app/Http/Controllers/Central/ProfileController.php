<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Central\Service;
use Illuminate\Support\Facades\Hash;
use App\Models\Central\Services\UserService;

class ProfileController extends Controller
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
        // get the logged in user
        $user = auth()->user();
        $service = Service::where('user_id', $user->id)->latest()->first();
        // Display the profile page
        if ($user->role == 'user'){
            $params = [
                'user' => $user,
                'service' => $service
            ];
            return view('central.profiles.user', $params);
        } else {
            $params = [
                'user' => $user,
            ];
            return view('central.profiles.admin', $params);
        }
    }

    public function update(Request $request)
    {
        try {
            // get the logged in user
            $user =  auth()->user();
            //Form validation
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required | unique:App\Models\User,email,'.$user->id,
                'phone' => 'numeric | nullable',
                'address_1' => 'required',
                'city' => 'required | string | max:255',
                'postal_code' => 'required',
                'state' => 'required',
                'country' => 'required',
            ]);
            /*
             * Update password
             */
            $check = $request->old_password;

            $updateArray = [];
            if (isset($check)) {
                // If old password is incorrect
                if (!Hash::check($check, $user->password)) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', __('Please check your password'));

                // If old password is correct
                } elseif (Hash::check($check, $user->password)) {
                    $validator = Validator::make($request->all(), [
                        'password' => 'required|min:6',
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
            // Get the user status
            $status_id = $user->status_id;
            /*
             * service class that interact with the User model.
             * refer app/Models/Services/UserService.php
             */
            $userService = new UserService();
            //Update profile using updateUser() function in UserService
            $userService->updateUser($request, $user, $password, $status_id);

            return redirect()->back()
                ->with('success', __('Profile updated'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }
}
