<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Central\Gateway;
use App\Models\Central\Address;
use App\Models\Central\GatewayDetails;
use Illuminate\Support\Facades\Validator;

class GatewayDetailsController extends Controller
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
        //Take all available gateways
        $gateways = Gateway::all();
        return view('central.gateway.index', compact('gateways'));
    }

    public function edit($id)
    {
        $this->authorize('isAdmin', Authorize::class);
        $billingAddress = Address::first();
        /*
         * Check wheather there is a valid billing address
         * if not, redirect to add billing address page
         */
        if(!$billingAddress){
            return redirect()->route('billing_address.create')
                ->with('error', __("Add a billing address first"));
        }

        // get the gateway
        $gateway = Gateway::find($id);
        // get the gateway details table
        $gatewayDetails = GatewayDetails::where('gateway_id', $gateway->id)->get();
        $params = [
            'gatewayDetails' => $gatewayDetails,
        ];
        // View the gateway edit page
        return view('central.gateway.edit', $gateway, $params);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin', Authorize::class);
        try {
            //Form validation
            $validator = Validator::make($request->all(), [
                   'details.*' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            
            //get the gateway
            $gateway = Gateway::find($id);
            /*
             * Update the details of the above gateway in
             * gateway details table
             */
            foreach($request->details as $key => $value) {
                $gatewayDetails = GatewayDetails::find($key);
                $gatewayDetails->value = $value;
                $gatewayDetails->save();
            }
     
            //update the gateway
            if ($request->status == "enable") {
                $gateway->status = true;
            } else {
                $gateway->status = false;
            }
            if ($request->test_mode == "enable") {
                $gateway->test_mode = true;
            } else {
                $gateway->test_mode = false;
            }
            $gateway->update();
            return redirect()->route('gateways.index')
                ->with('success', __("Gateway details updated"));
                
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }
}
