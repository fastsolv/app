<?php

namespace App\Http\Controllers\Tenant;

use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Announcement;
use App\Models\Tenant\RolePermission;
use App\Models\Tenant\Services\AnnouncementService;
use App\Models\Tenant\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
      
       
        $user = User::find(auth()->id());

        $show_add_button = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',44)->value('is_allowed'):1;
        $show_edit_button = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',45)->value('is_allowed'):1;
        $show_delete_button = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',46)->value('is_allowed'):1;
 
        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $announcements = Announcement::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $announcements = Announcement::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {

            $announcements = Announcement::paginate(10);
            $sort_order = 'decs';
        }
       
        $params = [
            'announcements' => $announcements,
            'request' => $request,
            'sort_order' =>  $sort_order,
            'show_add_button' => $show_add_button,
            'show_edit_button' => $show_edit_button,
            'show_delete_button' => $show_delete_button
        ];
        return view('tenant.announcement.index', $params);
    }

    public function create()
    {
        $this->authorize('create', Announcement::class);
        return view('tenant.announcement.create');
    }


    public function store(Request $request)
    {      $this->authorize('create', Announcement::class);
        try {
            $announcement = Announcement::all();
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'announcement' => 'required',
                'is_published' => 'required',
            ]);
           
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            $announdement_Service = new AnnouncementService();
            $announdement_Service->addAnnouncement( $request);

            return redirect()->route('get_announcement')
                ->with('success', __('Announcement added'));
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
        $this->authorize('update', Announcement::class);
        $announcement = Announcement::find($uuid);
        return view('tenant.announcement.edit', $announcement);
    }

    
    public function update(Request $request, $uuid)
    {
        $this->authorize('update', Announcement::class);
        // try {
            $announcement = Announcement::find($uuid);
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'announcement' => 'required',
                'is_published' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            $updateArray = [];

            $updateArray['title'] = $request->title;
            $updateArray['announcement'] = $request->announcement;
            $updateArray['is_published'] = $request->is_published;
            $updateArray['language_code'] = $request->language_code;
            $announcement->update($updateArray);
            return redirect()->route('get_announcement')
                ->with('success', __('Announcement updated'));

        // } catch (\Exception $e) {
        //     Logger::error($e->getMessage());
        //     return redirect()
        //         ->back()
        //         ->withInput()
        //         ->with('error', __('Something went wrong'));
        // }
    }

   
    public function destroy(Request $request, $uuid)
    {
        $this->authorize('delete', Announcement::class);
        $announcement = Announcement::find($uuid);
        $announcement->delete();
        return redirect()->route('get_announcement')
            ->with('success', __('Announcement deleted'));
    } 
    public function userAnnouncement()
    {
       
        $announcements  = Announcement::where('is_published',true)->get();
        $params = [
            'announcements' => $announcements,
            
        ];
      
        return view('tenant.announcement.user.index', $params);
    } 
}


