<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use App\Models\Tenant\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tenant\TicketStatus;
use App\Models\Tenant\Services\UserService;
use App\Models\Tenant\User;

class TicketStatusController extends Controller
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
        
        $this->authorize('view',TicketStatus::class);
        $user = User::find(auth()->id());
        $show_add_button=$user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',5)->value('is_allowed'):1;
        $show_edit_button=$user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',6)->value('is_allowed'):1;
        $show_delete_button=$user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',8)->value('is_allowed'):1;
 
        
        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $statuses = TicketStatus::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $statuses = TicketStatus::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {

            $statuses = TicketStatus::all();
            $sort_order = 'decs';
        }

       
        // Display ticket statuses page
        return view('tenant.ticket_status.index', compact('statuses','show_add_button','show_edit_button','show_delete_button','sort_order'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', TicketStatus::class);
       
        /*
        Check weather the user has access to this function
        */
        // $this->authorize('before', TicketStatus::class);
    
       

        // Display create ticket status page
        return view('tenant.ticket_status.create');
    }

    public function store(Request $request)
    {
        /*
        Check weather the user has access to this function
        */
        // $this->authorize('before', TicketStatus::class);
        $this->authorize('create', TicketStatus::class);

        // Add a ticket status
        try {
            $validator = Validator::make($request->all(), [
                   'title' => 'required | unique:App\Models\TicketStatus,title',
                   'color' => 'required',
                   'text_color' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            $data = $request->only('title', 'color');
            // create object for TicketStatus
            $ticketStatus = new TicketStatus();
            $ticketStatus->title = $request->title;
            $ticketStatus->color = $request->color;
            $ticketStatus->text_color = $request->text_color;
            $ticketStatus->save();

            return redirect()->route('get_ticket_statuses')
                ->with('success', __('Server added'));
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    public function edit(Request $request, $id)
    {
        /*
        Check weather the user has access to this function
        */
        // $this->authorize('before', TicketStatus::class);
        $this->authorize('update', TicketStatus::class);

        // Get the ticket status
        $status = TicketStatus::find($id);
        // display update ticket status page
        return view('tenant.ticket_status.edit', $status);
    }

    public function update(Request $request, $id)
    {
        /*
        Check weather the user has access to this function
        */
        // $this->authorize('before', TicketStatus::class);
        $this->authorize('update', TicketStatus::class);

        try {
            $status = TicketStatus::find($id);
            $validator = Validator::make($request->all(), [
                   'title' => 'required | unique:App\Models\TicketStatus,title,'.$status->id,
                   'color' => 'required',
                   'text_color' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            // Update ticket status
            $status->update($request->all());
            return redirect()->route('get_ticket_statuses')
                ->with('success', __('Ticket status updated'));

        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    public function destroy( $id)
    {
        /*
        Check weather the user has access to this function
        */
        // $this->authorize('before', TicketStatus::class);
        $this->authorize('delete', TicketStatus::class);

        // Delete ticket status
        $status = TicketStatus::find($id);
        $status->delete();
        return redirect()->route('get_ticket_statuses')
            ->with('success', __('Ticket status deleted'));
    }
}
