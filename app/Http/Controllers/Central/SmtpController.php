<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Central\Service;
use App\Models\Tenant;
use App\Helpers\Logger;
use Illuminate\Support\Facades\Validator;

class SmtpController extends Controller
{
    public function __construct()
    {
        /*
         make sure only logged in and verified user has access
         to this controller
         */
        $this->middleware(['auth', 'verified']);
    }

    public function create()
    {
        $this->authorize('isNotAdmin', Authorize::class);
        $user = auth()->user();
        $service = Service::where('user_id', $user->id)->first();
        if($service) {
            $tenant = Tenant::where('tenant_id', $service->tenant_id)->first();
        } else {
            return redirect()->route('domainSelect')
                ->with('error', __('Select a domain first'));
        }
        $params = [
            'tenant' => $tenant,
        ];
        return view('central.smtp.create', $params);
    }

    public function store(Request $request)
    {
        $this->authorize('isNotAdmin', Authorize::class);
        try {
            $user = auth()->user();
            $service = Service::where('user_id', $user->id)->first();
            if($service) {
                $validator = Validator::make($request->all(), [
                    'smtp_email' => 'required',
                    'smtp_host' => 'required',
                    'smtp_port' => 'required | numeric',
                    'smtp_password' => 'required',
                    'smtp_encryption' => 'required',
                    'mail_from_name' => 'required',
                ]);
    
                if ($validator->fails()) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($validator);
                }

                $tenant = Tenant::where('tenant_id', $service->tenant_id)->first();
                $tenant->MAIL_MAILER = 'smtp';
                $tenant->MAIL_USERNAME = $request->smtp_email;
                $tenant->MAIL_HOST = $request->smtp_host;
                $tenant->MAIL_PORT = $request->smtp_port;
                $tenant->MAIL_PASSWORD = $request->smtp_password;
                $tenant->MAIL_ENCRYPTION = $request->smtp_encryption;
                $tenant->MAIL_FROM_ADDRESS = $request->smtp_email;
                $tenant->MAIL_FROM_NAME = $request->mail_from_name;
                $tenant->save();

                return redirect()->route('dashboard')
                    ->with('success', __('SMTP details updated'));
            } else {
                abort(404);
            }
            
        } catch (\Exception $e) {
            //TODO: add the error to the error log ?
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __($e->getMessage()));
        }
    }

   
}
