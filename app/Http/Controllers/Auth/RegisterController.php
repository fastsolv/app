<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Central\Service;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (tenant('id') == null) {
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'phone' => ['nullable', 'numeric'],
                'address_1' => ['required'],
                'city' => ['required', 'string', 'max:255'],
                'postal_code' => ['required'],
                'state' => ['required'],
                'country' => ['required'],
            ]);
        } else {
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if (tenant('id') !== null) {
            return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        } else {
            return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'],
                'address_1' => $data['address_1'],
                'address_2' => $data['address_2'],
                'city' => $data['city'],
                'postal_code' => $data['postal_code'],
                'state_id' => $data['state'],
                'country_id' => $data['country'],
                // 'currency' => $data['currency'],
            ]);
        }
    }

    public function showRegistrationForm(Request $request)
    {
        $priceId = $request->input('plan');
        // Store the price ID in the session
        session()->put('plan', $priceId);

        if (tenant('id') !== null) {
            $service = Service::where('tenant_id', tenant('tenant_id'))->first();
            $userCount = User::where('role', 'user')->count();
            if ($service->plans->user_qty <= $userCount) {
                return redirect()->back()
                ->with('error', __('User limit exceeded, Please upgrade your plan.'));
            } else {
                return view('tenant.auth.register');
            }
        } else {
            return view('central.auth.register');
        }
    }
}
