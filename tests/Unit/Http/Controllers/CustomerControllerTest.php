<?php

namespace Unit\Http\Controllers;

use App\Models\Customer;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::factory()->create();
        $role = $this->getRoleWithPermission('index-customer');
        $user->roles()->save($role);
        $user->refresh();

        $this->actingAs($user)
            ->get(route('customer.index'))
            ->assertViewIs('customers.index')
            ->assertOk();

        $user->delete();
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $role = $this->getRoleWithPermission('view-customer');

        $user->roles()->save($role);
        $user->refresh();

        $this->actingAs($user)
            ->get(route('customer.show', ['id' => $customer->id]))
            ->assertOk()
            ->assertViewIs('customers.show');

        $user->delete();
        $customer->delete();
    }

    private function getRoleWithPermission(string $permission) {
        return Role::whereHas('permissions', function(Builder $query) use($permission) {
            $query->where('identifier', '=', $permission);
        })->first();
    }
}
