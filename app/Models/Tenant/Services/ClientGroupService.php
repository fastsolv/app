<?php

namespace App\Models\Tenant\Services;

use App\Models\User;
use App\Models\Tenant\ClientGroup;
use App\Helpers\Uuid;
use Auth;

class ClientGroupService
{

    public function getClientGroups($request)
    {
       //Query all users
       $query = ClientGroup::query();
       $query->orderBy('created_at', 'DESC');
       //Filter users by by search keywords
       if ($request->search) {
           $query = $query->where('name', 'like', '%' . $request->search . '%');
       }

       $client_groups = $query;
       return $client_groups;
    }

    public function addGroups($request)
    {
        $client_group = new ClientGroup;
        $client_group->uuid = Uuid::getUuid();
        $client_group->name = $request->name;
        $client_group->description = $request->description;
        $client_group->status = $request->status;
        $client_group->save();
        return $client_group;
    }
}
