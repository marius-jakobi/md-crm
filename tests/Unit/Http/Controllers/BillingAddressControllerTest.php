<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use App\Policies\BillingAddressPermission;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class BillingAddressControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testShowCreateForm()
    {
        $customer = Customer::factory()->create();
        $user = User::factory()->create();
        $role = Role::whereHas('permissions', function(Builder $query) {
            $query->where('identifier', '=', BillingAddressPermission::CREATE);
        })->first();

        $user->roles()->save($role);
        $user->refresh();

        $this->actingAs($user)
            ->get(route('customers.addresses.shipping.create', ['id' => $customer->id]))
            ->assertStatus(200);

        $customer->delete();
        $user->delete();
    }
}
