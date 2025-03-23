<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;

use App\Models\User;
use App\Models\Central\Order;
use App\Models\Central\Invoice;
use App\Models\Central\Service;
use App\Models\Central\Currency ;

use App\Models\Tenant\Ticket;
use App\Models\Tenant\ImapTicket;
use App\Models\Tenant\Department;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\Central\Services\DomainRegisterService;

class DashboardController extends Controller
{
    public function __construct(Request $request)
    {
        /*
        make sure only logged in and verified user has access
        to this controller
         */
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        /*
         * Take the count of all Servers,wepages and APIs
         */
        $user = User::find(auth()->id());

        if ($user->role == 'admin'){
            $users = User::count();

            $orders = Order::latest()->take(5)->get();
            //Count of total orders
            $orders_count = Order::count();
            //Count of total trial orders
            $trialOrders = Order::where('amount', 0.00)->count();
            //Count of total paid orders
            $paidOrders = Order::where('amount', '!=', 0.00)->count();

            //Take the total income of all time
            $currencies = Currency::all();
            if (count($currencies)) {
                foreach ($currencies as $currency) {
                    $totalIncome[$currency->id] = Invoice::where('test_mode', false)
                        ->where('currency', $currency->currency)
                        ->sum('amount');
                    //Take the today's income
                    $todayIncome[$currency->id] = Invoice::where('test_mode', false)
                        ->where('currency', $currency->currency)
                        ->where('payment_status', 'paid')
                        ->whereDate('created_at', Carbon::today())
                        ->sum('amount');
                    //Take last month's total income
                    $thisMonthIncome[$currency->id] = Invoice::where('test_mode', false)
                        ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                        ->where('currency', $currency->currency)
                        ->sum('amount');
                    //Take last year's total income
                    $thisYearIncome[$currency->id] = Invoice::where('test_mode', false)
                        ->where('currency', $currency->currency)
                        ->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                        ->sum('amount');
                }
            } else {
                $totalIncome = null;
                $thisMonthIncome = null;
                $todayIncome = null;
                $thisYearIncome = null;
            }

            $tenants = Tenant::count();

            $params = [
                'users' => $users,
                'orders_count' => $orders_count,
                'orders' => $orders,
                'trialOrders' => $trialOrders,
                'paidOrders' => $paidOrders,
                'totalIncome' => $totalIncome,
                'todayIncome' => $todayIncome,
                // 'thisWeekIncome' => $thisWeekIncome,
                'thisMonthIncome' => $thisMonthIncome,
                'thisYearIncome' => $thisYearIncome,
                'currencies' => $currencies,
                'tenants' => $tenants

            ];

            return view('central.dashboard.admin', $params);
        } else {
            $service = Service::where('user_id', $user->id)->first();
            if ($service) {
                $tenant = Tenant::where('tenant_id', $service->tenant_id)->first();
                $result = $tenant->run(function () use ($service){
                    $result['imap_ticket_count'] = ImapTicket::count();
                    $result['web_ticket_count'] = Ticket::count();
                    $result['ticket_count'] = $result['imap_ticket_count'] + $result['web_ticket_count'];
                    $result['users_count'] = User::where('role', 'user')->count();
                    $result['staff_count'] = User::where('role', 'staff')->count();
                    $result['department_count'] = Department::count();
                    return $result;
                });
                $tenant = Tenant::where('tenant_id', $service->tenant_id )->first();
                $domainRegisterService = new DomainRegisterService();
                $protocol = $domainRegisterService->getProtocol();
                if(empty($protocol)){
                    $protocol = 'http://';
                    $domainRegisterService->setProtocol($protocol) ;
                }     
                $params = [
                    'service' => $service,
                    'result' => $result,
                    'tenant' => $tenant,
                    'central' => $domainRegisterService->getCentralDomain(),
                    'protocol' => $protocol
                ];
                return view('central.dashboard.user', $params);
            } else {
                $domainRegisterService = new DomainRegisterService();
                $central = $domainRegisterService->getCentralDomain();
                if(empty($central)) {
                    $central = $request->getHttpHost();
                    $domainRegisterService->setCentralDomain($central);
                }
                $params = [
                    'central' => $central,
                ];
               return view('central.domain.register', $params);
            }

        }

    }
}
