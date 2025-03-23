<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\EmailTemplate;
use App\Models\User;
use App\Models\Tenant\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Logger;
use App\Helpers\Uuid;
use App\Models\Tenant\EmailTemplateTranslation;
use App\Models\Tenant\RolePermission;
use App\Models\Tenant\Services\EmailTemplateService;
class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $this->authorize( 'view', EmailTemplate::class );

        $user = User::find(auth()->id());
        $show_add_button =$user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',21)->value('is_allowed'):1;
        $show_edit_button =$user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',22)->value('is_allowed'):1;
        $show_delete_button =$user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',24)->value('is_allowed'):1;

        $languages = Language::all();
        $system_emails = EmailTemplate::where('system_template', true)->get();
        $custom_emails = EmailTemplate::where('system_template', false)->get();
        // Display the emailtemplate
        $params = [
            'languages' => $languages,
            'system_emails' => $system_emails,
            'custom_emails' => $custom_emails,
            'show_add_button' => $show_add_button,
            'show_edit_button' => $show_edit_button,
            'show_delete_button' => $show_delete_button,
        ];
        return view('tenant.email_template.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
     {
        $this->authorize( 'create', EmailTemplate::class );
        $languages = Language::all();

        $email = EmailTemplate::all();
        return view('tenant.email_template.create',compact('email','languages')
        );
     }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize( 'create', EmailTemplate::class );
        try {
            $email  = EmailTemplate::all();
            $validator = Validator::make($request->all(), [
                   'name' => 'required',
                   'custom.*.subject' => 'required ',
                   'custom.*.message' => 'required',
                   'status'=> 'required'  ,
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $emailTemplateService = new EmailTemplateService();
            $emailTemplateService->addEmailTemplate($request);

            return redirect()->route('email_template.index')
                ->with('success', __('Email template added'));

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $uuid)
    {
        $this->authorize( 'update', EmailTemplate::class );
        $email = EmailTemplate::find($uuid);
        $email_trans = EmailTemplateTranslation::where('email_template_id',$email->uuid)
        ->orderBy('language_id')
        ->with('language')
        ->get();
        $params = [
            'email'=>$email,
            'email_trans'=>$email_trans
        ];
        return view('tenant.email_template.edit',$params);
    }


    /**
     * Update the specified resource in storage.
    */
    public function update(Request $request, $uuid)
    {
        $this->authorize( 'update', EmailTemplate::class );
        try {

            $validator = Validator::make($request->all(), [
                'custom.*.subject' => 'required ',
                'custom.*.message' => 'required',
                'status'=> 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            // Get the emailTemplate
            $email = EmailTemplate::find($uuid);
            $language = Language::all();

            foreach($request->custom as $languageId=>$data){
                $email_trans = EmailTemplateTranslation::where('email_template_id',$email->uuid)
                ->where('language_id',$languageId)
                ->first();
                $email_trans->subject = $data['subject'];
                $email_trans->message = $data['message'];
                $email_trans->update();

            }

            // Update emailTemplate
            $email->update($request->all());
            return redirect()->route('email_template.index')
                ->with('success', __('Email Template Updated'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $uuid)
    {
        $this->authorize( 'delete', EmailTemplate::class );
        // Delete emailtemplate
        $email = EmailTemplate::find($uuid);
        $email->delete();

        return redirect()->route('email_template.index')
            ->with('success', __('Email template deleted'));
    }

}
