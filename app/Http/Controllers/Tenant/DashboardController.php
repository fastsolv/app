<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Department;
use App\Models\Tenant\Product;
use Illuminate\Http\Request;
use App\Models\Tenant\Services\TicketService;
use App\Models\Tenant\Services\ImapTicketService;
use App\Models\Tenant\Services\DashboardService;
use App\Models\Tenant\Ticket;
use App\Models\Tenant\User;

class DashboardController extends Controller
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
        $user = auth()->user();
        if ($user->role != 'user'){
            // Get all departments of the logged in user
            $dep = $user->departments()->pluck('department_id')->toArray();

            /*
            Create an object of TicketService,
            TicketService has functions that interact with the
            Ticket model
            */
            $ticketService = new TicketService();
            $emailTicketService = new ImapTicketService();

            /*
            Create an object of DashboardService,
            */
            $dashboardService = new DashboardService();

            /**
             * Call ticketCount() function from TicketService to get the count of tickets
             */
            $ticketCount = $ticketService->ticketCount($user, $dep);
            $emailTicketCount = $emailTicketService->ticketCount($user, $dep);

            /**
             * Call dashboard() function from DashboardService to get the dashboard data
             */
            $dashboard = $dashboardService->dashboard($user, $dep);
            $graphData = $dashboardService->graphData($user, $dep);
            $total_staffs=User::where('user_type','internal')->count();
            $total_departments =Department::count();
            $total_products =Product::count();
            $feedback_rating=Ticket::pluck('rating');
            $sum=0;
            $count=0;
           
            foreach(  $feedback_rating as $rating){
                if( $rating != null){
                $sum=$sum+$rating;
                $count=$count+1;
            }
            }
            
            $ticket_rating= $count>0 ? $sum/$count:0;
       

            $params = [
                'ticketCount' => $ticketCount,
                'dashboard' => $dashboard,
                'ticket_rating' => $ticket_rating,
                'total_staffs' => $total_staffs,
                'total_departments' => $total_departments,
                'total_products' => $total_products,
                'emailTicketCount' => $emailTicketCount,

                // line graph params
                'line_labels' => $graphData['date'],
                'line_data' => $graphData['tickets'],

                // doughnut graph
                'doughnut_labels' => $graphData['status'],
                'doughnut_data' => $graphData['ticketsByStatus'],
                'doughnut_bgColors' => $graphData['statusColor']

            ];
            return view('tenant.dashboard.index', $params);
        } else {
            return redirect()->route('get_tickets');
        }
    }
}
