<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;
use Session;

use App\Models\Central\Services\DomainRegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use App\Helpers\Logger;
use App\Models\Tenant;
use App\Models\Central\Service;

class DomainRegisterController extends Controller
{

    public function domainSelect(Request $request)
    {
        $user = auth()->user();
        $service = Service::where('user_id', $user->id)->first();
        if(!$service) {
            abort(404);
        } else {
            $domainRegisterService = new DomainRegisterService();
            $central = $domainRegisterService->getCentralDomain();
            if(empty($central)) {
                 $central = $request->getHttpHost();
                 $domainRegisterService->setCentralDomain($central);
            }
            $params = [
                 'central' => $central
            ];
            return view('central.domain.register', $params);
        }

    }

    public function domainRegister(Request $request)
    {
        $this->authorize('isNotAdmin', Authorize::class);
        try {
            $validator = Validator::make($request->all(), [
                'sub_domain' => 'required | unique:App\Models\Tenant,id',
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            Session::put('sub_domain', $request->sub_domain);
            $priceId = session()->get('plan');
            if ($priceId) {
                session()->forget('plan');
                return redirect()->route('invoice', $priceId);
            } else {
                return redirect()->route('available_plans.index')
                    ->with('success', __('Please choose your plan'));
            }

        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __($e->getMessage()));
        }
    }
}
