<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Tenant\Department;
use App\Models\User;
use App\Models\Tenant\Setting;
use Illuminate\Support\Facades\Validator;
use App\Services\Imap;
use App\Helpers\Logger;
use App\Models\Tenant\Services\UserService;
use App\Jobs\ImapConnection;
use App\Jobs\SmtpConnection;
use Illuminate\Support\Facades\App;
use App\Models\Central\Service;
use App\Models\Tenant;
use App\Models\Tenant\RolePermission;

class DepartmentController extends Controller
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
        $environment = App::environment();
      
        $this->authorize('viewAny', Department::class);
        $user = User::find(auth()->id());
        $show_add_button = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',1)->value('is_allowed'):1;
        $show_edit_button = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',2)->value('is_allowed'):1;
        $show_delete_button = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',4)->value('is_allowed'):1;
 
       
        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $departments = Department::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $departments = Department::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {
            $departments = Department::all();
            $sort_order = 'decs';
        }
   
  
        return view(
            'tenant.department.index',
            compact('departments','show_add_button','show_edit_button','show_delete_button','sort_order')
        );
    }

    public function create(Request $request)
    {
        /*
        Check weather the user has access to this controller
         */
        $this->authorize('create', Department::class);
        // $this->authorize('before', Department::class);
      
        // Display the create form
        return view('tenant.department.create');
    }

    public function store(Request $request)
    {
        /*
        Check weather the user has access to this controller
         */
        // $this->authorize('before', Department::class);
        $this->authorize('create', Department::class);

        try {
            // $imap is a flag.
            $imap = false;
            // Check weather imap is enabled or not
            $setting = Setting::where('name', 'imap')
                ->first();
            if ($setting->value == '1') {
                // if imap is enabled.
                $validator = Validator::make($request->all(), [
                    'name' => 'required | unique:App\Models\Tenant\Department,name',
                    'email' => 'required | unique:App\Models\Tenant\Department,email',
                    'host' => 'required',
                    'port' => 'required',
                    'password' => 'required',
                    'smtp_host' => 'required',
                    'smtp_port' => 'required',
                    'smtp_password' => 'required',
                ]);

                $flags = "";
                if (!empty($request->input('flags'))) {
                    $flags = $request->input('flags');
                }

                $mail_box = "";
                if (!empty($request->input('mail_box'))) {
                    $mail_box = $request->input('mail_box');
                }

                $pass = $request->input('password');
                $host = $request->input('host');
                $port = $request->input('port');
                $imap = true;
            } else {
                //if imap is not enabled.
                $validator = Validator::make($request->all(), [
                    'name' => 'required | unique:App\Models\Tenant\Department,name',
                    'email' => 'required | unique:App\Models\Tenant\Department,email',
             ]);
            }

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            //create a new department
            $department = Department::create(
                $request->all()
            );

            /*
            if imap is enabled, run two jobs
            ImapConnection check weather the
            imap server details are valid or not.

            SmtpConnection job check weather the
            smtp server details are valid or not.
            */
            if ($imap) {
                ImapConnection::dispatch($department->id);
                SmtpConnection::dispatch($department->id);
            }
            if ($setting->value == '1'){
                return redirect()->route('get_departments')
                ->with('error', __('We are validating your IMAP and SMTP details. Please check this page after 2 minutes. If status is still inactive please check the error logs.'));
            }else{
                return redirect()->route('get_departments')
                ->with('success', __('Department added'));
            }
            
        } catch (\Exception $e) {
            //TODO: add the error to the error log ?
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    /*
    Department edit
     */
    public function edit(Request $request, $id)
    {
        //check permission
        $this->authorize('update', Department::class);
        // $this->authorize('before', Department::class);
        // get the department
        $department = Department::find($id);
        // display the edit form.
        return view('tenant.department.edit', $department);
    }

    /*
    Update the department
     */
    public function update(Request $request, $id)
    {
        // check the user permission
        // $this->authorize('before', Department::class);
        $this->authorize('update', Department::class);

        // imap flag
        $imap = false;
        try {
            /*
            Check weather imap is enabled or not
             */
            $setting = Setting::where('name', 'imap')->first();
            if ($setting->value == '1') {
                //if imap is enabled.
                $imap = true;
                $department = Department::find($id);
                // validate the form
                $validator = Validator::make($request->all(), [
                    'name' => 'required | unique:App\Models\Tenant\Department,name,'.$department->id,
                    'email' => 'required | unique:App\Models\Tenant\Department,email,'.$department->id,
                    'host' => 'required',
                    'port' => 'required',
                    'password' => 'required',
                    'smtp_host' => 'required',
                    'smtp_port' => 'required',
                    'smtp_password' => 'required',
                ]);
            } else {
                //if imap is not enabled.
                $validator = Validator::make($request->all(), [
                    'name' => 'required | unique:App\Models\Tenant\Department,name',
                    'email' => 'required | unique:App\Models\Tenant\Department,email',
                ]);
            }

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            /*
            Update the department.
             */
            $department = Department::find($id);
            $department->update($request->all());

            if ($imap) {
                /*
                If imap is enabled, run two jobs.
                 */
                ImapConnection::dispatch($department);
                SmtpConnection::dispatch($department);
            }

            if ($setting->value == '1'){
                return redirect()->route('get_departments')
                ->with('error', __('We are validating your IMAP and SMTP details. Please check this page after 2 minutes. If status is still inactive please check the error logs.'));
            }else{
                return redirect()->route('get_departments')
                ->with('success', __('Department updated'));
            }
        } catch (\Exception $e) {
            Logger::error("IMAP error");
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    /*
    Delete a department
     */
    public function destroy(Request $request, $id)
    {
        // check the user permission
        // $this->authorize('before', Department::class);
        $this->authorize('delete', Department::class);

        /*
        Delete the department
         */
        $department = Department::find($id);
        $department->delete();
        return redirect()->route('get_departments')
            ->with('success', __('Department deleted'));
    }
}
