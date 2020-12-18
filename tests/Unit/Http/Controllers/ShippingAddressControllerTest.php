<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\ShippingAddress;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use App\Policies\ShippingAddressPermission;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;
use Tests\TestHelpers;

class ShippingAddressControllerTest extends TestCase
{
    public function testShowCreateForm()
    {
        $customer = Customer::factory()->create();
        $user = User::factory()->create();
        $role = Role::whereHas('permissions', function(Builder $query) {
            $query->where('identifier', '=', ShippingAddressPermission::CREATE);
        })->first();

        $user->roles()->save($role);
        $user->refresh();

        $this->actingAs($user)
            ->get(route('customers.addresses.shipping.create', ['id' => $customer->id]))
            ->assertStatus(200);

        $customer->delete();
        $user->delete();
    }

    public function testStoreAddress() {
        $customer = Customer::factory()->create();
        $user = TestHelpers::createUserWithPermission(ShippingAddressPermission::CREATE);

        $this->actingAs($user)
            ->post(
                route('customers.addresses.shipping.store', ['id' => $customer->id]),
                ShippingAddress::factory()->make()->attributesToArray() // Valid shipping address
            )
            ->assertRedirect(route('customer.show', ['id' => $customer->id]))
            ->assertSessionHas(['success']);

        $invalidAddresses = [
            ShippingAddress::factory()->make(['name' => null]),
            ShippingAddress::factory()->make(['street' => null]),
            ShippingAddress::factory()->make(['zip' => null]),
            ShippingAddress::factory()->make(['zip' => '123a5']),
            ShippingAddress::factory()->make(['city' => null]),
        ];

        $route = route('customers.addresses.shipping.store', ['id' => $customer->id]);

        foreach($invalidAddresses as $address) {
            $this->actingAs($user)
                ->post($route, $address->attributesToArray())
                ->assertRedirect(route('customers.addresses.shipping.create', ['id' => $customer->id]));
        }

        $user->delete();
        $customer->delete();
    }

    public function testShowUpdateForm() {
        $customer = Customer::factory()->create();
        $address = ShippingAddress::factory(['customer_id' => $customer->id])->create();
        $customer->refresh();

        $user = TestHelpers::createUserWithPermission(ShippingAddressPermission::UPDATE);

        $this->actingAs($user)
            ->get(route('customers.addresses.shipping.edit', ['id' => $customer->id, 'address_id' => $address->id]))
            ->assertOk()
            ->assertViewIs('customers.addresses.shipping.edit');

        $customer->delete();
        $user->delete();
    }

    public function testUpdateAddress()
    {
        $customer = Customer::factory()->create();
        $address = ShippingAddress::factory(['customer_id' => $customer->id])->create();
        $customer->refresh();

        $user = TestHelpers::createUserWithPermission(ShippingAddressPermission::UPDATE);

        $route = route('customers.addresses.shipping.update', ['id' => $customer->id, 'address_id' => $address->id]);

        $this->actingAs($user)
            ->put($route, $address->attributesToArray())
            ->assertRedirect(route('customer.show', ['id' => $customer->id]))
            ->assertSessionHas(['success']);

        $route = route('customers.addresses.shipping.update', ['id' => $customer->id, 'address_id' => $address->id]);

        $this->actingAs($user)
            ->put($route, [])
            ->assertRedirect(route('customers.addresses.shipping.edit', ['id' => $customer->id, 'address_id' => $address->id]))
            ->assertSessionHasErrors(['name', 'street', 'zip', 'city']);

        $customer->delete();
        $user->delete();
    }
}
