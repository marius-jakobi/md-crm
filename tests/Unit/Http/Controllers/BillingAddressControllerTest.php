<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\BillingAddress;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use App\Policies\BillingAddressPermission;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;
use Tests\TestHelpers;

class BillingAddressControllerTest extends TestCase
{
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
            ->get(route('customers.addresses.billing.create', ['id' => $customer->id]))
            ->assertStatus(200);

        $customer->delete();
        $user->delete();
    }

    public function testStoreAddress() {
        $customer = Customer::factory()->create();
        $user = TestHelpers::createUserWithPermission(BillingAddressPermission::CREATE);

        $this->actingAs($user)
            ->post(
                route('customers.addresses.billing.store', ['id' => $customer->id]),
                BillingAddress::factory()->make()->attributesToArray() // Valid billing address
            )
            ->assertRedirect(route('customer.show', ['id' => $customer->id]))
            ->assertSessionHas(['success']);

        $invalidAddresses = [
            BillingAddress::factory()->make(['name' => null]),
            BillingAddress::factory()->make(['street' => null, 'po_box' => null]),
            BillingAddress::factory()->make(['zip' => null]),
            BillingAddress::factory()->make(['zip' => '123a5']),
            BillingAddress::factory()->make(['city' => null]),
        ];

        $route = route('customers.addresses.billing.store', ['id' => $customer->id]);

        foreach($invalidAddresses as $address) {
            $this->actingAs($user)
                ->post($route, $address->attributesToArray())
                ->assertRedirect(route('customers.addresses.billing.create', ['id' => $customer->id]));
        }

        $user->delete();
        $customer->delete();
    }

    public function testShowUpdateForm() {
        $customer = Customer::factory()->create();
        $address = BillingAddress::factory(['customer_id' => $customer->id])->create();
        $customer->refresh();

        $user = TestHelpers::createUserWithPermission(BillingAddressPermission::UPDATE);

        $this->actingAs($user)
            ->get(route('customers.addresses.billing.edit', ['id' => $customer->id, 'address_id' => $address->id]))
            ->assertOk()
            ->assertViewIs('customers.addresses.billing.edit');

        $customer->delete();
        $user->delete();
    }

    public function testUpdateAddress()
    {
        $customer = Customer::factory()->create();
        $address = BillingAddress::factory(['customer_id' => $customer->id])->create();
        $customer->refresh();

        $user = TestHelpers::createUserWithPermission(BillingAddressPermission::UPDATE);

        $route = route('customers.addresses.billing.update', ['id' => $customer->id, 'address_id' => $address->id]);

        $this->actingAs($user)
            ->put($route, $address->attributesToArray())
            ->assertRedirect(route('customer.show', ['id' => $customer->id]))
            ->assertSessionHas(['success']);

        $route = route('customers.addresses.billing.update', ['id' => $customer->id, 'address_id' => $address->id]);

        $this->actingAs($user)
            ->put($route, [])
            ->assertRedirect(route('customers.addresses.billing.edit', ['id' => $customer->id, 'address_id' => $address->id]))
            ->assertSessionHasErrors(['name', 'street', 'po_box', 'zip', 'city']);

        $customer->delete();
        $user->delete();
    }
}
