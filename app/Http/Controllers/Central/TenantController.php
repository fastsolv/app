<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Central\Service;
use App\Models\Central\Services\DomainRegisterService;


class TenantController extends Controller
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
        $this->authorize('isAdmin', Authorize::class);
        //Query all tenants in descending order
        $query = Tenant::query()->orderBy('updated_at', 'DESC');
        //Filter tenants by by search keywords
        if ($request->search) {
            $search = $request->search;
            $query = $query->where('tenant_id', 'like', '%' . $search . '%')
            ->orWhere('id', 'like', '%' . $search . '%');
        }
        $tenants = $query->paginate(10);
        if (count($tenants)){
            foreach ($tenants as $tenant) {
                $service = Service::where('tenant_id', $tenant->tenant_id)->first();
                if ($service) {
                    $user[$tenant->id] = $service->user->first_name." ".$service->user->last_name;
                } else {
                    $user[$tenant->id] = null;
                }

            }
        } else {
            $user = null;
        }
        $domainRegisterService = new DomainRegisterService();
        $central = $domainRegisterService->getCentralDomain();
        if(empty($central)) {
            $central = $request->getHttpHost();
            $domainRegisterService->setCentralDomain($central);
        }
        $protocol = $domainRegisterService->getProtocol();
        if(empty($protocol)) {
            $protocol = 'http://';
            $domainRegisterService->setProtocol($protocol);
        }

        $params = [
            'user' => $user,
            'tenants' => $tenants,
            'request' => $request,
            'central' => $domainRegisterService->getCentralDomain(),
            'protocol' => $protocol
        ];
        return view('central.tenant.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('isAdmin', Authorize::class);
        //Get the service
        $tenant = Tenant::find($id);
        return view('central.tenant.edit', $tenant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin', Authorize::class);
        //Get the service
        $tenant = Tenant::find($id);
        if($request->status == 1) {
            $tenant->status = true;
        } else {
            $tenant->status = false;
        }
        $tenant->save();

        return redirect()->route('tenants.index')
            ->with('success', __('Tenant updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
