<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        $params = [
            'permissions' => $permissions,
        ];
        return view('tenant.permissions.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach($request->status as $uuid => $value) {
            $permission = Permission::where('uuid', $uuid)->first();
            $permission->status = $value;
            $permission->save();
        }
        return redirect()->route('permissions')
            ->with('success', __('Permissions updated'));
    }
}
