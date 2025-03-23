<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class MinimalRegisterController extends Controller
{
    public function index(Request $request )
    {
        return view('central.minimal_reg.index',compact('plan_id')
    );

    }
    public function registerMinimal(Request $request ,$id )
    {
        $priceId = $request->route('id');
        session()->put('plan', $priceId);

        $plan_id = $id;
        return view('central.minimal_reg.minimalReg'
            ,compact('plan_id')
        );
    }

    protected function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required_with:password', 'same:password'],
                'g-recaptcha-response' => 'recaptchav3:register,0.5'
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            $data = $request->all();
            $plan_id = $request->input('plan_id');
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'country_id' => '231',
                'state_id' => '3944',
                'currency' => 'USD',
            ]);
	     event(new Registered($user));
	    Auth::loginUsingId($user->id);
	    
            return redirect()->route('invoice', ['id' => $plan_id]);
         } catch (\Exception $e) {
            Logger::error($e->getMessage());
           return redirect()
            ->back()
           ->withInput()
           ->with('error', $e->getMessage());
        }
    }

}
