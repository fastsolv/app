<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Tenant\CannedResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use App\Helpers\Logger;
use App\Helpers\Uuid;
use DB;
use App\Http\Resources\CannedResponseResource;
use App\Models\Tenant\RolePermission;
use App\Models\Tenant\User;

class CannedResponseController extends Controller
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
        $this->authorize( 'view', CannedResponse::class );
        $user = User::find(auth()->id());
        $show_add_button =$user->user_type !=='admin'? RolePermission::where('role_id', $user->role_id)->where('permission_id',17)->value('is_allowed'):1;
        $show_edit_button =$user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',18)->value('is_allowed'):1;
        $show_delete_button =$user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',20)->value('is_allowed'):1;

        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $cannedresponses = CannedResponse::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $cannedresponses = CannedResponse::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {

            $cannedresponses = CannedResponse::all();
            $sort_order = 'decs';
        }
        
        return view('tenant.canned_responses.index', compact('cannedresponses','show_add_button','show_edit_button','show_delete_button','sort_order'));
    }

    public function create()
    {
        $this->authorize( 'create', CannedResponse::class );
        return view('tenant.canned_responses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize( 'create', CannedResponse::class );
        try {
            $validator = Validator::make($request->all(), [
                   'name' => 'required',
                   'body' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $cannedresponses = new CannedResponse();
            $cannedresponses->uuid = Uuid::getUuid();
            $cannedresponses->name= $request->name;
            $cannedresponses->body = $request->body;
            $cannedresponses->save();
            return redirect()->route('get_canned_response')
                ->with('success', __('Canned response added'));
         } catch (\Exception $e) {
              Logger::error($e->getMessage());
             return redirect()
              ->back()
             ->withInput()
             ->with('error', __('Something went wrong'));
          }
    }


    public function edit(Request $request, $uuid)
    {
        $this->authorize( 'update', CannedResponse::class );
        $cannedresponse = CannedResponse::find($uuid);
        return view('tenant.canned_responses.edit', $cannedresponse);
    }


    public function update(Request $request, $uuid)
    {
        $this->authorize( 'update', CannedResponse::class );

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'body' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $cannedresponse = CannedResponse::find($uuid);
            $cannedresponse ->update($request->all());
            return redirect()->route('get_canned_response')
                ->with('success', __('Canned response updated'));

        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->authorize( 'delete', CannedResponse::class );
        $cannedresponses = CannedResponse::find($uuid);
        $cannedresponses->delete();
        return redirect()->route('get_canned_response')
            ->with('success', __('Canned response deleted'));
    }


    public function getCannedResponsesApi(Request $request){
        $canned_responses = DB::table('canned_responses')->get()->toJson(JSON_PRETTY_PRINT);
        
        return response($canned_responses, 200);
        //TODO: how to use CannedResponseResource without any error ?
        // return  CannedResponseResource::collection(CannedResponse::all());
    }

}
