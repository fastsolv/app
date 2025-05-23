<?php

namespace App\Policies;

use App\Models\Tenant\ErrorLog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ErrorLogPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role != 'user') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant\ErrorLog  $errorLog
     * @return mixed
     */
    public function view(User $user, ErrorLog $errorLog)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant\ErrorLog  $errorLog
     * @return mixed
     */
    public function update(User $user, ErrorLog $errorLog)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant\ErrorLog  $errorLog
     * @return mixed
     */
    public function delete(User $user, ErrorLog $errorLog)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant\ErrorLog  $errorLog
     * @return mixed
     */
    public function restore(User $user, ErrorLog $errorLog)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant\ErrorLog  $errorLog
     * @return mixed
     */
    public function forceDelete(User $user, ErrorLog $errorLog)
    {
        //
    }
}
