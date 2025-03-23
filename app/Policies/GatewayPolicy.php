<?php

namespace App\Policies;

use App\Models\Central\Gateway;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GatewayPolicy
{
    use HandlesAuthorization;

    /**
     * Let's check whether the selected gateway is activated or not
     * Other wise user can't use that gateway
     */
    public function view(User $user, Gateway $gateway, $gatewayName)
    {
        $gateway = Gateway::where('name', $gatewayName)->first();
        if ($gateway->status == true){
            return true;
        } else {
            return false;
        }
    }
}
