<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Customer' => 'App\Policies\CustomerPolicy',
         'App\Models\BillingAddress' => 'App\Policies\BillingAddressPolicy',
         'App\Models\ShippingAddress' => 'App\Policies\ShippingAddressPolicy',
         'App\Models\CustomerContact' => 'App\Policies\CustomerContactPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
            if ($user->hasRole('administrators')) {
                return true;
            }
        });
    }
}
