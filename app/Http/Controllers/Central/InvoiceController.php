<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;
use DB;

use Illuminate\Http\Request;
use App\Models\Central\Invoice;
use App\Models\Central\InvoiceDetails;
use App\Models\Central\Service;
use App\Models\Central\Services\PlanService;
use App\Models\Central\Pricing;
use App\Models\User;
use App\Models\Central\Plan;

class InvoiceController extends Controller
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
        //Query all invoices in descending order
        $query = Invoice::query()->orderBy('updated_at', 'DESC');
        //Filter invoices by by search keywords
        if ($request->search) {
            $search = $request->search;
            /**
             * use hasMany ralation bcz user details and order details are only available in 
             * user and order table
            */
            $query = $query->whereHas('user', function ($items) use ($search){
                $items->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%');
            })->orWhereHas('orders', function ($items) use ($search){
                $items->where('order_id', 'like', '%' . $search . '%');
            });
        }
        $invoices = $query->paginate(10);

        $params = [
            'invoices' => $invoices,
            'request' => $request,
        ];
        return view('central.invoices.index', $params);
    }

    /*
     * Shows the invoce details page
     */
    public function show($uuid)
    {
        $this->authorize('isAdmin', Authorize::class);
        //Get the invoice
        $invoice = Invoice::find($uuid);
        //Get the invoice details
        $invoiceDetails = InvoiceDetails::where('invoice_id', $invoice->uuid)->latest()->first();
        //Get the pricing ID
        $pricing_id = $invoiceDetails->services->pricing_id;
        //Get the pricing details
        $pricing = Pricing::find($pricing_id);
        //Get the plan details
        $plan = Plan::where('uuid', $pricing->plan_id)->first();
        //Get the plan validity from plan property pivot table
        $planService = new PlanService ();
        $validity = $planService->displayValidity($pricing);
        //get the user
        $user = User::where('id', $invoice->user_id)->first();
        $params = [
            'invoice' => $invoice,
            'user' => $user,
            'plan' => $plan,
            'pricing' => $pricing,
            'validity' => $validity,
        ];
        return view('central.invoices.show', $params);
    }
}
