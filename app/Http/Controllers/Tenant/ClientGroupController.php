<?php

namespace App\Http\Controllers\Tenant;

use App\Helpers\Logger;
use App\Http\Controllers\Controller;

use App\Models\Tenant\ClientGroup;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Tenant\Services\ClientGroupService;
use Illuminate\Support\Facades\Validator;       

class ClientGroupController extends Controller
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
        $this->authorize('isNotUser', Authorize::class);
        $clientGroupService = new ClientGroupService();

        $client_groups = $clientGroupService->getClientGroups($request)->paginate(10);

        $params = [
            'client_groups' => $client_groups,
            'request' => $request,
        ];
        return view('tenant.client_groups.index', $params);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isNotUser', Authorize::class);
        $clients = User::where('role', 'user')->get();
        $params = [
            'clients' => $clients,
        ];

        return view('tenant.client_groups.create', $params);
    }

    public function store(Request $request)
    {
        $this->authorize('isNotUser', Authorize::class);
        try {
            //Form validation
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'client_ids' => 'required',
                'status' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $clientGroupService = new ClientGroupService();
            $client_group = $clientGroupService->addGroups($request);
            $clients = explode(",", $request->client_ids);
            $client_group->clients()->sync($clients);

            return redirect()->route('client_groups.index')
                ->with('success', __('Client group added'));
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __($e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant\ClientGroup  $clientGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ClientGroup $clientGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant\ClientGroup  $clientGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $this->authorize('isNotUser', Authorize::class);
        $client_group = ClientGroup::find($uuid);
        $selected_clients = $client_group->clients()->pluck('users.id')->toArray();

        $params = [
            'client_group' => $client_group,
            'selected_clients' => $selected_clients,
        ];
        return view('tenant.client_groups.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant\ClientGroup  $clientGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $this->authorize('isNotUser', Authorize::class);
        try {
            //Form validation
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'client_ids' => 'required',
                'status' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $client_group = ClientGroup::find($uuid);
            $client_group->update($request->all());

            $clients = explode(",", $request->client_ids);
            $client_group->clients()->sync($clients);

            return redirect()->route('client_groups.index')
                ->with('success', __('Client group updated'));
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __($e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant\ClientGroup  $clientGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->authorize('isNotUser', Authorize::class);
        $client_group = ClientGroup::find($uuid);
        $client_group->delete();
        return redirect()->route('client_groups.index')
            ->with('success', __('Client group deleted'));
    }

    public function getClientsApi(Request $request)
    {
        $clients = User::where('role', 'user')->get();
        return response($clients, 200);
    }
}
