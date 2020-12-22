<?php

namespace App\Policies;

use App\Models\CustomerContact;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission(CustomerContactPermission::INDEX);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CustomerContact  $customerContact
     * @return mixed
     */
    public function view(User $user, CustomerContact $customerContact)
    {
        return $user->hasPermission(CustomerContactPermission::VIEW);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission(CustomerContactPermission::CREATE);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CustomerContact  $customerContact
     * @return mixed
     */
    public function update(User $user, CustomerContact $customerContact)
    {
        return $user->hasPermission(CustomerContactPermission::UPDATE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CustomerContact  $customerContact
     * @return mixed
     */
    public function delete(User $user, CustomerContact $customerContact)
    {
        return $user->hasPermission(CustomerContactPermission::DELETE);
    }
}
