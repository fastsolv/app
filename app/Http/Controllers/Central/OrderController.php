<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Central\Order;
use App\Models\Central\Service;
use App\Models\Tenant;
use Illuminate\Support\Facades\Mail;
use App\Mail\Central\OrderAccept;
use App\Helpers\Logger;

class OrderController extends Controller
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
        //Query all orders in descending order
        $query = Order::query()->orderBy('order_id', 'DESC');
        //Filter orders by by search keywords
        if ($request->search) {
            $search = $request->search;
            //use hasMany ralation bcz user details only available in user table
            $query = $query->whereHas('user', function ($items) use ($search){
                $items->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%');
            })->orWhere('order_id', 'like', '%' . $search . '%');
        }
        $orders = $query->paginate(10);

        $params = [
            'orders' => $orders,
            'request' => $request,
        ];
        return view('central.orders.index', $params);
    }

    /*
     * Order accept function.
     * Changes the status of the order.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin', Authorize::class);
        $order = Order::find($id);
        $service = Service::where('order_id', $id)->latest()->first();
        
        if ($service) {
            $tenant = Tenant::where('tenant_id', $service->tenant_id)->first();
            $updateArray = [];
            $updateArray['status'] = true;
            $tenant->update($updateArray);
        }
        
        $order->status = 'active';
        $order->save();

        /*
         * Send order accepted mail to user's Email address
         * refer app/Mail/OrderAccept.php
         */
        if (!empty($order->user_id) && !empty($order->user->email)) {
            Logger::info('Order accept mail to ' . $order->user->email);
            $data = [];
            $mail = new OrderAccept($order);
            Mail::to($order->user->email)
                ->queue($mail);
        }

        return redirect()->back()
            ->with('success', __('Order accepted'));
    }
}