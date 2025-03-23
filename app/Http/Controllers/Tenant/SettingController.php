<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tenant\Setting;
use App\Models\Tenant\Services\UserService;
use App\Helpers\AttachmentHelper;



use App\Helpers\Logger;

class SettingController extends Controller
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
        $this->authorize('before', Setting::class);

        // Display the settings page
        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $settings = Setting::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $settings = Setting::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {

            $settings = Setting::all();
            $sort_order = 'decs';
        }
       
        return view('tenant.settings.index', compact('settings','sort_order'));
    }

    public function edit(Request $request, $id)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('before', Setting::class);

        $setting = Setting::find($id);
        // Display imap enable page
        if ($setting->type == 'radio') {
            return view('tenant.settings.radio', $setting);
        // Display add extension page
        } elseif ($setting->type == 'text') {
            return view('tenant.settings.text', $setting);
        }
        elseif ($setting->type == 'attachment') {
            return view('tenant.settings.attachment', $setting);
        }
        elseif ($setting->type == 'text_area') {
            return view('tenant.settings.textarea', $setting);
        }
        elseif ($setting->type == 'language') {
            return view('tenant.settings.language', compact('setting'));
        }
    }

    public function update(Request $request, $id)
    {
   
        /*
        Check weather the user has access to this function
        */
        $this->authorize('before', Setting::class);

        // Get the settings
        $setting = Setting::find($id);

        // Enable Imap
        if ($setting->type == 'radio') {
            $updateArray = [];
            if ($request->Enable == "enable") {
                $updateArray['value'] = 1;
            } else {
                $updateArray['value'] = 0;
            }
            $setting->update($updateArray);
        // Add extensions
        } elseif ($setting->type == 'text') {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'text' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
            }
            
            // update settings
            $updateArray = [];
            $updateArray['value'] = $request->text;
            $setting->update($updateArray);
        } elseif ($setting->type == 'text_area') {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'textarea' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
            }
            
            // update settings
            $updateArray = [];
            $updateArray['value'] = $request->textarea;
            $setting->update($updateArray);

        } elseif ($setting->type == 'attachment') {
           $validator = Validator::make($request->all(), [
              'name' => 'required',
           ]);
           if ($validator->fails()) {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
            }
           $updateArray = [];
           if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $validator = Validator::make($request->all(), [
                    'attachment' => "required|mimes:png,svg,"
                ]);

               if ($validator->fails()) {
                    return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', __('Invalid file format'));
                }
             
               // Set attachment name store to database
                $attachmentHelper = new AttachmentHelper();
                $fileName = $attachmentHelper->privateIconStore($file, 'system_logo');
                $updateArray['value']  = $fileName;     
            }
            // Update settings 
            // $updateArray['value'] = $request->attachment;          
            $setting->update($updateArray);
             
        }
        elseif($setting->type == 'dropdown'){
            $validator = Validator::make($request->all(), [
               
                'value' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
            }
            
            // update settings
            $updateArray = [];
            $updateArray['value'] = $request->value;
            $setting->update($updateArray);
            return redirect()->route('theme.index')
            ->with('success', __('Theme updated'));
        }
        elseif($setting->type == 'language'){
            $validator = Validator::make($request->all(), [         
                'language_id' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
            }
            
            // update settings
            $updateArray = [];
            $updateArray['value'] = $request->language_id;
            $setting->update($updateArray);
         
        }
        return redirect()->route('get_settings')
            ->with('success', __('Settings updated'));
    } 
}
        
  