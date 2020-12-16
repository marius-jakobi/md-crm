<?php

namespace App\Policies;

use App\Models\BillingAddress;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillingAddressPolicy
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
        return $user->hasPermission(BillingAddressPermission::INDEX);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BillingAddress  $billingAddress
     * @return mixed
     */
    public function view(User $user, BillingAddress $billingAddress)
    {
        return $user->hasPermission(BillingAddressPermission::VIEW);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission(BillingAddressPermission::CREATE);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BillingAddress  $billingAddress
     * @return mixed
     */
    public function update(User $user, BillingAddress $billingAddress)
    {
        return $user->hasPermission(BillingAddressPermission::UPDATE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BillingAddress  $billingAddress
     * @return mixed
     */
    public function delete(User $user, BillingAddress $billingAddress)
    {
        return $user->hasPermission(BillingAddressPermission::DELETE);
    }
}
