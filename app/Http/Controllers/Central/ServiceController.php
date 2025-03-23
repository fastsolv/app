<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Central\Service;
use App\Models\Central\Status;
use App\Models\Tenant;
use Carbon\Carbon;

class ServiceController extends Controller
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
        $this->authorize('isAdmin', Authorize::class);
        //Query all subscriptions in descending order.
        $query = Service::query()->orderBy('updated_at', 'DESC');
        //Filter services by by search keywords
        if ($request->search) {
            $search = $request->search;
            //use hasMany ralation bcz user details only available in user table
            $query = $query->whereHas('user', function ($items) use ($search){
                $items->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%');
            })->orWhereHas('orders', function ($items) use ($search){
                $items->where('order_id', 'like', '%' . $search . '%');
            })->orWhere('service_id', 'like', '%' . $search . '%');
        }
        $services = $query->paginate(10);

        $params = [
            'services' => $services,
            'request' => $request,
        ];

        return view('central.order-service.index', $params);
    }

    /*
     * View the service status update page
    */
    public function edit($uuid)
    {
        $this->authorize('isAdmin', Authorize::class);
        //Get the service
        $service = Service::find($uuid);
        //Get all statuses
        $statuses = Status::all();
        return view('central.order-service.edit', $service, compact('statuses'));
    }


    /*
     * Update the status of the service
    */
    public function update(Request $request, $uuid)
    {
        $this->authorize('isAdmin', Authorize::class);
        //Get the service
        $service = Service::find($uuid);
        $tenant = Tenant::where('tenant_id', $service->tenant_id)->first();
        //TODO:find a better way to find status id
        $status_id = Status::where('name', $request->status)->pluck('id');
        $service->status_id = $status_id[0];
        if($status_id[0] == 1) {
            $tenant->status = true;
        } else {
            $tenant->status = false;
        }
        $tenant->save();
        $currentDay = Carbon::now()->format('Y-m-d');
        if (Carbon::parse($request->grace_period)->format('Y-m-d') > $currentDay) {
           $service->grace_period = $request->grace_period; 
        }
        $service->update();

        return redirect()->route('services.index')
            ->with('success', __('Service updated'));
    }
}
