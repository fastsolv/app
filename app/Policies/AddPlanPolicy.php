<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Central\Plan;
use App\Models\Central\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddPlanPolicy
{
    use HandlesAuthorization;

    /**
     * Let's check whether there is a plan exist or not.
     */
    public function planExist(User $user)
    {
        $service = Service::where('user_id', $user->id)
        ->where('status_id', 1)
        ->latest()->first();
        if (!empty($service) && $service->plans->price !== 0.00){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Let's check whether the trial feature can be availed or not for the user.
     */
    public function trial(User $user)
    {
        $service = Service::where('user_id', $user->id)
        ->latest()->first();
        if(empty($service)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Let's check whether the user can down grade the plan at this moment.
     * it will apply only if the price that to be paid by the user is less than 0.
     * in other case they can downgrade the plan
     */
    public function downGrade(User $user, $price)
    {
        if ($price >= 0.00){
            return true;
        } else {
            return false;
        }
    }
}
