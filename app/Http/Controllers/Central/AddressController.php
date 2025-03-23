<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Central\Address;
use App\Helpers\Logger;

class AddressController extends Controller
{

    public function __construct()
    {
        /*
        make sure only logged in and verified user has access
        to this controller
         */
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $this->authorize('isAdmin', Authorize::class);
        /*
         * Get the billing address
         * There will be only one billing address whose id is 1
         */
        $address = Address::find(1);
        $params = [
            'address' => $address,
        ];
        return view('central.address.index', $params);
    }

    public function create()
    {
        $this->authorize('isAdmin', Authorize::class);
        // Display the address update form
        $address = Address::find(1);
        $params = [
            'address' => $address,
        ];
        return view('central.address.create', $params);
    }

    public function store(Request $request)
    {
        $this->authorize('isAdmin', Authorize::class);
        
        try {
            // Form validation
            $validator = Validator::make($request->all(), [
                'phone' => 'numeric | nullable',
                'name' => 'required | string | max:255',
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
            
            $updateAddress = Address::find(1);
            //Update the biling address if an address exist
            if ($updateAddress) {
                $address = $updateAddress;
            } else {
                // create a new address
                $address = new Address();
            }
            $address->id = 1;
            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->address_1 = $request->address_1;
            $address->address_2 = $request->address_2;
            $address->city = $request->city;
            $address->postal_code = $request->postal_code;
            $address->state_id = $request->state;
            $address->country_id = $request->country;
            $address->save();

            return redirect()->route('billing_address.index')
                ->with('success', __('Address added'));
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __($e->getMessage()));
        }
        
    }
}
