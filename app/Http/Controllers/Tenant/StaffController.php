<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Logger;
use App\Models\User;
use App\Models\Central\Service;
use App\Models\Tenant\Department;
use App\Models\UserDepartment;
use App\Models\Tenant\TicketStatus;
use App\Models\Tenant\TicketStatusLife;
use App\Models\Tenant\ImapTicketStatusLife;
use App\Models\Tenant\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Tenant\Services\UserService;

class StaffController extends Controller
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
        /*
        Check weather the user has access to this function
        */
        $this->authorize('viewStaff', User::class);

        // Display staff list
        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $users = User::where('role', 'staff')->orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $users = User::where('role', 'staff')->orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {

            $users = User::where('role', 'staff')
        ->paginate(10);
            $sort_order = 'decs';
        }
      
        $params = [
            'users' => $users,
            'request' => $request,
            'sort_order' => $sort_order
        ];
        return view('tenant.staff.index', $params);
    }

    public function create(Request $request)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('viewStaff', User::class);

        // Get all the departments
        $department = Department::all();
        $roles =Role::all();
        // Display staff create page
        $param = [
            'department' => $department,
            'roles' => $roles ,       ];
        return view('tenant.staff.create', $param);
    }

    public function store(Request $request)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('viewStaff', User::class);

        try {

            $department = Department::all();
            $validator = Validator::make($request->all(), [
                   'name' => 'required',
                   'email' => 'required | unique:App\Models\Tenant\User,email',
                   'password' => 'required|min:8',
                   'c_password'=> 'required|same:password'                     
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            } 

            // get the logged in user
            $user = User::find(auth()->id());

            /*
            Make an object for user,
            Add a staff
            */
            $staff = new User();
            $staff->first_name = $request->name;
            $staff->email = $request->email;
            $staff->password = Hash::make($request->password);
            $staff->role = 'staff';
            $staff->user_type = 'internal';
            // $staff->phone_number = $request->phone_number;
            $staff->role_id =$request->role_id;
          
            $staff->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
            $staff->save();

            // Get the staff 
            $user = User::find($staff->id);
            // Assign a department to created staff
            $user->departments()->sync($request->department);

            return redirect()->route('get_staffs')
                ->with('success', __('Staff created'));

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    public function show($id) 
    {
        $statuses = TicketStatus::all();
        $statusLife = TicketStatusLife::selectRaw('avg(life_time) as total, previous_status_id')
            ->where('assigned_to', $id)
            ->groupBy('previous_status_id')
            ->pluck('total', 'previous_status_id')->all();
        $imapStatusLife = ImapTicketStatusLife::selectRaw('avg(life_time) as total, previous_status_id')
            ->where('assigned_to', $id)
            ->groupBy('previous_status_id')
            ->pluck('total', 'previous_status_id')->all();
        $lifeTime = [];
        $keys = array_keys($statusLife+$imapStatusLife);
        foreach($keys as $v){
          $lifeTime[$v] = (empty($statusLife[$v]) ? 0 : $statusLife[$v]) + (empty($imapStatusLife[$v]) ? 0 : $imapStatusLife[$v]);
        }

        $avg_response_time = (empty($lifeTime[1]) ? 0 : $lifeTime[1]) + (empty($lifeTime[6]) ? 0 : $lifeTime[6]);
        if($avg_response_time != 0) {
            $avg_response_time = round(($avg_response_time/ 2) / 60, 2);
        }
        $staff = User::find($id);
        $params = [
            'statuses' => $statuses,
            'statusLife' => $statusLife,
            'staff' => $staff,
            'lifeTime' => $lifeTime,
            'avg_response_time' => $avg_response_time
        ];
        return view('tenant.staff.show', $params);
    }

    public function edit(Request $request, $id)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('viewStaff', User::class);

        // Get the staff
        $user = User::find($id);
        // Get the departments of selected staff
        $selected_department = $user->departments()->pluck('department_id')->toArray();
        // Get all departments
        $departments = Department::all();
        $roles =Role::all();
        // Display staff edit page
        $param = [
            'departments' => $departments,
            'selected_department' => $selected_department,
            'roles' => $roles,
        ];
        return view('tenant.staff.edit', $user, $param);
    }

    public function update(Request $request, $id)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('viewStaff', User::class);

        try {
            // Get the staff
            $user = User::find($id);
            $validator = Validator::make($request->all(), [
                   'name' => 'required',
                   'email' => 'required | unique:App\Models\Tenant\User,email,'.$user->id,                   
            ]);
            
            // Update password

            $updateArray = [];
            $check = $request->old_password;
            if (isset($check))
            {
                // If old password is incorrect
                if (!Hash::check($check, $user->password)){
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', __('Please check your password'));
                // If old password is correct
                } elseif (Hash::check($check, $user->password)) {

                    $validator = Validator::make($request->all(), [
                        'password' => 'required|min:8',
                        'c_password'=> 'required|same:password'                   
                ]);
                $updateArray['password'] = Hash::make($request->password);  
                    
                }
            }

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            // Update staff
            $updateArray['first_name'] = $request->name;
            $updateArray['email'] = $request->email;    
            // $updateArray['display_role'] = $request->role;
            $updateArray['role_id'] = $request->role_id;         
            $user->update($updateArray);
            $user->departments()->sync($request->department);
            return redirect()->route('get_staffs')
                ->with('success', __('Staff updated'));
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    public function destroy($id)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('viewStaff', User::class);

        // Delete staff
        $user = User::find($id);
        $user->delete();
        return redirect()->route('get_staffs')
            ->with('success', __('Staff deleted'));
    }
}



